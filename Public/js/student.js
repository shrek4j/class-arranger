$('.attended').click(function(){
	//render change
	$('.attended').removeClass('selected');
	$(this).addClass('selected');
	$("#attendedShow").text($(this).children('a').text());

	var classId = $(this).attr("attended");
	if(classId==0){
		$("#tuitionPerClass").val(null);
		$("#unfinishedClassTimes").val(null);
		$("#tuition").val(null);
		return;
	}
	//fetch class tuition_per_class and left_class_times
	$.ajax({
	   	type: "POST",
	   	url: "../Class/getClassTuitionInfo",
	   	data: "classId="+classId,
	   	success: function(msg){
	   		if(msg != null){
	   			var arr = msg.split("&");
	   			$("#tuitionPerClass").val(arr[0]/100);
	   			$("#unfinishedClassTimes").val(arr[1]);
	   			var balance = $("#balance").val();
	   			if(isEmpty(balance)){
					balance = 0;
				}
	   			var tuition = (arr[0]/100)*arr[1];
	   			$("#tuition").val(balance > tuition ? 0 : tuition-balance);
	   			$("#receivableTuition").val(tuition);
	   		}
	   	}
	});
});

$("#tuitionPerClass").keyup(function(){
	calculateTuition();
});

$("#unfinishedClassTimes").keyup(function(){
	calculateTuition();
});

function calculateTuition(){
	var tuitionPerClass = $("#tuitionPerClass").val();
	var unfinishedClassTimes = $("#unfinishedClassTimes").val();
	var balance = $("#balance").val();
	if(isEmpty(tuitionPerClass)){
		tuitionPerClass = 0;
	}
	if(isEmpty(tuitionPerClass)){
		unfinishedClassTimes = 0;
	}
	if(isEmpty(balance)){
		balance = 0;
	}

	var tuition = tuitionPerClass*unfinishedClassTimes;
	$("#receivableTuition").val(tuition);
	$("#tuition").val(balance > tuition ? 0 : tuition-balance);
}

$('.interest').click(function(){
	$('.interest').removeClass('selected');
	$(this).addClass('selected');
	$("#interestShow").text($(this).children('a').text());
});

$(".add-student").click(function(){
	var studentName = $("#studentName").val();
	var gender = $("input[name='gender']:checked").val();
	var grade = $('.grade').filter('.selected').attr('grade');
	var school = $("#school").val();
	var remark = $("#remark").val();
	var mobile = $("#mobile").val();

	var interest = $('.interest').filter('.selected').attr('interest');
	var attended = $('.attended').filter('.selected').attr('attended');
	var tuitionPerClass = $("#tuitionPerClass").val();
	var tuition = $("#tuition").val();
	var receivableTuition = $("#receivableTuition").val();
	
	if(isEmpty(studentName)){
		$.scojs_message('姓名不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(studentName.length > 20){
		$.scojs_message('姓名长度应小于20！', $.scojs_message.TYPE_ERROR);
		return;
	}

	$.ajax({
	   	type: "POST",
	   	url: "saveStudent",
	   	data: "studentName="+studentName+"&gender="+gender+"&grade="+grade+"&school="+school+
	   			"&remark="+remark+"&mobile="+mobile+
	   			"&receivableTuition="+receivableTuition+"&tuition="+tuition+
	   			"&tuitionPerClass="+tuitionPerClass+"&interest="+interest+"&attended="+attended,
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


$(".attend-new-class").click(function(){
	var studentId = $("#studentId").val();
	var attended = $('.attended').filter('.selected').attr('attended');
	var tuitionPerClass = $("#tuitionPerClass").val();
	var tuition = $("#tuition").val();
	var receivableTuition = $("#receivableTuition").val();
	if(isEmpty(attended)){
		$.scojs_message('暂无课程，无需保存！', $.scojs_message.TYPE_OK);
		return;
	}
	$.ajax({
	   	type: "POST",
	   	url: "attendNewClass",
	   	data: "studentId="+studentId+"&receivableTuition="+receivableTuition+"&tuition="+tuition+
	   			"&tuitionPerClass="+tuitionPerClass+"&attended="+attended,
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

function getClassStr(classInputs){
	var classes = "";
	for(var i=0;i<classInputs.length;i++){
		classes += classInputs[i].value;
		if(i<classInputs.length-1){
			classes += "|";
		}
	}
	return classes;
}

$(".update-student").click(function(){
	var studentId = $("#studentId").val();
	var studentName = $("#studentName").val();
	var gender = $("input[name='gender']:checked").val();
	var grade = $('.grade').filter('.selected').attr('grade');
	var school = $("#school").val();
	var remark = $("#remark").val();
	var mobile = $("#mobile").val();
	var tuition = $("#tuition").val();
	var payment = $("#payment").val();
	if(payment == null || payment == "undefined" || payment == "")
		payment = 0;
	var balance = parseFloat(tuition)+parseFloat(payment);
	if(balance < 0)
		balance = 0;

	if(isEmpty(studentName)){
		$.scojs_message('姓名不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(studentName.length > 20){
		$.scojs_message('姓名长度应小于20！', $.scojs_message.TYPE_ERROR);
		return;
	}
	
	$.ajax({
	   	type: "POST",
	   	url: "updateStudent",
	   	data: "studentName="+studentName+"&gender="+gender+"&grade="+grade+"&school="+school+
	   			"&remark="+remark+"&mobile="+mobile+"&balance="+balance+"&studentId="+studentId,
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

$(".grade").click(function(){
	$('.grade').removeClass('selected');
	$(this).addClass('selected');
	$("#gradeShow").text($(this).children('a').text());
});

function showAttendNewClass(studentId){
	window.location.href="showAttendNewClass?studentId="+studentId;
}

function showAttendedClasses(studentId){
	window.location.href="showAttendedClasses?studentId="+studentId;
}

function showStudentDetail(studentId){
	window.location.href="showStudentDetail?studentId="+studentId;
}

function deleteStudent(id,name){
	if(confirm("是否删除教室："+name+"？")){
		$.ajax({
		   	type: "POST",
		   	url: "deleteStudent",
		   	data: "studentId="+id,
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

function chargeRemainingTuition(id,studentId,classId,num){
	if(confirm("是否缴费？")){
		var chargeTuition = $("tuition_to_charge_"+num).val();
	  	$.ajax({
		   	type: "POST",
		   	url: "chargeRemainingTuition",
		   	data: "id="+id+"&studentId="+studentId+"&classId="+classId+"&chargeTuition="+chargeTuition,
		   	success: function(msg){
		   		if(msg == 'true'){
		   			$.scojs_message('缴费成功！', $.scojs_message.TYPE_OK);
		   			setInterval('reloadPage()',1500);
		   		}else{
		   			$.scojs_message('缴费失败！', $.scojs_message.TYPE_ERROR);
		   		}
				
		   	}
		});
  	}
}