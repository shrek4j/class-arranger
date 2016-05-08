<?php if (!defined('THINK_PATH')) exit();?>
 <!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="icon" href="../../favicon.ico">

	<title>console</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- bootstrap datepicker -->
    <link id="bsdp-css" href="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
    <link href="/Public/css/bootstrap/icheck/square.css" rel="stylesheet">
    
    <style type="text/css">
        .main-view{overflow-y:scroll;position:fixed;width:83.5%;height:98%;margin:0.5% 0.5% 0.5% 16%;padding:0.8% 0.8% 0.8% 1.2%;background:white;box-shadow:0 1px 2px 0 rgba(0,0,0,0.1)}
        .main-view-inner{margin:8% 2% 2% 6%;font-size:14px;width:1000px;}
        .main-view-inner .row{margin-top:2%;}
        .main-view-inner .row .col-md-2{width:90px;}
        .row-gutter{margin-top:5px;}
        .btn-submit{width:265px;height:40px;}
        .btn-class-type{width:185px;}
        .btn-class-list{width:200px;}
        .margin{display:inline;}
        .radio-text{margin:0px 12px 0px 8px;font-size:14px;}
    </style>


</head>
<body class="global">

 <!-- 导航 -->
	<link rel="icon" href="../../favicon.ico">
    
    <style type="text/css">
        .global{
            font-family: "微软雅黑","华文细黑",Helvetica,Tahoma,Arial,STXihei,"Microsoft YaHei",SimSun,"宋体",Heiti,"黑体",sans-serif;
            background:#ebebeb;
        }
        .favico{margin-top:8%;margin-bottom:15%;padding-left:23%;}
        .main-nav{position:fixed;width:15%;height:98%;margin:0.5%;padding:0.8% 0.8% 0.8% 1.2%;background:white;box-shadow:0 1px 2px 0 rgba(0,0,0,0.1)}
        .main-nav li{font-size:16px;}
        .sub-nav{padding-left: 30px;}
        .sub-nav li{font-size:12px;}
        
        .info-bar{position:fixed;width:83.5%;height:8%;margin:0.5% 0.5% 0.5% 16%;padding:0.8% 0.8% 0.8% 1.2%;background:white;box-shadow:0 1px 2px 0 rgba(0,0,0,0.1)}

        .operator-info span{margin:10px 10px 20px 15px;font-size:14px;font-weight: bold;color:#009ad6;}
    </style>

<nav>
  <ul class="nav nav-pills nav-stacked main-nav">
    <li class="favico"><img width="60%" height="60%" src="/Public/img/logo.png"/></li>
    <li class="operator-info">
        <span class="role"><?php echo ($_SESSION['role']); ?>,<?php echo ($_SESSION['operatorName']); ?></span>
        <span><a href="/index.php/Home/Operator/logout">退出</a></span>
    </li>
    <li role="presentation" id="headingOne" nav="10">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">教师管理</a>
    </li>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" pnav="10">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="11"><a href="/index.php/Home/Teacher/addTeacher?nav=11&pnav=10">添加教师</a></li>
            <li role="presentation" nav="12"><a href="/index.php/Home/Teacher/showTeachers?nav=12&pnav=10">教师列表</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingTwo" nav="20">
        <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">学生管理</a>
    </li>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" pnav="20">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="21"><a href="/index.php/Home/Student/addStudent?nav=21&pnav=20">添加学生</a></li>
            <li role="presentation" nav="22"><a href="/index.php/Home/Student/showStudents?nav=22&pnav=20">学生列表</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingThree" nav="30">
        <a data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">教室管理</a>
    </li>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" pnav="30">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="31"><a href="/index.php/Home/Classroom/addClassroom?nav=31&pnav=30">添加教室</a></li>
            <li role="presentation" nav="32"><a href="/index.php/Home/Classroom/showClassrooms?nav=32&pnav=30">教室列表</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingFour" nav="40">
        <a data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">课程管理</a>
    </li>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" pnav="40">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="41"><a href="/index.php/Home/Class/addClassType?nav=41&pnav=40">新建课程分类</a></li>
            <li role="presentation" nav="42"><a href="/index.php/Home/Class/showClassTypes?nav=42&pnav=40">课程分类列表</a></li>
            <li role="presentation" nav="43"><a href="/index.php/Home/Class/addClass?nav=43&pnav=40">新建课程</a></li>
            <li role="presentation" nav="44"><a href="./classmain.html?nav=44&pnav=40">课程列表</a></li>
            <li role="presentation" nav="45"><a href="./showclass.html?nav=45&pnav=40">课程查询</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingFive" nav="50">
        <a data-toggle="collapse" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">财务管理</a>
    </li>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" pnav="50">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="51"><a href="#">收入管理</a></li>
            <li role="presentation" nav="52"><a href="#">支出管理</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingSix" nav="60">
        <a data-toggle="collapse" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">统计信息</a>
    </li>
    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix" pnav="60">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="61"><a href="#">统计明细</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingSeven" nav="70">
        <a data-toggle="collapse" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">人员管理</a>
    </li>
    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven" pnav="70">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="71"><a href="#">角色设置</a></li>
        </ul>
    </div>
  </ul>
</nav>

<!--
<div class="info-bar">
    <span>姓名</span><span>角色</span><a href="#">退出</a> 
</div>
-->
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

    <script type="text/javascript">
        $("li[role='presentation']").click(function(){
            $("div[role='tabpanel']").removeClass("in");
            $("li[role='presentation']").removeClass("active");
            $(this).addClass("active");       
        });

        $(document).ready(function() {
            $("div[pnav='<?php echo ($_SESSION['pnav']); ?>']").addClass("in");
            $("li[nav='<?php echo ($_SESSION['nav']); ?>']").addClass("active");
        }); 
    </script>

    
<div class="main-view">
    <div class="main-view-inner container-fluid">
        <div class="row">
            <div class="col-md-2">
                <label for="classname" class="control-label">课程名称:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="classname" name="classnamee">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="classtype" class="control-label">课程分类:</label>
            </div>
            <div class="col-md-10">
                <?php if(is_array($classtypeList)): foreach($classtypeList as $key=>$vo): ?><input tabindex="<?php echo ($cnum); ?>" id="classtype_<?php echo ($cnum++); ?>" type="radio" name="classtype" value="<?php echo ($vo["id"]); ?>"><span class="radio-text"><?php echo ($vo["name"]); ?></span><?php endforeach; endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="teacher" class="control-label">教师:</label>
            </div>
            <div class="col-md-10">
                <?php if(is_array($teacherList)): foreach($teacherList as $key=>$vo): ?><input tabindex="<?php echo ($tnum); ?>" id="teacher_<?php echo ($tnum++); ?>" type="radio" name="teacher" value="<?php echo ($vo["teacher_id"]); ?>"><span class="radio-text"><?php echo ($vo["name"]); ?></span><?php endforeach; endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="classroom" class="control-label">教室:</label>
            </div>
            <div class="col-md-10">
                <?php if(is_array($classroomList)): foreach($classroomList as $key=>$vo): ?><input tabindex="<?php echo ($clnum); ?>" id="classroom_<?php echo ($clnum++); ?>" type="radio" name="classroom" value="<?php echo ($vo["classroom_id"]); ?>"><span class="radio-text"><?php echo ($vo["name"]); ?></span><?php endforeach; endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="student" class="control-label">学生:</label>
            </div>
            <div class="col-md-10">
                <?php if(is_array($studentList)): foreach($studentList as $key=>$vo): ?><div class="margin">
                        <input tabindex="<?php echo ($snum); ?>" id="student_<?php echo ($snum++); ?>" type="checkbox" name="student" value="<?php echo ($vo["student_id"]); ?>"><span class="radio-text"><?php echo ($vo["student_name"]); ?></span>
                    </div><?php endforeach; endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="timerange" class="control-label">起止时间:</label>
            </div>
            <div class="col-md-6">
                <div class="input-daterange input-group" id="datepicker">
                    <input type="text" class="input-sm form-control" name="startDate" />
                    <span class="input-group-addon">到</span>
                    <input type="text" class="input-sm form-control" name="endDate" />
                </div>
            </div>
        </div>
        <div class="row" id="class_time_row">
            <div class="col-md-2">
                <label for="weekpicker" class="control-label">上课时间:</label>
            </div>
            <div class="col-md-10">
                <div class="dropdown" style="display: inline-block;">
                    <a style="text-decoration:none;" class="dropdown-toggle" data-toggle="dropdown" id="weekpicker" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        选择星期
                    </a>
                    <ul class="dropdown-menu week-picker" aria-labelledby="weekpicker">
                        <li name="week"><a href="#">星期一</a></li>
                        <li name="week"><a href="#">星期二</a></li>
                        <li name="week"><a href="#">星期三</a></li>
                        <li name="week"><a href="#">星期四</a></li>
                        <li name="week"><a href="#">星期五</a></li>
                        <li name="week"><a href="#">星期六</a></li>
                        <li name="week"><a href="#">星期日</a></li>
                    </ul>
                </div>
                  
                <div class="dropdown" style="display: inline-block;margin-left:10%;">
                    <a style="text-decoration:none;" class="dropdown-toggle" data-toggle="dropdown" id="starttimepicker" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        开始时间
                    </a>
                    <ul class="dropdown-menu time-picker" aria-labelledby="starttimepicker">
                        <li name="starttime"><a href="#">7:00</a></li>
                        <li><a href="#">7:30</a></li>
                        <li><a href="#">8:00</a></li>
                        <li><a href="#">8:30</a></li>
                        <li><a href="#">9:00</a></li>
                        <li><a href="#">9:30</a></li>
                        <li><a href="#">10:00</a></li>
                        <li><a href="#">10:30</a></li>
                        <li><a href="#">11:00</a></li>
                    </ul>
                </div>
                <span style="display: inline-block;">-</span>
                <div class="dropdown" style="display: inline-block;">
                    <a style="text-decoration:none;" class="dropdown-toggle" data-toggle="dropdown" id="endtimepicker" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        结束时间
                    </a>
                    <ul class="dropdown-menu time-picker" aria-labelledby="endtimepicker">
                        <li name="endtime"><a href="#">7:00</a></li>
                        <li><a href="#">7:30</a></li>
                        <li><a href="#">8:00</a></li>
                        <li><a href="#">8:30</a></li>
                        <li><a href="#">9:00</a></li>
                        <li><a href="#">9:30</a></li>
                        <li><a href="#">10:00</a></li>
                        <li><a href="#">10:30</a></li>
                        <li><a href="#">11:00</a></li>
                    </ul>
                </div>
                <span style="margin-left:5%;" class="glyphicon glyphicon-trash remove-classtime" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>
            </div>
        </div>
        <div class="row" id="classTimeInsertBefore">
            <div class="col-md-2">
                <label for="remark" class="control-label">添加时间:</label>
            </div>
            <div class="col-md-10">
                <span class="glyphicon glyphicon-plus add-classtimerow" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="添加"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="remark" class="control-label">描述:</label>
            </div>
            <div class="col-md-10">
                <textarea class="form-control" id="remark"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 key row-gutter"><button type="button" class="btn btn-default btn-submit add-class">保存</button></div>
        </div>
    </div>

    


    
</div>


	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
    <script src="/Public/js/class.js"></script>
    <script src="http://7xl53o.com1.z0.glb.clouddn.com/dingdingenglish/js/jquery.icheck.min.js"></script>
        
    <script type="text/javascript">
		$('#navLoader').load("nav.html?"+new Date().getTime());
    </script>

    <script type="text/javascript">
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });

        $('.input-daterange').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            language: "zh-CN",
            autoclose: true
        });
    </script>

    <script>
        $(document).ready(function(){
          $('input').iCheck({
            checkboxClass: 'icheckbox_square',
            radioClass: 'iradio_square',
            increaseArea: '20%' // optional
          });
        });
    </script>
</body>
</html>