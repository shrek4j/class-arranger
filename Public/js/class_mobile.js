
$('.show-classes').click(function(){
	$("#showClassesForm").submit();
});

$('.backward').click(function(){
	$("#nextday").val("bw");
	$("#showClassesForm").submit();
});

$('.foreward').click(function(){
	$("#nextday").val("fw");
	$("#showClassesForm").submit();
});

$('.select-teacher').change(function(){
	$("#teacherName").val($("#selectTeacher").find("option:selected").text());
	$("#teacherId").val($("#selectTeacher").val());
	$("#showClassesForm").submit();
});

function editVacancy(classDetailId){
	$("#classDetailId").val(classDetailId);
	$("#editVacancyForm").submit();
}

$(".save-vacancy").click(function(){
	var classId = $("#myClassId").val();
	var classDetailId = $("#myClassDetailId").val();
	var cameStudentInputs = $("input[name='student']:checked");
	var cameRelaIds = getStudentStr(cameStudentInputs);
	var notCameStudentInputs = $("input[name='student']:not(:checked)");
	var notCameRelaIds = getStudentStr(notCameStudentInputs);

	//save
	$.ajax({
	   	type: "POST",
	   	url: "updateClassDetailStudentRela",
	   	data: "classId="+classId+"&classDetailId="+classDetailId+"&cameRelaIds="+cameRelaIds+"&notCameRelaIds="+notCameRelaIds,
	   	success: function(msg){
	   		if(msg == 'true'){
	   			$(".weui_toast_content").val("保存成功");
	   		}else{
	   			$(".weui_toast_content").val("保存失败");
	   		}
	   		$("#toast").show();
	   		setInterval('hideToast()',2000);
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

function hideToast(){
	$("#toast").hide();
	history.back();
}