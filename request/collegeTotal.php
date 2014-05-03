<?php
	$con = mysql_connect("localhost", "root", "ab7df0e4e6");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("growthtrack",$con);
	
	$anosql = "set names utf8";
	mysql_query($anosql,$con);
	
	
	$fillYear = $_POST['fillYear'];
	//$fillYear = "2013";
	
	$sql = "SELECT * from statics where department = '全校' and fillYear = '$fillYear' ";
	$result = mysql_query($sql,$con);
	$statics = mysql_fetch_array($result,MYSQL_ASSOC);
	
	//判断是否数据库中是否有这个数据；
	$count = 0;
	if($statics) $count++;
	if ($count != 0)
	{
		$arr["exist"] = "Y";
			
			
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','statics',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$arr[$field_name] = $statics["$field_name"];
		}
		
		//统计书本信息
		
		$sql = "SELECT * from books where fillYear = '$fillYear' ORDER BY bookNum desc LIMIT 0,19";
		$result = mysql_query($sql,$con);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','books',$con);
		$r = array();
		$count = 0;
		while($row = mysql_fetch_assoc($result))
		{
			for ($k=0; $k<$totalNum; $k++)
			{
				$field_name=mysql_field_name($result_field,$k);
				$r[$count][$field_name] = $row["$field_name"];
			}
			$count++;
		}
		$arr["bookRank"] = $r;
		
		$totaldays = 0;
		//游历国家
		$sql = "SELECT place,days from tour where fillYear = '$fillYear' ";
		$result = mysql_query($sql,$con);
		$ret = array();
		$r = array();
		$count = 0;
		$tourNum = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$ret[] = $row["place"];
			$totaldays += $row["days"];
		}
		$ret = array_count_values($ret);
		$arr_cnt = count($ret);
		for ($i=0; $i<$arr_cnt; $i++)
		{
			$key =key($ret);
			$r[$i]["place"] = "$key";
			$r[$i]["cnt"] = "$ret[$key]";
			$tourNum += $ret[$key];
			next($ret);
		}
		$arr["tour"] = $r;
		$arr["tourNum"] = $tourNum;
		
		
		//参与游历国家总人数；
		$sql="SELECT COUNT(distinct(sid)) AS count FROM tour WHERE fillYear = '$fillYear'"; 
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count']; 
		$arr["cntTourNum"] = "$count";
		
		//参与游历国家总次数；
		$sql="SELECT COUNT(*) AS count FROM tour WHERE fillYear = '$fillYear'"; 
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$arr["cntTourTimes"] = "$count";
		
		//平均游历次数；
		if($arr["stuNum"] != 0)
			{
				$arr["avgTourTimes"] = ($arr["cntTourTimes"]) / ($arr["stuNum"]);
				$arr["avgTourTimes"] = floor($arr["avgTourTimes"]*100)/100;
			}
		else
			$arr["avgTourTimes"] = 0;
		
		//平均时长
		if($arr["cntTourTimes"] != 0)
		{
			$arr["avgTourDay"] = ($totaldays / $arr["cntTourTimes"]);
			$arr["avgTourDay"] = floor($arr["avgTourDay"]*100)/100;
		}
		else
			$arr["avgTourDay"] = 0;
	}
	else $arr["exist"] = "N";
	
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
?>