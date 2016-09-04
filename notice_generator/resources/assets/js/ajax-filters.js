$(function(){
	$('#courses').on('change', function(){
		var request = {};
		request.courses = $('#courses').val();
		request._token = $('#_token').val();
		console.log(request._token);
		sendData(request);
	});

	$('#branches').on('change', function(){
		if($('#courses').val()==null)
		{	
			alert('select a course first');		

		}
		else
		{
			var branches = $('#branches').val();
			sendData(branches);
		}

	});

	$('#years').on('change', function(){
		if($('#years').val()==null)
		{	
			alert('select a branch first');			
		}
		else
		{
			var years = $('#years').val();
			sendData(years);
		}

	});

	$('#sections').on('change', function(){
		if($('#sections').val()==null)
		{	
			alert('select a year first');			
		}
		else
		{
			var sections = $('#sections').val();
			sendData(sections);
		}

	});

});


function sendData(request)
{
	$.ajax({
		'type': 'post',
		'url': 'home',
		'data': request
	})
	.done(function(response){
		console.log(response.branches);
		
	});

}