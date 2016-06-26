
$(".add-classroom").click(function(){
	var classroom = $("#classroom").val();
	var rent = $("#rent").val();
/**
	var constraints = {
	  classroom: {
	    presence: true,
	    length: {
	      maximum: 10,
	      message: "最多输入10个字符"
	    }
	  }
	};
	var msg = validate({classroom: classroom}, constraints);
	if(msg != null){
		var hint = msg.classroom[0];
		hint = hint.split(" ")[1];
		$("#classroom_msg").text(hint);
		return;
	}
*/
	$.ajax({
	   	type: "POST",
	   	url: "saveClassroom",
	   	data: "classroom="+classroom+"&rent="+rent,
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