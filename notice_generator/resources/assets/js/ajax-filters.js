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

});


function sendData(request)
{
	$.ajax({
		'type': 'post',
		'url': 'categorize',
		'data': request
	})
	.done(function(response){
		if(response.status==1)
		{				
			var allValues = []; // array of objects for retrieving values from controller 
			var responseCategory = response.category; // to get category from controller
			var category = []; //array of objects for getting html elements

			if(responseCategory == 'branches_&_years')
			{
				category[0] = $('#branches');
				category[1] = $('#years');

				allValues[0] = response.branches;
				allValues[1] = response.years;				

			}			
			else if(responseCategory == 'sections')
			{
				category[0] = $('#sections');

				allValues[0] = response.sections;
			}
			console.log(allValues[0]);
			console.log(allValues[1]);

			filter(category, allValues); // calling filter function for filtering out results
		}
		else
		{
			console.log('did not repond');
		}
		
	});

}

function filter(category, allValues)
{
	$.each(category, function(val){
		$.each(category[val].find('option'), function(){
			$(this).remove(); // removing all options from current category
		});
		category[val].multiselect('rebuild'); // rebuilding current category after removing all options
	});

	$.each(allValues, function(val){
		$.each(allValues[val], function(key, value){
			category[val].append('<option value="' + key + '">' + value + '</option'); // adding options that we got in response for the corresponding category
		});
		category[val].multiselect('rebuild'); // rebuilding current category after appending options
	});
}