<?php
	$con = mysql_connect("localhost", "root", "ab7df0e4e6");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("growthtrack",$con);
	
	$anosql = "set names utf8";
	mysql_query($anosql,$con);
	
	$grade = $_POST['grade'];
	$fillYear = $_POST['fillYear'];
	$should_pass = $_POST['should_pass'];
	//$grade="大二";
	//$fillYear = "2013";
	//$should_pass = 5;
	$arr["grade"] = $grade;
	$arr["should_pass"] = "$should_pass";
	
	$sql = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear' ";
	$result=mysql_fetch_array(mysql_query($sql)); 
	$count=$result['count']; 
	$fact_pass = $count;
	$arr["fact_pass"] = "$count";
	
	$not_pass = $should_pass - $fact_pass;
	$arr["not_pass"] = "$not_pass";
	
	if($count == 0 || $arr["not_pass"]<0 )   $arr["exist"] = "N";
	else
	{
		$arr["exist"] = "Y";
		
		$sql = "SELECT * from info1 where grade = '$grade' and fillYear = '$fillYear' ";
		$result = mysql_query($sql,$con);
		$info1 = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','Info1',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			
			$sql1 = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear' and $field_name = '' ";
			$result1=mysql_fetch_array(mysql_query($sql1)); 
			$count1=$result1['count'];
			//统计数量
			$count1 = $fact_pass - $count1;
			$arr[$field_name] = "$count1";
			
			//统计百分比
			$field_name1 = $field_name.'Percent';
			$percent = round($count1/$fact_pass,4) * 100;
			$arr[$field_name1] = "$percent";
		}
		
		
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear' ";
		$result = mysql_query($sql,$con);
		$info2 = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','Info2',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			
			$sql1 = "SELECT count(*) AS count from info2 where grade = '$grade' and fillYear = '$fillYear' and $field_name = '' ";
			$result1=mysql_fetch_array(mysql_query($sql1)); 
			$count1=$result1['count'];
			//统计数量
			$count1 = $fact_pass - $count1;
			$arr[$field_name] = "$count1";
			
			//统计百分比
			$field_name1 = $field_name.'Percent';
			$percent = round($count1/$fact_pass,4) * 100;
			$arr[$field_name1] = "$percent";
		}
		
		//申请专利情况
		$sql = "SELECT count(distinct(sid)) AS count from patent where grade = '$grade' and fillYear = '$fillYear' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$arr["patent"] = "$count";
		$percent = round($count/$fact_pass,4) * 100;
		$arr["patentPercent"] = "$percent";
		
		//短期游学交流
		$sql = "SELECT count(distinct(sid)) AS count from tour where grade = '$grade' and fillYear = '$fillYear' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$arr["tour"] = "$count";
		$percent = round($count/$fact_pass,4) * 100;
		$arr["tourPercent"] = "$percent";
		
		//获奖情况
		$sql = "SELECT count(distinct(sid)) AS count from prize where grade = '$grade' and fillYear = '$fillYear' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$arr["prize"] = "$count";
		$percent = round($count/$fact_pass,4) * 100;
		$arr["prizePercent"] = "$percent";
		
		//接受资助情况
		$sql = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear' and grantsInAid = '' and loan = ''  and partTimeJob='' and Allowance='' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$count1 = $fact_pass - $count;
		$arr["help"] = "$count1";
		$percent = round($count1/$fact_pass,4) * 100;
		$arr["helpPercent"] = "$percent";
		
		//党员人数
		$sql = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear' and politics = '党员' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$arr["partyMemNum"] = "$count";
		
		
		//第二个表格的内容
		//阅读经典书籍
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$bookcnt = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$bookcnt += $row['bookNum'];
		}
		$avgBookNum =  round($bookcnt/$fact_pass,2);
		$arr["avgBookNum"] = $avgBookNum;
		
		//参加公益时长
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$charityHourscnt = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$charityHourscnt += $row['charityHours'];
		}
		$avgcharityHoursNum =  round($charityHourscnt/$fact_pass,2);
		$arr["avgcharityHoursNum"] = $avgcharityHoursNum;
		
		//参加集体活动次数
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$groupActTimescnt = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$groupActTimescnt += $row['groupActTimes'];
		}
		$avggroupActTimesNum =  round($groupActTimescnt/$fact_pass,2);
		$arr["avggroupActTimesNum"] = $avggroupActTimesNum;
		
		//每天参加课外锻炼时长
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$trainHourscnt = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$trainHourscnt += $row['trainHours'];
		}
		$avgtrainHoursNum =  round($trainHourscnt/$fact_pass,2);
		$arr["avgtrainHoursNum"] = $avgtrainHoursNum;
		
		//短期游学交流次数
		$sql = "SELECT count(*) AS count from tour where grade = '$grade' and fillYear = '$fillYear' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		//$arr["Tourcnt"] = "$count";
		$avgTourNum =  round($count/$fact_pass,2);
		$arr["avgTourNum"] = $avgTourNum;
		
		//获得奖项次数
		$sql = "SELECT count(*) AS count from prize where grade = '$grade' and fillYear = '$fillYear' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$avgPrizeNum =  round($count/$fact_pass,2);
		$arr["avgPrizeNum"] = $avgPrizeNum;
		
		//其他经历次数
		$arr["avgOtherExpNum"] = round($arr["otherExp"]/$fact_pass,2);
	}
	
	
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
?>