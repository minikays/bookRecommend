$(document).ready(function() {	
	var args = {
		"basic1": {
			"name": "东东",
			"gender": "男",
			"department": "人文科学学院",
			"major": "地方",
			"grade": "大一",
			"myclass": "3班"
		},
		"basic2": {
			"politics": "",
			"phoneNum": "",
			"qq": "",
			"email": "",
			"dorm": ""
		},
		"charity": {
			"charityAct": "",
			"charityHours": "0"
		},
		"readClassicBook": {
			"book": "",
			"bookNum": "0"
		},
		"competitionSituation": {
			"competition": ""
		},
		"activity": {
			"groupAct": "",
			"groupActTime": "0"
		},
		"sciAndPro": {
			"sicPro": ""
		},
		"suitPaper": [
			{
				"paper": "《论数学》",
				"magazine": "数学周刊",
				"suitDate": "2013/01/01"
			}
		],
		"patent": [
			{
				"patentType": "发明专利",
				"patentId": "123456",
				"patentContent": "发明了xxxx"
			}
		],
		"study": {
			"failSub": "",
			"failSubNum": "0",
			"GPA": "0"
		},
		"tour": [
			{
				"place": "美国",
				"theme": "哈哈",
				"hostEntity": "懂得",
				"startDate": "2013-01-03",
				"endDate": "2013-02-02",
				"days": "31"
			},
			{
				"place": "中国台湾",
				"theme": "哈哈",
				"hostEntity": "懂得",
				"startDate": "2012-01-01",
				"endDate": "2013-02-02",
				"days": "32"
			}
		],
		"occupationSituation": {
			"occupation": ""
		},
		"training": {
			"train": "",
			"trainHours": "0"
		},
		"studentGrant": [
			{
				"type": "",
				"money": "",
				"obtainTime": "",
				"workTime": ""
			},
			{
				"type": "国家助学贷款或生源地贷款",
				"money": 123,
				"obtainTime": "2013-08-14",
				"workTime": 1
			}
		],
		"prize": [
			{
				"level": "国家级",
				"content": "东方角斗士"
			},
			{
				"level": "院级",
				"content": "祭祀阿道夫"
			}
		],
		"applyDate": {
			"type": "",
			"applyDate": ""
		},
		"otherExp": {
			"otherExp": ""
		},
		"hope": {
			"FcharityAct": "",
			"FGPA": "",
			"Fbook": "",
			"FsciPro": "",
			"Fpaper": "",
			"Fcompetition": "",
			"Ftour": "",
			"FgroupAct": "",
			"FotherExp": ""
		},
		"thought": {
			"thought": ""
		}
	};	
	args = JSON.stringify(args);

	
	$.post('request/write.php',args, function(json){
		var ret = $.parseJSON(json);
		document.getElementById("lmt1").innerHTML+=ret.content;
	});
	
	
});