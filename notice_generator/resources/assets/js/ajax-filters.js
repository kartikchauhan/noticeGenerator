$(function(){
	var request = {};
	request._token = $('#_token').val();

	$('#courses').on('change', function(){		
		request.courses = $('#courses').val();
		request.index = 1;
		// request._token = $('#_token').val();
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
			request.index = 2;
			request.branches = $('#branches').val();
			sendData(request);
		}

	});

	// $('#years').on('change', function(){
	// 	if($('#years').val()==null)
	// 	{	
	// 		alert('select a branch first');			
	// 	}
	// 	else
	// 	{
	// 		request.index = 3;
	// 		request.years = $('#years').val();
	// 		sendData(request);
	// 	}

	// });

	// $('#sections').on('change', function(){
	// 	if($('#sections').val()==null)
	// 	{	
	// 		alert('select a year first');			
	// 	}
	// 	else
	// 	{
	// 		request.sections = $('#sections').val();
	// 		sendData(request);
	// 	}

	// });

});


function sendData(request)
{
	$.ajax({
		'type': 'post',
		'url': 'home',
		'data': request
	})
	.done(function(response){
		if(response.status==1)
		{		
		console.log(response.category);
			var allValues = response.allValues; 
			var responseCategory = response.category;
			var category;

			if(responseCategory == 'branches')
			{
				category = $('.branches');
			}			
			else if(responseCategory == 'sections')
			{
				category = $('.sections');
			}

			category.find('option').remove();

			$.each(allValues, function(key, val){
				category.append('<option value="' + key + '">' + val + '</option');
			});

		}
		else
		{
			console.log('did not repond');
		}
		
	});

}