function setHeight($id,$height)
{	
		$height1 = parseFloat($height) + 11;
		$("#sidebar").css('height',$height+'px');
		$("#main").css('height',$height+'px');
		$("#mainbox").css('height',$height1+ 'px');
}

function showStuInfo($sid,$s621,$s622)
{
				//创建id名称的数组
				var idName = new Array("name","gender","sid","politics","phoneNum","dorm","department","grade","major","class","email","qq","charityAct","charityHours","book","bookNum","competition","groupAct","groupActTimes","sciPro","patent","paper","failSub","failSubNum","GPA","churchyard","abroad","scholarship","grantsInAid","loan","partTimeJob","Allowance","inside","outside","occupation","otherExp","train","trainHours","thought","Ftour");
				var idName2 = new Array("applyDateYear","applyDateMonth","applyDateDay","FapplyDateYear","FapplyDateMonth","FapplyDateDay");
				var idName3 = new Array("FcharityAct","FGPA","Fbook","FsciPro","Fpaper","Fcompetition","Ftour","FgroupAct","FotherExp");
				var HTMLStr = "<table><caption>基本信息</caption><tr><td>名字</td><td id = 'name'></td><td>性别</td><td id = 'gender'></td><td>学号</td><td id = 'sid'></td></tr><tr><td>政治面貌</td><td id = 'politics'></td><td>手机号</td><td id = 'phoneNum'></td><td>宿舍</td> <td id = 'dorm'></td></tr><tr><td>院系</td><td id = 'department'></td><td>年级</td><td id = 'grade'></td><td>专业</td><td id = 'major'></td></tr><tr><td>班级</td><td id = 'class'></td><td>邮箱</td><td id = 'email'></td><td>QQ</td><td id = 'qq'></td></tr></table><table><caption>本年成果展</caption><tr><td>我参加过的公益活动有：<p id = 'charityAct'></p><span id = 'charityHours'>共计</span><span>个公益小时</span></td> <td>我阅读了以下课外经典书籍：<p id = 'book'></p><span id = 'bookNum'>共计</span><span>本</span></td><td>我参加了以下的课外竞赛：（包括竞赛项目、竞赛时间、竞赛地点及获奖情况）：<p id = 'competition'></p></td></tr><tr><td rowspan='2'>我参与了以下的集体活动：（包括班级、社团等）<p id = 'groupAct'></p><span id = 'groupActTimes'>累计</span><span>次</span></td><td>我参加的科研项目及指导老师是：<p id = 'sciPro'></p></td><td>我申请了以下专利:<p id = 'patent'></p></td></tr><tr><td>文章、论文发表的刊物、期刊号：<p id = 'paper'></p></td><td><span id = 'failSubNum'>我不及格的科目有</span><span>门，分别是</span><p id = 'failSub'></p><span id = 'GPA'>我取得的绩点是：</span></td></tr><tr> <td rowspan = '2'>我的短期游学经历有：（包括短期境外文化交流的时间、地点、主题及举办单位）<p id = 'tour'><span>国内：</span><span id = 'churchyard'></span><br /><span>国外：</span><span id = 'abroad'></span><span></p></td><td rowspan = '4'>我接受了以下的帮助：<p>奖学金: </p><p id = 'scholarship'></p>助学金（项目、金额、时间）:<p id = 'grantsInAid'></p>国家助学贷款或生源地贷款：<p id = 'loan'></p>勤工助学（工作单位、每周工作时间）：<p id = 'partTimeJob'></p>临时经济困难补助（获补助时间、金额）：<p id = 'Allowance'></p></td><td rowspan = '2'>我获得了以下的奖项：<p>校内:</p><p id = 'inside'></p><p>校外：</p><p id = 'outside'></p></td></tr><tr></tr><tr> <td>我的任职情况如下：<p id = 'occupation'></p></td><td>我的其他经历有：<p id = 'otherExp'></p></td></tr><tr><td>我参加了以下的课外锻炼：<p id = 'train'></p><span id = 'trainHours'>每日大约平均</span><span>个小时</span></td><td>我于<span id = 'applyDateYear'></span><span>年</span><span id = 'applyDateMonth'></span><span>月</span><span id = 'applyDateDay'></span><span>日向党组织递交了入党申请书。</span></td></tr></table><table id='forth'><caption>愿景及感悟</caption><tr><th>愿 景</th><th>感 悟</th><tr><tr><td>公益活动<p id = 'FcharityAct'></p></td><td rowspan = '9'><p id = 'thought'></p></td></tr><tr> <td>成绩绩点<p id = 'FGPA'></p></td></tr> <tr><td>课外阅读<p id = 'Fbook'></p></td></tr><tr><td>参与科研<p id = 'FsciPro'></p></td></tr> <tr><td>文章发表<p id = 'Fpaper'></p></td></tr><tr> <td>课外竟赛<p id = 'Fcompetition'></p></td></tr> <tr> <td>游学经历<p id = 'Ftour'></p></td> </tr><tr><td>社会活动<p id = 'FgroupAct'></p></td></tr><tr> <td>我计划于<span id = 'FapplyDateYear'></span><span>年</span><span id = 'FapplyDateMonth'></span><span>月</span><span id = 'FapplyDateDay'></span><span>日递交入党申请书。</span></td></tr><tr><td>其它经历<p id = 'FotherExp'></p></td><td>本人在此郑重声明，上述填写的材料真实有效。 </td></tr></table>";
				$("#studentNewCont").empty();
				var cnt = 987;
				var not_cnt = 0;
				for (var j=$s621; j<=$s622;j++)
				{
					$("#studentNewCont").append("<div id='studentNewCont" + j + "'>" + j + "年的数据正在加载中...</div>");
					
					$.post('request/stuInfo.php',{sid:$sid, fillYear:j}, function(json){
						var ret = $.parseJSON(json);
						
						if(ret.exist == "Y")
						{
							cnt++;
							setHeight('studentNewCont', '2300'*(cnt-987) + '100'*not_cnt);
							//修改idName,idName3替换一次就可以了
							for (var i=0; i<idName.length; i++)
							{
								HTMLStr =  HTMLStr.replace(new RegExp(idName[i],"g"),idName[i]+cnt);
							}
							for (var i=0; i<idName2.length/2; i++)
							{
								HTMLStr =  HTMLStr.replace(new RegExp(idName2[i],"g"),idName2[i]+cnt);
							}
							
							//alert(HTMLStr); //如果不理解修改后的名称，可以看这个。
							document.getElementById("studentNewCont" + ret.fillYear ).innerHTML = "<h3>"+ ret.fillYear + "</h3></br>" + HTMLStr;
							
							for (var i=0; i<idName.length; i++)
							{
								var idStr = idName[i];
								//特殊情况
								if (idStr == 'bookNum') document.getElementById("book" + cnt + "Num").innerHTML += ret[idStr];
								else if(idStr == "groupActTimes") document.getElementById("groupAct" + cnt + "Times").innerHTML += ret[idStr];
								else if(idStr == "failSubNum")  document.getElementById("failSub" + cnt + "Num").innerHTML += ret[idStr];
								else if (idStr == "inside") document.getElementById("insid" + cnt + "e").innerHTML += ret[idStr];
								else if (idStr == "outside") document.getElementById("outsid" + cnt + "e").innerHTML += ret[idStr];
								else if (idStr == "trainHours") document.getElementById("train" + cnt + "Hours").innerHTML += ret[idStr];
								else document.getElementById(idName[i]+cnt).innerHTML += ret[idStr];
							}
							for (var i=0; i<idName3.length; i++)
							{
								var idStr = idName3[i];
								document.getElementById(idName3[i]+cnt).innerHTML += ret[idStr];
							}
							
							document.getElementById("applyDateYear"+cnt).innerHTML+=ret.applyDate.substr(0,4);	
							document.getElementById("applyDateMonth"+cnt).innerHTML+=ret.applyDate.substr(5,2);	
							document.getElementById("applyDateDay"+cnt).innerHTML+=ret.applyDate.substr(8,2);	
				
					
							document.getElementById("FapplyDateYear"+cnt).innerHTML+=ret.FapplyDate.substr(0,4);	
							document.getElementById("FapplyDateMonth"+cnt).innerHTML+=ret.FapplyDate.substr(5,2);	
							document.getElementById("FapplyDateDay"+cnt).innerHTML+=ret.FapplyDate.substr(8,2);	
							
							//还原HTML；
							HTMLStr = "<table><caption>基本信息</caption><tr><td>名字</td><td id = 'name'></td><td>性别</td><td id = 'gender'></td><td>学号</td><td id = 'sid'></td></tr><tr><td>政治面貌</td><td id = 'politics'></td><td>手机号</td><td id = 'phoneNum'></td><td>宿舍</td> <td id = 'dorm'></td></tr><tr><td>院系</td><td id = 'department'></td><td>年级</td><td id = 'grade'></td><td>专业</td><td id = 'major'></td></tr><tr><td>班级</td><td id = 'class'></td><td>邮箱</td><td id = 'email'></td><td>QQ</td><td id = 'qq'></td></tr></table><table><caption>本年成果展</caption><tr><td>我参加过的公益活动有：<p id = 'charityAct'></p><span id = 'charityHours'>共计</span><span>个公益小时</span></td> <td>我阅读了以下课外经典书籍：<p id = 'book'></p><span id = 'bookNum'>共计</span><span>本</span></td><td>我参加了以下的课外竞赛：（包括竞赛项目、竞赛时间、竞赛地点及获奖情况）：<p id = 'competition'></p></td></tr><tr><td rowspan='2'>我参与了以下的集体活动：（包括班级、社团等）<p id = 'groupAct'></p><span id = 'groupActTimes'>累计</span><span>次</span></td><td>我参加的科研项目及指导老师是：<p id = 'sciPro'></p></td><td>我申请了以下专利:<p id = 'patent'></p></td></tr><tr><td>文章、论文发表的刊物、期刊号：<p id = 'paper'></p></td><td><span id = 'failSubNum'>我不及格的科目有</span><span>门，分别是</span><p id = 'failSub'></p><span id = 'GPA'>我取得的绩点是：</span></td></tr><tr> <td rowspan = '2'>我的短期游学经历有：（包括短期境外文化交流的时间、地点、主题及举办单位）<p id = 'tour'><span>国内：</span><span id = 'churchyard'></span><br /><span>国外：</span><span id = 'abroad'></span><span></p></td><td rowspan = '4'>我接受了以下的帮助：<p>奖学金: </p><p id = 'scholarship'></p>助学金（项目、金额、时间）:<p id = 'grantsInAid'></p>国家助学贷款或生源地贷款：<p id = 'loan'></p>勤工助学（工作单位、每周工作时间）：<p id = 'partTimeJob'></p>临时经济困难补助（获补助时间、金额）：<p id = 'Allowance'></p></td><td rowspan = '2'>我获得了以下的奖项：<p>校内:</p><p id = 'inside'></p><p>校外：</p><p id = 'outside'></p></td></tr><tr></tr><tr> <td>我的任职情况如下：<p id = 'occupation'></p></td><td>我的其他经历有：<p id = 'otherExp'></p></td></tr><tr><td>我参加了以下的课外锻炼：<p id = 'train'></p><span id = 'trainHours'>每日大约平均</span><span>个小时</span></td><td>我于<span id = 'applyDateYear'></span><span>年</span><span id = 'applyDateMonth'></span><span>月</span><span id = 'applyDateDay'></span><span>日向党组织递交了入党申请书。</span></td></tr></table><table id='forth'><caption>愿景及感悟</caption><tr><th>愿 景</th><th>感 悟</th><tr><tr><td>公益活动<p id = 'FcharityAct'></p></td><td rowspan = '9'><p id = 'thought'></p></td></tr><tr> <td>成绩绩点<p id = 'FGPA'></p></td></tr> <tr><td>课外阅读<p id = 'Fbook'></p></td></tr><tr><td>参与科研<p id = 'FsciPro'></p></td></tr> <tr><td>文章发表<p id = 'Fpaper'></p></td></tr><tr> <td>课外竟赛<p id = 'Fcompetition'></p></td></tr> <tr> <td>游学经历<p id = 'Ftour'></p></td> </tr><tr><td>社会活动<p id = 'FgroupAct'></p></td></tr><tr> <td>我计划于<span id = 'FapplyDateYear'></span><span>年</span><span id = 'FapplyDateMonth'></span><span>月</span><span id = 'FapplyDateDay'></span><span>日递交入党申请书。</span></td></tr><tr><td>其它经历<p id = 'FotherExp'></p></td><td>本人在此郑重声明，上述填写的材料真实有效。 </td></tr></table>";
				
						}
						else
						{
							not_cnt++;
							document.getElementById("studentNewCont" + ret.fillYear  ).innerHTML = "<h3>"+  ret.fillYear + "</h3></br>" + "数据库中没有查找到学号为" + $sid + "的学生的相关年份数据";
							setHeight('studentNewCont', '2300'*(cnt-987) + '100'*not_cnt);
						}
					})
			
				}
}

function isNum(num){
  var reNum=/^\d*$/;
  return(reNum.test(num));
}

$(function(){
	//学生信息的显示；
	
	var $s1 = $("#s1_button");
	
	$s1.click(function(){
		
		$("#studentCont").empty();
		var $s11 = $("#s11_input").val();
		var $s121 = $("#s121_input").val();
		var $s122 = $("#s122_input").val();
		
		if(parseInt($s121) > parseInt($s122)) $("#studentCont").html("年份范围错误</br>原因：起始年份比结束年份大");
		else
		{
			//创建id名称的数组
			var idName = new Array("name","gender","sid","politics","phoneNum","dorm","department","grade","major","class","email","qq","charityAct","charityHours","book","bookNum","competition","groupAct","groupActTimes","sciPro","patent","paper","failSub","failSubNum","GPA","churchyard","abroad","scholarship","grantsInAid","loan","partTimeJob","Allowance","inside","outside","occupation","otherExp","train","trainHours","thought","Ftour");
			var idName2 = new Array("applyDateYear","applyDateMonth","applyDateDay","FapplyDateYear","FapplyDateMonth","FapplyDateDay");
			var idName3 = new Array("FcharityAct","FGPA","Fbook","FsciPro","Fpaper","Fcompetition","Ftour","FgroupAct","FotherExp");
			
			var HTMLStr = "<table><caption>基本信息</caption><tr><td>名字</td><td id = 'name'></td><td>性别</td><td id = 'gender'></td><td>学号</td><td id = 'sid'></td></tr><tr><td>政治面貌</td><td id = 'politics'></td><td>手机号</td><td id = 'phoneNum'></td><td>宿舍</td> <td id = 'dorm'></td></tr><tr><td>院系</td><td id = 'department'></td><td>年级</td><td id = 'grade'></td><td>专业</td><td id = 'major'></td></tr><tr><td>班级</td><td id = 'class'></td><td>邮箱</td><td id = 'email'></td><td>QQ</td><td id = 'qq'></td></tr></table><table><caption>本年成果展</caption><tr><td>我参加过的公益活动有：<p id = 'charityAct'></p><span id = 'charityHours'>共计</span><span>个公益小时</span></td> <td>我阅读了以下课外经典书籍：<p id = 'book'></p><span id = 'bookNum'>共计</span><span>本</span></td><td>我参加了以下的课外竞赛：（包括竞赛项目、竞赛时间、竞赛地点及获奖情况）：<p id = 'competition'></p></td></tr><tr><td rowspan='2'>我参与了以下的集体活动：（包括班级、社团等）<p id = 'groupAct'></p><span id = 'groupActTimes'>累计</span><span>次</span></td><td>我参加的科研项目及指导老师是：<p id = 'sciPro'></p></td><td>我申请了以下专利:<p id = 'patent'></p></td></tr><tr><td>文章、论文发表的刊物、期刊号：<p id = 'paper'></p></td><td><span id = 'failSubNum'>我不及格的科目有</span><span>门，分别是</span><p id = 'failSub'></p><span id = 'GPA'>我取得的绩点是：</span></td></tr><tr> <td rowspan = '2'>我的短期游学经历有：（包括短期境外文化交流的时间、地点、主题及举办单位）<p id = 'tour'><span>国内：</span><span id = 'churchyard'></span><br /><span>国外：</span><span id = 'abroad'></span><span></p></td><td rowspan = '4'>我接受了以下的帮助：<p>奖学金: </p><p id = 'scholarship'></p>助学金（项目、金额、时间）:<p id = 'grantsInAid'></p>国家助学贷款或生源地贷款：<p id = 'loan'></p>勤工助学（工作单位、每周工作时间）：<p id = 'partTimeJob'></p>临时经济困难补助（获补助时间、金额）：<p id = 'Allowance'></p></td><td rowspan = '2'>我获得了以下的奖项：<p>校内:</p><p id = 'inside'></p><p>校外：</p><p id = 'outside'></p></td></tr><tr></tr><tr> <td>我的任职情况如下：<p id = 'occupation'></p></td><td>我的其他经历有：<p id = 'otherExp'></p></td></tr><tr><td>我参加了以下的课外锻炼：<p id = 'train'></p><span id = 'trainHours'>每日大约平均</span><span>个小时</span></td><td>我于<span id = 'applyDateYear'></span><span>年</span><span id = 'applyDateMonth'></span><span>月</span><span id = 'applyDateDay'></span><span>日向党组织递交了入党申请书。</span></td></tr></table><table id='forth'><caption>愿景及感悟</caption><tr><th>愿 景</th><th>感 悟</th><tr><tr><td>公益活动<p id = 'FcharityAct'></p></td><td rowspan = '9'><p id = 'thought'></p></td></tr><tr> <td>成绩绩点<p id = 'FGPA'></p></td></tr> <tr><td>课外阅读<p id = 'Fbook'></p></td></tr><tr><td>参与科研<p id = 'FsciPro'></p></td></tr> <tr><td>文章发表<p id = 'Fpaper'></p></td></tr><tr> <td>课外竟赛<p id = 'Fcompetition'></p></td></tr> <tr> <td>游学经历<p id = 'Ftour'></p></td> </tr><tr><td>社会活动<p id = 'FgroupAct'></p></td></tr><tr> <td>我计划于<span id = 'FapplyDateYear'></span><span>年</span><span id = 'FapplyDateMonth'></span><span>月</span><span id = 'FapplyDateDay'></span><span>日递交入党申请书。</span></td></tr><tr><td>其它经历<p id = 'FotherExp'></p></td><td>本人在此郑重声明，上述填写的材料真实有效。 </td></tr></table>";
			
			var cnt = -1;
			var not_cnt = 0;
			for (var j=$s121; j<=$s122;j++)
			{
				$("#studentCont").append("<div id='studentCont" + j + "'>" + j + "年的数据正在加载中...</div>");
				$.post('request/stuInfo.php',{sid:$s11, fillYear:j}, function(json){
					
					var ret = $.parseJSON(json);
					if(ret.exist == "Y")
					{
						cnt++;
						setHeight('studentCont', '2200'*(cnt+1) + '100'*not_cnt);
						//修改idName,idName3替换一次就可以了
						for (var i=0; i<idName.length; i++)
						{
							HTMLStr =  HTMLStr.replace(new RegExp(idName[i],"g"),idName[i]+cnt);
						}
						for (var i=0; i<idName2.length/2; i++)
						{
							HTMLStr =  HTMLStr.replace(new RegExp(idName2[i],"g"),idName2[i]+cnt);
							
						}
						
						//alert(HTMLStr); //如果不理解修改后的名称，可以看这个。
						document.getElementById("studentCont" + ret.fillYear ).innerHTML = "<h3>"+ ret.fillYear + "</h3></br>" + HTMLStr;
								
						for (var i=0; i<idName.length; i++)
						{
							var idStr = idName[i];
							//特殊情况
							if (idStr == 'bookNum') document.getElementById("book" + cnt + "Num").innerHTML += ret[idStr];
							else if(idStr == "groupActTimes") document.getElementById("groupAct" + cnt + "Times").innerHTML += ret[idStr];
							else if(idStr == "failSubNum")  document.getElementById("failSub" + cnt + "Num").innerHTML += ret[idStr];
							else if (idStr == "inside") document.getElementById("insid" + cnt + "e").innerHTML += ret[idStr];
							else if (idStr == "outside") document.getElementById("outsid" + cnt + "e").innerHTML += ret[idStr];
							else if (idStr == "trainHours") document.getElementById("train" + cnt + "Hours").innerHTML += ret[idStr];
							else document.getElementById(idName[i]+cnt).innerHTML += ret[idStr];
						}
						for (var i=0; i<idName3.length; i++)
						{
							var idStr = idName3[i];
							document.getElementById(idName3[i]+cnt).innerHTML += ret[idStr];
						}
						
						document.getElementById("applyDateYear"+cnt).innerHTML+=ret.applyDate.substr(0,4);	
						document.getElementById("applyDateMonth"+cnt).innerHTML+=ret.applyDate.substr(5,2);	
						document.getElementById("applyDateDay"+cnt).innerHTML+=ret.applyDate.substr(8,2);	
			
				
						document.getElementById("FapplyDateYear"+cnt).innerHTML+=ret.FapplyDate.substr(0,4);	
						document.getElementById("FapplyDateMonth"+cnt).innerHTML+=ret.FapplyDate.substr(5,2);	
						document.getElementById("FapplyDateDay"+cnt).innerHTML+=ret.FapplyDate.substr(8,2);	
						
						//还原HTML；
						HTMLStr = "<table><caption>基本信息</caption><tr><td>名字</td><td id = 'name'></td><td>性别</td><td id = 'gender'></td><td>学号</td><td id = 'sid'></td></tr><tr><td>政治面貌</td><td id = 'politics'></td><td>手机号</td><td id = 'phoneNum'></td><td>宿舍</td> <td id = 'dorm'></td></tr><tr><td>院系</td><td id = 'department'></td><td>年级</td><td id = 'grade'></td><td>专业</td><td id = 'major'></td></tr><tr><td>班级</td><td id = 'class'></td><td>邮箱</td><td id = 'email'></td><td>QQ</td><td id = 'qq'></td></tr></table><table><caption>本年成果展</caption><tr><td>我参加过的公益活动有：<p id = 'charityAct'></p><span id = 'charityHours'>共计</span><span>个公益小时</span></td> <td>我阅读了以下课外经典书籍：<p id = 'book'></p><span id = 'bookNum'>共计</span><span>本</span></td><td>我参加了以下的课外竞赛：（包括竞赛项目、竞赛时间、竞赛地点及获奖情况）：<p id = 'competition'></p></td></tr><tr><td rowspan='2'>我参与了以下的集体活动：（包括班级、社团等）<p id = 'groupAct'></p><span id = 'groupActTimes'>累计</span><span>次</span></td><td>我参加的科研项目及指导老师是：<p id = 'sciPro'></p></td><td>我申请了以下专利:<p id = 'patent'></p></td></tr><tr><td>文章、论文发表的刊物、期刊号：<p id = 'paper'></p></td><td><span id = 'failSubNum'>我不及格的科目有</span><span>门，分别是</span><p id = 'failSub'></p><span id = 'GPA'>我取得的绩点是：</span></td></tr><tr> <td rowspan = '2'>我的短期游学经历有：（包括短期境外文化交流的时间、地点、主题及举办单位）<p id = 'tour'><span>国内：</span><span id = 'churchyard'></span><br /><span>国外：</span><span id = 'abroad'></span><span></p></td><td rowspan = '4'>我接受了以下的帮助：<p>奖学金: </p><p id = 'scholarship'></p>助学金（项目、金额、时间）:<p id = 'grantsInAid'></p>国家助学贷款或生源地贷款：<p id = 'loan'></p>勤工助学（工作单位、每周工作时间）：<p id = 'partTimeJob'></p>临时经济困难补助（获补助时间、金额）：<p id = 'Allowance'></p></td><td rowspan = '2'>我获得了以下的奖项：<p>校内:</p><p id = 'inside'></p><p>校外：</p><p id = 'outside'></p></td></tr><tr></tr><tr> <td>我的任职情况如下：<p id = 'occupation'></p></td><td>我的其他经历有：<p id = 'otherExp'></p></td></tr><tr><td>我参加了以下的课外锻炼：<p id = 'train'></p><span id = 'trainHours'>每日大约平均</span><span>个小时</span></td><td>我于<span id = 'applyDateYear'></span><span>年</span><span id = 'applyDateMonth'></span><span>月</span><span id = 'applyDateDay'></span><span>日向党组织递交了入党申请书。</span></td></tr></table><table id='forth'><caption>愿景及感悟</caption><tr><th>愿 景</th><th>感 悟</th><tr><tr><td>公益活动<p id = 'FcharityAct'></p></td><td rowspan = '9'><p id = 'thought'></p></td></tr><tr> <td>成绩绩点<p id = 'FGPA'></p></td></tr> <tr><td>课外阅读<p id = 'Fbook'></p></td></tr><tr><td>参与科研<p id = 'FsciPro'></p></td></tr> <tr><td>文章发表<p id = 'Fpaper'></p></td></tr><tr> <td>课外竟赛<p id = 'Fcompetition'></p></td></tr> <tr> <td>游学经历<p id = 'Ftour'></p></td> </tr><tr><td>社会活动<p id = 'FgroupAct'></p></td></tr><tr> <td>我计划于<span id = 'FapplyDateYear'></span><span>年</span><span id = 'FapplyDateMonth'></span><span>月</span><span id = 'FapplyDateDay'></span><span>日递交入党申请书。</span></td></tr><tr><td>其它经历<p id = 'FotherExp'></p></td><td>本人在此郑重声明，上述填写的材料真实有效。 </td></tr></table>";
			
					}
					else
					{
						not_cnt++;
						document.getElementById("studentCont" + ret.fillYear  ).innerHTML = "<h3>"+  ret.fillYear + "</h3></br>" + "数据库中没有查找到学号为" + $s11 + "的学生的相关年份数据";
						setHeight('studentCont', 500 +'2200'*(cnt+1) + '100'*not_cnt);
					}
				})
		
			}
		
		}
	})
	
	
	//全校信息总表的显示；
	
	
	var $s2 = $("#s2_button");
	
	$s2.click(function(){
		var $s21 = $("#s2_input").val();
		//if(!isNum($s21)|| ($s21 == "")) document.getElementById("schoolCont").innerHTML = "请确定是否输入有误！</br>提示：输入值为空或年份输入有误!";
		
		//else
		//{
			$.post('request/collegeTotal.php',{fillYear: $s21}, function(json){
				var ret = $.parseJSON(json);
				if(ret.exist == "Y")
				{
					document.getElementById("schoolCont").innerHTML = "<table id='fifth'><caption>信息统计</caption><tr><td>平均公益时数</td><td id = 'avgCHour'></td><td>平均集体活动次数</td><td id = 'AvgGroupActNum'></td> <td>每月锻炼时数</td><td id = 'avgTrainHour'></td></tr><tr><td>学科不及格人数</td> <td id = 'totalFailSub'></td> <td>党员人数</td><td id = 'partyMemNum'></td><td>团员人数</td><td id = 'LeagueMemNum'></td></tr></table><div id='bookRank'></div><table id='sixth'><caption>获奖情况</caption><tr><th>国家级</th><th>省级</th><th>校级</th><th>院级</th></tr><tr><td id = 'countryPriNum'></td> <td id = 'provincePriNum'></td><td id = 'CollegePriNum'></td><td id = 'departPriNum'></td></tr></table><table id='seventh'><caption>专利情况</caption><tr><th>发明专利</th><th>实用新型专利</th><th>外观设计专利</th></tr><tr><td id = 'patentType1Num'></td> <td id = 'patentType2Num'></td><td id = 'patentType3Num'></td></tr></table><table id='tour'></table><div class='tourExtra'><span>总人数：</span><span id='stuNum'></span></br><span>参与境外游学人数：</span><span id='cntTourNum'></span></br><span>参与境外游学总次数: </span><span id='cntTourTimes'></span></br><span>境外游学（人/次）:</span><span  id='avgTourTimes'></span></br><span>境外游学平均时长:</span><span p id='avgTourDay'></span></div>";
					setHeight('schoolCont', '2000');
					document.getElementById("avgCHour").innerHTML=ret.avgCHour;	
					document.getElementById("countryPriNum").innerHTML=ret.countryPriNum;	
					document.getElementById("provincePriNum").innerHTML=ret.provincePriNum;	
					document.getElementById("CollegePriNum").innerHTML=ret.CollegePriNum;	
					document.getElementById("departPriNum").innerHTML=ret.departPriNum;	
					document.getElementById("AvgGroupActNum").innerHTML=ret.AvgGroupActNum;	
					document.getElementById("patentType1Num").innerHTML=ret.patentType1Num;	
					document.getElementById("patentType2Num").innerHTML=ret.patentType2Num;	
					document.getElementById("patentType3Num").innerHTML=ret.patentType3Num;	
					document.getElementById("avgTrainHour").innerHTML=ret.avgTrainHour;	
					document.getElementById("totalFailSub").innerHTML=ret.totalFailSub;	
					document.getElementById("partyMemNum").innerHTML=ret.partyMemNum;
					document.getElementById("LeagueMemNum").innerHTML+=ret.LeagueMemNum;	
					document.getElementById("avgTourDay").innerHTML+=ret.avgTourDay + '天/次';
		
		
					var detailHtml = "<table><caption>图书排名情况</caption><tr><th>排名</th><th>书名</th><th>本数</th></tr>";
		
					for (var i=0; i<ret.bookRank.length;i++)
					{
			
						detailHtml = detailHtml + '<tr><td>' + (i+1) + '</td>';
						detailHtml = detailHtml + '<td>' + ret.bookRank[i].bookName + '</td>';
						detailHtml = detailHtml + '<td>' + ret.bookRank[i].bookNum + '</td></tr>';
					}
					document.getElementById("bookRank").innerHTML = detailHtml;
		
					var tourHtml =  "<table><caption>本年度游学情况</caption><tr><th>国家/地区</th><th>人数</th></tr></table>";
					for (var i=0; i<ret.tour.length;i++)
					{
						tourHtml =  tourHtml + '<tr><td>' + ret.tour[i].place + '</td>';
						tourHtml =  tourHtml + '<td>' + ret.tour[i]. cnt + '</td></tr></table>';
					}
		
					document.getElementById("tour").innerHTML =  tourHtml;
			
		
					document.getElementById("stuNum").innerHTML=ret.stuNum;
					document.getElementById("cntTourNum").innerHTML=ret.cntTourNum;
					document.getElementById("cntTourTimes").innerHTML=ret.cntTourTimes;
					document.getElementById("avgTourTimes").innerHTML=ret.avgTourTimes;
				}
				else
				{
					document.getElementById("schoolCont").innerHTML = "数据库中没有查找到相关数据，请确定是否输入有误！";
				}
			})
		//}
		
	})
	
	
	//对应学院的总表显示；
	var $s3 = $("#s3_button");
	
	$s3.click(function(){
		
		
		
		var $s31 = $("#s31_input").val();
		var $s32 = $("#s32_input").val();
		
		//if(!isNum($s32) || ($s32 == "") || ($s31==""))  
			//document.getElementById("departmentCont").innerHTML = "请确定是否输入有误！</br>提示：输入值为空或年份输入有误!";
		//else
		//{
			$.post('request/schoolTotal.php',{department:$s31, fillYear: $s32}, function(json){
				var ret = $.parseJSON(json);
			
				if(ret.exist == "Y")
				{
			
					//设置高度的地方
					setHeight('departmentCont', '1200');
					document.getElementById("departmentCont").innerHTML = "<table id='eighth'><caption>信息统计</caption><tr><td>平均公益时数</td><td id = 'avgCHour1'></td><td>平均集体活动次数</td><td id = 'AvgGroupActNum1'></td> <td>每月锻炼时数</td><td id = 'avgTrainHour1'></td></tr><tr><td>学科不及格人数</td> <td id = 'totalFailSub1'></td> <td>党员人数</td><td id = 'partyMemNum1'></td><td>团员人数</td><td id = 'LeagueMemNum1'></td></tr></table><table id='ninth'><caption>获奖情况</caption><tr><th>国家级</th><th>省级</th><th>校级</th><th>院级</th></tr><tr><td id = 'countryPriNum1'></td> <td id = 'provincePriNum1'></td><td id = 'CollegePriNum1'></td><td id = 'departPriNum1'></td></tr></table><table id='tenth'><caption>专利情况</caption><tr><th>发明专利</th><th>实用新型专利</th><th>外观设计专利</th></tr><tr><td id = 'patentType1Num1'></td> <td id = 'patentType2Num1'></td><td id = 'patentType3Num1'></td></tr></table><table id='tour1'></table><div class='tourExtra'><span>本学院人数：</span><span id='stuNum1'></span></br><span>参与境外游学人数：</span><span id='cntTourNum1'></span></br><span>参与境外游学总次数: </span><span id='cntTourTimes1'></span></br><span>境外游学（次/人）:</span><span  id='avgTourTimes1'></span></br><span>境外游学平均时长:</span><span p id='avgTourDay1'></span></div>";
			
					document.getElementById("avgCHour1").innerHTML=ret.avgCHour;	
					document.getElementById("countryPriNum1").innerHTML=ret.countryPriNum;	
					document.getElementById("provincePriNum1").innerHTML=ret.provincePriNum;	
					document.getElementById("CollegePriNum1").innerHTML=ret.CollegePriNum;	
					document.getElementById("departPriNum1").innerHTML=ret.departPriNum;	
					document.getElementById("AvgGroupActNum1").innerHTML=ret.AvgGroupActNum;	
					document.getElementById("patentType1Num1").innerHTML=ret.patentType1Num;	
					document.getElementById("patentType2Num1").innerHTML=ret.patentType2Num;	
					document.getElementById("patentType3Num1").innerHTML=ret.patentType3Num;	
					document.getElementById("avgTrainHour1").innerHTML=ret.avgTrainHour;	
					document.getElementById("totalFailSub1").innerHTML=ret.totalFailSub;	
					document.getElementById("partyMemNum1").innerHTML=ret.partyMemNum;
					document.getElementById("LeagueMemNum1").innerHTML+=ret.LeagueMemNum;	
					document.getElementById("avgTourDay1").innerHTML+=ret.avgTourDay + '天/次';
		
		
					var tourHtml =  "<table><caption>本年度游学情况</caption><tr><th>国家/地区</th><th>人数</th></tr></table>";
					for (var i=0; i<ret.tour.length;i++)
					{
						tourHtml =  tourHtml + '<tr><td>' + ret.tour[i].place + '</td>';
						tourHtml =  tourHtml + '<td>' + ret.tour[i]. cnt + '</td></tr></table>';
					}
		
					document.getElementById("tour1").innerHTML =  tourHtml;
			
			
					document.getElementById("stuNum1").innerHTML=ret.stuNum;
					document.getElementById("cntTourNum1").innerHTML=ret.cntTourNum;
					document.getElementById("cntTourTimes1").innerHTML=ret.cntTourTimes;
					document.getElementById("avgTourTimes1").innerHTML=ret.avgTourTimes;
					}
					else
					{
						document.getElementById("departmentCont").innerHTML = "数据库中没有查找到相关数据，请确定是否输入有误！";
					}
				})
			//}
		
		
	})
	
	var $s4 = $("#s4_button");
	
	//年级统计表的显示
	$s4.click(function(){
		
		
		var $s41 = $("#s41_input").val();
		var $s42 = $("#s42_input").val();
		var $s43 = $("#s43_input").val();
		
		if(!isNum($s43)|| ($s43 == ""))  
				document.getElementById("gradeStcCont").innerHTML = "请确定是否输入有误！</br>提示：应交人数为空或输入有误!";
				
		else
		{
			$.post('request/gradeTotal.php',{grade:$s41, fillYear: $s42, should_pass : $s43},function(json){

				var ret = $.parseJSON(json);
				if(ret.exist == "Y")
				{
					
					//设置高度的地方
					setHeight('gradeStcCont', '1700');
					document.getElementById("gradeStcCont").innerHTML = "<table><caption><span id='grade21'></span>成长轨统计数据</caption><tr><td>年级</td><td>应交</td><td>未交</td><td>实交</td><td>党员人数</td></tr><tr><td id='grade22'></td><td id='should_pass1'></td><td id='not_pass1'></td><td id='fact_pass1'></td><td id='partyMemNum22'></tr><table><table><tr><td  colspan = '3'>填写项目</td><td colspan = '3'>已填写（百分比）</td><td colspan = '3'>填写人数</td></tr><tr><td  colspan = '3'>参与公益</td><td colspan = '3' id='charityAct21'></td><td colspan = '3' id='charityAct2'></td></tr><tr><td  colspan = '3'>阅读经典书籍</td><td colspan = '3' id='book21'></td><td colspan = '3' id='book2'></td></tr><tr><td  colspan = '3'>集体活动</td><td colspan = '3' id='groupAct21'></td><td colspan = '3' id='groupAct2'></td></tr><tr><td  colspan = '3'>参加课外锻炼</td><td colspan = '3' id='train21'></td><td colspan = '3' id='train2'></td></tr><tr><td  colspan = '3'>短期游学交流</td><td colspan = '3' id='tour21'></td><td colspan = '3' id='tour2'></td></tr><tr><td  colspan = '3'>不及格人数</td><td colspan = '3' id='failSubNum21'></td><td colspan = '3' id='failSubNum2'></td></tr><tr><td  colspan = '3'>课外竞赛</td><td colspan = '3' id='competition21'></td><td colspan = '3' id='competition2'></td></tr><tr><td  colspan = '3'>科研项目</td><td colspan = '3' id='sciPro21'></td><td colspan = '3' id='sciPro2'></td></tr><tr><td  colspan = '3'>文章发表</td><td colspan = '3' id='paper21'></td><td colspan = '3' id='paper2'></td></tr><tr><td  colspan = '3'>申请专利</td><td colspan = '3' id='patent21'></td><td colspan = '3' id='patent2'></td></tr><tr><td  colspan = '3'>任职情况</td><td colspan = '3' id='occupation21'></td><td colspan = '3' id='occupation2'></td></tr><tr><td  colspan = '3'>接受帮助</td><td colspan = '3' id='help21'></td><td colspan = '3' id='help2'></td></tr><tr><td  colspan = '3'>获得奖项</td><td colspan = '3' id='prize21'></td><td colspan = '3' id='prize2'></td></tr><tr><td  colspan = '3'>其他经历</td><td colspan = '3' id='otherExp21'></td><td colspan = '3' id='otherExp2'></td></tr><table><table><tr><td  colspan = '7'>项目</td><td colspan = '3' >平均数</td></tr><tr><td  colspan = '7'>参加公益时长</td><td colspan = '3' id='avgcharityHoursNum2'></td></tr><tr><td  colspan = '7'>阅读经典书籍</td><td colspan = '3' id='avgBookNum2'></td></tr><tr><td  colspan = '7'>集体活动次数</td><td colspan = '3' id='avggroupActTimesNum2'></td></tr><tr><td  colspan = '7'>每天参加课外锻炼时长</td><td colspan = '3' id='avgtrainHoursNum2'></td></tr><tr><td  colspan = '7'>短期游学交流次数</td><td colspan = '3' id='avgTourNum2'></td></tr><tr><td  colspan = '7'>获得奖项次数</td><td colspan = '3' id='avgPrizeNum2'></td></tr><tr><td  colspan = '7'>其他经历次数</td><td colspan = '3' id='avgOtherExpNum2'></td></tr><table><table><caption>对未来的愿景中填写情况</caption><tr><td  colspan = '3'>主题</td><td colspan = '3'>已填写（百分比）</td><td colspan = '3'>填写人数</td></tr><tr><td  colspan = '3'>参与科研</td><td colspan = '3' id='FsciPro21'></td><td colspan = '3' id='FsciPro2'></td></tr><tr><td  colspan = '3'>成绩绩点</td><td colspan = '3' id='FGPA21'></td><td colspan = '3' id='FGPA2'></td></tr><tr><td  colspan = '3'>公益活动</td><td colspan = '3' id='FcharityAct21'></td><td colspan = '3' id='FcharityAct2'></td></tr><tr><td  colspan = '3'>课外竞赛</td><td colspan = '3' id='Fcompetition21'></td><td colspan = '3' id='Fcompetition2'></td></tr><tr><td  colspan = '3'>课外阅读</td><td colspan = '3' id='Fbook21'></td><td colspan = '3' id='Fbook2'></td></tr><tr><td  colspan = '3'>论文发表</td><td colspan = '3' id='Fpaper21'></td><td colspan = '3' id='Fpaper2'></td></tr><tr><td  colspan = '3'>其他方面</td><td colspan = '3' id='FotherExp21'></td><td colspan = '3' id='FotherExp2'></td></tr><tr><td  colspan = '3'>入党申请时间</td><td colspan = '3' id='FapplyDate21'></td><td colspan = '3' id='FapplyDate2'></td></tr><tr><td  colspan = '3'>社会活动</td><td colspan = '3' id='FgroupAct21'></td><td colspan = '3' id='FgroupAct2'></td></tr><tr><td  colspan = '3'>游学经历</td><td colspan = '3' id='Ftour21'></td><td colspan = '3' id='Ftour2'></td></tr><table>";
					
					document.getElementById("charityAct2").innerHTML=ret.charityAct;	
					document.getElementById("book2").innerHTML=ret.book;	
					document.getElementById("competition2").innerHTML=ret.competition;	
					document.getElementById("groupAct2").innerHTML=ret.groupAct;	
					document.getElementById("sciPro2").innerHTML=ret.sciPro;	
					document.getElementById("paper2").innerHTML=ret.paper;	
					document.getElementById("failSubNum2").innerHTML=ret.failSubNum + "【至少有一门不及格】";
					document.getElementById("occupation2").innerHTML=ret.occupation;	
					document.getElementById("otherExp2").innerHTML=ret.otherExp;	
					document.getElementById("train2").innerHTML=ret.train;	
					document.getElementById("patent2").innerHTML=ret.patent;
					document.getElementById("tour2").innerHTML=ret.tour;	
					document.getElementById("prize2").innerHTML=ret.prize;	
					document.getElementById("help2").innerHTML=ret.help;	
						
					document.getElementById("FcharityAct2").innerHTML=ret.FcharityAct;
					document.getElementById("FGPA2").innerHTML=ret.FGPA;	
					document.getElementById("Fbook2").innerHTML=ret.Fbook;	
					document.getElementById("FsciPro2").innerHTML=ret.FsciPro;	
					document.getElementById("Fpaper2").innerHTML=ret.Fpaper;	
					document.getElementById("Fcompetition2").innerHTML=ret.Fcompetition;	
					document.getElementById("Ftour2").innerHTML=ret.Ftour;	
					document.getElementById("FgroupAct2").innerHTML=ret.FgroupAct;	
					document.getElementById("FapplyDate2").innerHTML=ret.FapplyDate;
					document.getElementById("FotherExp2").innerHTML=ret.FotherExp;	
					
					document.getElementById("FcharityAct21").innerHTML=ret.FcharityActPercent + "%";
					document.getElementById("FGPA21").innerHTML=ret.FGPAPercent + "%";
					document.getElementById("Fbook21").innerHTML=ret.FbookPercent + "%";
					document.getElementById("FsciPro21").innerHTML=ret.FsciProPercent + "%";
					document.getElementById("Fpaper21").innerHTML=ret.FpaperPercent + "%";	
					document.getElementById("Fcompetition21").innerHTML=ret.FcompetitionPercent + "%";
					document.getElementById("Ftour21").innerHTML=ret.FtourPercent + "%";
					document.getElementById("FgroupAct21").innerHTML=ret.FgroupActPercent + "%";
					document.getElementById("FapplyDate21").innerHTML=ret.FapplyDatePercent + "%";
					document.getElementById("FotherExp21").innerHTML=ret.FotherExpPercent + "%";
			
					document.getElementById("charityAct21").innerHTML=ret.charityActPercent + "%";	
					document.getElementById("book21").innerHTML=ret.bookPercent + "%";	
					document.getElementById("competition21").innerHTML=ret.competitionPercent + "%";
					document.getElementById("groupAct21").innerHTML=ret.groupActPercent + "%";	
					document.getElementById("sciPro21").innerHTML=ret.sciProPercent + "%";	
					document.getElementById("paper21").innerHTML=ret.paperPercent + "%";
					document.getElementById("failSubNum21").innerHTML=ret.failSubNumPercent + "%";
					document.getElementById("occupation21").innerHTML=ret.occupationPercent + "%";	
					document.getElementById("otherExp21").innerHTML=ret.otherExpPercent + "%";
					document.getElementById("train21").innerHTML=ret.trainPercent + "%";
					document.getElementById("patent21").innerHTML=ret.patentPercent + "%";
					document.getElementById("tour21").innerHTML=ret.tourPercent + "%";	
					document.getElementById("prize21").innerHTML=ret.prizePercent + "%";	
					document.getElementById("help21").innerHTML=ret.helpPercent + "%";	
					
					document.getElementById("grade21").innerHTML=$s41;	
					document.getElementById("grade22").innerHTML=$s41;	
					document.getElementById("should_pass1").innerHTML=ret.should_pass;	
					document.getElementById("not_pass1").innerHTML=ret.not_pass;	
					document.getElementById("fact_pass1").innerHTML=ret.fact_pass;	
					
					document.getElementById("avgcharityHoursNum2").innerHTML=ret.avgcharityHoursNum + "小时";	
					document.getElementById("avgBookNum2").innerHTML=ret.avgBookNum + "本";	
					document.getElementById("avggroupActTimesNum2").innerHTML=ret.avggroupActTimesNum + "次";	
					document.getElementById("avgtrainHoursNum2").innerHTML=ret.avgtrainHoursNum + "小时";	
					document.getElementById("avgTourNum2").innerHTML=ret.avgTourNum + "次";	
					document.getElementById("avgPrizeNum2").innerHTML=ret.avgPrizeNum + "次";	
					document.getElementById("avgOtherExpNum2").innerHTML=ret.avgOtherExpNum + "次";		
					document.getElementById("partyMemNum22").innerHTML=ret.partyMemNum;	
					
				}
				else
				{
					document.getElementById("gradeStcCont").innerHTML = "数据库中没有查找到相关数据，请确定是否输入有误！或者应交人数过少";
				}
			
			
			})
		}	
	})
	
	
	
	var $s5 = $("#s5_button");
	
	//年级统计表的显示
	$s5.click(function(){
		
		var $s50 = $("#s50_input").val();
		var $s51 = $("#s51_input").val();
		var $s52 = $("#s52_input").val();
		var $s53 = $("#s53_input").val();
		
		if(!isNum($s53)|| ($s53 == ""))  
				document.getElementById("departmentStcCont").innerHTML = "请确定是否输入有误！</br>提示：应交人数为空或输入有误!";
				
		else
		{
			$.post('request/departmentTotal.php',{department:$s50, grade:$s51, fillYear: $s52, should_pass : $s53},function(json){

				var ret = $.parseJSON(json);
				if(ret.exist == "Y")
				{
				
				//设置高度的地方
					setHeight('departmentStcCont', '1500');
					document.getElementById("departmentStcCont").innerHTML = "<table><caption>中山大学成长轨信息汇总表</caption><tr><td>院系（盖章）：</td><td id='department2'></td><td>填表人：</td><td></td><td>填表时间：</td><td></td></tr></table><table><caption>填写情况</caption><tr><td>年级</td><td>应交份数</td><td>未交份数</td><td>党员人数</td><td>备注</td></tr><tr><td id='grade3'></td><td id='should_pass2'></td><td id='not_pass2'></td><td id='partyMemNum33'></td><td></td></tr></table><table><tr><td>项目</td><td>已填写</td><td>空白</td><td>人均情况</td><td>备注</td></tr><tr><td>参加公益活动</td><td id='charityAct31'></td><td id='charityAct32'></td><td>平均为<span id='avgcharityHoursNum3'></span>小时</td><td></td></tr><tr><td>阅读经典书籍</td><td id='book31'></td><td id='book32'></td><td>平均为<span id='avgBookNum3'></span>本</td><td></td></tr><tr><td>集体活动</td><td id='groupAct31'></td><td id='groupAct32'></td><td>平均为<span id='avggroupActTimesNum3'></span>次</td><td></td></tr><tr><td>参加课外锻炼</td><td id='train31'></td><td id='train32'></td><td>平均为<span  id='avgtrainHoursNum3'></span>小时</td><td></td></tr><tr><td>短期游学交流</td><td id='tour31'></td><td  id='tour32'></td><td>平均为<span id='avgTourNum3'></span>次</td><td></td></tr><tr><td>不及格科目</td><td id='failSubNum31'></td><td id='failSubNum32'></td><td>/</td><td>共<span id='failSubTotal3'></span>人有不及格科目，</br>是（）否（）如实填写</td></tr><tr><td>课外竞赛</td><td id='competition31'></td><td id='competition32'></td><td>/</td><td></td></tr><tr><td>科研项目</td><td id='sciPro31'></td><td id='sciPro32'></td><td>/</td><td></td></tr><tr><td>文章发表</td><td id='paper31'></td><td  id='paper32'></td><td>/</td><td></td></tr><tr><td>申请专利</td><td id='patent31'></td><td id='patent32'></td><td>/</td><td></td></tr><tr><td>任职情况</td><td id='occupation31'></td><td id='occupation32'></td><td>/</td><td></td></tr><tr><td>接受帮助</td><td id='help31'></td><td id='help32'></td><td>每周参加勤工助学时间平均<span id='avgpartTimeJobNum3'></span>小时</td><td>其中<span id='grantsInAidTotal3'></span>人接受助学金</br><span id='loanTotal3'></span>人接受贷款</br><span id='partTimeJobTotal3'></span>人参加勤工助学</br><span id='AllowanceTotal3'></span>人接受临时困难补助</td></tr><tr><td>获得奖项</td><td id='prize31'></td><td id='prize32'></td><td></td><td>其中获校内奖<span id='insideTotal3'></span>人</br>获校外奖<span id='outsideTotal3'></span>人</td></tr><tr><td>其他经历</td><td id='otherExp31'></td><td id='otherExp32'></td><td></td><td></td></tr></table><table><caption>愿景部分</caption><tr><td>项目</td><td>已填写</td><td>空白</td><td>主要集中在哪个方面</td><td>帮扶之策</td><td>备注</td></tr><tr><td>公益活动</td><td id='FcharityAct31'></td ><td id='FcharityAct32'></td><td></td><td></td><td></td></tr><tr><td>成绩绩点</td><td id='FGPA31'></td><td id='FGPA32'></td><td></td><td></td><td></td></tr><tr><td>课外阅读</td><td id='Fbook31'></td><td id='Fbook32'></td><td></td><td></td><td></td></tr><tr><td>参与科研</td><td id='FsciPro31'></td><td id='FsciPro32'></td><td></td><td></td><td></td></tr><tr><td>论文发表</td><td id='Fpaper31'></td><td  id='Fpaper32'></td><td></td><td></td><td></td></tr><tr><td>课外竞赛</td><td id='Fcompetition31'></td><td id='Fcompetition32'></td><td></td><td></td><td></td></tr><tr><td>游学经历</td><td id='Ftour31'></td><td id='Ftour32'></td><td></td><td></td><td></td></tr><tr><td>社会活动</td><td id='FgroupAct31'></td><td id='FgroupAct32'></td><td></td><td></td><td></td></tr><tr><td>入党申请时间</td><td id='FapplyDate31'></td><td id='FapplyDate32'></td><td></td><td></td><td></td></tr><tr><td>其他方面</td><td id='FotherExp31'></td><td id='FotherExp32'></td><td></td><td></td><td></td></tr></table>";
					
					document.getElementById("department2").innerHTML = $s50;
					document.getElementById("FcharityAct31").innerHTML=ret.FcharityActPercent + "%";
					document.getElementById("FGPA31").innerHTML=ret.FGPAPercent + "%";
					document.getElementById("Fbook31").innerHTML=ret.FbookPercent + "%";
					document.getElementById("FsciPro31").innerHTML=ret.FsciProPercent + "%";
					document.getElementById("Fpaper31").innerHTML=ret.FpaperPercent + "%";	
					document.getElementById("Fcompetition31").innerHTML=ret.FcompetitionPercent + "%";
					document.getElementById("Ftour31").innerHTML=ret.FtourPercent + "%";
					document.getElementById("FgroupAct31").innerHTML=ret.FgroupActPercent + "%";
					document.getElementById("FapplyDate31").innerHTML=ret.FapplyDatePercent + "%";
					document.getElementById("FotherExp31").innerHTML=ret.FotherExpPercent + "%";
			
					document.getElementById("charityAct31").innerHTML=ret.charityActPercent + "%";	
					document.getElementById("book31").innerHTML=ret.bookPercent + "%";	
					document.getElementById("competition31").innerHTML=ret.competitionPercent + "%";
					document.getElementById("groupAct31").innerHTML=ret.groupActPercent + "%";	
					document.getElementById("sciPro31").innerHTML=ret.sciProPercent + "%";	
					document.getElementById("paper31").innerHTML=ret.paperPercent + "%";
					document.getElementById("failSubNum31").innerHTML=ret.failSubNumPercent + "%";
					document.getElementById("occupation31").innerHTML=ret.occupationPercent + "%";	
					document.getElementById("otherExp31").innerHTML=ret.otherExpPercent + "%";
					document.getElementById("train31").innerHTML=ret.trainPercent + "%";
					document.getElementById("patent31").innerHTML=ret.patentPercent + "%";
					document.getElementById("tour31").innerHTML=ret.tourPercent + "%";	
					document.getElementById("prize31").innerHTML=ret.prizePercent + "%";	
					document.getElementById("help31").innerHTML=ret.helpPercent + "%";	
					
					
					document.getElementById("FcharityAct32").innerHTML=ret.FcharityActPercent1 + "%";
					document.getElementById("FGPA32").innerHTML=ret.FGPAPercent1 + "%";
					document.getElementById("Fbook32").innerHTML=ret.FbookPercent1 + "%";
					document.getElementById("FsciPro32").innerHTML=ret.FsciProPercent1 + "%";
					document.getElementById("Fpaper32").innerHTML=ret.FpaperPercent1 + "%";	
					document.getElementById("Fcompetition32").innerHTML=ret.FcompetitionPercent1 + "%";
					document.getElementById("Ftour32").innerHTML=ret.FtourPercent1 + "%";
					document.getElementById("FgroupAct32").innerHTML=ret.FgroupActPercent1 + "%";
					document.getElementById("FapplyDate32").innerHTML=ret.FapplyDatePercent1 + "%";
					document.getElementById("FotherExp32").innerHTML=ret.FotherExpPercent1 + "%";
			
					document.getElementById("charityAct32").innerHTML=ret.charityActPercent1 + "%";	
					document.getElementById("book32").innerHTML=ret.bookPercent1 + "%";	
					document.getElementById("competition32").innerHTML=ret.competitionPercent1 + "%";
					document.getElementById("groupAct32").innerHTML=ret.groupActPercent1 + "%";	
					document.getElementById("sciPro32").innerHTML=ret.sciProPercent1 + "%";	
					document.getElementById("paper32").innerHTML=ret.paperPercent1 + "%";
					document.getElementById("failSubNum32").innerHTML=ret.failSubNumPercent1 + "%";
					document.getElementById("occupation32").innerHTML=ret.occupationPercent1 + "%";	
					document.getElementById("otherExp32").innerHTML=ret.otherExpPercent1 + "%";
					document.getElementById("train32").innerHTML=ret.trainPercent1 + "%";
					document.getElementById("patent32").innerHTML=ret.patentPercent1 + "%";
					document.getElementById("tour32").innerHTML=ret.tourPercent1 + "%";	
					document.getElementById("prize32").innerHTML=ret.prizePercent1 + "%";	
					document.getElementById("help32").innerHTML=ret.helpPercent1 + "%";	
					
					
					
					document.getElementById("grade3").innerHTML=$s51;
					document.getElementById("should_pass2").innerHTML=ret.should_pass;	
					document.getElementById("not_pass2").innerHTML=ret.not_pass;	
					
					
					document.getElementById("avgcharityHoursNum3").innerHTML=ret.avgcharityHoursNum ;	
					document.getElementById("avgBookNum3").innerHTML=ret.avgBookNum;	
					document.getElementById("avggroupActTimesNum3").innerHTML=ret.avggroupActTimesNum;	
					document.getElementById("avgtrainHoursNum3").innerHTML=ret.avgtrainHoursNum;	
					document.getElementById("avgTourNum3").innerHTML=ret.avgTourNum;	
					document.getElementById("partyMemNum33").innerHTML=ret.partyMemNum;	
					
					document.getElementById("failSubTotal3").innerHTML=ret.failSubTotal;	
					document.getElementById("avgpartTimeJobNum3").innerHTML=ret.avgpartTimeJobNum;	
					document.getElementById("insideTotal3").innerHTML=ret.insideTotal;	
					document.getElementById("outsideTotal3").innerHTML=ret.outsideTotal;	
					document.getElementById("grantsInAidTotal3").innerHTML=ret.grantsInAidTotal;	
					document.getElementById("loanTotal3").innerHTML=ret.loanTotal;	
					document.getElementById("partTimeJobTotal3").innerHTML=ret.partTimeJobTotal;	
					document.getElementById("AllowanceTotal3").innerHTML=ret.AllowanceTotal;	
					
					
					
					
				}
				else
				{
					document.getElementById("departmentStcCont").innerHTML  ="数据库中没有查找到相关数据，请确定是否输入有误！或者应交人数过少";
				}
			
			
			})
		}	
	})
	
	var ifClick = 0;//弄多一个变量去判断是否已经进行了学院的选择。
	
	//学生信息（就是需要翻页功能的）
	var minSid;
	var maxSid;
	var nowSid;//当前Sid值。
	
	var $s6 = $("#s6_button");
	$s6.click(function(){
		var $s61 = $("#s61_input").val();
		var $s621 = $("#s621_input").val();
		var $s622 = $("#s622_input").val();
		$(".pageTip").empty();
		ifClick = 1;
		if($s621 > $s622) $("#studentNewCont").html("年份范围错误</br>原因：起始年份比结束年份大");
		
		else
		{
			$("#studentNewCont").empty();
			//该php的主要作用是求最大最小值
			$.post('request/minANDmax.php',{department:$s61,fromYear:$s621, toYear: $s622},function(json){
				var ret = $.parseJSON(json);
				if (ret.exist == "Y")
				{
					//alert(ret.minSid);
					//alert(ret.maxSid);
					
					minSid = ret.minSid;
					nowSid = ret.minSid;
					maxSid = ret.maxSid;
					showStuInfo(minSid,$s621,$s622);
					
				}
				else
				{
					$("#studentNewCont").append("该学院在该年份区间:" + $s621 + "——" + $s622 + "内没有数据");
					ifClick = 2;
				}
			})
		}
	})
	
	//往前翻一页
	var $pre = $("#pre");
	$pre.click(function(){
		var $s61 = $("#s61_input").val();
		var $s621 = $("#s621_input").val();
		var $s622 = $("#s622_input").val();
		if(ifClick == 0)  $(".pageTip").html("您还没有进行学院的相关选择和点击搜索按钮哦~</br>请完成相关选择并点击搜索后进行翻页");
		else if (ifClick == 1)
		{
			$(".pageTip").html("数据库数据庞大！请耐心等候...");
			//该php的主要作用是求出前一个值，并且刷新当前nowSid值。
			
			$.post('request/pagepre.php',{department:$s61,fromYear:$s621, toYear: $s622, nowSid : nowSid, minSid: minSid},function(json){
				var ret = $.parseJSON(json);
				$(".pageTip").empty();
				if (ret.exist == "E") $(".pageTip").html("当前已经为第一位同学！！");
				else if (ret.exist == "Y")
				{
					
					nowSid = ret.nowSid;
					showStuInfo(nowSid,$s621,$s622);
				}
			})
		}
		else  $(".pageTip").html("请尝试不同学院不同年份的数据搜索~");
	})
	//往后翻一页
	var $next = $("#next");
	$next.click(function(){
		var $s61 = $("#s61_input").val();
		var $s621 = $("#s621_input").val();
		var $s622 = $("#s622_input").val();
		if(ifClick == 0)  $(".pageTip").html("您还没有进行学院的相关选择和点击搜索按钮哦~</br>请完成相关选择并点击搜索后进行翻页");
		else if (ifClick == 1)
		{
			$(".pageTip").html("数据库数据庞大！请耐心等候...");

			//该php的主要作用是求出后一个值，并且刷新当前nowSid值。
			
			$.post('request/pagenext.php',{department:$s61,fromYear:$s621, toYear: $s622, nowSid : nowSid, maxSid: maxSid},function(json){
				var ret = $.parseJSON(json);
				$(".pageTip").empty();
				if (ret.exist == "E") $(".pageTip").html("当前已经为最后一位同学！！");
				else if (ret.exist == "Y")
				{
					nowSid = ret.nowSid;
					showStuInfo(nowSid,$s621,$s622);
				}
			})
		}
		else  $(".pageTip").html("请尝试不同学院不同年份的数据搜索~");
	})
	
	
	
})