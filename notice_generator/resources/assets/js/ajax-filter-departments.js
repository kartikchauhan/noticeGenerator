$(function(){
	var request = {};
	request._token = $('#_token').val();

	$('#departments').on('change', function(){
		request.value = $('#departments').val();
		if(request.value != null)
			sendData(request);
	});

});

function sendData(request)
{
	$.ajax({
		'type' : 'post',
		'url' : 'home',
		'data' : request
	})
	.done(function(response)
	{
		console.log(response.noticesAndFilesArray);
		console.log(response.departmentId);
	});
}