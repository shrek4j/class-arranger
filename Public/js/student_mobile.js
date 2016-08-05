$('.attended').click(function(){
	var classId = $(this).val();
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
	   			$("#tuition").val((arr[0]/100)*arr[1]);
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
	if(isEmpty(tuitionPerClass)){
		tuitionPerClass = 0;
	}
	if(isEmpty(tuitionPerClass)){
		unfinishedClassTimes = 0;
	}

	var tuition = tuitionPerClass*unfinishedClassTimes;
	$("#tuition").val(tuition);
}

$(".add-student").click(function(){
	var studentName = $("#studentName").val();
	var gender = $("input[name='gender']:checked").val();
	var grade = $('.grade').filter('.selected').attr('grade');
	var school = $("#school").val();
	var remark = $("#remark").val();
	var mobile = $("#mobile").val();
	var tuition = $("#tuition").val();
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
	   			"&remark="+remark+"&mobile="+mobile+"&tuition="+tuition,
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
