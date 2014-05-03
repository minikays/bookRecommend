$(document).ready(function() {	
	
	var args = new Object();
	//args.sid = $('#sid').val();
	//args.fillYear = $('#fillYear').val();
	$.post('request/statics.php', function(json){
		//alert("check");
		var ret = $.parseJSON(json);
		
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
		document.getElementById("avgTourDay").innerHTML+=ret.avgTourHour + '天';
		document.getElementById("stuNum").innerHTML+=ret.stuNum;
		
		var detailHtml = "<tr><th>排名</th><th>学号</th><th>所属学院</th><th>本数</th></tr>";
		
		for (var i=0; i<ret.bookRank.length;i++)
		{
			
			detailHtml = detailHtml + '<tr><td>' + (i+1) + '</td>';
			detailHtml = detailHtml + '<td>' + ret.bookRank[i].sid + '</td>';
			detailHtml = detailHtml + '<td>' + ret.bookRank[i].department + '</td>';
			detailHtml = detailHtml + '<td>' + ret.bookRank[i].bookNum + '</td></tr>';
		}
		
		document.getElementById("bookRank").innerHTML = detailHtml;
		
		
		
		var tourHtml =  "<tr><th>国家</th><th>人数</th></tr>";
		for (var i=0; i<ret.tour.length;i++)
		{
			 tourHtml =  tourHtml + '<tr><td>' + ret.tour[i].country + '</td>';
			 tourHtml =  tourHtml + '<td>' + ret.tour[i]. cnt + '</td></tr>';
		}
		
		document.getElementById("tour").innerHTML =  tourHtml;
		document.getElementById("tourNum").innerHTML+=ret.tourNum;
	});
});