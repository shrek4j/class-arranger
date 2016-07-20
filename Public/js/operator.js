$(".add-operator").click(function(){
    var realName = $("#realName").val();
    var userName = $("#userName").val();
	var userPwd = $("#userPwd").val();
	var userPwd2 = $("#userPwd2").val();
	var role = $("input[name='role']:checked");
	var roles = getRoleStr(role);
	var teacher = $("input[name='teacher']:checked").val();
	if(isEmpty(realName)){
		$.scojs_message('姓名不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(isEmpty(userName)){
		$.scojs_message('用户名不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(isEmpty(userPwd)){
		$.scojs_message('密码不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(isEmpty(userPwd2)){
		$.scojs_message('确认密码不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(userPwd != userPwd2){
		$.scojs_message('两次输入的密码不一致！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(isEmpty(roles)){
		$.scojs_message('角色为必选！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(isEmpty(teacher)){
		$.scojs_message('教师为必选！', $.scojs_message.TYPE_ERROR);
		return;
	}
	
	$.ajax({
	   	type: "POST",
	   	url: "saveOperator",
	   	data: "realName="+realName+"&userName="+userName+"&userPwd="+userPwd+
	   		"&userPwd2="+userPwd2+"&roles="+roles+"&teacher="+teacher,
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

function getRoleStr(roleInputs){
	var roles = "";
	for(var i=0;i<roleInputs.length;i++){
		roles += roleInputs[i].value;
		if(i<roleInputs.length-1){
			roles += "|";
		}
	}
	return roles;
}

function deleteOperator(id,name){
  if(confirm("是否删除管理员："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "deleteOperator",
	   	data: "operatorId="+id,
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

function toggleDisabled(id,name,disabled){
	var msg = "禁用";
	if(disabled==0){
		var msg = "启用";
	}
  if(confirm("是否"+msg+"管理员："+name+"？")){
  	$.ajax({
	   	type: "POST",
	   	url: "toggleDisabled",
	   	data: "operatorId="+id+"&disabled="+disabled,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('操作成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else{
	   			$.scojs_message('操作失败！', $.scojs_message.TYPE_ERROR);
	   		}
			
	   	}
	});
  }
}

function editOperator(id,isSuperAdmin){
	if(isSuperAdmin == 1){
		window.location.href = "/index.php/Home/Role/showEditSA?&nav=72&pnav=70";
	}else{
		window.location.href = "/index.php/Home/Role/showEditOperator?operatorId="+id+"&nav=72&pnav=70";
	}
}

$(".edit-superadmin").click(function(){
	var teacher = $("input[name='teacher']:checked").val();

	$.ajax({
	   	type: "POST",
	   	url: "editSuperadmin",
	   	data: "teacher="+teacher,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('编辑成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else{
	   			$.scojs_message('编辑失败！', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});
});

$(".edit-profile").click(function(){
	var userPwd0 = $("#userPwd0").val();
	var userPwd1 = $("#userPwd1").val();
	var userPwd2 = $("#userPwd2").val();
	if(isEmpty(userPwd0)){
		$.scojs_message('原密码不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(isEmpty(userPwd1)){
		$.scojs_message('修改密码不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(isEmpty(userPwd2)){
		$.scojs_message('确认密码不可为空！', $.scojs_message.TYPE_ERROR);
		return;
	}
	if(userPwd1 != userPwd2){
		$.scojs_message('两次输入的密码不一致！', $.scojs_message.TYPE_ERROR);
		return;
	}
	$.ajax({
	   	type: "POST",
	   	url: "editProfile",
	   	data: "userPwd0="+userPwd0+"&userPwd1="+userPwd1,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$.scojs_message('修改密码成功！', $.scojs_message.TYPE_OK);
	   			setInterval('reloadPage()',1500);
	   		}else if(msg == 'originPwd wrong'){
	   			$.scojs_message('原密码输入错误！', $.scojs_message.TYPE_ERROR);
	   		}else{
	   			$.scojs_message('操作失败！', $.scojs_message.TYPE_ERROR);
	   		}
	   	}
	});

});