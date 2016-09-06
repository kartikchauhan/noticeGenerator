$(function(){
	var request = {};
	request._token = $('#_token').val();
	$('#courses').on('change', function(){
		var request = {};
		request.courses = $('#courses').val();
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
		if(response.status==1)
		{		
		console.log(response.category);
			// var allValues = response.allValues; 
			// var responseCategory = response.category;
			// var category;

			// if(responseCategory == 'branches')
			// {
			// 	category = $('.branches');
			// }
			// else if(responseCategory == 'years')
			// {
			// 	category = $('.years');
			// }
			// else if(responseCategory == 'sections')
			// {
			// 	category = $('.sections');
			// }

			// category.find('option').remove();

			// $.each(allValues, function(key, val){
			// 	category.append('<option value="' + key + '">' + val + '</option');
			// });

		}
		else
		{
			console.log('did not repond');
		}
		
	});

}