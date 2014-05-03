(function(){
    var now_ptr = "basic1";
	var wh_data = {};
	var ptr_list = new Array('basic1','basic2','charity','book','competition','activity','research','article','patent','gpa','tlearn','job','sport','help','award','handin','other','hope','think','end');
	var ptr={
	    basic1      :0,
		basic2      :-600,
		charity     :-1320,
		book        :-2070,
		competition :-2860,
		activity    :-3600,
		research    :-4700,
		article     :-5100,
		patent      :-5850,
		gpa         :-6500,
		tlearn      :-7350,
		job         :-8150,
		sport       :-8750,
		help        :-9600,
		award       :-10220,
		handin      :-11000,
		other       :-11870,
		hope        :-12870,
		think       :-13800,
		end         :-14420
	};
	function init(){
	    wh_data["competition"] = [];
		wh_data["article"] = [];
		wh_data["patent"] = [];
		wh_data["help"] = [];
		wh_data["tlearn"] = [];
	}
	$(document).ready(function(){
        init();
    });
	function get_val(str){
        return str.substr(0, str.length-2);
    }
	function now_loc(str){
	    for(i=0;i<ptr_list.length;i++)
		    if(now_ptr == ptr_list[i]) return i;
	}
	function time_step(start, end, step, inval, handler){
        var over = start;
        function inner(){
            if((start >= over) && (over > end)){
                over += step;
                handler(over);
                setTimeout(inner, inval);
            }
			else if((start <= over) && (over < end))
			{
			    step=Math.abs(step);
				over += step;
                handler(over);
                setTimeout(inner, inval);
			}
        }
        inner();
    }
	var action={
	    move : function(data,event){
		    var self = event.target;
			var name = self.name;
            var old = Number(get_val($('#content').css('left')));
			var now = ptr[name];
			var step = -20;
			if(Math.abs(old-now) > 1000) step=-25;
			else if(Math.abs(old-now) > 2000) step=-30;
			else if(Math.abs(old-now) > 3000) step=-35;
			else if(Math.abs(old-now) > 4000) step=-40;
			else if(Math.abs(old-now) > 5000) step=-50;
			else if(Math.abs(old-now) > 6000) step=-60;
			else if(Math.abs(old-now) > 7000) step=-70;
			else if(Math.abs(old-now) > 8000) step=-80;
			else if(Math.abs(old-now) > 9000) step=-90;
			else if(Math.abs(old-now) > 10000) step=-100;
			else if(Math.abs(old-now) > 11000) step=-110;
			else if(Math.abs(old-now) > 12000) step=-120;
			else if(Math.abs(old-now) > 13000) step=-130;
			else if(Math.abs(old-now) > 14000) step=-140;
            time_step(old, now, step, 10, function(v){
                $('#content').css('left', v + 'px');
            });
			now_ptr = name;
		},
		prev : function(data,event){
		    var now = now_loc(now_ptr);
			if(now != 0) now = now-1;
			else return;
			var old = ptr[now_ptr];
			var name = ptr_list[now];
		    time_step(old, ptr[name], -20, 10, function(v){
                $('#content').css('left', v + 'px');
            });
			now_ptr = name;
		},
		next : function(data,event){
		    var now = now_loc(now_ptr);
			if(now != 19) now = now+1;
			else return;
			var old = ptr[now_ptr];
			var name = ptr_list[now];
		    time_step(old, ptr[name], -20, 10, function(v){
                $('#content').css('left', v + 'px');
            });
			now_ptr = name;
		},
		save : function(data,event){
		    self = $(event.target);
		    var name = event.target.name;
			var form = $(":input",$(self).parent().parent());
			var datapiece = {};
			if((name == "competition") || (name == "article") || (name == "patent") || (name == "tlearn") || (name == "help")){		
			    for(i=0;i<form.length;i++)
			    {
			        if(form[i].value == ""){
				        alert("不能有栏位为空（请酌情填写“无”）");
				    	return;
			    	}
			    	else if(form[i].type == "number"){
				        var number = Number(form[i].value);
				    	if(number) datapiece[form[i].name] = number;
				    	else{
			    		    alert("数字栏位必须填写数字！");
			    			return;
			    		}
			    	}
			    	else{
			    	    datapiece[form[i].name] = form[i].value;
						alert(form[i].name + " : " + form[i].value);
			    	}
			    }
			    wh_data[name].push(datapiece);
			}
			else{
			    for(i=0;i<form.length;i++)
			    {
			        if(form[i].value == ""){
				        alert("不能有栏位为空（请酌情填写“无”）");
				    	return;
			    	}
			    	else if(form[i].type == "number"){
				        var number = Number(form[i].value);
				    	if(number) datapiece[form[i].name] = number;
				    	else{
			    		    alert("数字栏位必须填写数字！");
			    			return;
			    		}
			    	}
			    	else{
			    	    datapiece[form[i].name] = form[i].value;
						alert(form[i].name + " : " + datapiece[form[i].name]);
			    	}
			    }
			    wh_data[name] = datapiece;
			}
			alert("保存信息成功，请关闭小窗口");
		},
	}
	$("a[href='#']").click(function(event){
        var self = $(event.target);
        var data = self.data();
        if(data.act){
            action[data.act](data, event);
        }
    });
})();