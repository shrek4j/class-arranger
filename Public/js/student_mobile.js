
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

function showStudentDetail(studentId){
	window.location.href="showStudentDetail.html?studentId="+studentId;
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