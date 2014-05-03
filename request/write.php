<?php
	session_start();
	if(!isset($_SESSION['valid_user']))
		header("location:../not_login.html");
	
	$s = file_get_contents("php://input");
	$arr = json_decode($s,TRUE);

	$sid = $_SESSION['valid_user'];
	//$sid = "11331110";
	$fillYear = date('Y');
	$department = $arr["basic1"]["department"];
	$grade = $arr["basic1"]["grade"];
	
	//将部分信息连接成一个字符串
	$paperNum = sizeof($arr["suitPaper"]);
	$arr["suitPaper"]["paper"] = "";
	for($index = 0; $index < $paperNum; $index++)
	{
		if($arr["suitPaper"][$index]["paper"]!="")
			$arr["suitPaper"]["paper"] = $arr["suitPaper"][$index]["paper"]."&&1".$arr["suitPaper"][$index]["magazine"]."&&2".$arr["suitPaper"][$index]["suitDate"]."&&&";
	}
	$arr["suitPaper"]["paper"] = rtrim($arr["suitPaper"]["paper"],'&');
	
	$grantNum = sizeof($arr["studentGrant"]);
	$arr["studentGrant"]["grantsInAid"] = "";
	$arr["studentGrant"]["loan"] = "";
	$arr["studentGrant"]["partTimeJob"] = "";
	$arr["studentGrant"]["Allowance"] = "";
	$arr["studentGrant"]["scholarship"] = "";
	for($index = 0; $index < $grantNum; $index++)
	{
		if($arr["studentGrant"][$index]["type"] == "助学金")
		{
			$arr["studentGrant"]["grantsInAid"] = $arr["studentGrant"]["grantsInAid"].$arr["studentGrant"][$index]["money"]."&&1".$arr["studentGrant"][$index]["obtainTime"]."&&2".$arr["studentGrant"][$index]["workTime"]."&&&";
		}
		else if($arr["studentGrant"][$index]["type"] == "国家助学贷款或生源地贷款")
		{
			$arr["studentGrant"]["loan"] = $arr["studentGrant"]["loan"].$arr["studentGrant"][$index]["money"]."&&1".$arr["studentGrant"][$index]["obtainTime"]."&&2".$arr["studentGrant"][$index]["workTime"]."&&&";
		}
		else if($arr["studentGrant"][$index]["type"] == "勤工助学")
		{
			$arr["studentGrant"]["partTimeJob"] = $arr["studentGrant"]["partTimeJob"].$arr["studentGrant"][$index]["money"]."&&1".$arr["studentGrant"][$index]["obtainTime"]."&&2".$arr["studentGrant"][$index]["workTime"]."&&&";
		}
		else if($arr["studentGrant"][$index]["type"] == "临时经济困难补助")
		{
			$arr["studentGrant"]["Allowance"] = $arr["studentGrant"]["Allowance"].$arr["studentGrant"][$index]["money"]."&&1".$arr["studentGrant"][$index]["obtainTime"]."&&2".$arr["studentGrant"][$index]["workTime"]."&&&";
		}
		else if($arr["studentGrant"][$index]["type"] == "奖学金")
		{
			$arr["studentGrant"]["scholarship"] = $arr["studentGrant"]["scholarship"].$arr["studentGrant"][$index]["money"]."&&1".$arr["studentGrant"][$index]["obtainTime"]."&&2".$arr["studentGrant"][$index]["workTime"]."&&&";
		}
	}
	$arr["studentGrant"]["grantsInAid"] = rtrim($arr["studentGrant"]["grantsInAid"],'&');
	$arr["studentGrant"]["loan"] = rtrim($arr["studentGrant"]["loan"],'&');
	$arr["studentGrant"]["partTimeJob"] = rtrim($arr["studentGrant"]["partTimeJob"],'&');
	$arr["studentGrant"]["Allowance"] = rtrim($arr["studentGrant"]["Allowance"],'&');
	$arr["studentGrant"]["scholarship"] = rtrim($arr["studentGrant"]["scholarship"],'&');
	
	if($arr["applyDate"]["type"]=="1")
	{
		$arr["hope"]["FapplyDate"] = "0000-00-00";		
	}
	else if($arr["applyDate"]["type"]=="2")
	{
		$arr["hope"]["FapplyDate"] = $arr["applyDate"]["applyDate"];
		$arr["applyDate"]["applyDate"] = "0000-00-00";
	}
	else
	{
		$arr["hope"]["FapplyDate"] = "0000-00-00";	
		$arr["applyDate"]["applyDate"] = "0000-00-00";
	}
	
	$str = $arr["readClassicBook"]["book"];
	$tmp1 = explode("》",$str);
	$sz1 = sizeof($tmp1);
	for($i = 0;$i < $sz1-1 ;$i++){
		$tmp2 = explode("《",$tmp1[$i]);
		$books[$i] = $tmp2[1];
	}
	$booknum = $i;
	
	
	//连接数据库
	$con = mysql_connect("localhost", "root", "ab7df0e4e6");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	//选择成长轨的数据库
	$db_selected = mysql_select_db("growthtrack",$con);
	
	//解决中文乱码的问题
	$anosql = "set names utf8";
	mysql_query($anosql,$con);
	
	mysql_query("BEGIN");
	
	//如果是该学院第一个学生填写，初始化学院的统计信息
	$sql = "select * from statics where department = \"$department\" and fillYear = $fillYear";
	$result = mysql_query($sql,$con);
	$isempty = mysql_num_rows($result);
	if($isempty <=0 )
	{
		$sql = "insert into statics values($fillYear, \"$department\",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)";
		mysql_query($sql,$con);
	}
	
	//如果是全校第一个学生填写，初始化全校统计信息
	$sql = "select * from statics where department = \"全校\" and fillYear = $fillYear";
	$result = mysql_query($sql,$con);
	$isempty = mysql_num_rows($result);
	if($isempty <=0 )
	{
		$sql = "insert into statics values($fillYear, \"全校\",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)";
		mysql_query($sql,$con);
	}
	
	//全校统计信息处理
	$sql = "SELECT * from statics where department = '全校' and fillYear = '$fillYear' ";
	$result = mysql_query($sql,$con);
	$statics = mysql_fetch_array($result,MYSQL_ASSOC);
	$totalNum = mysql_num_fields($result); 
	$result_field=mysql_list_fields('GrowthTrack','statics',$con);
	for ($k=0;$k<$totalNum;$k++){
		$field_name=mysql_field_name($result_field,$k);
		$college[$field_name] = $statics["$field_name"];
	}
	
	//检查该同学是否已经填写过
	$sql = "select * from info1 where sid = '$sid' and fillYear = '$fillYear'";
	$result = mysql_query($sql,$con);
	$isempty = mysql_num_rows($result);

	//没有填写过则插入新数据
	if($isempty <= 0)
	{
		
		//书籍统计，没填写过时，直接插入、更新
		for($i = 0;$i < $booknum;$i++){
			$sql = "select * from books where bookName = \"$books[$i]\" and fillYear = $fillYear";
			$result = mysql_query($sql,$con);
			$rowNum = mysql_num_rows($result);
			$result=mysql_fetch_array($result);
			if($rowNum<=0){
				$sql = "INSERT INTO  books VALUES ('$books[$i]','$fillYear',1)";
				$result = mysql_query($sql,$con);
			}
			else{
				$bookNum = $result["bookNum"];
				$bookNum++;
				$sql = "update books set bookNum = $bookNum where bookName = \"$books[$i]\" and fillYear = $fillYear";
				$result = mysql_query($sql,$con);
			}
		}
	
		$sql = "insert into info1(name,gender,sid,politics,phoneNum,dorm,department,grade,major,class,email,qq,charityAct,book,competition,groupAct,sciPro,";
		$sql = $sql."paper,failSub,GPA,fillYear,occupation,train,grantsInAid,loan,partTimeJob,Allowance,scholarship, otherExp,applyDate,FcharityAct,";
		$sql = $sql."FGPA,Fbook,FsciPro,Fpaper,Fcompetition,Ftour,FgroupAct,FapplyDate,FotherExp,thought) ";
		$sql = $sql."values(\"".$arr["basic1"]["name"]."\",\"".$arr["basic1"]["gender"]."\",\"";
		$sql = $sql.$sid."\",\"".$arr["basic2"]["politics"]."\",\"".$arr["basic2"]["phoneNum"]."\",\"".$arr["basic2"]["dorm"]."\",\"";
		$sql = $sql.$arr["basic1"]["department"]."\",\"".$arr["basic1"]["grade"]."\",\"".$arr["basic1"]["major"]."\",\"".$arr["basic1"]["myclass"]."\",\"".$arr["basic2"]["email"]."\",\"";
		$sql = $sql.$arr["basic2"]["qq"]."\",\"".$arr["charity"]["charityAct"]."\",\"".$arr["readClassicBook"]["book"]."\",\"";
		$sql = $sql.$arr["competitionSituation"]["competition"]."\",\"".$arr["activity"]["groupAct"]."\",\"".$arr["sciAndPro"]["sicPro"]."\",\"";
		$sql = $sql.$arr["suitPaper"]["paper"]."\",\"".$arr["study"]["failSub"]."\",\"".$arr["study"]["GPA"]."\",\"".$fillYear."\",\"";
		$sql = $sql.$arr["occupationSituation"]["occupation"]."\",\"".$arr["training"]["train"]."\",\"".$arr["studentGrant"]["grantsInAid"]."\",\"";
		$sql = $sql.$arr["studentGrant"]["loan"]."\",\"".$arr["studentGrant"]["partTimeJob"]."\",\"".$arr["studentGrant"]["Allowance"]."\",\"".$arr["studentGrant"]["scholarship"]."\",\"".$arr["otherExp"]["otherExp"]."\",\"";
		$sql = $sql.$arr["applyDate"]["applyDate"]."\",\"".$arr["hope"]["FcharityAct"]."\",\"".$arr["hope"]["FGPA"]."\",\"".$arr["hope"]["Fbook"]."\",\"";
		$sql = $sql.$arr["hope"]["FsciPro"]."\",\"".$arr["hope"]["Fpaper"]."\",\"".$arr["hope"]["Fcompetition"]."\",\"".$arr["hope"]["Ftour"]."\",\"";
		$sql = $sql.$arr["hope"]["FgroupAct"]."\",\"".$arr["hope"]["FapplyDate"]."\",\"".$arr["hope"]["FotherExp"]."\",\"".$arr["thought"]["thought"]."\")";
		mysql_query($sql,$con);
		
		
		$sql = "insert into info2(sid,fillYear,department,grade,charityHours,bookNum,groupActTimes,failSubNum,trainHours) values (\"";
		$sql = $sql.$sid."\",\"".$fillYear."\",\"".$arr["basic1"]["department"]."\",\"".$arr["basic1"]["grade"]."\",";
		$sql = $sql.$arr["charity"]["charityHours"].",".$arr["readClassicBook"]["bookNum"].",".$arr["activity"]["groupActTime"].",";
		$sql = $sql.$arr["study"]["failSubNum"].",".$arr["training"]["trainHours"].")";
		mysql_query($sql,$con);
		
		//统计数据的处理
		$sql = "SELECT * from statics where department = '$department' and fillYear = '$fillYear' ";
		$result = mysql_query($sql,$con);
		$statics = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','statics',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$school[$field_name] = $statics["$field_name"];
		}
	
		//即时修改统计信息
		$school["avgCHour"] = ($school["stuNum"]*$school["avgCHour"]+$arr["charity"]["charityHours"])/($school["stuNum"]+1);
		$school["AvgGroupActNum"]=($school["stuNum"]*$school["AvgGroupActNum"]+$arr["activity"]["groupActTime"])/($school["stuNum"]+1);
		$school["avgTrainHour"] = ($school["stuNum"]*$school["avgTrainHour"]+$arr["training"]["trainHours"])/($school["stuNum"]+1);
		$school["totalFailSub"]+=$arr["study"]["failSubNum"];
		if($arr["basic2"]["politics"]=="党员")
			$school["partyMemNum"]++;
		if($arr["basic2"]["politics"]=="团员")
			$school["LeagueMemNum"]++;
		$school["stuNum"]++;
		
		$college["avgCHour"] = ($college["stuNum"]*$college["avgCHour"]+$arr["charity"]["charityHours"])/($college["stuNum"]+1);
		$college["AvgGroupActNum"]=($college["stuNum"]*$college["AvgGroupActNum"]+$arr["activity"]["groupActTime"])/($college["stuNum"]+1);
		$college["avgTrainHour"] = ($college["stuNum"]*$college["avgTrainHour"]+$arr["training"]["trainHours"])/($college["stuNum"]+1);
		$college["totalFailSub"]+=$arr["study"]["failSubNum"];
		if($arr["basic2"]["politics"]=="党员")
			$college["partyMemNum"]++;
		if($arr["basic2"]["politics"]=="团员")
			$college["LeagueMemNum"]++;
		$college["stuNum"]++;
		
	} 
	
	//填写过则更新原有数据
	else
	{
		//获取学生原有数据
		$mydata = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','info1',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$ori[$field_name] = $mydata["$field_name"];
		}
		$sql = "select * from info2 where sid = " .$sid. " and fillYear = ".$fillYear;
		$result = mysql_query($sql,$con);
		$mydata = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','info2',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$ori[$field_name] = $mydata["$field_name"];
		}
	
		//将原学院统计信息先删除
		$oriDepart = $ori["department"];
		$sql = "SELECT * from statics where department = '$oriDepart' and fillYear = '$fillYear' ";
		$result = mysql_query($sql,$con);
		$statics = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','statics',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$oriSchool[$field_name] = $statics["$field_name"];
		}
		
		//patent delete
		$sql = "select count(*) as Type1Num from patent where sid = ".$sid. " and fillYear = ".$fillYear." and patentType = \"发明专利\"";
		$result = mysql_query($sql,$con);
		$result=mysql_fetch_array($result);
		$patentType1Num = $result["Type1Num"];
		$sql = "select count(*) as Type2Num from patent where sid = ".$sid. " and fillYear = ".$fillYear." and patentType = \"实用新型专利\"";
		$result = mysql_query($sql,$con);
		$result=mysql_fetch_array($result);
		$patentType2Num = $result["Type2Num"];
		$sql = "select count(*) as Type3Num from patent where sid = ".$sid. " and fillYear = ".$fillYear." and patentType = \"外观设计专利\"";
		$result = mysql_query($sql,$con);
		$result=mysql_fetch_array($result);
		$patentType3Num = $result["Type3Num"];	
		
		$oriSchool["patentType1Num"] = $oriSchool["patentType1Num"] - $patentType1Num;
		$oriSchool["patentType2Num"] = $oriSchool["patentType2Num"] - $patentType2Num;
		$oriSchool["patentType3Num"] = $oriSchool["patentType3Num"] - $patentType3Num;
		$college["patentType1Num"] = $college["patentType1Num"] - $patentType1Num;
		$college["patentType2Num"] = $college["patentType2Num"] - $patentType2Num;
		$college["patentType3Num"] = $college["patentType3Num"] - $patentType3Num;
	
		$sql = "delete from patent where sid = " .$sid. " and fillYear = ".$fillYear;
		mysql_query($sql,$con);
		
		//prize delete
		$sql = "select count(*) as countryP from prize where sid = ".$sid. " and fillYear = ".$fillYear." and level = \"国家级\"";
		$result = mysql_query($sql,$con);
		$result=mysql_fetch_array($result);
		$countryPriNum = $result["countryP"];
		$sql = "select count(*) as provinceP from prize where sid = ".$sid. " and fillYear = ".$fillYear." and level = \"省级\"";
		$result = mysql_query($sql,$con);
		$result=mysql_fetch_array($result);
		$provincePriNum = $result["provinceP"];
		$sql = "select count(*) as collegeP from prize where sid = ".$sid. " and fillYear = ".$fillYear." and level = \"校级\"";
		$result = mysql_query($sql,$con);
		$result=mysql_fetch_array($result);
		$CollegePriNum = $result["collegeP"];
		$sql = "select count(*) as schoolP from prize where sid = ".$sid. " and fillYear = ".$fillYear." and level = \"院级\"";
		$result = mysql_query($sql,$con);
		$result=mysql_fetch_array($result);
		$departPriNum = $result["schoolP"];
		
		$oriSchool["countryPriNum"] = $oriSchool["countryPriNum"] - $countryPriNum;
		$oriSchool["provincePriNum"] = $oriSchool["provincePriNum"] - $provincePriNum;
		$oriSchool["CollegePriNum"] = $oriSchool["CollegePriNum"] - $CollegePriNum;
		$oriSchool["departPriNum"] = $oriSchool["departPriNum"] - $departPriNum;
		$college["countryPriNum"] = $college["countryPriNum"] - $countryPriNum;
		$college["provincePriNum"] = $college["provincePriNum"] - $provincePriNum;
		$college["CollegePriNum"] = $college["CollegePriNum"] - $CollegePriNum;
		$college["departPriNum"] = $college["departPriNum"] - $departPriNum;
		
		$sql = "delete from prize where sid = " .$sid. " and fillYear = ".$fillYear;
		mysql_query($sql,$con);
		
		if(($oriSchool["stuNum"]-1)!=0)
		{
			$oriSchool["avgCHour"] = ($oriSchool["stuNum"]*$oriSchool["avgCHour"]-$ori["charityHours"])/($oriSchool["stuNum"]-1);
			$oriSchool["AvgGroupActNum"]=($oriSchool["stuNum"]*$oriSchool["AvgGroupActNum"]-$ori["groupActTimes"])/($oriSchool["stuNum"]-1);
			$oriSchool["avgTrainHour"] = ($oriSchool["stuNum"]*$oriSchool["avgTrainHour"]-$ori["trainHours"])/($oriSchool["stuNum"]-1);
			$oriSchool["totalFailSub"]-=$ori["failSubNum"];
			if($ori["politics"]=="党员")
				$oriSchool["partyMemNum"]--;
			if($ori["politics"]=="团员")
				$oriSchool["LeagueMemNum"]--;
			$oriSchool["stuNum"]--;
			$sql = "update statics set avgCHour = ".$oriSchool["avgCHour"].", AvgGroupActNum = ".$oriSchool["AvgGroupActNum"].", avgTrainHour = ".$oriSchool["avgTrainHour"].", ";
			$sql = $sql."totalFailSub = ".$oriSchool["totalFailSub"].", partyMemNum = ".$oriSchool["partyMemNum"].", LeagueMemNum = ".$oriSchool["LeagueMemNum"]++.", stuNum = ".$oriSchool["stuNum"].", ";
			$sql = $sql."patentType1Num = ".$oriSchool["patentType1Num"].", patentType2Num = ".$oriSchool["patentType2Num"].", patentType3Num = ".$oriSchool["patentType3Num"].", ";
			$sql = $sql."countryPriNum = ".$oriSchool["countryPriNum"].", provincePriNum = ".$oriSchool["provincePriNum"].", CollegePriNum = ".$oriSchool["CollegePriNum"].", departPriNum = ".$oriSchool["departPriNum"]." ";
			$sql = $sql."where department = '$oriDepart' and fillYear = '$fillYear' ";
			mysql_query($sql,$con);
		}
		else
		{
			$sql = "update statics set avgCHour = 0, AvgGroupActNum = 0, avgTrainHour = 0, totalFailSub = 0, partyMemNum = 0, LeagueMemNum = 0, stuNum = 0, patentType1Num = 0, patentType2Num = 0, patentType3Num = 0, countryPriNum = 0, provincePriNum = 0, CollegePriNum = 0, departPriNum = 0  where department = '$oriDepart' and fillYear = '$fillYear' ";
			mysql_query($sql,$con);
		}
		
		//书籍统计，填写过时，减去已填写的书，再更新没有的(记得不要用result）
		$sql = "select book from info1 where sid = '$sid' and fillYear = '$fillYear'";
		$row = mysql_query($sql,$con);
		$info1Book = mysql_fetch_array($row,MYSQL_ASSOC);
		$info1book = $info1Book['book'];

		$str = $info1book;
		$tmp1 = explode("》",$str);
		$sz1 = sizeof($tmp1);
		for($i = 0;$i < $sz1-1 ;$i++){
			$tmp2 = explode("《",$tmp1[$i]);
			$sql = "update books set bookNum = bookNum-1 where bookName = \"$tmp2[1]\" and fillYear = $fillYear";
			mysql_query($sql,$con);
		}


		for($i = 0;$i < $booknum;$i++){
			$sql = "select * from books where bookName = \"$books[$i]\" and fillYear = $fillYear";
			$result1 = mysql_query($sql,$con);
			$rowNum = mysql_num_rows($result1);
			$result1=mysql_fetch_array($result1);
			if($rowNum<=0){
				$sql = "INSERT INTO  books VALUES ('$books[$i]','$fillYear',1)";
				$result1 = mysql_query($sql,$con);
			}
			else{
				$sql = "update books set bookNum = bookNum + 1 where bookName = \"$books[$i]\" and fillYear = $fillYear";
				$result1 = mysql_query($sql,$con);
			}
		}
		
		
		//update some basic infomation in info1
		$sql = "update info1 set name = \"".$arr["basic1"]["name"]."\", gender = \"".$arr["basic1"]["gender"]."\", ";	
		$sql = $sql."politics = \"".$arr["basic2"]["politics"]."\", phoneNum = \"".$arr["basic2"]["phoneNum"]."\", dorm = \"".$arr["basic2"]["dorm"]."\", ";
		$sql = $sql."department = \"".$arr["basic1"]["department"]."\", grade = \"".$arr["basic1"]["grade"]."\", major = \"".$arr["basic1"]["major"]."\", ";
		$sql = $sql."class = \"".$arr["basic1"]["myclass"]."\", email = \"".$arr["basic2"]["email"]."\", qq = \"".$arr["basic2"]["qq"]."\", ";
		$sql = $sql."charityAct = \"".$arr["charity"]["charityAct"]."\", book = \"".$arr["readClassicBook"]["book"]."\", competition = \"".$arr["competitionSituation"]["competition"]."\", ";
		$sql = $sql."groupAct = \"".$arr["activity"]["groupAct"]."\", sciPro = \"".$arr["sciAndPro"]["sicPro"]."\", paper = \"".$arr["suitPaper"]["paper"]."\", ";
		$sql = $sql."failSub = \"".$arr["study"]["failSub"]."\", GPA = \"".$arr["study"]["GPA"]."\", ";
		$sql = $sql."occupation = \"".$arr["occupationSituation"]["occupation"]."\", train = \"".$arr["training"]["train"]."\", grantsInAid = \"".$arr["studentGrant"]["grantsInAid"]."\", ";
		$sql = $sql."loan = \"".$arr["studentGrant"]["loan"]."\", partTimeJob = \"".$arr["studentGrant"]["partTimeJob"]."\", Allowance = \"".$arr["studentGrant"]["Allowance"]."\", scholarship = \"".$arr["studentGrant"]["scholarship"]."\",";
		$sql = $sql."otherExp = \"".$arr["otherExp"]["otherExp"]."\", applyDate = \"".$arr["applyDate"]["applyDate"]."\", thought = \"".$arr["thought"]["thought"]."\" ";
		$sql = $sql."where sid = " .$sid. " and fillYear = ".$fillYear;
		mysql_query($sql,$con);	

		//update the hope in info1		
		$FcharityAct = $arr["hope"]["FcharityAct"];
		$FGPA = $arr["hope"]["FGPA"];
		$Fbook = $arr["hope"]["Fbook"];
		$FsciPro = $arr["hope"]["FsciPro"];
		$Fpaper = $arr["hope"]["Fpaper"];
		$Fcompetition  = $arr["hope"]["Fcompetition"];
		$Ftour  = $arr["hope"]["Ftour"];
		$FgroupAct = $arr["hope"]["FgroupAct"];
		$FapplyDate = $arr["hope"]["FapplyDate"];
		$FotherExp  = $arr["hope"]["FotherExp"];

		$sql = "UPDATE  info1 SET FcharityAct = \"$FcharityAct\",FGPA =$FGPA ,Fbook = \"$Fbook\" ,FsciPro = \"$FsciPro\",Fpaper = \"$Fpaper\",";
		$sql = $sql."Fcompetition = \"$Fcompetition\",Ftour = \"$Ftour\" ,FgroupAct= \"$FgroupAct\" ,FapplyDate = \"$FapplyDate\",FotherExp = \"$FotherExp\" ";
		$sql = $sql."WHERE sid = $sid AND fillYear = $fillYear";
		$myarr["lmt1"] = $sql;
		mysql_query($sql,$con);
		
		//update the table info2
		$sql = "update info2 set charityHours = ".$arr["charity"]["charityHours"].", bookNum = ".$arr["readClassicBook"]["bookNum"].", groupActTimes = ".$arr["activity"]["groupActTime"];
		$sql = $sql.", department = \"$department\", grade = \"$grade\"";
		$sql = $sql." where sid = ".$sid." and fillYear = ".$fillYear;
		mysql_query($sql,$con);
		
		$myarr["status"] = $sql;
		
		//统计数据的处理
		$sql = "SELECT * from statics where department = '$department' and fillYear = '$fillYear' ";
		$result = mysql_query($sql,$con);
		$statics = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','statics',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$school[$field_name] = $statics["$field_name"];
		}
		
		//即时更新统计信息
		$school["avgCHour"] = ($school["stuNum"]*$school["avgCHour"]+$arr["charity"]["charityHours"])/($school["stuNum"]+1);
		$school["AvgGroupActNum"]=($school["stuNum"]*$school["AvgGroupActNum"]+$arr["activity"]["groupActTime"])/($school["stuNum"]+1);
		$school["avgTrainHour"] = ($school["stuNum"]*$school["avgTrainHour"]+$arr["training"]["trainHours"])/($school["stuNum"]+1);
		$school["totalFailSub"]+=$arr["study"]["failSubNum"];
		if($arr["basic2"]["politics"]=="党员")
			$school["partyMemNum"]++;
		if($arr["basic2"]["politics"]=="团员")
			$school["LeagueMemNum"]++;
		$school["stuNum"]++;
			
		
		$college["avgCHour"] = $college["avgCHour"]+($arr["charity"]["charityHours"] - $ori["charityHours"])/$college["stuNum"];
		$college["AvgGroupActNum"]=$college["AvgGroupActNum"]+($arr["activity"]["groupActTime"] - $ori["groupActTimes"])/$college["stuNum"];
		$college["avgTrainHour"] = $college["avgTrainHour"]+($arr["training"]["trainHours"] - $ori["trainHours"])/$college["stuNum"];
		$college["totalFailSub"]+=$arr["study"]["failSubNum"] - $ori["failSubNum"];
		if($arr["basic2"]["politics"]=="党员")
			$college["partyMemNum"]++;
		if($arr["basic2"]["politics"]=="团员")
			$college["LeagueMemNum"]++;
		if($ori["politics"]=="党员")
			$college["partyMemNum"]--;
		if($ori["politics"]=="团员")
			$college["LeagueMemNum"]--;
		
	}
	
	//patent insert and update
	$patentnum =sizeof($arr["patent"]);
	for($i = 0; $i < $patentnum; $i++)
	{
		$patentType = $arr["patent"][$i]["patentType"];
		$patentContent = $arr["patent"][$i]["patentContent"];
		$patentId = $arr["patent"][$i]["patentId"];
		if($patentType == "发明专利" || $patentType == "实用新型专利" || $patentType == "外观设计专利"){
			$sql = "INSERT INTO  patent VALUES ('$sid','$fillYear','$department','$grade','$patentType','$patentContent','$patentId')";
			mysql_query($sql,$con);
		}
	}
	
	$sql = "select count(*) as Type1Num from patent where sid = ".$sid. " and fillYear = ".$fillYear." and patentType = \"发明专利\"";
	$result = mysql_query($sql,$con);
	$result=mysql_fetch_array($result);
	$school["patentType1Num"]= $school["patentType1Num"] + $result["Type1Num"];
	$college["patentType1Num"]= $college["patentType1Num"] + $result["Type1Num"];
	
	$sql = "select count(*) as Type2Num from patent where sid = ".$sid. " and fillYear = ".$fillYear." and patentType = \"实用新型专利\"";
	$result = mysql_query($sql,$con);
	$result=mysql_fetch_array($result);
	$school["patentType2Num"] = $school["patentType2Num"] + $result["Type2Num"];
	$college["patentType2Num"] = $college["patentType2Num"] + $result["Type2Num"];
	
	$sql = "select count(*) as Type3Num from patent where sid = ".$sid. " and fillYear = ".$fillYear." and patentType = \"外观设计专利\"";
	$result = mysql_query($sql,$con);
	$result=mysql_fetch_array($result);
	$school["patentType3Num"] = $school["patentType3Num"] + $result["Type3Num"];
	$college["patentType3Num"] = $college["patentType3Num"] + $result["Type3Num"];
	
	
	
	//tour delete and insert
	$sql = "delete from tour where sid = " .$sid. " and fillYear = ".$fillYear;
	mysql_query($sql,$con);
	$tournum =sizeof($arr["tour"]);
	for($i = 0; $i < $tournum; $i++)
	{
		$arr["tour"][$i]["time"] = $arr["tour"][$i]["startDate"]."&&1".$arr["tour"][$i]["endDate"];
		$place = $arr["tour"][$i]["place"];
		$day = $arr["tour"][$i]["days"];
		$time =$arr["tour"][$i]["time"];
		$theme = $arr["tour"][$i]["theme"];
		$hostEntity = $arr["tour"][$i]["hostEntity"];

		if($place != ""){
			$sql = "INSERT INTO  tour VALUES ('$sid','$fillYear','$department','$grade','$place','$day','$time','$theme','$hostEntity')";
			mysql_query($sql,$con);
		}
	}
	
	
	//prize insert and update
	$prizenum =sizeof($arr["prize"]);
	for($i = 0; $i < $prizenum; $i++)
	{
		$level = $arr["prize"][$i]["level"];
		$content = $arr["prize"][$i]["content"];
		$gavecommitte = $arr["prize"][$i]["gavecommitte"];

		if($level!=""){
			$sql = "INSERT INTO  prize VALUES ('$sid','$fillYear','$department','$grade','$level','$content','$i', '$gavecommitte')";
			mysql_query($sql,$con);
		}
	}
	$sql = "select count(*) as countryP from prize where sid = ".$sid. " and fillYear = ".$fillYear." and level = \"国家级\"";
	$result = mysql_query($sql,$con);
	$result=mysql_fetch_array($result);
	$countryPriNum = $result["countryP"];
	$sql = "select count(*) as provinceP from prize where sid = ".$sid. " and fillYear = ".$fillYear." and level = \"省级\"";
	$result = mysql_query($sql,$con);
	$result=mysql_fetch_array($result);
	$provincePriNum = $result["provinceP"];
	$sql = "select count(*) as collegeP from prize where sid = ".$sid. " and fillYear = ".$fillYear." and level = \"校级\"";
	$result = mysql_query($sql,$con);
	$result=mysql_fetch_array($result);
	$CollegePriNum = $result["collegeP"];
	$sql = "select count(*) as schoolP from prize where sid = ".$sid. " and fillYear = ".$fillYear." and level = \"院级\"";
	$result = mysql_query($sql,$con);
	$result=mysql_fetch_array($result);
	$departPriNum = $result["schoolP"];
	
	$school["countryPriNum"] = $school["countryPriNum"] + $countryPriNum;
	$school["provincePriNum"] = $school["provincePriNum"] + $provincePriNum;
	$school["CollegePriNum"] = $school["CollegePriNum"] + $CollegePriNum;
	$school["departPriNum"] = $school["departPriNum"] + $departPriNum;
	$college["countryPriNum"] = $college["countryPriNum"] + $countryPriNum;
	$college["provincePriNum"] = $college["provincePriNum"] + $provincePriNum;
	$college["CollegePriNum"] = $college["CollegePriNum"] + $CollegePriNum;
	$college["departPriNum"] = $college["departPriNum"] + $departPriNum;
	
	$sql = "update statics set avgCHour = ".$school["avgCHour"].", AvgGroupActNum = ".$school["AvgGroupActNum"].", avgTrainHour = ".$school["avgTrainHour"].", ";
	$sql = $sql."totalFailSub = ".$school["totalFailSub"].", partyMemNum = ".$school["partyMemNum"].", LeagueMemNum = ".$school["LeagueMemNum"]++.", stuNum = ".$school["stuNum"].", ";
	$sql = $sql."patentType1Num = ".$school["patentType1Num"].", patentType2Num = ".$school["patentType2Num"].", patentType3Num = ".$school["patentType3Num"].", ";
	$sql = $sql."countryPriNum = ".$school["countryPriNum"].", provincePriNum = ".$school["provincePriNum"].", CollegePriNum = ".$school["CollegePriNum"].", departPriNum = ".$school["departPriNum"]." ";
	$sql = $sql."where department = '$department' and fillYear = '$fillYear' ";
	mysql_query($sql,$con);
	$sql = "update statics set avgCHour = ".$college["avgCHour"].", AvgGroupActNum = ".$college["AvgGroupActNum"].", avgTrainHour = ".$college["avgTrainHour"].", ";
	$sql = $sql."totalFailSub = ".$college["totalFailSub"].", partyMemNum = ".$college["partyMemNum"].", LeagueMemNum = ".$college["LeagueMemNum"]++.", stuNum = ".$college["stuNum"].", ";
	$sql = $sql."patentType1Num = ".$college["patentType1Num"].", patentType2Num = ".$college["patentType2Num"].", patentType3Num = ".$college["patentType3Num"].", ";
	$sql = $sql."countryPriNum = ".$college["countryPriNum"].", provincePriNum = ".$college["provincePriNum"].", CollegePriNum = ".$college["CollegePriNum"].", departPriNum = ".$college["departPriNum"]." ";
	$sql = $sql."where department = '全校' and fillYear = '$fillYear' ";
	mysql_query($sql,$con);
	
	mysql_query("COMMIT");
	
	$myarr["content"] ="123";
	$myarr["status"] = "true";
	echo json_encode($myarr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
?>