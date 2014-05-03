<?php
	session_start();
	$old_user = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	session_destroy();
?>
<!doctype html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<title>注销成功</title>
	</head>
	<body>
		<p>您已经成功退出。</p>
		<p>请按<a href = "login.html">这里</a>转到登录界面</p>
	</body>
</html>