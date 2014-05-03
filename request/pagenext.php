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
	$nowSid = $_POST['nowSid'];
	$maxSid = $_POST['maxSid'];
	
	//$fromYear = "2012";
	//$toYear = "2013";
	
	if ($nowSid == $maxSid) $arr["exist"] = "E";
	else
	{
		
			$sql = "SELECT min(sid) as retID from info1 where department = '$department' and fillYear <= '$toYear' and fillYear >= '$fromYear' and sid >'$nowSid' ";
			$result=mysql_fetch_array(mysql_query($sql)); 
			$retID=$result['retID'];
			
			
			$arr["nowSid"] = $retID;
			$arr["exist"] = "Y";
		
	}
	
	
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
?>