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
    
    <style type="text/css">
        .main-view{position:fixed;width:83.5%;height:98%;margin:0.5% 0.5% 0.5% 16%;padding:0.8% 0.8% 0.8% 1.2%;background:white;box-shadow:0 1px 2px 0 rgba(0,0,0,0.1)}
        .main-view-inner{margin:2% 6% 2% 2%;}
        .main-view-inner-bar{margin:10% 2% 2% 2%;}
        .main-view-inner-table{margin:4% 2% 2% 2%;}
        .main-view-inner-table .title{font-weight:bold;font-size:16px;background-color:#339966;color:white;}
        .cell-operation-gutter{margin-left:10%}
        .row-gutter{margin-top:10px;}
        .main-view-inner-bar-input{width:250px;}
        .main-view-inner-bar-button{width:150px;}
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
    <div class="main-view-inner">
        <div class="main-view-inner-bar container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control main-view-inner-bar-input" placeholder="学生姓名" aria-describedby="basic-addon1"/>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control main-view-inner-bar-input" placeholder="家长姓名" aria-describedby="basic-addon1"/>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control main-view-inner-bar-input" placeholder="联系电话" aria-describedby="basic-addon1"/>
                </div>
            </div>
            <div class="row row-gutter">
                <div class="col-md-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle main-view-inner-bar-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            学生状态 <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">已咨询</a></li>
                            <li><a href="#">课程中</a></li>
                            <li><a href="#">已结课</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle main-view-inner-bar-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            学费余额 <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">从少到多</a></li>
                            <li><a href="#">从多到少</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle main-view-inner-bar-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            课时剩余 <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">从少到多</a></li>
                            <li><a href="#">从多到少</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-default main-view-inner-bar-input">查询</button>
                </div>
            </div>

        </div>

        <table class="main-view-inner-table table table-bordered table-striped table-hover text-center">
            <thead class="title"><tr><td>编号</td><td>学生</td><td>家长</td><td>联系电话</td><td>余额</td><td>状态</td><td>管理</td></tr></thead>
            <tbody>
              <?php if(is_array($studentList)): foreach($studentList as $key=>$vo): ?><tr>
                  <td><?php echo ($num++); ?></td>
                  <td><?php echo ($vo["student_name"]); ?></td>
                  <td><?php echo ($vo["parent_name"]); ?></td>
                  <td><?php echo ($vo["phone"]); ?></td>
                  <td><?php echo ($vo["balance"]); ?></td>
                  <td>课程中</td>
                    <td>
                        <span style="cursor:pointer" class="glyphicon glyphicon-folder-open student-detail" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="详情"></span>
                        <span style="cursor:pointer" class="glyphicon glyphicon-education cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="报名"></span>
                        <span style="cursor:pointer" class="glyphicon glyphicon-trash cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top"  onclick="deleteStudent(<?php echo ($vo["student_id"]); ?>,'<?php echo ($vo["student_name"]); ?>')" title="删除">
                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <nav class="text-center">
            <ul class="pagination">
                <li><a href="showStudents?pageNo=1" aria-label="Begin"><span aria-hidden="true">首页</span></a></li>
                <li <?php if($pageNo == 1): ?>class="disabled"<?php else: endif; ?>>
                  <a <?php if($pageNo == 1): else: ?>href="showStudents?pageNo=<?php echo ($pageNo-1); ?>"<?php endif; ?> aria-label="Previous">
                    <span aria-hidden="true">上一页</span>
                  </a>
                </li>
                <li class="active"><a href="#"><?php echo ($pageNo); ?></a></li>
                <li <?php if($pageNo*$pageSize < $total): else: ?>class="disabled"<?php endif; ?>>
                  <a <?php if($pageNo*$pageSize < $total): ?>href="showStudents?pageNo=<?php echo ($pageNo+1); ?>"<?php else: endif; ?> aria-label="Next">
                    <span aria-hidden="true">下一页</span>
                  </a>
                </li>
                <li><a href="showStudents?pageNo=<?php echo ($howMangPages); ?>" aria-label="End"><span aria-hidden="true">尾页</span></a></li>
            </ul>
        </nav>

    </div>    
</div>


	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
    <script src="/Public/js/student.js"></script>

    <script type="text/javascript">
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });


		$('.student-detail').click(function(){
			window.location.href="studentdetail.html";
		});

    </script>
</body>
</html>