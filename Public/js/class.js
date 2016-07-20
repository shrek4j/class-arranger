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
	var deductFlag = $("input[name='deductFlag']:checked").val();

	var time = "";
	var timecn = "";
	for(var i=0;i<=rowCount;i++){
		var week = $('.week_'+i).filter('.selected').attr('week');
		var weekcn = $('.week_'+i).filter('.selected').find('a').text();
		var startTime = $('.startTime_'+i).filter('.selected').children('a').text();
		var endTime = $('.endTime_'+i).filter('.selected').children('a').text();
		time += week + "|" + startTime + "-" + endTime + ";";
		timecn += weekcn + "  " + startTime + "-" + endTime + "</br>";
	}
	
	var tuition = $("#tuition").val();
	var wage = $("#wage").val();
	var remark = $("#remark").val();

	$.ajax({
	   	type: "POST",
	   	url: "saveClass",
	   	data: "className="+classname+"&classtypeId="+classtype+"&teacherId="+teacher+
	   		"&studentIds="+students+"&classroomId="+classroom+"&startDate="+startdate+
	   		"&endDate="+enddate+"&time="+time+"&timecn="+timecn+"&tuition="+tuition+
	   		"&wage="+wage+"&remark="+remark+"+&deductFlag="+deductFlag,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('添加成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else{
	   			$.scojs_message('添加失败！', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});

});

$("input[name='student']").click(function(){
	$('#tags-students').tagsinput('removeAll');
	var studentInputs = $("input[name='student']:checked");
	for(var i=0;i<studentInputs.length;i++){
		$('#tags-students').tagsinput('add', $(studentInputs[i]).attr('studentname'));
	}
});

function fakeSaveStudents(){
	$('#tags-students').tagsinput('removeAll');
	var studentInputs = $("input[name='student']:checked");
	for(var i=0;i<studentInputs.length;i++){
		$('#tags-students').tagsinput('add', $(studentInputs[i]).attr('studentname'));
	}
	$("#studentModal").modal("hide");
}


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
	   		if(msg == 'true'){
	   			$.scojs_message('删除成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else{
	   			$.scojs_message('删除失败！', $.scojs_message.TYPE_ERROR);
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

function editVacancy(className,classDetailId,classId){
	//clear
	clearVacancyInfo();
	//load
	$.ajax({
	   	type: "POST",
	   	url: "showStudentsFromClassDetail",
	   	data: "classDetailId="+classDetailId,
	   	success: function(msg){
	   		if(msg == 'true'){
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
	   			$('#myClassDetailId').val(classDetailId);
	   			$('#myClassId').val(classId);
	   			$("#students").append(html);
				$("#myModal").modal('show');
	   		}else{
	   			$.scojs_message('操作失败！', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});
}

$(".save-vacancy").click(function(){
	var classId = $("#myClassId").val();
	var classDetailId = $("#myClassDetailId").val();
	var cameStudentInputs = $("input[name='student']:checked");
	var cameRelaIds = getStudentStr(cameStudentInputs);
	var notCameStudentInputs = $("input[name='student']:not(:checked)");
	var notCameRelaIds = getStudentStr(notCameStudentInputs);

	//save
	$.ajax({
	   	type: "POST",
	   	url: "updateClassDetailStudentRela",
	   	data: "classId="+classId+"&classDetailId="+classDetailId+"&cameRelaIds="+cameRelaIds+"&notCameRelaIds="+notCameRelaIds,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('保存成功！', $.scojs_message.TYPE_OK);
				$("#myModal").modal('hide');
				//clear
				clearVacancyInfo();
				//render
				$("#vacancy_"+classDetailId).removeClass("vacancy-undone");
				$("#vacancy_"+classDetailId).addClass("vacancy-done");
	   		}else{
	   			$.scojs_message('保存失败！', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});
});

function clearVacancyInfo(){
	$("#className").text("");
	$("#myClassDetailId").val('');
	$("#myClassId").val('');
	$("#students").empty();
}

function deleteClassDetail(classId,classDetailId){

  if(confirm("是否删除课程此课程？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteClassDetail",
	   	data: "classId="+classId+"&classDetailId="+classDetailId,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('删除成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else{
	   			$.scojs_message('删除失败！', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});
  }
}

function editClassDetail(num,classDetailId){
	$("#classDetailId").val(classDetailId);
	$("#datepicker_u").val($("#date_"+num).text());
	var dayOfWeek = $("#dayOfWeek_"+num).attr("value");
	$("#weekShow_u").text($("#dayOfWeek_"+num).text());
	$("#week_"+dayOfWeek).addClass('selected','selected');
	$("#startTimeShow_u").text($("#time_"+num).attr("startTime"));
	$("#endTimeShow_u").text($("#time_"+num).attr("endTime"));
	var teacherId = $("#teacher_"+num).attr("value");
	$("input[name='teacher_u'][value='"+teacherId+"']").iCheck('check');
	var classroomId = $("#classroom_"+num).attr("value");
	$("input[name='classroom_u'][value='"+classroomId+"']").iCheck('check');
	$("#updateModal").modal("show");
}

$('.week_u').click(function(){
	$('.week_u').removeClass('selected');
	$(this).addClass('selected');
	$("#weekShow_u").text($(this).children('a').text());
});

$('.startTime_u').click(function(){
	$('.startTime_u').removeClass('selected');
	$(this).addClass('selected');
	$("#startTimeShow_u").text($(this).children('a').text());
});

$('.endTime_u').click(function(){
	$('.endTime_u').removeClass('selected');
	$(this).addClass('selected');
	$("#endTimeShow_u").text($(this).children('a').text());
});

$('.week_a').click(function(){
	$('.week_a').removeClass('selected');
	$(this).addClass('selected');
	$("#weekShow_a").text($(this).children('a').text());
});

$('.startTime_a').click(function(){
	$('.startTime_a').removeClass('selected');
	$(this).addClass('selected');
	$("#startTimeShow_a").text($(this).children('a').text());
});

$('.endTime_a').click(function(){
	$('.endTime_a').removeClass('selected');
	$(this).addClass('selected');
	$("#endTimeShow_a").text($(this).children('a').text());
});

function addClassDetail(){
	$("#addModal").modal("show");
}

$(".update-classdetail").click(function(){
	var teacher = $("input[name='teacher_u']:checked").val();
	var classroom = $("input[name='classroom_u']:checked").val();
	var date = $("#datepicker_u").val();
	var week = $('.week_u').filter('.selected').attr('week');
	var startTime = $("#startTimeShow_u").text();
	var endTime = $("#endTimeShow_u").text();
	var classId = $("#classId").val();
	var classDetailId = $("#classDetailId").val();

	$.ajax({
	   	type: "POST",
	   	url: "updateClassDetail",
	   	data: "classId="+classId+"&classDetailId="+classDetailId+"&teacherId="+teacher+"&classroomId="+classroom+"&startTime="+startTime+
	   		"&endTime="+endTime+"&date="+date+"&week="+week,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('更新成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else{
	   			$.scojs_message('更新失败！', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});

});

$(".add-classdetail").click(function(){
	var teacher = $("input[name='teacher_a']:checked").val();
	var classroom = $("input[name='classroom_a']:checked").val();
	var date = $("#datepicker_a").val();
	var week = $('.week_a').filter('.selected').attr('week');
	var startTime = $("#startTimeShow_a").text();
	var endTime = $("#endTimeShow_a").text();
	var classId = $("#classId").val();

	$.ajax({
	   	type: "POST",
	   	url: "addClassDetail",
	   	data: "classId="+classId+"&teacherId="+teacher+"&classroomId="+classroom+"&startTime="+startTime+
	   		"&endTime="+endTime+"&date="+date+"&week="+week,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('添加成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else{
	   			$.scojs_message('添加失败！', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});
});

function deleteClassDetailStudents(num,classDetailId){

}

function editClassStudents(className,classId){
	//clear
	$('#tags-students').tagsinput('removeAll');
	$("input[name='student']").iCheck('uncheck');
	//load
	$.ajax({
	   	type: "POST",
	   	url: "showStudentsFromClass",
	   	data: "classId="+classId,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			var studentArr = msg.split(";");
	   			var names = "";
	   			for(var i=0;i<studentArr.length-1;i++){
	   				var s = studentArr[i].split(":");
	   				$('#tags-students').tagsinput('add',s[1]);
	   				$("input[name='student'][value='"+s[0]+"']").iCheck('check');
	   			}
	   			$("#classId").val(classId);
	   			$('#studentModal').modal('show');
	   		}else{
	   			$.scojs_message('服务器开小差了。。', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});
}

function editStudentTuitions(className,classId){
	//clear
	clearTuitionInfo();
	//load
	$.ajax({
	   	type: "POST",
	   	url: "showAllStudentsFromClass",
	   	data: "classId="+classId,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			var html = "";
	   			var studentArr = msg.split(";");
	   			html='<table class="table table-bordered table-striped table-hover text-center" style="width:300px;">';
	   			html+='<thead><tr class="title"><td>学生</td><td>学费(每次课每人) 单位:元</td></tr></thead><tbody>';
	   			for(var i=0;i<studentArr.length-1;i++){
	   				var s = studentArr[i].split(":");
	   				html += '<tr><td>'+s[1]+'</td><td><input type="text" class="form-control" style="text-align:right;" placeholder="0" name="stdTuition" student_id="'+s[0]+'" value='+parseFloat(s[2])/100.00+'></td></tr>';
	   			}
	   			html+='</tbody></table>';
	   			$("#className").text("课程："+className);
	   			$('#myClassId').val(classId);
	   			$("#tuitions").append(html);
				$("#tuitionModal").modal('show');
	   		}else{
	   			$.scojs_message('服务器开小差了。。', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});
}

function saveTuitions(){
	var classId = $("#myClassId").val();
	var tuitionInputs = $("input[name='stdTuition']");
	var tuitions = "";
	for(var i=0;i<tuitionInputs.length;i++){
		tuitions += $(tuitionInputs[i]).attr('student_id');
		tuitions += ":";
		tuitions += tuitionInputs[i].value;
		if(i<tuitionInputs.length-1){
			tuitions += "|";
		}
	}

	//save
	$.ajax({
	   	type: "POST",
	   	url: "updateStudentTuitions",
	   	data: "classId="+classId+"&tuitions="+tuitions,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('修改成功！', $.scojs_message.TYPE_OK);
				$("#tuitionModal").modal('hide');
				//clear
				clearTuitionInfo();
	   		}else{
	   			$.scojs_message('修改失败！', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});
}

function clearTuitionInfo(){
	$("#className").text("");
	$("#myClassId").val('');
	$("#tuitions").empty();
}

function editClassDetailStudents(classDetailId){
	//clear
	$('#tags-students').tagsinput('removeAll');
	$("input[name='student']").iCheck('uncheck');
	//load
	$.ajax({
	   	type: "POST",
	   	url: "showStudentsFromClassDetail",
	   	data: "classDetailId="+classDetailId,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			var studentArr = msg.split(";");
	   			var names = "";
	   			for(var i=0;i<studentArr.length-1;i++){
	   				var s = studentArr[i].split(":");
	   				$('#tags-students').tagsinput('add',s[1]);
	   				$("input[name='student'][value='"+s[4]+"']").iCheck('check');
	   			}
	   			$("#classDetailIdForStudent").val(classDetailId);
	   			$('#studentModal').modal('show');
	   		}else{
	   			$.scojs_message('服务器开小差了。。', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});
}

function saveStudents(){
	var classId = $("#classId").val();
	var studentInputs = $("input[name='student']:checked");
	var students = getStudentStr(studentInputs);
	$.ajax({
	   	type: "POST",
	   	url: "saveStudentsForClass",
	   	data: "classId="+classId+"&students="+students,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('删除成功！', $.scojs_message.TYPE_OK);
	   			$("#studentModal").modal('hide');
	   		}else{
	   			$.scojs_message('修改失败！', $.scojs_message.TYPE_ERROR);
	   		}
			
	   	}
	});
}

function saveStudentsToOneClass(){
	var classId = $("#classId").val();
	var classDetailId = $("#classDetailIdForStudent").val();
	var studentInputs = $("input[name='student']:checked");
	var students = getStudentStr(studentInputs);
	$.ajax({
	   	type: "POST",
	   	url: "saveStudentsToOneClass",
	   	data: "classId="+classId+"&classDetailId="+classDetailId+"&students="+students,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('删除成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1000);
	   		}else{
	   			$.scojs_message('修改失败！', $.scojs_message.TYPE_ERROR);
	   		}
			
	   	}
	});
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
	   		if(msg == 'true'){
	   			$.scojs_message('添加成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else{
	   			$.scojs_message('添加失败！', $.scojs_message.TYPE_ERROR);
			}
	   	}
	});
});

function deleteClassType(id,name){
  if(confirm("是否删除课程类型："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteClassType",
	   	data: "classTypeId="+id,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('删除成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else{
	   			$.scojs_message('删除失败！', $.scojs_message.TYPE_ERROR);
	   		}
			
	   	}
	});
  }
}