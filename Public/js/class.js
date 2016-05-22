$(".add-class").click(function(){
	$(this).attr("disabled","disabled");
    var classname = $("#classname").val();
    var classtype = $("input[name='classtype']:checked").val();
	var teacher = $("input[name='teacher']:checked").val();
	var classroom = $("input[name='classroom']:checked").val();
	var studentInputs = $("input[name='student']:checked");
	var students = getStudentStr(studentInputs);
	var startdate = $("input[name='startDate']").val();
	var enddate = $("input[name='endDate']").val();

	var time = "";
	for(var i=0;i<=rowCount;i++){
		var week = $('.week_'+i).filter('.selected').attr('week');
		var startTime = $('.startTime_'+i).filter('.selected').children('a').text();
		var endTime = $('.endTime_'+i).filter('.selected').children('a').text();
		time += week + "|" + startTime + "-" + endTime + ";";
	}
	
	var tuition = "1000";
	var remark = $("#remark").val();

	$.ajax({
	   	type: "POST",
	   	url: "saveClass",
	   	data: "className="+classname+"&classtypeId="+classtype+"&teacherId="+teacher+
	   		"&studentIds="+students+"&classroomId="+classroom+"&startDate="+startdate+
	   		"&endDate="+enddate+"&time="+time+"&tuition="+tuition+"&remark="+remark,
	   	success: function(msg){
	   		if(msg == 'ok'){
	   			//提示保存成功
	   			window.location.reload();
	   		}else{
	   			//提示保存失败
	   		}
	   	}
	});

});

function editClass(id){
  window.location.href = "/index.php/Home/Class/showClassDetails?classId="+id+"&nav=44&pnav=40";
}

function deleteClass(id,name){
  if(confirm("是否删除课程："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteClass",
	   	data: "classId="+id,
	   	success: function(msg){
	   		if(msg == 'false'){
	   			//提示保存失败
	   		}else{
	   			//提示保存成功
	   			window.location.reload();
	   		}
	   	}
	});
  }
}

function getStudentStr(studentInputs){
	var students = "";
	for(var i=0;i<studentInputs.length;i++){
		students += studentInputs[i].value;
		if(i<studentInputs.length-1){
			students += "|";
		}
	}
	return students;
}

var rowCount = 0;
$('.add-classtimerow').click(function(){
    ++rowCount;

	var row = '<div class="row">'+
        '<div class="col-md-2">'+
            '<label for="weekpicker" class="control-label">上课时间:</label>'+
        '</div>'+
        '<div class="col-md-10">'+
            '<div class="dropdown" style="display: inline-block;">'+
                '<a style="text-decoration:none;" class="dropdown-toggle" data-toggle="dropdown" id="weekpicker" href="#" role="button" aria-haspopup="true" aria-expanded="false">'+
                    '<span id="weekShow_'+rowCount+'">选择星期</span>'+
                '</a>'+
                '<ul class="dropdown-menu week-picker" aria-labelledby="weekpicker">'+
                    '<li class="week_'+rowCount+'" week="1"><a href="#">星期一</a></li>'+
                    '<li class="week_'+rowCount+'" week="2"><a href="#">星期二</a></li>'+
                    '<li class="week_'+rowCount+'" week="3"><a href="#">星期三</a></li>'+
                    '<li class="week_'+rowCount+'" week="4"><a href="#">星期四</a></li>'+
                    '<li class="week_'+rowCount+'" week="5"><a href="#">星期五</a></li>'+
                    '<li class="week_'+rowCount+'" week="6"><a href="#">星期六</a></li>'+
                    '<li class="week_'+rowCount+'" week="7"><a href="#">星期日</a></li>'+
                '</ul>'+
            '</div>'+
              
            '<div class="dropdown" style="display: inline-block;margin-left:10%;">'+
                '<a style="text-decoration:none;" class="dropdown-toggle" data-toggle="dropdown" id="starttimepicker" href="#" role="button" aria-haspopup="true" aria-expanded="false">'+
                    '<span id="startTimeShow_'+rowCount+'">开始时间</span>'+
                '</a>'+
                '<ul class="dropdown-menu time-picker" aria-labelledby="starttimepicker">'+
                    '<li class="startTime_'+rowCount+'"><a href="#">7:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">7:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">8:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">8:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">9:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">9:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">10:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">10:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">11:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">11:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">12:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">12:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">13:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">13:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">14:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">14:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">15:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">15:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">16:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">16:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">17:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">17:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">18:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">18:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">19:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">19:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">20:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">20:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">21:00</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">21:30</a></li>'+
                    '<li class="startTime_'+rowCount+'"><a href="#">22:00</a></li>'+
                '</ul>'+
            '</div>'+
            '<span style="display: inline-block;">&nbsp;-&nbsp;</span>'+
            '<div class="dropdown" style="display: inline-block;">'+
                '<a style="text-decoration:none;" class="dropdown-toggle" data-toggle="dropdown" id="endtimepicker" href="#" role="button" aria-haspopup="true" aria-expanded="false">'+
                    '<span id="endTimeShow_'+rowCount+'">结束时间</span>'+
                '</a>'+
                '<ul class="dropdown-menu time-picker" aria-labelledby="endtimepicker">'+
                    '<li class="endTime_'+rowCount+'"><a href="#">7:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">7:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">8:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">8:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">9:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">9:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">10:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">10:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">11:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">11:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">12:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">12:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">13:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">13:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">14:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">14:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">15:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">15:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">16:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">16:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">17:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">17:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">18:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">18:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">19:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">19:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">20:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">20:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">21:00</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">21:30</a></li>'+
                    '<li class="endTime_'+rowCount+'"><a href="#">22:00</a></li>'+
                '</ul>'+
            '</div>'+
            '<span id="tooltip_del_'+rowCount+'" style="margin-left:5%;" class="glyphicon glyphicon-trash remove-classtime" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="删除"></span>'+
        '</div>'+
    '</div>';

    $("#classTimeInsertBefore").before(row);
    
    bindClicks(rowCount);

});

$(document).ready(function(){
  bindClicks(0);
});

//为课程星期时间列绑定事件
function bindClicks(rowCount){
	$('#tooltip_del_'+rowCount).tooltip();

	$('#tooltip_del_'+rowCount).on('click',function(){
		if(!confirm("确定删除此时间？")){
			return;
		}
		$(this).parent().parent().remove();
		if(rowCount>0)
			rowCount--;
	});

	$('.week_'+rowCount).click(function(){
		$('.week_'+rowCount).removeClass('selected');
		$(this).addClass('selected');
		$("#weekShow_"+rowCount).text($(this).children('a').text());
	});

	$('.startTime_'+rowCount).click(function(){
		$('.startTime_'+rowCount).removeClass('selected');
		$(this).addClass('selected');
		$("#startTimeShow_"+rowCount).text($(this).children('a').text());
	});

	$('.endTime_'+rowCount).click(function(){
		$('.endTime_'+rowCount).removeClass('selected');
		$(this).addClass('selected');
		$("#endTimeShow_"+rowCount).text($(this).children('a').text());
	});
}


$('.show-classes').click(function(){
	$("#showClassesForm").submit();
});

$('.teacherId').click(function(){
	$('.teacherId').removeClass('selected');
	$(this).addClass('selected');
	$("#teacherShow").text($(this).children("a").text());
	$("#teacherName").val($(this).children("a").text());
	var teacherId = $('.teacherId').filter('.selected').attr('teacherId');
	$("#teacherId").val(teacherId);
});

$('.ym').click(function(){
	$('.ym').removeClass('selected');
	$(this).addClass('selected');
	$("#ymShow").text($(this).attr('ym'));
	var ym = $('.ym').filter('.selected').attr('ym');
	$("#ym").val(ym);
});

$(".list-group-item").mousedown(function(){
	$(".list-group-item").removeClass("cactive");
	$(this).addClass("cactive");
});

function editVacancy(className,classDetailId){
	//clear
	clearVacancyInfo();
	//load
	$.ajax({
	   	type: "POST",
	   	url: "showStudentsFromClassDetail",
	   	data: "classDetailId="+classDetailId,
	   	success: function(msg){
	   		if(msg == 'false'){
	   			//提示保存失败
	   		}else{
	   			var html = "";
	   			var studentArr = msg.split(";");
	   			for(var i=0;i<studentArr.length-1;i++){
	   				var s = studentArr[i].split(":");
	   				html += '<div><input tabindex="'+i+'" id="student_'+i+'" type="checkbox" '; 
	   				if(s[3] == 0){
	   					html += 'checked="checked"';
	   				} 
	   				html += ' name="student" value="'+s[0]+'"><span class="radio-text">'+s[1]+'</span><span class="radio-text">(电话：'+s[2]+')</span></div>';
	   			}
	   			$("#className").text("课程："+className);
	   			$("#students").append(html);
				$("#myModal").modal('show');
	   		}
	   	}
	});
}

$(".save-vacancy").click(function(){
	var cameStudentInputs = $("input[name='student']:checked");
	var cameRelaIds = getStudentStr(cameStudentInputs);
	var notCameStudentInputs = $("input[name='student']:not(:checked)");
	var notCameRelaIds = getStudentStr(notCameStudentInputs);

	//save
	$.ajax({
	   	type: "POST",
	   	url: "updateClassDetailStudentRela",
	   	data: "cameRelaIds="+cameRelaIds+"&notCameRelaIds="+notCameRelaIds,
	   	success: function(msg){
	   		if(msg == 'false'){
	   			//提示保存失败
	   		}else{
				$("#myModal").modal('hide');
				//clear
				clearVacancyInfo();
	   		}
	   	}
	});
});

function clearVacancyInfo(){
	$("#className").text("");
	$("#students").empty();
}

function deleteClassDetail(classId,classDetailId){

  if(confirm("是否删除课程此课程？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteClassDetail",
	   	data: "classId="+classId+"&classDetailId="+classDetailId,
	   	success: function(msg){
	   		if(msg == 'false'){
	   			//提示保存失败
	   		}else{
	   			//提示保存成功
	   			window.location.reload();
	   		}
	   	}
	});
  }
}

///////////////////////////////////////////////////////////////////////////////
////////////////////////////////classtype//////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
$(".add-classtype").click(function(){
	var classtype = $("#classtype").val();
	$.ajax({
	   	type: "POST",
	   	url: "saveClassType",
	   	data: "classtype="+classtype,
	   	success: function(msg){
	   		if(msg == 'false'){
	   			//提示保存失败
	   		}else{
	   			//提示保存成功
	   			window.location.reload();
	   		}
			
	   	}
	});
});

function deleteClassType(id,name){
  if(confirm("是否删除课程分类："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteClassType",
	   	data: "classTypeId="+id,
	   	success: function(msg){
	   		if(msg == 'false'){
	   			//提示保存失败
	   		}else{
	   			//提示保存成功
	   			window.location.reload();
	   		}
			
	   	}
	});
  }
}