$(document).ready(function() {	
	var loginType = 0;
	$("#firstFill").hide();
	
	//登录键行为
	$("#login").click(function(){
		var userid = $('#sid').val();
		var password = $('#password').val();
		var passwordAga = $('#passwordAga').val();
		$.post('request/valid.php',{"userid":userid,"password":password,"passwordAga":passwordAga,"loginType":loginType}, function(json){
			var ret = $.parseJSON(json);
			if(ret.status == "emptyUserid"){
				$("#passwordWarn").html(""); 
				$("#passwordAgaWarn").html(""); 
				$("#useridWarn").html("用户名为空"); 
			}
			else if(ret.status == "noUser"){
				$("#passwordWarn").html(""); 
				$("#passwordAgaWarn").html(""); 
				$("#useridWarn").html("用户名不存在"); 
			}
			else if(ret.status == "emptyPassword"){
				$("#useridWarn").html(""); 
				$("#passwordAgaWarn").html(""); 
				$("#passwordWarn").html("密码为空"); 
			}
			else if(ret.status == "unmatch"){
				$("#useridWarn").html(""); 
				$("#passwordAgaWarn").html(""); 
				$("#passwordWarn").html("用户名与密码不匹配"); 
			}
			else if(ret.status == "emptyPasswordAga"){
				$("#useridWarn").html(""); 
				$("#passwordWarn").html("");  
				$("#passwordAgaWarn").html("再次确认密码为空"); 
			}
			else if(ret.status == "UseridNotNum"){
				$("#passwordWarn").html(""); 
				$("#passwordAgaWarn").html(""); 
				$("#useridWarn").html("学号格式不正确"); 
			}
			else if(ret.status == "passwordNotMatch"){
				$("#useridWarn").html(""); 
				$("#passwordWarn").html(""); 
				$("#passwordAgaWarn").html("两次输入的密码不相同"); 
			}
			else if(ret.status == "userExist"){
				$("#passwordWarn").html(""); 
				$("#passwordAgaWarn").html(""); 
				$("#useridWarn").html("该用户已存在！"); 
			}
			else if(ret.status == "adminSuccess"){
				window.location.href='stc.php';
			}
			else if(ret.status == "success"){
				window.location.href='test.php';
			}
		});
	});
	
	$("#first").toggle(function(){
			loginType = 1;
			$("#firstFill").show();
			$("#first").attr("value","非第一次填写");
			$("#note td p").html("注意：请记住您的密码以便下次进入填写。");
		},
		function(){
			loginType = 0;
			$("#firstFill").hide();
			$("#first").attr("value","第一次填写");
			$("#note td p").html("注意：如果是第一次填写请先按“第一次填写”按钮。");
		}
	);
	
	$("#modify").click(function(){
		window.location.href='changepwd.html';
	});
	
	function ReImgSize() {
		for (j = 0; j < document.images.length; j++) {
			if (document.images[j].id == "hint") {
				document.images[j].width = (document.images[j].width > 370) ? "370" : document.images[j].width;
			}
			else {
				document.images[j].width = (document.images[j].width > 130) ? "130" : document.images[j].width;
			}
		}
	}
	
	
	
});