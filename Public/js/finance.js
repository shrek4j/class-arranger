$('.ym').click(function(){
	$('.ym').removeClass('selected');
	$(this).addClass('selected');
	$("#ymShow").text($(this).attr('ym'));
	var ym = $('.ym').filter('.selected').attr('ym');
	$("#ym").val(ym);
});

$('.show-financedetail').click(function(){
	$("#showFinanceDetailForm").submit();
});