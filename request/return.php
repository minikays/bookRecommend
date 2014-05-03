<?php
	session_start();
	if(!isset($_SESSION['valid_user']))
		header("location:../not_login.html");
		
	$sid = $_SESSION['valid_user'];
	$fillYear = date("Y");
	//$sid = 11331257;
	//$fillYear = 2013;
	
	//连接数据库
	$con = mysql_connect("localhost", "root", "ab7df0e4e6");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	//选择成长轨数据库
	$db_selected = mysql_select_db("growthtrack",$con);
	
	//解决中文乱码问题
	$anosql = "set names utf8";
	mysql_query($anosql,$con);
	
	$sql = "SELECT * from info1 where sid = '$sid' and fillYear = '$fillYear'";
	$result = mysql_query($sql,$con);
	$info1 = mysql_fetch_array($result,MYSQL_ASSOC);
	$number = mysql_num_rows($result);
	
	if($number >= 1){
		$arr["basic1"]["name"] = $info1["name"];
		$arr["basic1"]["gender"] = $info1["gender"];
		$arr["basic1"]["department"] = $info1["department"];
		$arr["basic1"]["major"] = $info1["major"];
		$arr["basic1"]["grade"] = $info1["grade"];
		$arr["basic1"]["myclass"] = $info1["class"];
	
		$arr["basic2"]["politics"] = $info1["politics"];
		$arr["basic2"]["phoneNum"] = $info1["phoneNum"];
		$arr["basic2"]["qq"] = $info1["qq"];
		$arr["basic2"]["email"] = $info1["email"];
		$arr["basic2"]["dorm"] = $info1["dorm"];
	
		$arr["charity"]["charityAct"] = $info1["charityAct"];
	
		$arr["readClassicBook"]["book"] = $info1["book"];
	
		$arr["competitionSituation"]["competition"] = $info1["competition"];
	
		$arr["activity"]["groupAct"] = $info1["groupAct"];
	
		$arr["sciAndPro"]["sicPro"] = $info1["sciPro"];			//我没写错
	
		//对paper的处理
		$tmp1 = explode("&&&", $info1["paper"]);
		if($tmp1[0] != "")
		{
			$sz = sizeof($tmp1);
			for ($i = 0; $i < $sz; $i++){
				$tmp2 = explode("&&1", $tmp1[$i]);
				$arr["suitPaper"][$i]["paper"] = $tmp2[0];
				$tmp3 = explode("&&2", $tmp2[1]);
				$arr["suitPaper"][$i]["magazine"] = $tmp3[0];
				$arr["suitPaper"][$i]["suitDate"] = $tmp3[1];	
			}
		}
		else
		{
			$arr["suitPaper"][0]["paper"] = "";
			$arr["suitPaper"][0]["magazine"] = "";
			$arr["suitPaper"][0]["suitDate"] = "";
		}
		$arr["study"]["failSub"] = $info1["failSub"];
		$arr["study"]["GPA"] = $info1["GPA"];
		
		$arr["occupationSituation"]["occupation"] = $info1["occupation"];
	
		$arr["training"]["train"] = $info1["train"];
	
		$grantNum = 0;
		$tmp1 = explode("&&&", $info1["grantsInAid"]);
		if($tmp1[0]!=0){
			$sz = sizeof($tmp1);
			for ($i = 0; $i < $sz; $i++){
				$arr["studentGrant"][$grantNum]["type"] = "助学金";
				$tmp2 = explode("&&1", $tmp1[$i]);
				$arr["studentGrant"][$grantNum]["money"] = $tmp2[0]; 
				$tmp3 = explode("&&2", $tmp2[1]);
				$arr["studentGrant"][$grantNum]["obtainTime"] = $tmp3[0];
				$arr["studentGrant"][$grantNum]["workTime"] = $tmp3[1];
				$grantNum++;
			}
		}
		
		$tmp1 = explode("&&&", $info1["scholarship"]);
		if($tmp1[0]!=0){
			$sz = sizeof($tmp1);
			for ($i = 0; $i < $sz; $i++){
				$arr["studentGrant"][$grantNum]["type"] = "奖学金";
				$tmp2 = explode("&&1", $tmp1[$i]);
				$arr["studentGrant"][$grantNum]["money"] = $tmp2[0]; 
				$tmp3 = explode("&&2", $tmp2[1]);
				$arr["studentGrant"][$grantNum]["obtainTime"] = $tmp3[0];
				$arr["studentGrant"][$grantNum]["workTime"] = $tmp3[1];
				$grantNum++;
			}
		}
		
		
		$tmp1 = explode("&&&", $info1["grantsInAid"]);
		if($tmp1[0]!=0){
			$sz = sizeof($tmp1);
			for ($i = 0; $i < $sz; $i++){
				$arr["studentGrant"][$grantNum]["type"] = "助学金";
				$tmp2 = explode("&&1", $tmp1[$i]);
				$arr["studentGrant"][$grantNum]["money"] = $tmp2[0]; 
				$tmp3 = explode("&&2", $tmp2[1]);
				$arr["studentGrant"][$grantNum]["obtainTime"] = $tmp3[0];
				$arr["studentGrant"][$grantNum]["workTime"] = $tmp3[1];
				$grantNum++;
			}
		}
	
		$tmp1 = explode("&&&", $info1["loan"]);
		if($tmp1[0]!=0){
			$sz = sizeof($tmp1);
			for ($i = 0; $i < $sz; $i++){
				$arr["studentGrant"][$grantNum]["type"] = "国家助学贷款或生源地贷款";
				$tmp2 = explode("&&1", $tmp1[$i]);
				$arr["studentGrant"][$grantNum]["money"] = $tmp2[0]; 
				$tmp3 = explode("&&2", $tmp2[1]);
				$arr["studentGrant"][$grantNum]["obtainTime"] = $tmp3[0];
				$arr["studentGrant"][$grantNum]["workTime"] = $tmp3[1];	
				$grantNum++;
			}
		}
		$tmp1 = explode("&&&", $info1["partTimeJob"]);
		if($tmp1[0]!=0){
			$sz = sizeof($tmp1);
			for ($i = 0; $i < $sz; $i++){
				$arr["studentGrant"][$grantNum]["type"] = "勤工助学";
				$tmp2 = explode("&&1", $tmp1[$i]);
				$arr["studentGrant"][$grantNum]["money"] = $tmp2[0]; 
				$tmp3 = explode("&&2", $tmp2[1]);
				$arr["studentGrant"][$grantNum]["obtainTime"] = $tmp3[0];
				$arr["studentGrant"][$grantNum]["workTime"] = $tmp3[1];	
				$grantNum++;
			}
		}
		$tmp1 = explode("&&&", $info1["Allowance"]);
		if($tmp1[0]!=0){
			$sz = sizeof($tmp1);
			for ($i = 0; $i < $sz; $i++){
				$arr["studentGrant"][$grantNum]["type"] = "临时经济困难补助";
				$tmp2 = explode("&&1", $tmp1[$i]);
				$arr["studentGrant"][$grantNum]["money"] = $tmp2[0]; 
				$tmp3 = explode("&&2", $tmp2[1]);
				$arr["studentGrant"][$grantNum]["obtainTime"] = $tmp3[0];
				$arr["studentGrant"][$grantNum]["workTime"] = $tmp3[1];
				$grantNum++;
			}
		}
		if($grantNum == 0){
			$arr["studentGrant"][$grantNum]["type"] = "";
			$arr["studentGrant"][$grantNum]["money"] = ""; 
			$arr["studentGrant"][$grantNum]["obtainTime"] = "";
			$arr["studentGrant"][$grantNum]["workTime"] = "";	
		}
		
		$arr["otherExp"]["otherExp"] = $info1["failSub"];
		
		$arr["thought"]["thought"] = $info1["thought"];
		
		if ($info1["applyDate"] == "0000-00-00" && $info1["FapplyDate"] == "0000-00-00" ){
			$arr["applyDate"]["applyDate"] = "";
			$arr["applyDate"]["type"] = "3";
		}
		else if($info1["applyDate"] == "0000-00-00" ){
			$arr["applyDate"]["applyDate"] = $info1["FapplyDate"];
			$arr["applyDate"]["type"] = "2";
		}
		else{
			$arr["applyDate"]["applyDate"] = $info1["applyDate"];
			$arr["applyDate"]["type"] = "1";
		}
		
		
		$arr["hope"]["FcharityAct"] = $info1["FcharityAct"];
		$arr["hope"]["FGPA"] = $info1["FGPA"];
		$arr["hope"]["Fbook"] = $info1["Fbook"];
		$arr["hope"]["FsciPro"] = $info1["FsciPro"];
		$arr["hope"]["Fpaper"] = $info1["Fpaper"];
		$arr["hope"]["Fcompetition"] = $info1["Fcompetition"];
		$arr["hope"]["Ftour"] = $info1["Ftour"];
		$arr["hope"]["FgroupAct"] = $info1["FgroupAct"];
		$arr["hope"]["FotherExp"] = $info1["FotherExp"];
		
		$sql = "SELECT * from info2 where sid = '$sid' and fillYear = $fillYear";
		$result = mysql_query($sql,$con);
		$info2 = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$arr["charity"]["charityHours"] = $info2["charityHours"];
		$arr["readClassicBook"]["bookNum"] = $info2["bookNum"];
		$arr["activity"]["groupActTime"] = $info2["groupActTimes"];			//一句有s一句没有s，注意
		
		$arr["study"]["failSubNum"] = $info2["failSubNum"];
		
		$arr["training"]["trainHours"] = $info2["trainHours"];
		
		//return tour
		$sql = "SELECT * from Tour where sid = $sid and fillYear = $fillYear";
		$result = mysql_query($sql,$con);
		$i = 0;
		while($row = mysql_fetch_array($result)){
			$time =$row['time'];
			$time = explode("&&1",$time);
			$tour[$i]["place"] = $row['place'];
			$tour[$i]["theme"] = $row['theme'];
			$tour[$i]["hostEntity"] = $row['hostEntity'];
			$tour[$i]["days"] = $row['days'];
			$tour[$i]["startDate"] = $time[0];
			$tour[$i]["endDate"] = $time[1];
			$arr["tour"] = $tour;
			$i++;
		}
		if($i==0){
			$tour[$i]["place"] = "";
			$tour[$i]["theme"] = "";
			$tour[$i]["hostEntity"] = "";
			$tour[$i]["days"] = "";
			$tour[$i]["startDate"] = "";
			$tour[$i]["endDate"] = "";
			$arr["tour"] = $tour;
		}

		//return patent
		$sql = "SELECT * from patent where sid = $sid and fillYear = $fillYear";
		$result = mysql_query($sql,$con);
		$i = 0;
		while($row = mysql_fetch_array($result)){
			//patent : [{ patentType: "发明专利", patentId:"12345678", patentContent: "发明了新型通讯设备"}],
			$patent[$i]["patentType"] = $row['patentType'];
			$patent[$i]["patentId"] = $row['patentId'];
			$patent[$i]["patentContent"] = $row['patent'];
			$arr["patent"] = $patent;
			$i++;
		}
		if($i==0){
			$patent[$i]["patentType"] = "";
			$patent[$i]["patentId"] = "";
			$patent[$i]["patentContent"] = "";
			$arr["patent"] = $patent;
		}

		//return prize
		$sql = "SELECT * from prize where sid = $sid and fillYear = $fillYear";
		$result = mysql_query($sql,$con);
		$i = 0;
		while($row = mysql_fetch_array($result)){
			$prize[$i]["level"] = $row['level'];
			$prize[$i]["content"] = $row['content'];
			$prize[$i]["gavecommitte"] = $row['gavecommitte'];
			$arr["prize"] = $prize;
			$i++;
		}
		if($i==0){
			$prize[$i]["level"] = "";
			$prize[$i]["content"] = "";
			$prize[$i]["gavecommitte"] = "";
			$arr["prize"] = $prize;
		}
		$arr["status"] = "success";
	}
	else{
		$arr["status"] = "fail";
	}
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
	
?>