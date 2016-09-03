$(function(){
	$('#search').keyup(function(){
		alert('hey');
		var request = {};
		request.search = $('#search').val();
		request._token = $('#_token').val();

		$.ajax({
			'type':'post',
			'url': 'search',
			'data': request
		})
		.done(function(response){
			console.log(JSON.stringify(response.name));
			$name = response.name;	
			$('#names').text($name.name);
		});


	});
});