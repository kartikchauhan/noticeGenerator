@foreach($noticesAndFilesArray as $key => $noticesAndFiles)	
	@if($key == 0)
		@foreach($noticesAndFiles as $notices)
			{{ $notices->notice_subject }}
		@endforeach
	@endif
@endforeach

<br>
@foreach($noticesAndFilesArray as $key => $noticesAndFiles)	
	@if($key == 1)
		@foreach($noticesAndFiles as $files)
			@foreach($files as $file)
				{{ $file->filename }}
			@endforeach
		@endforeach
	@endif
@endforeach
