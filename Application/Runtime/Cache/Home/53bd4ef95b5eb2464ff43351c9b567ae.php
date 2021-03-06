<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
        .main-view{overflow-y:scroll;position:fixed;width:83.5%;height:98%;margin:0.5% 0.5% 0.5% 16%;padding:0.8% 0.8% 0.8% 1.2%;background:white;box-shadow:0 1px 2px 0 rgba(0,0,0,0.1)}
        .main-view-inner{margin:2% 6% 2% 2%;}
        .main-view-inner-bar{margin:2% 2% 2% 2%;}
        .class-detail-list{margin:2% 2% 2% 2%;}
        .class-detail-list .list-group{margin-bottom:0px}
        .class-detail-list .finished .list-group li{padding:10px;margin-top:5px;background-color:#339966;color:white;box-shadow:0 1px 2px 0 rgba(0,0,0,0.2)}
        .class-detail-list .finished .list-group li.cactive{background-color:#339966;color:white;}
        .class-detail-list .unfinished .list-group li{padding:10px;margin-top:5px;background-color:white;color:#339966;box-shadow:0 1px 2px 0 rgba(0,0,0,0.2)}
        .class-detail-list .unfinished .list-group li.cactive{background-color:#FF9933;color:white;}
        .cell-operation-gutter{margin-left:10%}
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
    </style>

<nav>
  <ul class="nav nav-pills nav-stacked main-nav">
    <li class="favico"><img width="60%" height="60%" src="/Public/img/logo.png"/></li>
    <li role="presentation" id="headingOne" nav="10">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">教师管理</a>
    </li>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" pnav="10">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="11"><a href="#">分组管理</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingTwo" nav="20">
        <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">学生管理</a>
    </li>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" pnav="20">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="21"><a href="./addstudent.html?nav=21&pnav=20">添加学生</a></li>
            <li role="presentation" nav="22"><a href="./studentlist.html?nav=22&pnav=20">学生列表</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingThree" nav="30">
        <a href="#">教室管理</a>
    </li>
    <li role="presentation" id="headingFour" nav="40">
        <a data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">课程管理</a>
    </li>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" pnav="40">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="41"><a href="#">课程分类设置</a></li>
            <li role="presentation" nav="42"><a href="./classmain.html?nav=42&pnav=40">课程设置</a></li>
            <li role="presentation" nav="43"><a href="./showclass.html?nav=43&pnav=40">课程查询</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingFive" nav="50">
        <a data-toggle="collapse" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">财务管理</a>
    </li>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" pnav="50">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation" nav="51"><a href="#">学费管理</a></li>
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
        <div class="main-view-inner-bar">
            <h3 style="display: inline-block;">新概念1 5人班</h3><h4 style="margin:0px 0px 0px 20px;display: inline-block;"><span class="label" style="background-color: #333366;">新概念1</span></h4>
        </div>
        <div class="class-detail-list">
            <div id="unplay" class="finished">
                <ul id="list1" class="list-group">
                  <li class="list-group-item container-fluid">
                    <div class="row text-center">
                        <div class="col-md-2">2016-01-08</div>
                        <div class="col-md-1">星期二</div>
                        <div class="col-md-2">10:00-12:00</div>
                        <div class="col-md-1">王老吉</div>
                        <div class="col-md-1">101</div>
                        <div class="col-md-1">学生</div>
                        <div class="col-md-2">
                            <span style="cursor:pointer" class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="编辑"></span>
                            <span style="cursor:pointer" class="glyphicon glyphicon-trash cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>
                        </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-2">2016-01-14</div>
                        <div class="col-md-1">星期二</div>
                        <div class="col-md-2">10:00-12:00</div>
                        <div class="col-md-1">王老吉</div>
                        <div class="col-md-1">101</div>
                        <div class="col-md-1">学生</div>
                        <div class="col-md-2">
                            <span style="cursor:pointer" class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="编辑"></span>
                            <span style="cursor:pointer" class="glyphicon glyphicon-trash cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>
                        </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-2">2016-01-14</div>
                        <div class="col-md-1">星期二</div>
                        <div class="col-md-2">10:00-12:00</div>
                        <div class="col-md-1">王老吉</div>
                        <div class="col-md-1">101</div>
                        <div class="col-md-1">学生</div>
                        <div class="col-md-2">
                            <span style="cursor:pointer" class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="编辑"></span>
                            <span style="cursor:pointer" class="glyphicon glyphicon-trash cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>
                        </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-2">2016-01-14</div>
                        <div class="col-md-1">星期二</div>
                        <div class="col-md-2">10:00-12:00</div>
                        <div class="col-md-1">王老吉</div>
                        <div class="col-md-1">101</div>
                        <div class="col-md-1">学生</div>
                        <div class="col-md-2">
                            <span style="cursor:pointer" class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="编辑"></span>
                            <span style="cursor:pointer" class="glyphicon glyphicon-trash cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>
                        </div>
                    </div>
                  </li>
                </ul>
            </div>
            <div id="play" class="unfinished">
                <ul id="list1" class="list-group">
                  <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-2">2016-01-14</div>
                        <div class="col-md-1">星期二</div>
                        <div class="col-md-2">10:00-12:00</div>
                        <div class="col-md-1">王老吉</div>
                        <div class="col-md-1">101</div>
                        <div class="col-md-1">学生</div>
                        <div class="col-md-2">
                            <span style="cursor:pointer" class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="编辑"></span>
                            <span style="cursor:pointer" class="glyphicon glyphicon-trash cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>
                        </div>
                    </div>
                  </li>
                  <li class="list-group-item cactive">
                    <div class="row text-center">
                        <div class="col-md-2"><input id="datepicker" type="text" class="form-control text-center"/></div>
                        <div class="col-md-1">星期二</div>
                        <div class="col-md-2">10:00-12:00</div>
                        <div class="col-md-1">王老吉</div>
                        <div class="col-md-1">101</div>
                        <div class="col-md-1">学生</div>
                        <div class="col-md-2">
                            <span style="cursor:pointer" class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="编辑"></span>
                            <span style="cursor:pointer" class="glyphicon glyphicon-trash cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>
                        </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-2">2016-01-14</div>
                        <div class="col-md-1">星期二</div>
                        <div class="col-md-2">10:00-12:00</div>
                        <div class="col-md-1">王老吉</div>
                        <div class="col-md-1">101</div>
                        <div class="col-md-1">学生</div>
                        <div class="col-md-2">
                            <span style="cursor:pointer" class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="编辑"></span>
                            <span style="cursor:pointer" class="glyphicon glyphicon-trash cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>
                        </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-2">2016-01-14</div>
                        <div class="col-md-1">星期二</div>
                        <div class="col-md-2">10:00-12:00</div>
                        <div class="col-md-1">王老吉</div>
                        <div class="col-md-1">101</div>
                        <div class="col-md-1">学生</div>
                        <div class="col-md-2">
                            <span style="cursor:pointer" class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="编辑"></span>
                            <span style="cursor:pointer" class="glyphicon glyphicon-trash cell-operation-gutter" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>
                        </div>
                    </div>
                  </li>
                </ul>
            </div>
        </div>
    </div>
    
    
</div>

	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- YUI -->
    <script src="http://yui.yahooapis.com/3.18.1/build/yui/yui-min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
    
    <script type="text/javascript">
		$('#navLoader').load("nav.html?"+new Date().getTime());
    </script>
    
    <script type="text/javascript">
	        $(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			});

        YUI().use('dd-constrain', 'dd-proxy', 'dd-drop', function(Y) {
            //Listen for all drop:over events
            Y.DD.DDM.on('drop:over', function(e) {
                //Get a reference to our drag and drop nodes
                var drag = e.drag.get('node'),
                    drop = e.drop.get('node');
        
                //Are we dropping on a li node?
                if (drop.get('tagName').toLowerCase() === 'li') {
                    //Are we not going up?
                    if (!goingUp) {
                        drop = drop.get('nextSibling');
                    }
                    //Add the node to this list
                    e.drop.get('node').get('parentNode').insertBefore(drag, drop);
                    //Resize this nodes shim, so we can drop on it later.
                    e.drop.sizeShim();
                }
            });
            //Listen for all drag:drag events
            Y.DD.DDM.on('drag:drag', function(e) {
                //Get the last y point
                var y = e.target.lastXY[1];
                //is it greater than the lastY var?
                if (y < lastY) {
                    //We are going up
                    goingUp = true;
                } else {
                    //We are going down.
                    goingUp = false;
                }
                //Cache for next check
                lastY = y;
            });
            //Listen for all drag:start events
            Y.DD.DDM.on('drag:start', function(e) {
                //Get our drag object
                var drag = e.target;
                //Set some styles here
                drag.get('node').setStyle('opacity', '.25');
                drag.get('dragNode').set('innerHTML', drag.get('node').get('innerHTML'));
                drag.get('dragNode').setStyles({
                    opacity: '.5',
                    borderColor: drag.get('node').getStyle('borderColor'),
                    backgroundColor: drag.get('node').getStyle('backgroundColor')
                });
            });
            //Listen for a drag:end events
            Y.DD.DDM.on('drag:end', function(e) {
                var drag = e.target;
                //Put our styles back
                drag.get('node').setStyles({
                    visibility: '',
                    opacity: '1'
                });
            });
            //Listen for all drag:drophit events
            Y.DD.DDM.on('drag:drophit', function(e) {
                var drop = e.drop.get('node'),
                    drag = e.drag.get('node');
        
                //if we are not on an li, we must have been dropped on a ul
                if (drop.get('tagName').toLowerCase() !== 'li') {
                    if (!drop.contains(drag)) {
                        drop.appendChild(drag);
                    }
                }
            });
        
            //Static Vars
            var goingUp = false, lastY = 0;
        
            //Get the list of li's in the lists and make them draggable
            var lis = Y.Node.all('#play ul li');
            lis.each(function(v, k) {
                var dd = new Y.DD.Drag({
                    node: v,
                    target: {
                        padding: '0 0 0 20'
                    }
                }).plug(Y.Plugin.DDProxy, {
                    moveOnEnd: false
                }).plug(Y.Plugin.DDConstrained, {
                    constrain2node: '#play'
                });
            });
        
            //Create simple targets for the 2 lists.
            var uls = Y.Node.all('#play ul');
            uls.each(function(v, k) {
                var tar = new Y.DD.Drop({
                    node: v
                });
            });
        
        });
        
        $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            language: "zh-CN",
            autoclose: true
        });
    </script>
</body>
</html>