$(".add-class").click(function(){
    var classname = $("#classname").val();
    var classtype = $("li[name='classtype'][selected='selected']").children().text();
	var teacher = $("li[name='teacher'][selected='selected']").children().text();
	var students = "12,34,64";
	var classroom = $("li[name='classroom'][selected='selected']").children().text();
	var startdate = $("input[name='startDate']").val();
	var enddate = $("input[name='endDate']").val();
	var week = $("li[name='week'][selected='selected']").children().text();
	var starttime = $("li[name='starttime'][selected='selected']").children().text();
	var endtime = $("li[name='endtime'][selected='selected']").children().text();
	var remark = $("#remark").val();

	$.ajax({
	   	type: "POST",
	   	url: "addClass",
	   	data: "classname="+classname+"&classtype="+classtype+"&teacher="+teacher+
	   		"&students="+students+"&classroom="+classroom+"&startdate="+startdate+
	   		"&enddate="+enddate+"&week="+week+"&starttime="+starttime+"&endtime="+endtime+"&remark="+remark,
	   	success: function(msg){
			window.location.reload();
	   	}
	});

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