<html>

    <head>
        <title>
            �޸�����
        </title>
    </head>
    <body>
<?php
	$con = mysql_connect("localhost", "root", "ab7df0e4e6");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("growthtrack",$con);
	
	$anosql = "set names utf8";
	mysql_query($anosql,$con);
    $userid = $_POST["userid"];
    $oldpassword = $_POST["oldpassword"];
	$newpassword = $_POST["newpassword1"];
	
	$sql = "select password from users where sid = '$userid'";
	$result = mysql_query($sql,$con);
	$ps = mysql_fetch_array($result,MYSQL_ASSOC);
	$pwd = sha1($newpassword);
	if ($ps["password"] != sha1($oldpassword)){
		echo "�Բ����������ԭ��������";

		mysql_close($con);
	}
	else{
		$sql = "update users set password = '$pwd' where sid = '$userid'";

		mysql_query($sql,$con);
      //  printf("%d", mysql_affected_rows());
        
        
		mysql_close($con);
		echo "�ɹ�";
	}
?>

    <p align = 'center'>�밴<a href = "../login.html">����</a>ת����¼����</p>



</html>