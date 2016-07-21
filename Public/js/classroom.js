
$(".add-classroom").click(function(){
	var classroom = $("#classroom").val();
	var rent = $("#rent").val();
	if(isEmpty(classroom)){
		$.scojs_message('教室名称不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(classroom.length > 20){
		$.scojs_message('教室名称长度应小于20！', $.scojs_message.TYPE_ERROR);
		return;
	}
	$.ajax({
	   	type: "POST",
	   	url: "saveClassroom",
	   	data: "classroom="+classroom+"&rent="+rent,
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

function deleteClassroom(id,name){
  if(confirm("是否删除教室："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteClassroom",
	   	data: "classroomId="+id,
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