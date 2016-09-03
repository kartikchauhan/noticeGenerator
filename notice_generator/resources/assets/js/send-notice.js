$(function(){
	$('button').off('click');
	$('button').on('click',function(e){
		e.preventDefault();
		var request = {};
		var courses = $('#courses').val();
		var branches = $('#branches').val();
		var years = $('#years').val();
		var sections = $('#sections').val();
		var subject = $('#subject').val();
		var additional_details = $('#additional-details').val();
		var _token = $('#_token').val();

		$.ajax({
			'type': 'post',
			'url': 'home',
			'data': request
		})
		.done(function(response){
			console.log(response.status);
		});
		


	});
});