
$(".add-teacher").click(function(){
	var teacher = $("#teacher").val();
	var constraints = {
	  teacher: {
	    presence: true,
	    length: {
	      maximum: 10,
	      message: "最多输入10个字符"
	    }
	  }
	};
	var msg = validate({teacher: teacher}, constraints);
	if(msg != null){
		$("#teacher_msg").text(msg.teacher);
		return;
	}
	$.ajax({
	   	type: "POST",
	   	url: "saveTeacher",
	   	data: "teacher="+teacher,
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

function deleteTeacher(id,name){
  if(confirm("是否删除教室："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteTeacher",
	   	data: "teacherId="+id,
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