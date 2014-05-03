function getTime()
{
	var myDate = new Date();
	document.getElementById("header_bot").innerHTML = "&nbsp&nbsp&nbsp&nbsp" + myDate.toLocaleString();      
}

$(function(){
		
		
		//设置当前时间的显示
		setInterval("getTime()",1000);
		
		var $sum_nav = $("#main ul li");
		//设置起始状态
		$sum_nav.eq(0).removeClass("not_select").addClass("select");
		$("#studentInfo").show();
		$("#schoolInfo").hide();
		$("#departmentInfo").hide();
		$("#gradeStc").hide();
		$("#departmentStc").hide();
		$("#studentNewInfo").hide();
		
		$sum_nav.hover( 
			function () { 
				$(this).addClass("li_bg"); 
			}, 
			function () { 
				$(this).removeClass("li_bg"); 
			} 
		); 
		
		//设置点击选择
		$sum_nav.click(function(){
			$(this).removeClass("not_select").addClass("select")
			.siblings().removeClass("select").addClass("not_select");
		
			sum_index = $sum_nav.index(this);
			
			if(sum_index == 0)
			{	
				$("#studentInfo").show();
				$("#schoolInfo").hide();
				$("#departmentInfo").hide();
				$("#gradeStc").hide();
				$("#departmentStc").hide();
				$("#studentNewInfo").hide();
			}
			if(sum_index == 1)
			{
				$("#schoolInfo").show();
				$("#studentInfo").hide();
				$("#departmentInfo").hide();
				$("#gradeStc").hide();
				$("#departmentStc").hide();
				$("#studentNewInfo").hide();
			}
			if (sum_index == 2)
			{	
				$("#departmentInfo").show();
				$("#studentInfo").hide();
				$("#schoolInfo").hide();
				$("#gradeStc").hide();
				$("#departmentStc").hide();
				$("#studentNewInfo").hide();
			}
			if (sum_index == 3)
			{	
				$("#departmentInfo").hide();
				$("#studentInfo").hide();
				$("#schoolInfo").hide();
				$("#gradeStc").hide();
				$("#departmentStc").show();
				$("#studentNewInfo").hide();
			}
			if (sum_index == 4)
			{	
				$("#departmentInfo").hide();
				$("#studentInfo").hide();
				$("#schoolInfo").hide();
				$("#gradeStc").show();
				$("#departmentStc").hide();
				$("#studentNewInfo").hide();
			}
			if (sum_index == 5)
			{
				$("#departmentInfo").hide();
				$("#studentInfo").hide();
				$("#schoolInfo").hide();
				$("#gradeStc").hide();
				$("#departmentStc").hide();
				$("#studentNewInfo").show();
			}
				
		})
		
		
		//设置年份的。规定好了fromYear和toYear的大小关系。
		 $("#s121_input").change(function(){
			var $s121= $("#s121_input").val();
			//alert($s121);
			$("#s122_input").empty();
			for (var i=0; i<8; i++)
			{
				
				$("#s122_input").append("<option value='"+ (parseInt($s121)+i) +"'>"+ (parseInt($s121)+i) +"</option>");
			}
		 })
		
		$("#s621_input").change(function(){
			var $s621= $("#s621_input").val();
			//alert($s121);
			$("#s622_input").empty();
			for (var i=0; i<8; i++)
			{
				
				$("#s622_input").append("<option value='"+ (parseInt($s621)+i) +"'>"+ (parseInt($s621)+i) +"</option>");
			}
		 })
		 
		 //设置翻页的模式的。
		 $("#pre").hover( 
			function () { 
				$(this).html("<img src='img/pagepre_hover.png' align='absmiddle'/>上一页");
				$(this).addClass("pageClass"); 
			}, 
			function () { 
				$(this).html("<img src='img/pagepre.png' align='absmiddle'/>上一页");
				$(this).removeClass("pageClass"); 
			} 
		); 
		 //设置翻页的模式的。
		 $("#next").hover( 
			function () { 
				$(this).html("下一页<img src='img/pagenext_hover.png' align='absmiddle'/>");
				$(this).addClass("pageClass"); 
			}, 
			function () { 
				$(this).html("下一页<img src='img/pagenext.png' align='absmiddle'/>");
				$(this).removeClass("pageClass"); 
			} 
		); 
		
})