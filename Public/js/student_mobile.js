$('#attendedClass').change(function(){
	var classId = $("#attendedClass").find("option:selected").val();
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
	var gender = $("#gender").find("option:selected").val();
	var grade = $("#grade").find("option:selected").val();
	var school = $("#school").val();
	var remark = $("#remark").val();
	var mobile = $("#mobile").val();

	var interest = $("#interest").find("option:selected").val();
	var attended = $("#attendedClass").find("option:selected").val();
	var tuitionPerClass = $("#tuitionPerClass").val();
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
	   			"&remark="+remark+"&mobile="+mobile+"&tuition="+tuition+
	   			"&tuitionPerClass="+tuitionPerClass+"&interest="+interest+"&attended="+attended,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$(".weui_toast_content").val("保存成功");
	   		}else{
	   			$(".weui_toast_content").val("保存失败");
	   		}
			$("#toast").show();
	   		setInterval('reloadPage()',2000);
	   	}
	});
});