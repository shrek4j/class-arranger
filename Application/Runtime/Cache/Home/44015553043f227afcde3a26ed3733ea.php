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
    
    <style type="text/css">
        .global{
            font-family: "微软雅黑","华文细黑",Helvetica,Tahoma,Arial,STXihei,"Microsoft YaHei",SimSun,"宋体",Heiti,"黑体",sans-serif;
            background:#ebebeb;
        }
        .favico{margin-top:8%;margin-bottom:10%;padding-left:23%;}
        .main-nav{position:fixed;width:15%;height:98%;margin:0.5%;padding:0.8% 0.8% 0.8% 1.2%;background:white;box-shadow:0 1px 2px 0 rgba(0,0,0,0.1)}
        .main-nav li{font-size:16px;}
        .sub-nav{padding-left: 30px;}
        .sub-nav li{font-size:12px;}
    </style>
    
</head>
<body class="global">

<nav>
  <ul class="nav nav-pills nav-stacked main-nav">
    <li class="favico"><img width="60%" height="60%" src="./Public/img/logo.png"/></li>
    <li role="presentation" id="headingOne" class="active">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">教师管理</a>
    </li>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation"><a href="#">分组管理</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingTwo">
        <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">学生管理</a>
    </li>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <ul class="nav nav-pills nav-stacked sub-nav">
            <li role="presentation"><a href="#">分组管理</a></li>
            <li role="presentation"><a href="#">批量操作</a></li>
        </ul>
    </div>
    <li role="presentation" id="headingThree">
        <a href="#">教室管理</a>
    </li>
    <li role="presentation" id="headingFour">
        <a href="#">课程管理</a>
    </li>
  </ul>
</nav>


	<!-- 可选的Bootstrap主题文件（一般不用引入） -->
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"/>
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $("li[role='presentation']").click(function(){
           $("li[role='presentation']").removeClass("active");
           $(this).addClass("active"); 
        });
    </script>
</body>
</html>
  <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        .defaultClassDiv{
            background:#70E1EF;
            color:#FFF;
            position:absolute;
            border:solid #CBF3FB 2px;
            font-size:6px;
            font-family:Arial;
            text-align:center;
            opacity:0.9;
        }
    
        .singleTdTop{
            border-width: 1px 0px 0px 0px;border-color: black; border-style:solid solid solid solid;
        }
        .singleTdTopAndLeft{
            border-width: 1px 0px 0px 1px;border-color: black; border-style:solid solid solid solid;
        }
        
        .doubleTdTop{
            border-width: 1px 0px 0px 0px;border-color: black; border-style:solid solid solid solid;
        }
        
        .doubleTdTopAndLeft{
            border-width: 1px 0px 0px 1px;border-color: black; border-style:solid solid solid solid;
        }
        
        .doubleTdTopThick{
            border-width: 2px 0px 0px 0px;border-color: black; border-style:solid solid solid solid;
        }
        
        .doubleTdTopAndLeftThick{
            border-width: 2px 0px 0px 1px;border-color: black; border-style:solid solid solid solid;
        }
        
        .topTdLeft{
            border-width: 0px 0px 0px 1px;border-color: black; border-style:solid solid solid solid;
        }
    </style>
    
    <style type="text/css">
        .input-wrapper{
            margin-top:18px;
            position:relative;
            width:400px;margin:25px auto 0;text-align:center;
            top:40px;
            left:50px;
        }
        
        .input-wrapper input{
            background:#e7f1f8;font-size:15px;border:1px solid #1672B9;border-radius:5px;padding:8px 10px;box-shadow:inset 0 1px 2px rgba(15,82,135,.25),0 1px 0 rgba(255,255,255,.15);width:180px;margin:0;color:#555;line-height:17px;
        }
        
        .input-wrapper input:focus{
            background:#fff;outline:0;box-shadow:inset 0 1px 2px rgba(15,82,135,.25),0 0 10px rgba(255,255,255,.3);border:1px solid #197CC9
        }
        
        .input-wrapper.name{margin-bottom:18px}
        
        .input-wrapper input{width:228px}
        
        .input-wrapper input{border:1px solid #1672B9}
        
        .input-wrapper input{width:226px;font-size:16px;font-family:'黑体';line-height:19px}
        
        .button-wrapper{
            position:relative;
            width:250px;margin:25px auto 0;text-align:center;
        }
        
        .command {
            top:50px;
            left:95px;
            margin-top: 20px;
        }
        
        .sign-button {border:1px solid #1D80CF;width:100%;text-align:center;font-size:15px;color:#fff;text-shadow:0 1px 1px rgba(0,0,0,.2);background:#80C3F7;background:-webkit-gradient(linear,left top,left bottom,from(#80c3f7),to(#6bbaf8));box-shadow:inset 0 1px 0 rgba(255,255,255,.3),0 1px 1px rgba(50,50,50,.05);border-radius:5px;cursor:pointer;line-height:33px;display:block;padding:0 15px;outline:0}
        .sign-button:active{background:-webkit-gradient(linear,left top,left bottom,from(#5dadec),to(#51a4e6));box-shadow:inset 0 1px 2px rgba(0,0,0,.1),0 1px 0 rgba(255,255,255,.1);color:#eee;border:1px solid #0971C5}
        .sign-button{width:228px;margin:0 auto}
        .sign-button{font-weight:700;font-size:16px;line-height:37px}
        
        .future_monday{
            cursor:pointer;height:5%;opacity:1;color:white;font-family:Helvetica;font-size:14px;text-align:center;
        }
        
        .teacher_div{
            cursor:pointer;height:5%;opacity:1;color:white;font-family:Helvetica;font-size:14px;text-align:center;width:100px;
        }
    </style>
    
     <link rel="stylesheet" type="text/css" href="/Public/js/jquery/easyui/themes/default/easyui.css">
  <!--   <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css"> -->
  <!--  <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css"> -->
   <!--   <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script> -->
   <!--   <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script> -->
    <script type="text/javascript" src="/Public/js/jquery/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery/easyui/jquery.easyui.min.js"></script>	

    <script type="text/javascript">
        var default_width = '78px';//单元格width=80,div设成78，有2px是border的
        var default_height = 24;//单元格的height
        var border = 2;//单元格的border
        
        //打开页面时，加载课程div，只运行一次
        $(function(){
            <?php if(is_array($scheduleList)): foreach($scheduleList as $key=>$vo): ?>var div_start_<?php echo ($key); ?> = '<?php echo ($vo["day_of_week"]); ?>_<?php echo ($vo["start_time"]); ?>';
            var div_end_<?php echo ($key); ?> = '<?php echo ($vo["day_of_week"]); ?>_<?php echo ($vo["end_time"]); ?>';
            
            var top = $("#"+div_start_<?php echo ($key); ?>).offset().top + border/2;//修正位置
           // var bottom = $("#"+div_end_<?php echo ($key); ?>).offset().top;
            var left = $("#"+div_start_<?php echo ($key); ?>).offset().left + border/2;//修正位置
            var width = default_width;
           // var height = bottom - top - 2*border;//修正位置
            var timeUnit;
            for(var i=0;i<timeOfDay.length;i++){
                if(timeOfDay[i] == '<?php echo ($vo["start_time"]); ?>'){
                    timeUnit = i;
                }
                if(timeOfDay[i] == '<?php echo ($vo["end_time"]); ?>'){
                    timeUnit = i - timeUnit;
                }
            }
            var height = timeUnit * default_height - 5;
            
            var id = '<?php echo ($vo["schedule_id"]); ?>';
            var dayOfWeek = '<?php echo ($vo["day_of_week"]); ?>';
            var startTime = '<?php echo ($vo["start_time"]); ?>';
            var endTime = '<?php echo ($vo["end_time"]); ?>';
            var classTag = '<?php echo ($vo["class_tag"]); ?>';
            
            createDiv(id,dayOfWeek,startTime,endTime,top,height,left,width,classTag);<?php endforeach; endif; ?>
         });

        //创建一个课程div
        function createDiv(id,dayOfWeek,startTime,endTime,top,height,left,width,classTag){
            var div=$('<div class="defaultClassDiv" data-options="handle:\'#'+id+'\',onDrag:onDrag,onStopDrag:onStopDrag,onStopResize:onStopResize" onmouseover="mouseover(this);">' +
                        '<div id="'+id+'" style="padding:10px;background:#065FB9;color:#fff;font-family:Arial;word-wrap:break-word;"></div>' +
                        '<div id="'+id+'Div" ondblclick="toUpdateClassTag('+id+')" style="padding:3px;cursor:pointer;font-family:Arial;word-wrap:break-word">'+classTag+'</div>' +
                        '<input style="display:none;" id="'+id+'Input" onblur="updateClassTag('+id+',this)" value="'+classTag +'"/>'+
                        '</div>');        //创建一个div
            div.attr('id',id);        //给div设置id
            div.attr('dayOfWeek',dayOfWeek);
            div.attr('startTime',startTime);
            div.attr('endTime',endTime);
            div.css({'top':top,'left':left});
            div.css({'height':height,'width':width});
            $("#divIncluder").append(div);
            
            $(div).draggable();
            $(div).resizable({
                handles:'s',
                edge:15
            });
                    
        }
        
        function toUpdateClassTag(id){
            $("#"+id+"Input").show();
            $("#"+id+"Input").focus();
            $("#"+id+"Div").hide();
        }
        
        function updateClassTag(id,div){
            if(div.value == ""){
                $("#"+id+"Input").val($("#"+id+"Div").innerHTML);                
                $("#"+id+"Input").hide();
                $("#"+id+"Div").show();
                return;
            }
            $.ajax({
               type: "POST",
               url: "updateClassTag",
               data: "schedId="+id+"&classTag="+div.value,
               success: function(msg){
                    $("#"+id+"Input").hide();
                    $("#"+id+"Div")[0].innerHTML = div.value;
                    $("#"+id+"Div").show();
               }
            });
            
        }
        </script>
        
        <script type="text/javascript">
            //获得当前操作div的id
            var currId;
            function mouseover(div){
                currId = div.id;
            }
        </script>
        
        <script type="text/javascript">
        //课程div拖动事件 start
        function onDrag(e){
            if(isOverlapped()){
                $("#trashCan").css('opacity','0.95');
            
            }else{
                $("#trashCan").css('opacity','0.8');
            }
        }

        var dayOfWeek = ['1','2','3','4','5','6','7'];
        var timeOfDay = ['0730','0800','0830','0900','0930','1000','1030','1100','1130','1200','1230','1300','1330','1400','1430','1500','1530','1600','1630','1700',
                            '1730','1800','1830','1900','1930','2000','2030','2100','2130'];
        function onStopDrag(e){
            var d = e.data;
            
            //是否为删除动作
            if(deleteSchedule()){
                return;
            }
            
            //修正课程div的位置 start
            //1.得到最新的top,left
            var shortestDis = 10000;
            var fitLeft;
            var fitTop;
            var fitStartEle;
            for(var i=0;i<dayOfWeek.length;i++){
                for(var m=0;m<timeOfDay.length;m++){
                    var ele = $("#"+dayOfWeek[i]+"_"+timeOfDay[m]);
                    if(ele[0] != undefined){
                       var width = ele.offset().left - d.left;
                        var height = ele.offset().top - d.top;
                        var dis = Math.sqrt(Math.pow(width,2)+Math.pow(height,2));
                        if(dis < shortestDis){
                            shortestDis = dis;
                            fitLeft = ele.offset().left + border/2;//修正位置
                            fitTop = ele.offset().top + border/2;//修正位置
                            fitStartEle = ele;
                        }
                    }
                }
            }
            //2.更新
            $("#"+currId).css({'top':fitTop,'left':fitLeft});
            //修正课程div的位置 end  
          
          
            //修改当前课程div的dayOfWeek,startTime,endTime   start
            //1.得到最新的dayOfWeek,得到最新的startTime,得到最新的endTime
            var fitStartId = fitStartEle.attr('id');
            var newDayOfWeek = fitStartId.split('_')[0];
            var newStartTime = fitStartId.split('_')[1];
            var newEndTime;
            var timeUnit = ($("#"+currId).height() + 5)/default_height;//3是什么？
            for(var i=0;i<timeOfDay.length;i++){
                if(timeOfDay[i] == newStartTime){
                    if(i+timeUnit < timeOfDay.length){
                        newEndTime = timeOfDay[i+timeUnit];
                        break;
                    }
                }
            }
            //2.更新
            if(newEndTime != undefined){
                $("#"+currId).attr('dayOfWeek',newDayOfWeek);
                $("#"+currId).attr('startTime',newStartTime);
                $("#"+currId).attr('endTime',newEndTime);
            }
            //修改当前课程div的dayOfWeek,startTime,endTime   end
          
            //保存数据
            $.ajax({
               type: "POST",
               url: "updateSchedule",
               data: "schedId="+currId+"&dayOfWeek="+newDayOfWeek+"&startTime="+newStartTime+"&endTime="+newEndTime,
               success: function(msg){
                   
               }
            });
          
        }
        //课程div拖动事件 end
     </script>

    <script type="text/javascript">
        //课程div resize事件  start
        function onStopResize(e){
            //1.自动对齐UI
            var timeUnit;
            //差值
            var diff = ($("#"+currId).height() + 5) % default_height;
            if(diff*2 > default_height){
                timeUnit = (($("#"+currId).height() + 5 - diff) / default_height) + 1;
            }else{
                timeUnit = ($("#"+currId).height() + 5 - diff) / default_height;
            }
            
            //2.更新UI高度
            var newHeight = timeUnit * default_height - 5;
            var left = $("#"+currId).offset().left;
            $("#"+currId).css({'height':newHeight,'left':left});
            
            
            //1.计算结束时间
            var newEndTime;
            var startTime = $("#"+currId).attr('startTime');
            for(var i=0;i<timeOfDay.length;i++){
                if(timeOfDay[i] == startTime){
                    if(i+timeUnit < timeOfDay.length){
                        newEndTime = timeOfDay[i+timeUnit];
                        break;
                    }
                }
            }
            //2.更新实际值
            if(newEndTime != undefined){
                $("#"+currId).attr('endTime',newEndTime);
            }
            
            var newDayOfWeek = $("#"+currId).attr('dayOfWeek');
            var newStartTime = $("#"+currId).attr('startTime');
            var newEndTime = $("#"+currId).attr('endTime');
            
            //保存数据
            $.ajax({
               type: "POST",
               url: "updateSchedule",
               data: "schedId="+currId+"&dayOfWeek="+newDayOfWeek+"&startTime="+newStartTime+"&endTime="+newEndTime,
               success: function(msg){
                   
               }
            });
        }
        //课程div resize事件  end
    </script>
    
    <script type="text/javascript">
        $(function(){
            $('.right td').dblclick(
                function () {
                    $("#scheduleEditBG").show();
                    $("#scheduleEdit").show();
                    
                    var id = $(this).attr('id');
                    var dayOfWeek = id.split('_')[0];
                    var startTimeOfDay = id.split('_')[1];
                    var endTimeOfDay;
                    for(var i=0;i<timeOfDay.length;i++){
                        if(timeOfDay[i] == startTimeOfDay && i+2<timeOfDay.length){
                            endTimeOfDay = timeOfDay[i+2];
                            break;
                        }
                    }
                    $("#edit_class_td").val($(this).attr("id"));
                    $("#edit_day_of_week").val(dayOfWeek);
                    $("#edit_start_time").val(startTimeOfDay);
                    $("#edit_end_time").val(endTimeOfDay);                 
                }
            );
        });
        
        $(function(){
            $("#saveScheduleSubmitBtn").click(
                function(){
                    $("#saveScheduleSubmitBtn").attr("disabled",true);
                    var newClassTag = $("#edit_class_tag").val();
                    var newDayOfWeek = $("#edit_day_of_week").val();
                    var newStartTime = $("#edit_start_time").val();
                    var newEndTime = $("#edit_end_time").val();
                    //保存数据
                    $.ajax({
                       type: "POST",
                       url: "saveSchedule",
                       data: "classTag="+newClassTag+"&dayOfWeek="+newDayOfWeek+"&startTime="+newStartTime+"&endTime="+newEndTime,
                       success: function(msg){
                           if(msg!="false"){
                                var classId = $("#edit_class_td").val();
                                
                                var top = $("#"+classId).offset().top + border/2;//修正位置
                                var left = $("#"+classId).offset().left + border/2;//修正位置
                                var width = default_width;
                                var timeUnit = 2;
                                var height = timeUnit * default_height - 5;
                                
                                var id = msg[0]['schedid'];
                                var dayOfWeek = newDayOfWeek;
                                var startTime = newStartTime;
                                var endTime = newEndTime;
                                var classTag = newClassTag;
                                
                                createDiv(id,dayOfWeek,startTime,endTime,top,height,left,width,classTag);
                                
                                resetSaveSchedulePanel();
                           }
                       }
                    }); 
                }
            );
        });
            
        function resetSaveSchedulePanel(){
            $("#saveScheduleSubmitBtn").attr("disabled",false);
            $("#scheduleEditBG").hide();
            $("#scheduleEdit").hide();
            $("#edit_class_td").val("");
            $("#edit_day_of_week").val("");
            $("#edit_start_time").val("");
            $("#edit_end_time").val("");
        }
        
        function backToOriginalPosition(){
            var classDiv = $("#"+currId);
            var startDiv = classDiv.attr('dayOfWeek')+"_"+classDiv.attr('starttime');
            var top = $("#"+startDiv).offset().top;
            var left = $("#"+startDiv).offset().left;
            classDiv.css({'top':top,'left':left});
        }
        
        function deleteSchedule(){
            //检测是否重合
            if(isOverlapped()){
                var expireMonday = $("#effectMonday").val();
                $.ajax({
                   type: "POST",
                   url: "deleteSchedule",
                   data: "schedId="+currId+"&expireMonday="+expireMonday,
                   success: function(msg){
                    if(msg){
                        $("#"+currId).remove();
                        
                    }else{
                        alert("未删除成功！");
                        backToOriginalPosition();
                        
                    }
                        
                   }
                });
                $("#trashCan").css('opacity','0.8');
                return true;
            }else{
                return false;
            } 
        }
        
        function isOverlapped(){
            var objOne=$("#"+currId);
                objTwo=$("#trashCan");
            
            if(objOne.offset().left + 80 > objTwo.offset().left){
                return true;
            }else{
                return false;
            }
        }
    </script>
    
    <script type="text/javascript">
        $(function(){
       
            $(".future_monday").mouseover(
                function(){
                    if($(this).attr('selectedWeek') == 'true'){
                    
                    }else{   
                        $(this).css('background','#bed742');
                    }
                }
            );
            $(".future_monday").mouseout(
                function(){
                    if($(this).attr('selectedWeek') == 'true'){
                         
                    }else{
                       $(this).css('background','#7fb80e'); 
                    }
                    
                }
            );
            
            $(".future_monday").click(
                function(){
                    $(".future_monday[selectedWeek='true']").css('background','#7fb80e'); 
                    $(".future_monday[selectedWeek='true']").attr('selectedWeek','false');
                    $(this).attr('selectedWeek','true');
                    $(this).css('background','#f47920');
                    
                    var effectMonday = $(this).attr('effectMonday');
                    $("#effectMonday").val(effectMonday);
                    $("#showSchedule").submit();
                }
            );
            
            $(".teacher_div").mouseover(
                function(){
                    if($(this).attr('selectedTeacher') == 'true'){
                    
                    }else{   
                        $(this).css('background','#bed742');
                    }
                }
            );
            $(".teacher_div").mouseout(
                function(){
                    if($(this).attr('selectedTeacher') == 'true'){
                         
                    }else{
                       $(this).css('background','#7fb80e'); 
                    }
                    
                }
            );
            
            $(".teacher_div").click(
                function(){
                    $(".teacher_div[selectedTeacher='true']").css('background','#7fb80e'); 
                    $(".teacher_div[selectedTeacher='true']").attr('selectedTeacher','false');
                    $(this).attr('selectedTeacher','true');
                    $(this).css('background','#f47920');
                    
                    var tId = $(this).attr('teacher_id');
                    $("#tId").val(tId);
                    $("#showSchedule").submit();
                }
            );
            
        });
        
        
    </script>
    </head>
    <body style="background:#f1f5f8;margin:0px;">
        <form action="show" method="post" id="showSchedule">
            <input type="hidden" name="tId" id="tId" value="<?php echo ($tId); ?>"/>
            <input type="hidden" name="effectMonday" id="effectMonday" value="<?php echo ($effectMonday); ?>"/>
        </form>

        <div id="scheduleEditBG" style="display:none;background: black;opacity:0.9;position:fixed;width:100%;height:100%;z-index:998;">
        </div>
        <div id="scheduleEdit" style="display:none;color: white;position:absolute;z-index:999;font-family: '黑体';">
            <div class="input-wrapper">
                <span>课程标签：</span>
                <input placeholder="该文字会显示在课程上" maxlength="128" name="edit_class_tag" id="edit_class_tag"/>
            </div>
            <input hidden="true" name="edit_class_td" id="edit_class_td"/>
            <input hidden="true" name="edit_day_of_week" id="edit_day_of_week"/>
            <input hidden="true" name="edit_start_time" id="edit_start_time"/>
            <input hidden="true" name="edit_end_time" id="edit_end_time"/>
            <div class="button-wrapper command">
                <input id="saveScheduleSubmitBtn" class="sign-button" type="button" value="保存课程"/>
            </div>
            <div class="button-wrapper command">
                <input class="sign-button" type="button" value="关闭" onclick="resetSaveSchedulePanel();"/>
            </div>
        </div>
        <div id="scheduleUpdate" style="display:none;color: white;position:absolute;z-index:999;font-family: '黑体';">
            <div class="input-wrapper">
                <span>课程标签：</span>
                <input placeholder="该文字会显示在课程上" maxlength="128" name="edit_class_tag" id="edit_class_tag"/>
            </div>
            <input hidden="true" name="update_class_td" id="update_class_td"/>
            <input hidden="true" name="update_day_of_week" id="update_day_of_week"/>
            <input hidden="true" name="update_start_time" id="update_start_time"/>
            <input hidden="true" name="update_end_time" id="update_end_time"/>
            <div class="button-wrapper command">
                <input id="updateScheduleSubmitBtn" class="sign-button" type="button" value="更新课程"/>
            </div>
            <div class="button-wrapper command">
                <input class="sign-button" type="button" value="关闭" onclick="resetUpdateSchedulePanel();"/>
            </div>
        </div>
        
        
        <div id="trashCan" style="position:absolute;height:100%;width:7%;top:16%;left:93%;background:#1b315e;opacity:0.8;color:white;font-family:'黑体';font-size:40px;">
            <div style="margin-left:30%;margin-top:100px;">拖<br>到<br>此<br>处<br>删<br>除<br>课<br>程</div>
        </div>
        <div id="operationBar">
            <div style="color:white;font-family:Helvetica;font-size:14px;text-align:center;width:300px;margin: 10px;">
                <a style="margin: 20px;" href="/index.php/Home/Student/show">管理学生</a> <a style="margin: 20px;" href="/index.php/Home/Teacher/show">管理教师</a>
            </div>
        
            <div id="manageClass">
                <table style="height:6%;left:0%;border:5px;">
                    <tr>
                        <td class="edit_class" style="background: #5c7a29;color:white;font-family:Helvetica;font-size:14px;text-align:center;height:5%;width:100px;">
                            教师
                        </td>
                        <?php if(is_array($teacherList)): foreach($teacherList as $key=>$vo): ?><td teacher_id="<?php echo ($vo["teacher_id"]); ?>" <?php if($tId == $vo['teacher_id']): ?>selectedTeacher="true"<?php endif; ?> class="teacher_div" style="background:
                                <?php if($tId == $vo['teacher_id']): ?>#f47920
                                <?php else: ?> 
                                    #7fb80e<?php endif; ?>
                                ;">
                            <?php echo ($vo["name"]); ?>
                        </td><?php endforeach; endif; ?>
                    </tr>
                </table>
            </div>
            
            <div id="timeLine">
                <table style="height:6%;width:100%;left:0%;">
                    <tr>
                        <td style="background: #5c7a29;color:white;font-family:Helvetica;font-size:14px;text-align:center;height:5%;width:100px;">
                            课表
                        </td>
                    
                    <?php if(is_array($dateList)): foreach($dateList as $key=>$vo): ?><td effectMonday="<?php echo ($vo); ?>" <?php if($effectMonday == $vo): ?>selectedWeek="true"<?php endif; ?> class="future_monday" style="background:
                            <?php if($effectMonday == $vo): ?>#f47920
                            <?php else: ?> 
                                #7fb80e<?php endif; ?>
                            ;">
                        <?php echo ($vo); ?>
                        </td><?php endforeach; endif; ?>
                        <td class="future_monday" style="background:#7fb80e;">
                            更多......
                        </td>
                    </tr> 
                </table>
            </div>
        </div>
        
        <div id="divIncluder">
        </div>
        <div class="right">
        <table align="center"
         style="margin-top:5px;background:#f6f5ec;font-family:Arial,'黑体'; font-size: middle; border: 2px solid black; height:700px;text-align:center">
            <tr></tr>
                <td width="80px"></td><td width="80px" id="1_" class="topTdLeft">星期一</td><td width="80px" id="2_"class="topTdLeft">星期二</td><td width="80px" id="3_"class="topTdLeft">星期三</td><td width="80px" id="4_"class="topTdLeft">星期四</td><td width="80px" id="5_"class="topTdLeft">星期五</td><td width="80px" id="6_"class="topTdLeft">星期六</td><td width="80px" id="7_"class="topTdLeft">星期日</td>
            </tr>
            <tr>
              <td class="singleTdTop">07:30</td><td id="1_0730" class="singleTdTopAndLeft"></td><td id="2_0730" class="singleTdTopAndLeft"></td><td id="3_0730" class="singleTdTopAndLeft"></td><td id="4_0730" class="singleTdTopAndLeft"></td><td id="5_0730" class="singleTdTopAndLeft"></td><td id="6_0730" class="singleTdTopAndLeft"></td><td id="7_0730" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTopThick"><b>08:00</b></td><td id="1_0800" class="doubleTdTopAndLeftThick"></td><td id="2_0800" class="doubleTdTopAndLeftThick"></td><td id="3_0800" class="doubleTdTopAndLeftThick"></td><td id="4_0800" class="doubleTdTopAndLeftThick"></td><td id="5_0800" class="doubleTdTopAndLeftThick"></td><td id="6_0800" class="doubleTdTopAndLeftThick"></td><td id="7_0800" class="doubleTdTopAndLeftThick"></td>
            </tr>
             <tr>
              <td class="singleTdTop">08:30</td><td id="1_0830" class="singleTdTopAndLeft"></td><td id="2_0830" class="singleTdTopAndLeft"></td><td id="3_0830" class="singleTdTopAndLeft"></td><td id="4_0830" class="singleTdTopAndLeft"></td><td id="5_0830" class="singleTdTopAndLeft"></td><td id="6_0830" class="singleTdTopAndLeft"></td><td id="7_0830" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTop">09:00</td><td id="1_0900" class="doubleTdTopAndLeft"></td><td id="2_0900" class="doubleTdTopAndLeft"></td><td id="3_0900" class="doubleTdTopAndLeft"></td><td id="4_0900" class="doubleTdTopAndLeft"></td><td id="5_0900" class="doubleTdTopAndLeft"></td><td id="6_0900" class="doubleTdTopAndLeft"></td><td id="7_0900" class="doubleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="singleTdTop">09:30</td><td id="1_0930" class="singleTdTopAndLeft"></td><td id="2_0930" class="singleTdTopAndLeft"></td><td id="3_0930" class="singleTdTopAndLeft"></td><td id="4_0930" class="singleTdTopAndLeft"></td><td id="5_0930" class="singleTdTopAndLeft"></td><td id="6_0930" class="singleTdTopAndLeft"></td><td id="7_0930" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTopThick"><b>10:00</b></td><td id="1_1000" class="doubleTdTopAndLeftThick"></td><td id="2_1000" class="doubleTdTopAndLeftThick"></td><td id="3_1000" class="doubleTdTopAndLeftThick"></td><td id="4_1000" class="doubleTdTopAndLeftThick"></td><td id="5_1000" class="doubleTdTopAndLeftThick"></td><td id="6_1000" class="doubleTdTopAndLeftThick"></td><td id="7_1000" class="doubleTdTopAndLeftThick"></td>
            </tr>
            <tr>
              <td class="singleTdTop">10:30</td><td id="1_1030" class="singleTdTopAndLeft"></td><td id="2_1030" class="singleTdTopAndLeft"></td><td id="3_1030" class="singleTdTopAndLeft"></td><td id="4_1030" class="singleTdTopAndLeft"></td><td id="5_1030" class="singleTdTopAndLeft"></td><td id="6_1030" class="singleTdTopAndLeft"></td><td id="7_1030" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTop">11:00</td><td id="1_1100" class="doubleTdTopAndLeft"></td><td id="2_1100" class="doubleTdTopAndLeft"></td><td id="3_1100" class="doubleTdTopAndLeft"></td><td id="4_1100" class="doubleTdTopAndLeft"></td><td id="5_1100" class="doubleTdTopAndLeft"></td><td id="6_1100" class="doubleTdTopAndLeft"></td><td id="7_1100" class="doubleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="singleTdTop">11:30</td><td id="1_1130" class="singleTdTopAndLeft"></td><td id="2_1130" class="singleTdTopAndLeft"></td><td id="3_1130" class="singleTdTopAndLeft"></td><td id="4_1130" class="singleTdTopAndLeft"></td><td id="5_1130" class="singleTdTopAndLeft"></td><td id="6_1130" class="singleTdTopAndLeft"></td><td id="7_1130" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTopThick"><b>12:00</b></td><td id="1_1200" class="doubleTdTopAndLeftThick"></td><td id="2_1200" class="doubleTdTopAndLeftThick"></td><td id="3_1200" class="doubleTdTopAndLeftThick"></td><td id="4_1200" class="doubleTdTopAndLeftThick"></td><td id="5_1200" class="doubleTdTopAndLeftThick"></td><td id="6_1200" class="doubleTdTopAndLeftThick"></td><td id="7_1200" class="doubleTdTopAndLeftThick"></td>
            </tr>
            <tr>
              <td class="singleTdTop">12:30</td><td id="1_1230" class="singleTdTopAndLeft"></td><td id="2_1230" class="singleTdTopAndLeft"></td><td id="3_1230" class="singleTdTopAndLeft"></td><td id="4_1230" class="singleTdTopAndLeft"></td><td id="5_1230" class="singleTdTopAndLeft"></td><td id="6_1230" class="singleTdTopAndLeft"></td><td id="7_1230" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTop">13:00</td><td id="1_1300" class="doubleTdTopAndLeft"></td><td id="2_1300" class="doubleTdTopAndLeft"></td><td id="3_1300" class="doubleTdTopAndLeft"></td><td id="4_1300" class="doubleTdTopAndLeft"></td><td id="5_1300" class="doubleTdTopAndLeft"></td><td id="6_1300" class="doubleTdTopAndLeft"></td><td id="7_1300" class="doubleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="singleTdTop">13:30</td><td id="1_1330" class="singleTdTopAndLeft"></td><td id="2_1330" class="singleTdTopAndLeft"></td><td id="3_1330" class="singleTdTopAndLeft"></td><td id="4_1330" class="singleTdTopAndLeft"></td><td id="5_1330" class="singleTdTopAndLeft"></td><td id="6_1330" class="singleTdTopAndLeft"></td><td id="7_1330" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTopThick"><b>14:00</b></td><td id="1_1400" class="doubleTdTopAndLeftThick"></td><td id="2_1400" class="doubleTdTopAndLeftThick"></td><td id="3_1400" class="doubleTdTopAndLeftThick"></td><td id="4_1400" class="doubleTdTopAndLeftThick"></td><td id="5_1400" class="doubleTdTopAndLeftThick"></td><td id="6_1400" class="doubleTdTopAndLeftThick"></td><td id="7_1400" class="doubleTdTopAndLeftThick"></td>
            </tr>
            <tr>
              <td class="singleTdTop">14:30</td><td id="1_1430" class="singleTdTopAndLeft"></td><td id="2_1430" class="singleTdTopAndLeft"></td><td id="3_1430" class="singleTdTopAndLeft"></td><td id="4_1430" class="singleTdTopAndLeft"></td><td id="5_1430" class="singleTdTopAndLeft"></td><td id="6_1430" class="singleTdTopAndLeft"></td><td id="7_1430" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTop">15:00</td><td id="1_1500" class="doubleTdTopAndLeft"></td><td id="2_1500" class="doubleTdTopAndLeft"></td><td id="3_1500" class="doubleTdTopAndLeft"></td><td id="4_1500" class="doubleTdTopAndLeft"></td><td id="5_1500" class="doubleTdTopAndLeft"></td><td id="6_1500" class="doubleTdTopAndLeft"></td><td id="7_1500" class="doubleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="singleTdTop">15:30</td><td id="1_1530" class="singleTdTopAndLeft"></td><td id="2_1530" class="singleTdTopAndLeft"></td><td id="3_1530" class="singleTdTopAndLeft"></td><td id="4_1530" class="singleTdTopAndLeft"></td><td id="5_1530" class="singleTdTopAndLeft"></td><td id="6_1530" class="singleTdTopAndLeft"></td><td id="7_1530" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTopThick"><b>16:00</b></td><td id="1_1600" class="doubleTdTopAndLeftThick"></td><td id="2_1600" class="doubleTdTopAndLeftThick"></td><td id="3_1600" class="doubleTdTopAndLeftThick"></td><td id="4_1600" class="doubleTdTopAndLeftThick"></td><td id="5_1600" class="doubleTdTopAndLeftThick"></td><td id="6_1600" class="doubleTdTopAndLeftThick"></td><td id="7_1600" class="doubleTdTopAndLeftThick"></td>
            </tr>
            <tr>
              <td class="singleTdTop">16:30</td><td id="1_1630" class="singleTdTopAndLeft"></td><td id="2_1630" class="singleTdTopAndLeft"></td><td id="3_1630" class="singleTdTopAndLeft"></td><td id="4_1630" class="singleTdTopAndLeft"></td><td id="5_1630" class="singleTdTopAndLeft"></td><td id="6_1630" class="singleTdTopAndLeft"></td><td id="7_1630" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTop">17:00</td><td id="1_1700" class="doubleTdTopAndLeft"></td><td id="2_1700" class="doubleTdTopAndLeft"></td><td id="3_1700" class="doubleTdTopAndLeft"></td><td id="4_1700" class="doubleTdTopAndLeft"></td><td id="5_1700" class="doubleTdTopAndLeft"></td><td id="6_1700" class="doubleTdTopAndLeft"></td><td id="7_1700" class="doubleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="singleTdTop">17:30</td><td id="1_1730" class="singleTdTopAndLeft"></td><td id="2_1730" class="singleTdTopAndLeft"></td><td id="3_1730" class="singleTdTopAndLeft"></td><td id="4_1730" class="singleTdTopAndLeft"></td><td id="5_1730" class="singleTdTopAndLeft"></td><td id="6_1730" class="singleTdTopAndLeft"></td><td id="7_1730" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTopThick"><b>18:00</b></td><td id="1_1800" class="doubleTdTopAndLeftThick"></td><td id="2_1800" class="doubleTdTopAndLeftThick"></td><td id="3_1800" class="doubleTdTopAndLeftThick"></td><td id="4_1800" class="doubleTdTopAndLeftThick"></td><td id="5_1800" class="doubleTdTopAndLeftThick"></td><td id="6_1800" class="doubleTdTopAndLeftThick"></td><td id="7_1800" class="doubleTdTopAndLeftThick"></td>
            </tr>
            <tr>
              <td class="singleTdTop">18:30</td><td id="1_1830" class="singleTdTopAndLeft"></td><td id="2_1830" class="singleTdTopAndLeft"></td><td id="3_1830" class="singleTdTopAndLeft"></td><td id="4_1830" class="singleTdTopAndLeft"></td><td id="5_1830" class="singleTdTopAndLeft"></td><td id="6_1830" class="singleTdTopAndLeft"></td><td id="7_1830" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTop">19:00</td><td id="1_1900" class="doubleTdTopAndLeft"></td><td id="2_1900" class="doubleTdTopAndLeft"></td><td id="3_1900" class="doubleTdTopAndLeft"></td><td id="4_1900" class="doubleTdTopAndLeft"></td><td id="5_1900" class="doubleTdTopAndLeft"></td><td id="6_1900" class="doubleTdTopAndLeft"></td><td id="7_1900" class="doubleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="singleTdTop">19:30</td><td id="1_1930" class="singleTdTopAndLeft"></td><td id="2_1930" class="singleTdTopAndLeft"></td><td id="3_1930" class="singleTdTopAndLeft"></td><td id="4_1930" class="singleTdTopAndLeft"></td><td id="5_1930" class="singleTdTopAndLeft"></td><td id="6_1930" class="singleTdTopAndLeft"></td><td id="7_1930" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTopThick"><b>20:00</b></td><td id="1_2000" class="doubleTdTopAndLeftThick"></td><td id="2_2000" class="doubleTdTopAndLeftThick"></td><td id="3_2000" class="doubleTdTopAndLeftThick"></td><td id="4_2000" class="doubleTdTopAndLeftThick"></td><td id="5_2000" class="doubleTdTopAndLeftThick"></td><td id="6_2000" class="doubleTdTopAndLeftThick"></td><td id="7_2000" class="doubleTdTopAndLeftThick"></td>
            </tr>
            <tr>
              <td class="singleTdTop">20:30</td><td id="1_2030" class="singleTdTopAndLeft"></td><td id="2_2030" class="singleTdTopAndLeft"></td><td id="3_2030" class="singleTdTopAndLeft"></td><td id="4_2030" class="singleTdTopAndLeft"></td><td id="5_2030" class="singleTdTopAndLeft"></td><td id="6_2030" class="singleTdTopAndLeft"></td><td id="7_2030" class="singleTdTopAndLeft"></td>
            </tr>
            <tr>
              <td class="doubleTdTop">21:00</td><td id="1_2100" class="doubleTdTopAndLeft"></td><td id="2_2100" class="doubleTdTopAndLeft"></td><td id="3_2100" class="doubleTdTopAndLeft"></td><td id="4_2100" class="doubleTdTopAndLeft"></td><td id="5_2100" class="doubleTdTopAndLeft"></td><td id="6_2100" class="doubleTdTopAndLeft"></td><td id="7_2100" class="doubleTdTopAndLeft"></td>
            </tr>
        </table>
        </div>
    </body>
    <?php if(empty($teacherList)): ?><script type="text/javascript">
        $(function(){
            $(".right").remove();
            $("#timeLine").remove();
        });
    </script><?php endif; ?>
 </html>