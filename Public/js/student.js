
$(".add-student").click(function(){
	var studentName = $("#studentName").val();
	var gender = $("#gender").val();
	var grade = $("#grade").val();
	var school = $("#school").val();
	var parentName = $("#parentName").val();
	var mobile = $("#mobile").val();
	var tuition = $("#tuition").val();
	$.ajax({
	   	type: "POST",
	   	url: "saveStudent",
	   	data: "studentName="+studentName+"&gender="+gender+"&grade="+grade+"&school="+school+
	   			"&parentName="+parentName+"&mobile="+mobile+"&tuition="+tuition,
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