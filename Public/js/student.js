
$(".add-student").click(function(){
	var studentName = $("#studentName").val();
	var gender = $("input[name='gender']:checked").val();
	var grade = $('.grade').filter('.selected').attr('grade');
	var school = $("#school").val();
	var remark = $("#remark").val();
	var mobile = $("#mobile").val();
	var tuition = $("#tuition").val();
	$.ajax({
	   	type: "POST",
	   	url: "saveStudent",
	   	data: "studentName="+studentName+"&gender="+gender+"&grade="+grade+"&school="+school+
	   			"&remark="+remark+"&mobile="+mobile+"&tuition="+tuition,
	   	success: function(msg){
	   		if(msg == 'false'){
	   			//提示保存失败
	   			alert(msg);
	   		}else{
	   			//提示保存成功
	   			window.location.reload();
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
	$.ajax({
	   	type: "POST",
	   	url: "updateStudent",
	   	data: "studentName="+studentName+"&gender="+gender+"&grade="+grade+"&school="+school+
	   			"&remark="+remark+"&mobile="+mobile+"&balance="+balance+"&studentId="+studentId,
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