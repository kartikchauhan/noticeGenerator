@extends('student.master-student')

@section('content')

<div class="container fluid">
	@foreach($noticesAndFilesArray as $noticesAndFiles)		
		<div class="col-md-8 col-md-offset-2">
			<div class="jumbotron">
				@foreach($noticesAndFiles as $key => $value) 	
				<!-- fetching notice subject -->
					@if($key == 0)						
						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<h4>{{ $value->notice_subject }}</h4>
							</div>
						</div>
						<!-- fetching all the files in relation to the subject -->
					@elseif($key == 1)												
						<div class="jumbotron" style="background-color:white">
							<div class="files-container">
								@foreach($value as $filekey=> $file)	
									<div class=files>																									
										<img src="{{ url('/uploads/'.$file->filename) }}" />
										<div class="gyphicon-container">
											<a download="{{ $file->filename }}" href="{{ url('/uploads/'.$file->filename) }}" ><span class="glyphicon glyphicon-download-alt"></span></a> <span style="color:grey">| </span>
											<a href="#"><span class="glyphicon glyphicon-eye-open"></span></a>									
										</div>
									</div>
								@endforeach
							</div>
						</div>								
					@endif
				@endforeach
				<!-- fetching notice additional details if any -->
				@foreach($noticesAndFiles as $key => $value) <!-- should be using a variable in lieu of a loop for fetching additional details -->
					@if($key == 0)
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<h5>{{ $value->additional_details }}</h5>
							</div>
						</div>
					@endif
				@endforeach
			</div>
		</div>	
	@endforeach			
 </div>

@endsection