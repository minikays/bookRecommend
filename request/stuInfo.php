<?php
	$con = mysql_connect("localhost", "root", "ab7df0e4e6");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("growthtrack",$con);
	
	$anosql = "set names utf8";
	mysql_query($anosql,$con);
	
	$sid = $_POST['sid'];
	$fillYear = $_POST['fillYear'];
	//$sid = "11330001";
	//$fillYear = "2013";
	
	$sql = "SELECT * from info1 where sid = '$sid' and fillYear = '$fillYear' ";
	$result = mysql_query($sql,$con);
	$info1 = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$count = 0;
	if($info1) $count++;
	if ($count != 0)
	{
		$arr["exist"] = "Y";
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','Info1',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$arr[$field_name] = $info1["$field_name"];
		}
		
		//对发表文章的处理
		$arr["paper"] = "";
		if($info1["paper"]!="")
		{
			$tmp1 = explode("&&&",$info1["paper"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($paper,$tmp2) = explode("&&1",$tmp1[$i]);
				list($magazine,$suitDate) = explode("&&2",$tmp2);
				$arr["paper"] = $arr["paper"]."文章名："."$paper"." 发表刊物：".$magazine." 发表时间：".$suitDate." ";
			}
		}
		//对助学金的处理
		$arr["grantsInAid"] = "";
		if($info1["grantsInAid"]!=""){
			$tmp1 = explode("&&&",$info1["grantsInAid"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["grantsInAid"] = $arr["grantsInAid"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		$arr["loan"] = "";
		if($info1["loan"]!=""){
			$tmp1 = explode("&&&",$info1["loan"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["loan"] = $arr["loan"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		$arr["partTimeJob"] = "";
		if($info1["partTimeJob"]!=""){
			$tmp1 = explode("&&&",$info1["partTimeJob"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["partTimeJob"] = $arr["partTimeJob"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		$arr["Allowance"] = "";
		if($info1["Allowance"]!=""){
			$tmp1 = explode("&&&",$info1["Allowance"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["Allowance"] = $arr["Allowance"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		
		$arr["scholarship"] = "";
		if($info1["scholarship"]!=""){
			$tmp1 = explode("&&&",$info1["scholarship"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["scholarship"] = $arr["scholarship"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		
		$sql = "SELECT * from info2 where sid = '$sid' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$info2 = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','Info2',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$arr[$field_name] = $info2["$field_name"];
		}
		
		$arr["churchyard"]="";
		$arr["abroad"]="";
		$sql = "SELECT * from tour where sid = '$sid' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$rowNum = mysql_num_rows($result);
		for($i=0;$i<$rowNum;$i++){
			$tour = mysql_fetch_array($result,MYSQL_ASSOC);
			if($tour["place"]!=""){
				list($tour["startDate"],$tour["endDate"]) = explode("&&1",$tour["time"]);
				if($tour["place"]!="中国"){
					$arr["abroad"] = $arr["abroad"]."国家/地区:".$tour["place"]." 主题:".$tour["theme"]." 举办单位:".$tour["hostEntity"]." 开始日期:".$tour["startDate"]." 结束日期".$tour["endDate"]." 时长:".$tour["days"]." ";
				}
				else{
					$arr["churchyard"] = $arr["churchyard"]."地区:".$tour["place"]." 主题:".$tour["theme"]." 举办单位:".$tour["hostEntity"]." 开始日期:".$tour["startDate"]." 结束日期".$tour["endDate"]." 时长:".$tour["days"]." ";
				}
			}
		}
		
		$arr["patent"] = "";
		$sql = "SELECT * from patent where sid = '$sid' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$rowNum = mysql_num_rows($result);
		for($i=0;$i<$rowNum;$i++){
			$patent = mysql_fetch_array($result,MYSQL_ASSOC);
			if($patent["patentType"]!=""){
				$arr["patent"] = $arr["patent"]."专利类型：".$patent["patentType"]." 专利号：".$patent["patentId"]." 专利内容：".$patent["patentId"]." ";
			}
		}
		
		$arr["inside"] = "";
		$arr["outside"] = "";
		$sql = "SELECT * from prize where sid = '$sid' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$rowNum = mysql_num_rows($result);
		for($i=0;$i<$rowNum;$i++){
			$prize = mysql_fetch_array($result,MYSQL_ASSOC);
			if($prize["level"]=="国家级"||$prize["level"]=="省级")
				$arr["outside"] = $arr["outside"]."级别:".$prize["level"]." 内容：".$prize["content"]."   颁奖单位:".$prize["gavecommitte"]." ";
			else
				$arr["inside"] = $arr["inside"]."级别:".$prize["level"]." 内容：".$prize["content"]."   颁奖单位:".$prize["gavecommitte"]." ";
		}
		
		
	}
	else $arr["exist"] = "N";
	$arr["fillYear"] = $fillYear;
	
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
?>