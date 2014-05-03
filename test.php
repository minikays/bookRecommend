<?php
	session_start();
	if(!isset($_SESSION['valid_user']))
		header("location:not_login.html");
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>中山大学学生成长轨迹</title>
    <meta name='description' content='中山大学学生成长轨迹填写页' />
    <meta name='author' content='Leo He from ss' />
    <link rel='stylesheet' href='css/main.css' />
    <link rel='stylesheet' href='css/messi.min.css' />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/messi.min.js"></script>
</head>
<body>
    <div class='bodycontainer'>
        <div class='container'>
            <div id="left" class="border"></div>
            <div id="right" class="border"></div>
            <div class='content'>
                <div id='title' class='page'>
                    <div id='start'>
                        <a href="#" class="btn-type1" data-act="start">&nbsp </a>
                    </div>
                </div>
                <div id='basic1' class='page'>
                    <div class="header">
                        <h3>基本信息之一</h3>
                        <p></p>
                    </div>
                    <div class="option-fld" id="b-basic1">
                        <div class="form tp1">
                            <form name="basic1" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">姓名：</label>
                                        <input type="text" name="name" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">性别：</label>
                                        <select name="gender">
                                            <option value="男">男</option>
                                            <option value="女">女</option>
                                        </select>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">学院：</label>
                                        <select name="department">
                                            <option value="人文科学学院">人文科学学院</option>
                                            <option value="社会学与人类学学院">社会学与人类学学院</option>
                                            <option value="亚太研究院">亚太研究院</option>
                                            <option value="人文高等研究院（博雅学院、通识教育部）">人文高等研究院（博雅学院、通识教育部）</option>
                                            <option value="逸仙学院">逸仙学院</option>
                                            <option value="岭南学院">岭南学院</option>
                                            <option value="国际商学院">国际商学院</option>
                                            <option value="法学院">法学院</option>
                                            <option value="知识产权学院">知识产权学院</option>
                                            <option value="政治与公共事务管理学院　">政治与公共事务管理学院　</option>
                                            <option value="管理学院">管理学院</option>
                                            <option value="创业学院">创业学院</option>
                                            <option value="教育学院">教育学院</option>
                                            <option value="社会科学教育学院">社会科学教育学院</option>
                                            <option value="马克思主义研究院">马克思主义研究院</option>
                                            <option value="外国语学院">外国语学院</option>
                                            <option value="翻译学院">翻译学院</option>
                                            <option value="国际汉语学院">国际汉语学院</option>
                                            <option value="外语教学中心">外语教学中心</option>
                                            <option value="传播与设计学院">传播与设计学院</option>
                                            <option value="数学与计算科学学院">数学与计算科学学院</option>
                                            <option value="物理科学与工程技术学院">物理科学与工程技术学院</option>
                                            <option value="中法核工程与技术学院">中法核工程与技术学院</option>
                                            <option value="化学与化学工程学院">化学与化学工程学院</option>
                                            <option value="生命科学学院">生命科学学院</option>
                                            <option value="海洋学院（海洋科学与技术研究院）">海洋学院（海洋科学与技术研究院）</option>
                                            <option value="地理科学与规划学院">地理科学与规划学院</option>
                                            <option value="旅游学院">旅游学院</option>
                                            <option value="环境科学与工程学院">环境科学与工程学院</option>
                                            <option value="信息科学与技术学院">信息科学与技术学院</option>
                                            <option value="软件学院">软件学院</option>
                                            <option value="移动信息工程学院">移动信息工程学院</option>
                                            <option value="中山大学-卡内基梅隆大学联合工程学院">中山大学-卡内基梅隆大学联合工程学院</option>
                                            <option value="超级计算学院">超级计算学院</option>
                                            <option value="工学院">工学院</option>
                                            <option value="资讯管理学院">资讯管理学院</option>
                                            <option value="国家保密学院">国家保密学院</option>
                                            <option value="中山医学院">中山医学院</option>
                                            <option value="光华口腔医学院　">光华口腔医学院　</option>
                                            <option value="公共卫生学院">公共卫生学院</option>
                                            <option value="护理学院">护理学院</option>
                                            <option value="药学院">药学院</option>
                                            <option value="高等继续教育学院（网络教育学院）">高等继续教育学院（网络教育学院）</option>
                                        </select>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">专业：</label>
                                        <input type="text" name="major" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">年级：</label>
                                        <select name="grade">
                                            <option value="大一">大一</option>
                                            <option value="大二">大二</option>
                                            <option value="大三">大三</option>
                                            <option value="大四">大四</option>
                                        </select>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">班级：</label>
                                        <input type="text" name="myclass" />
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='basic2' class='page'>
                    <div class="header">
                        <h3>基本信息之二</h3>
                    </div>
                    <div class="option-fld" id="b-basic2">
                        <div class="form tp1">
                            <form name="basic2" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">政治面貌：</label>
                                        <select name="politics">
                                            <option value="团员">团员</option>
                                            <option value="党员">党员</option>
                                            <option value="其他">其他</option>
                                        </select>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">手机号：</label>
                                        <input type="text" name="phoneNum" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">QQ：</label>
                                        <input type="text" name="qq" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">邮箱：</label>
                                        <input type="email" name="email" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">宿舍：</label>
                                        <input type="text" name="dorm" />
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='charity' class='page'>
                    <div class="header">
                        <h3>参与公益活动</h3>
                    </div>
                    <div class="option-fld" id="b-charity">
                        <div class="form tp1">
                            <form name="charity" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">参与活动：</label>
                                        <textarea name="charityAct"></textarea>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">总公益时长(小时)：</label>
                                        <input type="number" name="charityHours" />
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='readClassicBook' class='page'>
                    <div class="header">
                        <h3>阅读经典书籍</h3>
                    </div>
                    <div class="option-fld" id="b-book">
                        <div class="form tp1">
                            <form name="readClassicBook" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">阅读的书：</label>
                                        <textarea name="book"></textarea>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">总本数（本）：</label>
                                        <input type="number" name="bookNum" />
                                        <div class="tip">
                                            <label for="">提示：</label><span id="Span1">对每一本书，请务必使用书名号。如《百年孤独》</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div id='competitionSituation' class='page'>
                    <div class="header">
                        <h3>参与竞赛</h3>
                    </div>
                    <div class="option-fld" id="b-competition">
                        <div class="form tp1">
                            <form name="competitionSituation" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">参与的竞赛：</label>
                                        <textarea name="competition"></textarea>
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='activity' class='page'>
                    <div class="header">
                        <h3>参与校园活动</h3>
                    </div>
                    <div class="option-fld" id="b-activity">
                        <div class="form tp1">
                            <form name="activity" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">参与的活动：</label>
                                        <textarea name="groupAct"></textarea>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">集体活动次数（次）：</label>
                                        <input type="number" name="groupActTime" />
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='sciAndPro' class='page'>
                    <div class="header">
                        <h3>科研项目与成果</h3>
                    </div>
                    <div class="option-fld" id="b-research">
                        <div class="form tp1">
                            <form name="sciAndPro" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">科研项目与指导老师：</label>
                                        <textarea name="sicPro"></textarea>
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='suitPaper' class='page'>
                    <div class="header">
                        <h3>发表文章</h3>
                    </div>
                    <div class="option-fld" id="b-article">
                        <div class="list">
                            <h4>已经填写的项目：</h4>
                            <ul class="list">
                            </ul>
                        </div>
                        <div class="form tp2">
                            <form name="suitPaper" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">文章名：</label>
                                        <input type="text" name="paper" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">发表刊物：</label>
                                        <input type="text" name="magazine" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">期刊号：</label>
                                        <input type="text" name="suitDate" />
                                    </div>
                                    <div class="tip">
                                        <label for="">提示：</label><span id="Span2">如需填写多项，请点击“添加”按钮</span>
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type8" data-act="add">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='patent' class='page'>
                    <div class="header">
                        <h3>申请专利</h3>
                    </div>
                    <div class="option-fld" id="b-patent">
                        <div class="list">
                            <h4>已经填写的项目：</h4>
                            <ul class="list">
                            </ul>
                        </div>
                        <div class="form tp2">
                            <form name="patent" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">专利类型：</label>
                                        <select name="patentType">
                                            <option value="发明专利">发明专利</option>
                                            <option value="实用新型专利">实用新型专利</option>
                                            <option value="外观设计专利">外观设计专利</option>
                                        </select>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">专利号：</label>
                                        <input type="text" name="patentId" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">专利内容：</label>
                                        <textarea name="patentContent"></textarea>
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type8" data-act="add">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='study' class='page'>
                    <div class="header">
                        <h3>学习成绩相关</h3>
                    </div>
                    <div class="option-fld" id="b-gpa">
                        <div class="form tp1">
                            <form name="study" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">挂掉的科目：</label>
                                        <textarea name="failSub"></textarea>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">挂科数：</label>
                                        <input type="number" name="failSubNum" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">总绩点：</label>
                                        <input type="number" name="GPA" />
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='tour' class='page'>
                    <div class="header">
                        <h3>游学经历</h3>
                    </div>
                    <div class="option-fld" id="b-tlearn">
                        <div class="list">
                            <h4>已经填写的项目：</h4>
                            <ul class="list">
                            </ul>
                        </div>
                        <div class="form tp2">
                            <form name="tour" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">地点：</label>
                                        <select name="place">
                                            <option selected="selected" value="-选择国家/地区-">-选择国家/地区-</option>
                                            <option value="澳大利亚">澳大利亚</option>
                                            <option value="阿曼">阿曼</option>
                                            <option value="安哥拉">安哥拉</option>
                                            <option value="阿鲁巴">阿鲁巴</option>
                                            <option value="阿塞拜疆">阿塞拜疆</option>
                                            <option value="埃塞俄比亚">埃塞俄比亚</option>
                                            <option value="爱尔兰">爱尔兰</option>
                                            <option value="阿根廷">阿根廷</option>
                                            <option value="阿尔巴尼亚">阿尔巴尼亚</option>
                                            <option value="阿尔及利亚">阿尔及利亚</option>
                                            <option value="阿富汗">阿富汗</option>
                                            <option value="阿联酋">阿联酋</option>
                                            <option value="埃及">埃及</option>
                                            <option value="爱沙尼亚">爱沙尼亚</option>
                                            <option value="安道尔">安道尔</option>
                                            <option value="安提瓜巴布达">安提瓜巴布达</option>
                                            <option value="奥地利">奥地利</option>
                                            <option value="冰岛">冰岛</option>
                                            <option value="比利时">比利时</option>
                                            <option value="巴巴多斯">巴巴多斯</option>
                                            <option value="巴布亚新几内亚">巴布亚新几内亚</option>
                                            <option value="巴哈马">巴哈马</option>
                                            <option value="巴基斯坦">巴基斯坦</option>
                                            <option value="巴拉圭">巴拉圭</option>
                                            <option value="巴勒斯坦">巴勒斯坦</option>
                                            <option value="巴林">巴林</option>
                                            <option value="巴拿马">巴拿马</option>
                                            <option value="巴西">巴西</option>
                                            <option value="白俄罗斯">白俄罗斯</option>
                                            <option value="百慕大">百慕大</option>
                                            <option value="保加利亚">保加利亚</option>
                                            <option value="贝宁">贝宁</option>
                                            <option value="波多黎各">波多黎各</option>
                                            <option value="波黑">波黑</option>
                                            <option value="波兰">波兰</option>
                                            <option value="玻利维亚">玻利维亚</option>
                                            <option value="伯利兹">伯利兹</option>
                                            <option value="博茨瓦纳">博茨瓦纳</option>
                                            <option value="不丹">不丹</option>
                                            <option value="布基纳法索">布基纳法索</option>
                                            <option value="布隆迪">布隆迪</option>
                                            <option value="秘鲁">秘鲁</option>
                                            <option value="朝鲜">朝鲜</option>
                                            <option value="赤道几内亚">赤道几内亚</option>
                                            <option value="丹麦">丹麦</option>
                                            <option value="德国">德国</option>
                                            <option value="东帝汶">东帝汶</option>
                                            <option value="多哥">多哥</option>
                                            <option value="多米尼加">多米尼加</option>
                                            <option value="多米尼克">多米尼克</option>
                                            <option value="俄罗斯">俄罗斯</option>
                                            <option value="厄瓜多尔">厄瓜多尔</option>
                                            <option value="厄立特里亚">厄立特里亚</option>
                                            <option value="佛得角">佛得角</option>
                                            <option value="法国">法国</option>
                                            <option value="菲律宾">菲律宾</option>
                                            <option value="斐济">斐济</option>
                                            <option value="芬兰">芬兰</option>
                                            <option value="冈比亚">冈比亚</option>
                                            <option value="刚果(金)">刚果(金)</option>
                                            <option value="刚果（布）">刚果（布）</option>
                                            <option value="哥伦比亚">哥伦比亚</option>
                                            <option value="哥斯达黎加">哥斯达黎加</option>
                                            <option value="格林纳达">格林纳达</option>
                                            <option value="格鲁吉亚">格鲁吉亚</option>
                                            <option value="古巴">古巴</option>
                                            <option value="关岛">关岛</option>
                                            <option value="圭亚那">圭亚那</option>
                                            <option value="古巴共和国">古巴共和国</option>
                                            <option value="韩国">韩国</option>
                                            <option value="黑山">黑山</option>
                                            <option value="洪都拉斯">洪都拉斯</option>
                                            <option value="海地">海地</option>
                                            <option value="荷兰">荷兰</option>
                                            <option value="荷属安的列斯">荷属安的列斯</option>
                                            <option value="哈萨克斯坦">哈萨克斯坦</option>
                                            <option value="吉尔吉斯斯坦">吉尔吉斯斯坦</option>
                                            <option value="加拿大">加拿大</option>
                                            <option value="几内亚比绍">几内亚比绍</option>
                                            <option value="基里巴斯">基里巴斯</option>
                                            <option value="吉布提">吉布提</option>
                                            <option value="几内亚">几内亚</option>
                                            <option value="加纳">加纳</option>
                                            <option value="加蓬">加蓬</option>
                                            <option value="柬埔寨">柬埔寨</option>
                                            <option value="捷克">捷克</option>
                                            <option value="津巴布韦">津巴布韦</option>
                                            <option value="喀麦隆">喀麦隆</option>
                                            <option value="卡塔尔">卡塔尔</option>
                                            <option value="开曼">开曼</option>
                                            <option value="科摩罗">科摩罗</option>
                                            <option value="科特迪瓦">科特迪瓦</option>
                                            <option value="科威特">科威特</option>
                                            <option value="克罗地亚">克罗地亚</option>
                                            <option value="肯尼亚">肯尼亚</option>
                                            <option value="库克群岛">库克群岛</option>
                                            <option value="拉脱维亚">拉脱维亚</option>
                                            <option value="莱索托">莱索托</option>
                                            <option value="老挝">老挝</option>
                                            <option value="黎巴嫩">黎巴嫩</option>
                                            <option value="立陶宛">立陶宛</option>
                                            <option value="利比里亚">利比里亚</option>
                                            <option value="利比亚">利比亚</option>
                                            <option value="列支敦士登">列支敦士登</option>
                                            <option value="卢森堡">卢森堡</option>
                                            <option value="卢旺达">卢旺达</option>
                                            <option value="罗马尼亚">罗马尼亚</option>
                                            <option value="美国">美国</option>
                                            <option value="美属萨摩亚">美属萨摩亚</option>
                                            <option value="毛里求斯">毛里求斯</option>
                                            <option value="马达加斯加">马达加斯加</option>
                                            <option value="马尔代夫">马尔代夫</option>
                                            <option value="马耳他">马耳他</option>
                                            <option value="马拉维">马拉维</option>
                                            <option value="马来西亚">马来西亚</option>
                                            <option value="马里">马里</option>
                                            <option value="马其顿">马其顿</option>
                                            <option value="马绍尔群岛">马绍尔群岛</option>
                                            <option value="毛里塔尼亚">毛里塔尼亚</option>
                                            <option value="美属维尔京群岛">美属维尔京群岛</option>
                                            <option value="蒙古">蒙古</option>
                                            <option value="孟加拉">孟加拉</option>
                                            <option value="密克罗尼西亚">密克罗尼西亚</option>
                                            <option value="缅甸">缅甸</option>
                                            <option value="摩尔多瓦">摩尔多瓦</option>
                                            <option value="摩洛哥">摩洛哥</option>
                                            <option value="摩纳哥">摩纳哥</option>
                                            <option value="莫桑比克">莫桑比克</option>
                                            <option value="墨西哥">墨西哥</option>
                                            <option value="瑙鲁">瑙鲁</option>
                                            <option value="尼泊尔">尼泊尔</option>
                                            <option value="尼加拉瓜">尼加拉瓜</option>
                                            <option value="纳米比亚">纳米比亚</option>
                                            <option value="南非">南非</option>
                                            <option value="尼日尔">尼日尔</option>
                                            <option value="尼日利亚">尼日利亚</option>
                                            <option value="挪威">挪威</option>
                                            <option value="帕劳">帕劳</option>
                                            <option value="葡萄牙">葡萄牙</option>
                                            <option value="瑞士">瑞士</option>
                                            <option value="日本">日本</option>
                                            <option value="瑞典">瑞典</option>
                                            <option value="塞尔维亚">塞尔维亚</option>
                                            <option value="斯里兰卡">斯里兰卡</option>
                                            <option value="塞内加尔">塞内加尔</option>
                                            <option value="塞拉利昂">塞拉利昂</option>
                                            <option value="萨尔瓦多">萨尔瓦多</option>
                                            <option value="萨摩亚">萨摩亚</option>
                                            <option value="塞浦路斯">塞浦路斯</option>
                                            <option value="塞舌尔">塞舌尔</option>
                                            <option value="沙特阿拉伯">沙特阿拉伯</option>
                                            <option value="圣多美和普林西比">圣多美和普林西比</option>
                                            <option value="圣基茨和尼维斯">圣基茨和尼维斯</option>
                                            <option value="圣卢西亚">圣卢西亚</option>
                                            <option value="圣马力诺">圣马力诺</option>
                                            <option value="圣文森特和格林纳丁斯">圣文森特和格林纳丁斯</option>
                                            <option value="斯洛伐克">斯洛伐克</option>
                                            <option value="斯洛文尼亚">斯洛文尼亚</option>
                                            <option value="斯威士兰">斯威士兰</option>
                                            <option value="苏丹">苏丹</option>
                                            <option value="苏里南">苏里南</option>
                                            <option value="所罗门群岛">所罗门群岛</option>
                                            <option value="索马里">索马里</option>
                                            <option value="泰国">泰国</option>
                                            <option value="塔吉克斯坦">塔吉克斯坦</option>
                                            <option value="坦桑尼亚">坦桑尼亚</option>
                                            <option value="汤加">汤加</option>
                                            <option value="特立尼达和多巴哥">特立尼达和多巴哥</option>
                                            <option value="突尼斯">突尼斯</option>
                                            <option value="土耳其">土耳其</option>
                                            <option value="土库曼斯坦">土库曼斯坦</option>
                                            <option value="图瓦卢">图瓦卢</option>
                                            <option value="瓦努阿图">瓦努阿图</option>
                                            <option value="危地马拉">危地马拉</option>
                                            <option value="委内瑞拉">委内瑞拉</option>
                                            <option value="文莱">文莱</option>
                                            <option value="乌干达">乌干达</option>
                                            <option value="乌克兰">乌克兰</option>
                                            <option value="乌拉圭">乌拉圭</option>
                                            <option value="乌兹别克斯坦">乌兹别克斯坦</option>
                                            <option value="西班牙">西班牙</option>
                                            <option value="希腊">希腊</option>
                                            <option value="新加坡">新加坡</option>
                                            <option value="新西兰">新西兰</option>
                                            <option value="匈牙利">匈牙利</option>
                                            <option value="叙利亚">叙利亚</option>
                                            <option value="意大利">意大利</option>
                                            <option value="牙买加">牙买加</option>
                                            <option value="亚美尼亚">亚美尼亚</option>
                                            <option value="也门">也门</option>
                                            <option value="伊拉克">伊拉克</option>
                                            <option value="伊朗">伊朗</option>
                                            <option value="以色列">以色列</option>
                                            <option value="印度">印度</option>
                                            <option value="印度尼西亚">印度尼西亚</option>
                                            <option value="英国">英国</option>
                                            <option value="英属维尔京群岛">英属维尔京群岛</option>
                                            <option value="约旦">约旦</option>
                                            <option value="越南">越南</option>
                                            <option value="英格兰">英格兰</option>
                                            <option value="中国">中国</option>
                                            <option value="赞比亚">赞比亚</option>
                                            <option value="乍得">乍得</option>
                                            <option value="智利">智利</option>
                                            <option value="中非">中非</option>
                                            <option value="中国台湾">中国台湾</option>
                                            <option value="中国香港">中国香港</option>
                                            <option value="中国澳门">中国澳门</option>
                                        </select>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">主题：</label>
                                        <input type="text" name="theme" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">举办单位：</label>
                                        <input type="text" name="hostEntity" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">开始时间：</label>
                                        <input type="date" name="startDate" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">结束时间：</label>
                                        <input type="date" name="endDate" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">总时长（天）：</label>
                                        <input type="number" name="days" />
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type8" data-act="add">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='occupationSituation' class='page'>
                    <div class="header">
                        <h3>任职情况</h3>
                    </div>
                    <div class="option-fld" id="b-job">
                        <div class="form tp1">
                            <form name="occupationSituation" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">任职情况：</label>
                                        <textarea name="occupation"></textarea>
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='training' class='page'>
                    <div class="header">
                        <h3>体育锻炼</h3>
                    </div>
                    <div class="option-fld" id="b-sport">
                        <div class="form tp1">
                            <form name="training" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">体育锻炼项目：</label>
                                        <textarea name="train"></textarea>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">每日课外锻炼时间（小时）：</label>
                                        <input type="number" name="trainHours" />
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='studentGrant' class='page'>
                    <div class="header">
                        <h3>助学金情况</h3>
                    </div>
                    <div class="option-fld" id="b-help">
                        <div class="list">
                            <h4>已经填写的项目：</h4>
                            <ul class="list">
                            </ul>
                        </div>
                        <div class="form tp2">
                            <form name="studentGrant" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">助学项目：</label>
                                        <select name="type">
                                            <option value="助学金">助学金</option>
                                            <option value="奖学金">奖学金</option>
                                            <option value="国家助学贷款或生源地贷款">国家助学贷款或生源地贷款</option>

                                            <option value="勤工助学">勤工助学</option>
                                            <option value="临时经济困难补助">临时经济困难补助</option>
                                        </select>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">金额：</label>
                                        <input type="number" name="money" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">获得时间：</label>
                                        <input type="date" name="obtainTime" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">勤工助学工作时间：</label>
                                        <input type="number" name="workTime" />
                                    </div>
                                    <div class="tip">
                                        <label for="">提示：</label><span id="Span3">如不需要填写勤工助学工作时间，请将相应值置为0</span>
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type8" data-act="add">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='prize' class='page'>
                    <div class="header">
                        <h3>获得奖项</h3>
                    </div>
                    <div class="option-fld" id="b-award">
                        <div class="list">
                            <h4>已经填写的项目：</h4>
                            <ul class="list">
                            </ul>
                        </div>
                        <div class="form tp2">
                            <form name="prize" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">获奖项目：</label>
                                        <input type="text" name="content" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">获奖等级：</label>
                                        <select name="level">
                                            <option value="国家级">国家级及以上</option>
                                            <option value="省级">省级</option>
                                            <option value="市级">市级</option>
                                            <option value="校级">校级</option>
                                        </select>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">颁发单位：</label>
                                        <input type="text" name="gavecommitte" />
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type8" data-act="add">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='applyDate' class='page'>
                    <div class="header">
                        <h3>入党申请</h3>
                    </div>
                    <div class="option-fld" id="b-handin">
                        <div class="form tp1">
                            <form name="applyDate" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">是否已经提交入党申请书：</label>
                                        <select name="type">
                                            <option value="1">是，已经提交</option>
                                            <option value="2">否，即将提交</option>
                                            <option value="3">否，未打算提交</option>
                                        </select>
                                    </div>
                                    <div class="txt-fld">
                                        <label for="" id="handinTime">提交时间：</label>
                                        <input type="date" name="applyDate" />
                                    </div>
                                    <div class="tip">
                                        <label for="">提示：</label><span id="tip">如未打算提交则无需填写时间</span>
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='otherExp' class='page'>
                    <div class="header">
                        <h3>其他补充事项</h3>
                    </div>
                    <div class="option-fld" id="b-other">
                        <div class="form tp1">
                            <form name="otherExp" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">补充：</label>
                                        <textarea name="otherExp"></textarea>
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='hope' class='page'>
                    <div class="header">
                        <h3>展望未来</h3>
                    </div>
                    <div class="option-fld" id="b-hope">
                        <div class="form tp1">
                            <form name="hope" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">公益项目：</label>
                                        <input type="text" name="FcharityAct" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">绩点：</label>
                                        <input type="number" name="FGPA" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">阅读书籍：</label>
                                        <input type="text" name="Fbook" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">计划科研项目：</label>
                                        <input type="text" name="FsciPro" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">计划发表文章：</label>
                                        <input type="text" name="Fpaper" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">计划参与竞赛：</label>
                                        <input type="text" name="Fcompetition" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">游学计划：</label>
                                        <input type="text" name="Ftour" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">计划参与活动：</label>
                                        <input type="text" name="FgroupAct" />
                                    </div>
                                    <div class="txt-fld">
                                        <label for="">其他：</label>
                                        <input type="text" name="FotherExp" />
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='thought' class='page'>
                    <div class="header">
                        <h3>总结与思索</h3>
                    </div>
                    <div class="option-fld" id="b-think">
                        <div class="form tp1">
                            <form name="thought" action="">
                                <div class="input-fld">
                                    <div class="txt-fld">
                                        <label for="">总结与思索：</label>
                                        <textarea name="thought"></textarea>
                                    </div>
                                </div>
                                <div class="btn-fld">
                                    <a href="#" class="btn-type6" data-act="save">&nbsp</a>
                                    <a href="#" class="btn-type7" data-act="clear">&nbsp</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id='end' class='page'>
                    <a href='#' class="btn-type2" data-act='end'>&nbsp</a>
                </div>
            </div>

            <div class='footer'>
                <p></p>
                <div class='footcontainer'>
                    <div id='footercontent'>
                        <ul class='ptr-list'>
                            <li><a href='#' class='btn-type3' data-act='prev'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='basic1' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='basic2' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='charity' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='readClassicBook' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='competitionSituation' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='activity' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='sciAndPro' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='suitPaper' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='patent' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='study' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='tour' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='occupationSituation' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='training' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='studentGrant' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='prize' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='applyDate' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='otherExp' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='hope' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='thought' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type4' name='end' data-act='move'>&nbsp</a></li>
                            <li><a href='#' class='btn-type5' data-act='next'>&nbsp</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="js/option.js"></script>
</body>
</html>
