<?php
	session_start();
	$con = mysql_connect("localhost", "root", "ab7df0e4e6");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("growthtrack",$con);
	
	$anosql = "set names utf8";
	mysql_query($anosql,$con);
	
	
	$s1 = $_POST['s1'];
	$s2 = $_POST['s2'];
	$s3 = $_POST['s3'];
	
	//判断密码
	//三个输入值其中一个为空；

	if ($s1 == '' || $s2 == '' || $s3 == '')	$arr["empty"] = "Y";
	else
	{
		$sql = "SELECT * from users where sid = '$s1'";
		$result = mysql_query($sql,$con);
		$info1 = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$count = 0;
		if($info1) $count++;
		if ($count != 0)   $arr["exist"] = "Y";
		else
		{
			$arr["exist"] = "N";
			if($s2 != $s3)  $arr["pwEqual"] = "N";
			else
			{
				$arr["pwEqual"] = "Y";
				$s2 = sha1($s2);
				$result= mysql_query("insert into users(sid,password) values ('$s1','$s2')"); 
			}
		}
	}
	
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
?>