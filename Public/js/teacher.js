
$(".add-teacher").click(function(){
	var teacher = $("#teacher").val();
	var loginname = $("#loginname").val();
	if(isEmpty(teacher)){
		$.scojs_message('姓名不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(teacher.length > 20){
		$.scojs_message('姓名长度应小于20！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(isEmpty(loginname)){
		$.scojs_message('系统用户名不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(loginname.length > 20){
		$.scojs_message('系统用户名长度应小于20！', $.scojs_message.TYPE_ERROR);
		return;
	}

	$.ajax({
	   	type: "POST",
	   	url: "saveTeacher",
	   	data: "teacher="+teacher+"&loginname="+loginname,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('添加成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1000);
	   		}else{
	   			$.scojs_message('添加失败！', $.scojs_message.TYPE_ERROR);
	   		}
			
	   	}
	});
});

function deleteTeacher(id,name){
  if(confirm("是否删除教师："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteTeacher",
	   	data: "teacherId="+id,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('删除成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1000);
	   		}else{
	   			$.scojs_message('删除失败！', $.scojs_message.TYPE_ERROR);
	   		}
			
	   	}
	});
  }
}