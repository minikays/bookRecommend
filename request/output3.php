<?php
        Header("Content-type:text/html; charset = utf-8");
		
		Header("Content-type: application/octet-stream; filename=\"学生信息.xls\"");
		Header("Content-Disposition: attachment; filename=\"学生信息.xls\"");
		
		
	$con = mysql_connect("localhost", "root", "ab7df0e4e6");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("growthtrack",$con);
	
	$anosql = "set names utf8";
	mysql_query($anosql,$con);
	
	$sid = $_POST["userid"];
	$year1 = $_POST["year1"];
    $year2 = $_POST["year2"];
	//$sid = "11330001";
	//$fillYear = "2013";
    
    echo "<html>    
    <head>
        <style>
			body {
				text-align:left;
			}
			
			table {
				width: 80px;
				border: 1px solid green;
				border-collapse:collapse;
			}
			
			td,th{
				border:1px solid green;
				
			}
		</style>
    </head>
    
<body>";
	for ($fillYear = $year1; $fillYear <= $year2; ++$fillYear){
    echo "
    <table>
        <h1>".$fillYear.": </h1>"."
    </table>
    ";
	$sql = "SELECT * from info1 where sid = '$sid' and fillYear = '$fillYear' ";
	$result = mysql_query($sql,$con);
	$info1 = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$count = 0;
	if($info1) $count++;
	if ($count != 0)
	{
		$arr["exist"] = "Y";
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','Info1',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$arr[$field_name] = $info1["$field_name"];
		}
		
		//对发表文章的处理
		$arr["paper"] = "";
		if($info1["paper"]!="")
		{
			$tmp1 = explode("&&&",$info1["paper"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($paper,$tmp2) = explode("&&1",$tmp1[$i]);
				list($magazine,$suitDate) = explode("&&2",$tmp2);
				$arr["paper"] = $arr["paper"]."文章名："."$paper"." 发表刊物：".$magazine." 发表时间：".$suitDate." ";
			}
		}
		//对助学金的处理
		$arr["grantsInAid"] = "";
		if($info1["grantsInAid"]!=""){
			$tmp1 = explode("&&&",$info1["grantsInAid"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["grantsInAid"] = $arr["grantsInAid"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		$arr["loan"] = "";
		if($info1["loan"]!=""){
			$tmp1 = explode("&&&",$info1["loan"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["loan"] = $arr["loan"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		$arr["partTimeJob"] = "";
		if($info1["partTimeJob"]!=""){
			$tmp1 = explode("&&&",$info1["partTimeJob"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["partTimeJob"] = $arr["partTimeJob"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		$arr["Allowance"] = "";
		if($info1["Allowance"]!=""){
			$tmp1 = explode("&&&",$info1["Allowance"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["Allowance"] = $arr["Allowance"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		
		$arr["scholarship"] = "";
		if($info1["scholarship"]!=""){
			$tmp1 = explode("&&&",$info1["scholarship"]);
			$len = count($tmp1);
			for($i = 0; $i < $len; $i++){
				list($money,$tmp2) = explode("&&1",$tmp1[$i]);
				list($obtainTime,$workTime) = explode("&&2",$tmp2);
				$arr["scholarship"] = $arr["scholarship"]."金额："."$money"." 获得时间：".$obtainTime." 工作时间：".$workTime." ";
			}
		}
		
		$sql = "SELECT * from info2 where sid = '$sid' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$info2 = mysql_fetch_array($result,MYSQL_ASSOC);
		$totalNum = mysql_num_fields($result); 
		$result_field=mysql_list_fields('GrowthTrack','Info2',$con);
		for ($k=0;$k<$totalNum;$k++){
			$field_name=mysql_field_name($result_field,$k);
			$arr[$field_name] = $info2["$field_name"];
		}
		
		$arr["churchyard"]="";
		$arr["abroad"]="";
		$sql = "SELECT * from tour where sid = '$sid' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$rowNum = mysql_num_rows($result);
		for($i=0;$i<$rowNum;$i++){
			$tour = mysql_fetch_array($result,MYSQL_ASSOC);
			if($tour["place"]!=""){
				list($tour["startDate"],$tour["endDate"]) = explode("&&1",$tour["time"]);
				if($tour["place"]!="中国"){
					$arr["abroad"] = $arr["abroad"]."国家/地区:".$tour["place"]." 主题:".$tour["theme"]." 举办单位:".$tour["hostEntity"]." 开始日期:".$tour["startDate"]." 结束日期".$tour["endDate"]." 时长:".$tour["days"]." ";
				}
				else{
					$arr["churchyard"] = $arr["churchyard"]."地区:".$tour["place"]." 主题:".$tour["theme"]." 举办单位:".$tour["hostEntity"]." 开始日期:".$tour["startDate"]." 结束日期".$tour["endDate"]." 时长:".$tour["days"]." ";
				}
			}
		}
		
		$arr["patent"] = "";
		$sql = "SELECT * from patent where sid = '$sid' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$rowNum = mysql_num_rows($result);
		for($i=0;$i<$rowNum;$i++){
			$patent = mysql_fetch_array($result,MYSQL_ASSOC);
			if($patent["patentType"]!=""){
				$arr["patent"] = $arr["patent"]."专利类型：".$patent["patentType"]." 专利号：".$patent["patentId"]." 专利内容：".$patent["patentId"]." ";
			}
		}
		
		$arr["inside"] = "";
		$arr["outside"] = "";
		$sql = "SELECT * from prize where sid = '$sid' and fillYear = '$fillYear'";
		$result = mysql_query($sql,$con);
		$rowNum = mysql_num_rows($result);
		for($i=0;$i<$rowNum;$i++){
			$prize = mysql_fetch_array($result,MYSQL_ASSOC);
			if($prize["level"]=="国家级"||$prize["level"]=="省级")
				$arr["outside"] = $arr["outside"]."级别:".$prize["level"]." 内容：".$prize["content"]."   颁奖单位:".$prize["gavecommitte"]." ";
			else
				$arr["inside"] = $arr["inside"]."级别:".$prize["level"]." 内容：".$prize["content"]."   颁奖单位:".$prize["gavecommitte"]." ";
		}	
	
	

	echo "

<table border = 1>
    <caption>基本信息</caption>
    <tr>
        <td width = 10>名字</td>
        <td width = 10>".$arr["name"]."</td>
        <td>性别</td>
        <td>".$arr["gender"]."</td>
        <td>学号</td>
        <td>".$sid."</td>
        </tr>
    <tr>
        <td>政治面貌</td>
        <td>".$arr["politics"]."</td>
        <td>手机号</td>
        <td>".$arr["phoneNum"]."</td>
        <td>宿舍</td>
        <td>".$arr["dorm"]."</td>
    </tr>
    
    <tr>
        <td>院系</td>
        <td>".$arr["department"]."</td>
        <td>年级</td>
        <td>".$arr["grade"]."</td>
        <td>专业</td>
        <td>".$arr["major"]."</td>
    </tr>
    
    <tr>
        <td>班级</td>
        <td>".$arr["class"]."</td>
        <td>邮箱</td>
        <td>".$arr["email"]."</td>
        <td>QQ</td>
        <td>".$arr["qq"]."</td>
     </tr>
</table>

<table border = 1>
    <caption>本年成果展</caption>
    <tr>
        <td colspan = 2>我参加过的公益活动有：<p>".$arr["charityAct"]."</p>共计".$arr["charityHours"]."个公益小时</td>
        <td colspan = 2>我阅读了以下课外经典书籍：<p>".$arr["book"]."</p>共计".$arr["bookNum"]."<span>本</span></td>
        <td colspan = 2>我参加了以下的课外竞赛：<p id = 'competition'></p></td>
    </tr>
    
    <tr>
        <td rowspan='2' colspan = 2>我参与了以下的集体活动：<p>".$arr["groupAct"]."</p>累计".$arr["groupActTimes"]."次</td>
        
        <td colspan = 2>我参加的科研项目及指导老师是：<p>".$arr["sciPro"]."</p></td>
        
        <td colspan = 2>我申请了以下专利:<p>".$arr["patent"]."</p></td>
    </tr>
    
    <tr>
        <td colspan = 2>文章、论文发表的刊物、期刊号：<p>".$arr["paper"]."</p></td>
        <td colspan = 2>我不及格的科目有".$arr["failSubNum"]."门，分别是<p>".$arr["failSub"]."</p>我取得的绩点是：".$arr["GPA"]."</td>
    </tr>
    
    <tr>
        <td rowspan = '2' colspan = 2>我的短期游学经历有：<p>国内".$arr["churchyard"]."<br />国外：".$arr["abroad"]."</p></td>
        
        <td rowspan = '4' colspan = 2>我接受了以下的帮助：<p>奖学金: </p><p>".$arr["scholarship"]."</p>助学金:<p>".$arr["grantsInAid"]."</p>国家助学贷款或生源地贷款：<p>".$arr["loan"]."</p>勤工助学：<p>".$arr["partTimeJob"]."</p>临时经济困难补助：<p>".$arr["Allowance"]."</p></td>
        
        <td rowspan = '2' colspan = 2>我获得了以下的奖项：<p>校内:</p><p>".$arr["inside"]."</p><p>校外：</p><p>".$arr["outside"]."</p></td>
        
    </tr>
    
    <tr></tr>
    <tr>
        <td colspan = 2>我的任职情况如下：<p>".$arr["occupation"]."</p></td>
        <td colspan = 2>我的其他经历有：<p>".$arr["otherExp"]."</p></td>
    </tr>
    
    <tr>
        <td colspan = 2>我参加了以下的课外锻炼：<p>".$arr["train"]."</p>每日大约平均".$arr["trainHours"]."个小时</td>
        <td colspan = 2>递交入党申请书时间为<br />".$arr["applyDate"]."</td>
    </tr>
</table>

<table id='forth' border = 1>
    <caption>愿景及感悟</caption>
    <tr>
        <th>愿 景</th>
        <th>感 悟</th>
    </tr>
    
    <tr>
        <td colspan = 2>公益活动<p>".$arr["FcharityAct"]."</p></td>
        <td rowspan = '9' colspan = 4><p>".$arr["thought"]."</p></td>
    </tr>
    
    <tr>
        <td colspan = 2>成绩绩点<p>".$arr["FGPA"]."</p></td>
    </tr>
    
    <tr>
        <td colspan = 2>课外阅读<p>".$arr["Fbook"]."</p></td>
    </tr>
    
    <tr>
        <td colspan =2>参与科研<p>".$arr["FsciPro"]."</p></td>
    </tr>
    
    <tr>
        <td colspan = 2>文章发表<p>".$arr["Fpaper"]."</p></td>
    </tr>
    
    <tr>
        <td colspan = 2>课外竟赛<p>".$arr["Fcompetition"]."</p></td>
    </tr>
    
    <tr>
        <td colspan = 2>游学经历<p>".$arr["Ftour"]."</p></td>
    </tr>
    
    <tr>
        <td colspan = 2>社会活动<p>".$arr["FgroupAct"]."</p></td>
    </tr>
    
    <tr>
        <td colspan = 2>递交入党申请书时间为：<br />".$arr["FapplyDate"]."</td>
        
    </tr>
    <tr>
        <td colspan = 2>其它经历<p>".$arr["FotherExp"]."</p></td>
        <td colspan = 4>本人在此郑重声明：上述材料真实有效。 </td>
    </tr>
</table>

";
    }
    else{
        echo "对不起，条件填写错误或无学号为".$sid."的学生当年信息";
    }

}

    echo "
    </body>
    </html>
    ";

	mysql_close($con);
?>
