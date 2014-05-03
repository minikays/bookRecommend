(function(){
    var window_width;
	var wh_data = {};
	var ptr_list = new Array('basic1','basic2','charity','readClassicBook','competitionSituation','activity','sciAndPro','suitPaper','patent','study','tour','occupationSituation','training','studentGrant','prize','applyDate','otherExp','hope','thought','end');
	var ptr={
	    basic1      :0,
		basic2      :0,
		charity     :0,
		readClassicBook        :0,
		competitionSituation :0,
		activity    :0,
		sciAndPro    :0,
		suitPaper     :0,
		patent      :0,
		study         :0,
		tour      :0,
		occupationSituation         :0,
		training       :0,
		studentGrant        :0,
		prize       :0,
		applyDate      :0,
		otherExp       :0,
		hope        :0,
		thought       :0,
		end         :0
	};
	function init(){
	    $.ajax({
            type: 'POST',
            url: 'request/return.php' ,
            data: { act : 'fetch' ,data : '' } ,
            success: function(data){
			    if(data["status"] == "fail"){
                    wh_data = {
                        basic1 : { name : "", gender : "" , department: "", major : "", grade: "", myclass : "" },
                        basic2 : { politics : "" , phoneNum : "" , qq : "" , email : "" , dorm : ""},
                        charity : { charityAct : "" , charityHours : "0"},
                        readClassicBook : { book : "" , bookNum : "0"},
                        competitionSituation : { competition : ""},
                        activity : { groupAct : "" , groupActTime : "0"},
                        sciAndPro : { sicPro : "" },
                        suitPaper : [{paper:"",magazine:"", suitDate:""}],
                        patent : [{ patentType: "", patentId:"", patentContent: ""}],
                        study : { failSub : "" , failSubNum : "0" , GPA : "0"},
                        tour : [{place:"", theme:"", hostEntity:"", startDate:"", endDate:"",days:""}],
                        occupationSituation : { occupation : ""},
                        training : { train : "" , trainHours : "0"},
                        studentGrant : [{type:"", money:"", obtainTime:"", workTime:""}],
                        prize : [ {level:"",content:"", gavecommitte:""}],
                        applyDate : { type : "" , applyDate : ""},
                        otherExp : { otherExp : ""},
                        hope : {
                                FcharityAct: "", FGPA: "", Fbook: "", FsciPro: "",
                                Fpaper: "", Fcompetition: "", Ftour: "", FgroupAct: "",
                                FotherExp: "" },
                        thought : { thought : ""}
                    };
				}
				else{
				    wh_data = data;
                    for(i=0;i<ptr_list.length;i++){
                        var name = ptr_list[i]
                        var area = $(('#'+name));
                        if(name != 'suitPaper' && name != 'patent' && name != 'tour' && name != 'studentGrant' && name != 'prize'){
                            var inputs = $(":input",area);
                            for(j=0;j<inputs.length;j++){
                                var item_name = inputs[j].name;
                                inputs[j].value = wh_data[name][item_name];
                            }
                        }
                        else{
                            var list = $('ul',area);
                            for(j=0;j<wh_data[name].length;j++){
								var item = "<li num='" + j + "'>" + "<a href='#' data-act='view' class='list-btn'>" + (j+1) 
										+ "查看 </a><a href='#' data-act='del' class='del-btn'>删除</a></li>";
								list.append(item);
                            }
							var li = $("li",list);
							$("a",li).click(function(event){
								var self = $(event.target);
								var data = self.data();
								if(data.act){
									action[data.act](data, event);
								}        
							});
                        }
                    }
				}
			} ,
            timeout: 10000,
            error: function (XMLHttpRequest, textStatus, errorThrown){
                alert("链接服务器失败，请重新上传或检查网络");
                wh_data = {
                    basic1 : { name : "", gender : "" , department: "", major : "", grade: "", myclass : "" },
                        basic2 : { politics : "" , phoneNum : "" , qq : "" , email : "" , dorm : ""},
                        charity : { charityAct : "" , charityHours : "0"},
                        readClassicBook : { book : "" , bookNum : "0"},
                        competitionSituation : { competition : ""},
                        activity : { groupAct : "" , groupActTime : "0"},
                        sciAndPro : { sicPro : "" },
                        suitPaper : [{paper:"",magazine:"", suitDate:""}],
                        patent : [{ patentType: "", patentId:"", patentContent: ""}],
                        study : { failSub : "" , failSubNum : "0" , GPA : "0"},
                        tour : [{place:"", theme:"", hostEntity:"", startDate:"", endDate:"",days:""}],
                        occupationSituation : { occupation : ""},
                        training : { train : "" , trainHours : "0"},
                        studentGrant : [{type:"", money:"", obtainTime:"", workTime:""}],
                        prize : [ {level:"",content:"",gavecommitte:""}],
                        applyDate : { type : "" , applyDate : ""},
                        otherExp : { otherExp : ""},
                        hope : {
                                FcharityAct: "", FGPA: "", Fbook: "", FsciPro: "",
                                Fpaper: "", Fcompetition: "", Ftour: "", FgroupAct: "",
                                FotherExp: "" },
                        thought : { thought : ""}
                };
            },
            dataType: 'json',
        });
        window_width = $(window).width();
        window_height = $(window).height();
		for(i=0;i<ptr_list.length;i++){
		    ptr[ptr_list[i]]=-(i+1)*window_width;
		}
		$('.page').css('width',window_width+'px');
        $('.page').css('height',window_height+'px');
		$('.content').css('width',window_width*21+'px');
	}
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
                if(over <= end) over = end;
                handler(over);
                setTimeout(inner, inval);
            }
			else if((start <= over) && (over < end))
			{
			    step=Math.abs(step);
				over += step;
                if(over >= end) over = end;
                handler(over);
                setTimeout(inner, inval);
			}
        }
        inner();
    }
    var list_action = {
        suitPaper       : function(num){
            var str = "";
            str += "文章名：" + wh_data['suitPaper'][num]['paper'] + "<br/>";
            str += "发表刊物：" + wh_data['suitPaper'][num]['magazine'] + "<br/>";
            str += "期刊号：" + wh_data['suitPaper'][num]['suitDate'] + "<br/>";
            return str;
        },
        patent          : function(num){
            var str = "";
            str += "专利类型：" + wh_data['patent'][num]['patentType'] + "<br/>";
            str += "专利号：" + wh_data['patent'][num]['patentId'] + "<br/>";
            str += "专利内容：" + wh_data['patent'][num]['patentContent'] + "<br/>";
            return str;
        },
        tour            : function(num){
            var str = "";
            str += "地点：" + wh_data['tour'][num]['place'] + "<br/>";
            str += "主题：" + wh_data['tour'][num]['theme'] + "<br/>";
            str += "举办单位：" + wh_data['tour'][num]['hostEntity'] + "<br/>";
            str += "开始时间：" + wh_data['tour'][num]['startDate'] + "<br/>";
            str += "结束时间：" + wh_data['tour'][num]['endDate'] + "<br/>";
            str += "总时长（天）：" + wh_data['tour'][num]['days'] + "<br/>";
            return str;
        },
        prize           : function(num){
            var str = "";
            str += "获奖项目：" + wh_data['prize'][num]['content'] + "<br/>";
            str += "获奖等级：" + wh_data['prize'][num]['level'] + "<br/>";
			str += "颁奖单位: " + wh_data['prize'][num]['gavecommitte'] + "<br/>";
            return str;
        },
        studentGrant    : function(num){
            var str = "";
            str += "助学项目：" + wh_data['studentGrant'][num]['type'] + "<br/>";
            str += "金额：" + wh_data['studentGrant'][num]['money'] + "<br/>";
            str += "获得时间：" + wh_data['studentGrant'][num]['obtainTime'] + "<br/>";
            str += "每周工作时间：" + wh_data['studentGrant'][num]['workTime'] + "<br/>";
            return str;
        },    
    };
	var action={
	    move  : function(data,event){
		    var self = event.target;
			var name = self.name;
            var old = Number(get_val($('.content').css('margin-left')));
			var now = ptr[name];
			var step = 20;
            for(i=0;i<Math.abs(old-now);i+=1000) step += 20;
            time_step(old, now, -step, 10, function(v){
                $('.content').css('margin-left', v + 'px');
            });
		},
		prev  : function(data,event){
			var old = Number(get_val($('.content').css('margin-left')));
			if(old < 0)
		    time_step(old, old+window_width, -40, 10, function(v){
                $('.content').css('margin-left', v + 'px');
            });
		},
		next  : function(data,event){
		    var old = Number(get_val($('.content').css('margin-left')));
			if(old > ptr['end'])
		    time_step(old, old-window_width, -40, 10, function(v){
                $('.content').css('margin-left', v + 'px');
            });
		},
		add   : function(data,event){
		    var self = $(event.target);
		    var name = self.parent().parent().attr("name");
			var form = $(":input",self.parent().parent());
            var area = $(('#'+name));
            var list = $('ul',area);
			var datapiece = {};	
			for(i=0;i<form.length;i++)
			{
			    if(form[i].value == ""){
				    alert("不能有栏位为空（请酌情填写“无”或“0”）");
				    return;
			    }
			    else if(form[i].type == "number"){
				    var number = Number(form[i].value);
				    if(number>=0) datapiece[form[i].name] = number;
				    else{
			    		alert("数字栏位必须填写数字！");
			    		return;
			    	}
			    }
			    else{
			    	datapiece[form[i].name] = form[i].value;
			    }
			}
			wh_data[name].push(datapiece);
            var j = wh_data[name].length-1;
            var item = "<li num='" + j + "'>" + "<a href='#' data-act='view' class='list-btn'>" + (j+1) 
                               + "查看 </a><a href='#' data-act='del' class='del-btn'>删除</a></li>";
            list.append(item);
            li = $("ul li:last-child",area);
            $("a",li).click(function(event){
                var self = $(event.target);
                var data = self.data();
                if(data.act){
                    action[data.act](data, event);
                }        
            });
            alert("保存信息成功！");
		},
		save  : function(data,event){
            var self = $(event.target);
		    var name = self.parent().parent().attr("name");
            var form = $(":input",self.parent().parent());
            var datapiece = {};	
		    for(i=0;i<form.length;i++)
		    {
		        if(form[i].value == "" && form[i].name != "applyDate" ){
		            alert("不能有栏位为空（请酌情填写“无”）");
				        return;
			    }
				else if(form[i].value == "" &&  form[i-1].value != "3"){
		            alert("不能有栏位为空（请酌情填写“无”）");
				        return;
			    }
			    else if(form[i].type == "number"){
				    var number = Number(form[i].value);
				  	if(number>=0) datapiece[form[i].name] = number;
				   	else{
			    	    alert("数字栏位必须填写数字！");
			    		return;
			    	}
			    }
			    else{
			        datapiece[form[i].name] = form[i].value;
			    }
			}
			wh_data[name] = datapiece;
            alert("保存信息成功！");
	    },
        view  : function(data,event){
            var str = "";
            var self = $(event.target);
            var name = self.parent().parent().parent().parent().parent().attr('id');
            var num = Number(self.parent().attr('num'));
            str = list_action[name](num);
            var window = new Messi(str, {title: '填写的信息', buttons: [{id: 0, label: 'Close', val: 'X'}]});
        },
        clear : function(data,event){
            var self = $(event.target);
		    var name = self.parent().parent().attr("name");
            var form = $(":input",self.parent().parent());
            for(i=0;i<form.length;i++){
                form[i].value = "";
            }
        },
        del   : function(data,event){
            var self = $(event.target);
            var name = self.parent().parent().parent().parent().parent().attr('id');
            var num = Number(self.parent().attr('num'));
            for(i=num;i<wh_data[name].length-1;i++){
                wh_data[name][i] = wh_data[name][i+1];
            }
            wh_data[name].pop();
            var list = self.parent().parent();
            list.empty();
            for(j=0;j<wh_data[name].length;j++){
                    var item = "<li num='" + j + "'>" + "<a href='#' data-act='view' class='list-btn'>" + (j+1) 
                               + "查看 </a><a href='#' data-act='del' class='del-btn'>删除</a></li>";
                    list.append(item);
            }
            var li = $("li",list);
            $("a",li).click(function(event){
                var self = $(event.target);
                var data = self.data();
                if(data.act){
                    action[data.act](data, event);
                }        
            });
        },
        start   : function(data,event){
            time_step(0, (-window_width), -40, 10, function(v){
                $('.content').css('margin-left', v + 'px');
            });
        },
        end     : function(data,event){
			str = JSON.stringify(wh_data);
            $.ajax({
                type: 'POST',
				url: 'request/write.php' ,
				data: str,
                success: function(success){
			        if(success["status"]=="true"){
						
			        	alert("上传服务器成功");
						new Messi('是否注销？', {title: '注销', buttons: [{id: 0, label: '是', val: 'Y'}, {id: 1, label: '否', val: 'N'}], callback: function(val) { 
							if(val=="Y"){
								window.location.href='logout.php';
							}
						}});
			        }
			        else{
			        	alert("上传服务器失败，请重新上传或检查网络");
			        }
			    },
                timeout: 10000,
                error: function (XMLHttpRequest, textStatus, errorThrown){
                    alert("上传服务器失败，请重新上传或检查网络");
                },
                dataType: 'json',
            });
        }
	}
    $(document).ready(function(){
        init();
        $("a[href='#']").click(function(event){
            var self = $(event.target);
            var data = self.data();
            if(data.act){
                action[data.act](data, event);
            }        
        });
		
    });	
})();