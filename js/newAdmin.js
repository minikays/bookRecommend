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
			
			$.post('request/newAdmin.php',{s1:$s1, s2: $s2,s3: $s3}, function(json){
				var ret = $.parseJSON(json);
				
				if (ret.empty == "Y") $("#pwTip").html("输入不完整，请填写完整后再提交！");
				else
				{
					if(ret.exist =="Y") $("#pwTip").html("该用户名已存在！");
					else
					{
						if (ret.pwEqual == "N") $("#pwTip").html("输入的两次密码不相同，请重新输入！");
						else
						{
							$("#pwTip").html("创建成功，3秒后返回！");
							setInterval("stop()",3000);
						}
					}
				}
			})
		})

})