<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../resources/assets/js/search.js" type="text/javascript"></script>
	
</head>
<body>
	<input type="text" name="search" id="search" />
	<p id="names">get values here</p>
	<input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token" />

</body>
</html>