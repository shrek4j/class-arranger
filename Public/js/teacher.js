
$(".add-teacher").click(function(){
	var teacher = $("#teacher").val();
	var loginname = $("#loginname").val();
	$.ajax({
	   	type: "POST",
	   	url: "saveTeacher",
	   	data: "teacher="+teacher+"&loginname="+loginname,
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