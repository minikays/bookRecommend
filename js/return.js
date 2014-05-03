$(document).ready(function() {
	$.post('request/return.php', function(json){
		var ret = $.parseJSON(json);
		document.getElementById("lmt1").innerHTML+=ret.tour[0]["country"]+" "+ ret.tour[0]["theme"]+" "+ret.tour[0]["hostEntity"]+" "+ret.tour[0]["days"]+ " "+ret.tour[0]["startDate"]+" "+ret.tour[0]["endDate"];
		document.getElementById("lmt2").innerHTML+=ret.patent[0]["patentType"]+" "+ ret.patent[0]["patentId"]+" "+ret.patent[0]["patentContent"];
		document.getElementById("lmt3").innerHTML+=ret.prize[0]["level"]+" "+ ret.prize[0]["content"];
		//document.getElementById("lmt3").innerHTML+=ret.prize[1]["content"];
		//document.getElementById("lmt2").innerHTML+=ret.prize[1]["content"];

	});


});