
$(".add-classroom").click(function(){
	var classroom = $("#classroom").val();
	$.ajax({
	   	type: "POST",
	   	url: "saveClassroom",
	   	data: "classroom="+classroom,
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

function deleteClassroom(id,name){
  if(confirm("是否删除教室："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteClassroom",
	   	data: "classroomId="+id,
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