$(function(){
	$('button').on('click',function(e){
		e.preventDefault();
		console.log('something just got clicked');
		var request = {};		
		request.courses = $('#courses').val();
		request.branches = $('#branches').val();
		request.years = $('#years').val();
		request.sections = $('#sections').val();
		request.subject = $('#subject').val();
		request.additional_details = $('#additional-details').val();
		request._token = $('#_token').val();
		request.files = $(':file').prop("files");
		$.ajax({
			'type': 'post',
			'url': 'save',
			'data': request
		})
		.done(function(response){
			console.log(response);
		});
	});
});



