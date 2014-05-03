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
	
	$sid = $_SESSION['userid'];
	$s1 = $_POST['s1'];
	$s2 = $_POST['s2'];
	$s3 = $_POST['s3'];
	
	//判断密码
	//三个输入值其中一个为空；

	if ($s1 == '' || $s2 == '' || $s3 == '')	$arr["empty"] = "Y";
	else
	{
		
		$arr["empty"] = "N";
		//旧密码与数据库不一致；
		$sql="SELECT password FROM users WHERE sid='$sid'"; 
		$result=mysql_fetch_array(mysql_query($sql)); 
		if($result['password'] != sha1($s1)) $arr["oldNotEqual"] = "Y";
		else
		{
			$arr["oldNotEqual"] = "N";
			//两个新密码不一致；
			if($s2 != $s3)	$arr["newNotEqual"] = "Y";
			else
			{
				$s2 = sha1($s2);
				$result= mysql_query("update users set password='$s2' where sid='$sid'"); 
			}
		}
	}
	
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
?>