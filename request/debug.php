<?php
	session_start();
	//获取填写的用户名和密码
	$userid = "11331257";
	$password = "1234";
	$passwordAga = "1234";
	$loginType = 1;
	
	
	$_SESSION['userid']=$userid;
	
	if($userid == ""){
		$arr["status"] = "emptyUserid";
	}
	else if($password == ""){
		$arr["status"] = "emptyPassword";
	}
	else if($loginType == 0 && $userid == "admin"){
		//连接数据库
		$con = mysql_connect("localhost", "root", "minikays2013");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}	
		//选择成长轨的数据库
		$db_selected = mysql_select_db("growthtrack",$con);
		
		//解决中文乱码的问题
		$anosql = "set names utf8";
		mysql_query($anosql,$con);
		
		$sql = "select * from users where sid = '$userid'";
		$result = mysql_query($sql,$con);
		$result=mysql_fetch_array($result);
		$encrypt = sha1($password);
		if($encrypt == $result["password"]){
			$arr["status"] = "adminSuccess";
			$_SESSION['valid_user'] = $userid;
		}
		else{
			$arr["status"] = "unmatch";
		}
		mysql_close($con);
	}
	else if($loginType == 1 && $passwordAga == ""){
		$arr["status"] = "emptyPasswordAga";
	}
	else if($loginType == 1 && !is_numeric($userid)){
		$arr["status"] = "UseridNotNum";
	}
	else if($loginType == 1 && $passwordAga != $password){
		$arr["status"] = "passwordNotMatch";
	}
	else if($loginType == 0){
		//连接数据库
		$con = mysql_connect("localhost", "root", "minikays2013");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}	
		//选择成长轨的数据库
		$db_selected = mysql_select_db("growthtrack",$con);
		
		//解决中文乱码的问题
		$anosql = "set names utf8";
		mysql_query($anosql,$con);
		
		$sql = "select * from users where sid = '$userid'";
		$result = mysql_query($sql,$con);
		$rowNum = mysql_num_rows($result);
		if($rowNum <= 0){
			$arr["status"] = "noUser";
		}
		else{
			$result=mysql_fetch_array($result);
			$encrypt = sha1($password);
			if($encrypt == $result["password"]){
				$arr["status"] = "success";
				$_SESSION['valid_user'] = $userid;
			}
			else{
				$arr["status"] = "unmatch";
			}
		}
		mysql_close($con);
	}
	else{
		//连接数据库
		$con = mysql_connect("localhost", "root", "minikays2013");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}	
		//选择成长轨的数据库
		$db_selected = mysql_select_db("growthtrack",$con);
		
		//解决中文乱码的问题
		$anosql = "set names utf8";
		mysql_query($anosql,$con);
		
		$sql = "select * from users where sid = '$userid'";
		$result = mysql_query($sql,$con);
		$rowNum = mysql_num_rows($result);
		if($rowNum <= 0){
			$encrypt = sha1($password);
			$sql = "insert into users values('$userid','$encrypt')";
			mysql_query($sql,$con);
			$arr["status"] = "success";
			$_SESSION['valid_user'] = $userid;
		}
		else{
			$arr["status"] = "userExist";
		}
		
		mysql_close($con);
	}
	echo json_encode($arr);

?>
