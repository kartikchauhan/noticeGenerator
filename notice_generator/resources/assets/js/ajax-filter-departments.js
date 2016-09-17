$(function(){
	var request = {};
	request._token = $('#_token').val();

	$('#departments').on('change', function(){
		request.departmentID = $('#departments').val();
		if(request.departmentID != null)
			sendData(request);
	});

});

function sendData(request)
{
	var _token = request._token;
	console.log(request);
	$.ajax({
		'type' : 'post',
		'url' : 'home',
		'data' : request
	})
	.done(function(response)
	{		
		console.log(response.status);
		$.ajax({
			'type' : 'post',
			'url' : 'home', 
			'data': {noticesAndFiles:response.noticesAndFilesArray, _token:_token}
		})
		.done(function(response)
		{
			console.log(response.status);
		});
	});
}