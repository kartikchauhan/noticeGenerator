@extends('student.master-student')

@section('content')

<div class="container fluid">
	@foreach($noticesAndFilesArray as $noticesAndFiles)		
		<div class="col-md-8 col-md-offset-2">
			<div class="jumbotron">
				@foreach($noticesAndFiles as $key => $value) 	
					@if($key == 0)	
						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<h4>{{ $value->notice_subject }}</h4>
							</div>
						</div>
					@elseif($key == 1)												
						<div class="jumbotron files-container" style="background-color:white" id="files-container">
							@foreach($value as $filekey=> $file)	
								<div class=files>																									
									<img src="{{ url('/uploads/'.$file->filename) }}" />										
								</div>
							@endforeach
						</div>								
					@endif
				@endforeach
			</div>
		</div>	
	@endforeach			
 </div>

@endsection