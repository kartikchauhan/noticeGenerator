$(function(){
	$('#departments').on('change', function(){
		$('.notice-container').each(function(){
			if($(this).find('.department-id').val() != $('#departments').val())
				$(this).hide();
			else
				$(this).show();
		});
	});
});