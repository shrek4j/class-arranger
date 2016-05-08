$(".add-class").click(function(){
    var classname = $("#classname").val();
    var classtype = $("input[name='classtype']:checked").val();
	var teacher = $("input[name='teacher']:checked").val();
	var classroom = $("input[name='classroom']:checked").val();
	var studentInputs = $("input[name='student']:checked");
	var students = getStudentStr(studentInputs);
	var startdate = $("input[name='startDate']").val();
	var enddate = $("input[name='endDate']").val();
	var week = "1";//$("li[name='week'][selected='selected']").children().text();
	var starttime = "9:00";//$("li[name='starttime'][selected='selected']").children().text();
	var endtime = "11:00";//$("li[name='endtime'][selected='selected']").children().text();
	var tuition = "1000";
	var remark = $("#remark").val();
	var time = "1|9:00-11:00;3|9:00-11:00";

	$.ajax({
	   	type: "POST",
	   	url: "saveClass",
	   	data: "className="+classname+"&classtypeId="+classtype+"&teacherId="+teacher+
	   		"&studentIds="+students+"&classroomId="+classroom+"&startDate="+startdate+
	   		"&endDate="+enddate+"&time="+time+"&tuition="+tuition+"&remark="+remark,
	   	success: function(msg){
	   		if(msg == 'ok'){
	   			//提示保存成功
	   			window.location.reload();
	   		}else{
	   			//提示保存失败
	   		}
	   	}
	});

});

function getStudentStr(studentInputs){
	var students = "";
	for(var i=0;i<studentInputs.length;i++){
		students += studentInputs[i].value;
		if(i<studentInputs.length-1){
			students += "|";
		}
	}
	return students;
}

$(".add-classtimerow").click(function(){
	
});

$('.remove-classtime').bind('click',function(){
	$(this).parent().parent().remove();
});

//classtype
$(".add-classtype").click(function(){
	var classtype = $("#classtype").val();
	$.ajax({
	   	type: "POST",
	   	url: "saveClassType",
	   	data: "classtype="+classtype,
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

function deleteClassType(id,name){
  if(confirm("是否删除课程分类："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteClassType",
	   	data: "classTypeId="+id,
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