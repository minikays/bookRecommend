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
	$department = $_POST['department'];
	//$grade="大二";
	//$fillYear = "2013";
	//$department = "软件学院";
	//$should_pass = 5;
	//$arr["grade"] = "$grade";
	$arr["should_pass"] = "$should_pass";
	
	$sql = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear' and department = '$department'";
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
		
		$sql = "SELECT * from info1 where grade = '$grade' and fillYear = '$fillYear'  and department = '$department' ";
		$result = mysql_query($sql,$con);
		$info1 = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','Info1',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			
			$sql1 = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear'  and department = '$department' and $field_name = '' ";
			$result1=mysql_fetch_array(mysql_query($sql1)); 
			$count1=$result1['count'];
			//统计数量
			$count1 = $fact_pass - $count1;
			$arr[$field_name] = "$count1";
			
			//统计百分比
			$field_name1 = $field_name.'Percent';
			$percent = round($count1/$fact_pass,4) * 100;
			$arr[$field_name1] = "$percent";
			
			//统计空白的百分比
			$field_name2 = $field_name1.'1';
			$percent = 100 - $percent;
			$arr[$field_name2] = "$percent";
		}
		
		
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear'   and department = '$department' ";
		$result = mysql_query($sql,$con);
		$info2 = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','Info2',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			
			$sql1 = "SELECT count(*) AS count from info2 where grade = '$grade' and fillYear = '$fillYear'  and department = '$department'  and $field_name = '' ";
			$result1=mysql_fetch_array(mysql_query($sql1)); 
			$count1=$result1['count'];
			//统计数量
			$count1 = $fact_pass - $count1;
			$arr[$field_name] = "$count1";
			
			//统计百分比
			$field_name1 = $field_name.'Percent';
			$percent = round($count1/$fact_pass,4) * 100;
			$arr[$field_name1] = "$percent";
			
			//统计空白的百分比
			$field_name2 = $field_name1.'1';
			$percent = 100 - $percent;
			$arr[$field_name2] = "$percent";
		}
		
		//申请专利情况
		$sql = "SELECT count(distinct(sid)) AS count from patent where grade = '$grade' and fillYear = '$fillYear'   and department = '$department'  ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$arr["patent"] = "$count";
		$percent = round($count/$fact_pass,4) * 100;
		$arr["patentPercent"] = "$percent";
		
		//统计空白的百分比
		$percent = 100 - $percent;
		$arr["patentPercent1"] = "$percent";
			
		
		//短期游学交流
		$sql = "SELECT count(distinct(sid)) AS count from tour where grade = '$grade' and fillYear = '$fillYear'  and department = '$department'  ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$arr["tour"] = "$count";
		$percent = round($count/$fact_pass,4) * 100;
		$arr["tourPercent"] = "$percent";
		//统计空白的百分比
		$percent = 100 - $percent;
		$arr["tourPercent1"] = "$percent";
		
		//获奖情况
		$sql = "SELECT count(distinct(sid)) AS count from prize where grade = '$grade' and fillYear = '$fillYear'   and department = '$department' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$arr["prize"] = "$count";
		$percent = round($count/$fact_pass,4) * 100;
		$arr["prizePercent"] = "$percent";
		//统计空白的百分比
		$percent = 100 - $percent;
		$arr["prizePercent1"] = "$percent";
		
		//接受资助情况
		$sql = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear'   and department = '$department' and grantsInAid = '' and loan = ''  and partTimeJob='' and Allowance='' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$count1 = $fact_pass - $count;
		$arr["help"] = "$count1";
		$percent = round($count1/$fact_pass,4) * 100;
		$arr["helpPercent"] = "$percent";
		//统计空白的百分比
		$percent = 100 - $percent;
		$arr["helpPercent1"] = "$percent";
		
		//党员人数
		$sql = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear'   and department = '$department' and politics = '党员' ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$arr["partyMemNum"] = "$count";
		
		
		//第二个表格的内容
		//阅读经典书籍
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear'  and department = '$department' ";
		$result = mysql_query($sql,$con);
		$bookcnt = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$bookcnt += $row['bookNum'];
		}
		$avgBookNum =  round($bookcnt/$fact_pass,2);
		$arr["avgBookNum"] = $avgBookNum;
		
		//参加公益时长
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear'  and department = '$department' ";
		$result = mysql_query($sql,$con);
		$charityHourscnt = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$charityHourscnt += $row['charityHours'];
		}
		$avgcharityHoursNum =  round($charityHourscnt/$fact_pass,2);
		$arr["avgcharityHoursNum"] = $avgcharityHoursNum;
		
		//参加集体活动次数
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear'  and department = '$department' ";
		$result = mysql_query($sql,$con);
		$groupActTimescnt = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$groupActTimescnt += $row['groupActTimes'];
		}
		$avggroupActTimesNum =  round($groupActTimescnt/$fact_pass,2);
		$arr["avggroupActTimesNum"] = $avggroupActTimesNum;
		
		//每天参加课外锻炼时长
		$sql = "SELECT * from info2 where grade = '$grade' and fillYear = '$fillYear'  and department = '$department' ";
		$result = mysql_query($sql,$con);
		$trainHourscnt = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$trainHourscnt += $row['trainHours'];
		}
		$avgtrainHoursNum =  round($trainHourscnt/$fact_pass,2);
		$arr["avgtrainHoursNum"] = $avgtrainHoursNum;
		
		//短期游学交流次数
		$sql = "SELECT count(*) AS count from tour where grade = '$grade' and fillYear = '$fillYear'  and department = '$department'  ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		//$arr["Tourcnt"] = "$count";
		$avgTourNum =  round($count/$fact_pass,2);
		$arr["avgTourNum"] = $avgTourNum;
		
		//获得奖项次数
		$sql = "SELECT count(*) AS count from prize where grade = '$grade' and fillYear = '$fillYear'  and department = '$department'  ";
		$result=mysql_fetch_array(mysql_query($sql)); 
		$count=$result['count'];
		$avgPrizeNum =  round($count/$fact_pass,2);
		$arr["avgPrizeNum"] = $avgPrizeNum;
		
		//其他经历次数
		$arr["avgOtherExpNum"] = round($arr["otherExp"]/$fact_pass,2);
		
		//统计又不及格科目的人数
		$sql1 = "SELECT count(*) AS count from info2 where grade = '$grade' and fillYear = '$fillYear'   and department = '$department' and (failSubNum='' or failSubNum=0) ";
		$result1=mysql_fetch_array(mysql_query($sql1)); 
		$count1=$result1['count'];
		$count1 = $fact_pass - $count1;
		$arr["failSubTotal"] = "$count1";
		
		//每周参加勤工助学时间平均
		$sql = "SELECT * from info1 where grade = '$grade' and fillYear = '$fillYear'   and department = '$department' and partTimeJob != ''";
		$result = mysql_query($sql,$con);
		$partTimeJobcnt = 0;
		while($info1 = mysql_fetch_assoc($result))
		{
			$tmp1 = explode("&&&",$info1["partTimeJob"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$partTimeJobcnt += $workTime;
			}
		}
		
		$avgpartTimeJobNum =  round($partTimeJobcnt/$fact_pass,2);
		$arr["avgpartTimeJobNum"] = $avgpartTimeJobNum;
		
		
		
		//接受助学金人数
		$sql1 = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear'   and department = '$department' and grantsInAid='' ";
		$result1=mysql_fetch_array(mysql_query($sql1)); 
		$count1=$result1['count'];
		$count1 = $fact_pass - $count1;
		$arr["grantsInAidTotal"] = "$count1";
		
		//接受贷款人数
		$sql1 = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear'   and department = '$department' and loan='' ";
		$result1=mysql_fetch_array(mysql_query($sql1)); 
		$count1=$result1['count'];
		$count1 = $fact_pass - $count1;
		$arr["loanTotal"] = "$count1";
		
		//接受勤工助学人数
		$sql1 = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear'  and department = '$department'  and partTimeJob='' ";
		$result1=mysql_fetch_array(mysql_query($sql1)); 
		$count1=$result1['count'];
		$count1 = $fact_pass - $count1;
		$arr["partTimeJobTotal"] = "$count1";
		
		//接受临时困难补助人数
		$sql1 = "SELECT count(*) AS count from info1 where grade = '$grade' and fillYear = '$fillYear'  and department = '$department'  and Allowance='' ";
		$result1=mysql_fetch_array(mysql_query($sql1)); 
		$count1=$result1['count'];
		$count1 = $fact_pass - $count1;
		$arr["AllowanceTotal"] = "$count1";
		
		//获得校内外奖人数
		$sql = "SELECT * from prize where grade = '$grade' and fillYear = '$fillYear'  and department = '$department'  ";
		$result = mysql_query($sql,$con);
		$insidecnt = 0;
		$outsidecnt = 0;
		while($prize = mysql_fetch_assoc($result))
		{
			
			if($prize["level"]=="国家级"||$prize["level"]=="省级" || $prize["level"]=="市级")
				$outsidecnt++;
			else
				$insidecnt++;
			
		}
		$arr["outsideTotal"] = $outsidecnt;
		$arr["insideTotal"] = $insidecnt;
	}
	
	
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	mysql_close($con);
?>