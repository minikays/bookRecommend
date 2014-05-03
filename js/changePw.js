function getTime()
{
	var myDate = new Date();
	document.getElementById("header_bot").innerHTML = "&nbsp&nbsp&nbsp&nbsp" + myDate.toLocaleString();      
}
//修改成功后返回管理页面；
function stop()
{
	window.location.href = "stc.php";
}
$(function(){

		//设置当前时间的显示
		setInterval("getTime()",1000);
		
		//修改密码的信息
		var $s = $("#enter");
		$s.click(function(){
			var $s1 = $("#s1").val();
			var $s2 = $("#s2").val();
			var $s3 = $("#s3").val();
			
			$.post('request/changePw.php',{s1:$s1, s2: $s2,s3: $s3}, function(json){
				var ret = $.parseJSON(json);
				
				
				if(ret.empty =="Y") $("#pwTip").html("输入不完整，请填写完整后再提交！");
				else
				{
					if (ret.oldNotEqual == "Y") $("#pwTip").html("旧密码填写错误，请重新填写！");
					else
					{
						if (ret.newNotEqual == "Y") $("#pwTip").html("输入的两次新密码不同，请重新填写！");
						else
						{
							 $("#pwTip").html("修改成功！3秒后返回");
							 setInterval("stop()",3000);
						}
					}
				}
			})
		})

})