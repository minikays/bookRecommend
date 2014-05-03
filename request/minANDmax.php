<?php
	$con = mysql_connect("localhost", "root", "ab7df0e4e6");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("growthtrack",$con);
	
	$anosql = "set names utf8";
	mysql_query($anosql,$con);
	
	$department = $_POST['department'];
	$fromYear = $_POST['fromYear'];
	$toYear = $_POST['toYear'];
	//$fromYear = "2012";
	//$toYear = "2013";
	
	$arr["toYear"] = $toYear;
	$arr["fromYear"] = $fromYear;
	
	$sql = "SELECT * from info1 where department = '$department' and fillYear <= '$toYear' and fillYear >= '$fromYear'";
	$result = mysql_query($sql,$con);
	$info1 = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$count = 0;
	if($info1) $count++;
	if ($count != 0)
	{
		$arr["exist"] = "Y";
		
		//求最小值
		$sql = "SELECT min(sid) as minSid from info1 where department = '$department' and fillYear <= '$toYear' and fillYear >= '$fromYear'";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$arr["minSid"]=$result['minSid'];
		
		//求最大值
		$sql = "SELECT max(sid) as maxSid from info1 where department = '$department' and fillYear <= '$toYear' and fillYear >= '$fromYear'";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$arr["maxSid"]=$result['maxSid'];
	}
	else $arr["exist"] = "N";
	
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
?>