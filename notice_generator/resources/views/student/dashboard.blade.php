
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
								<h3>{{ $value->notice_subject }}</h3>
							</div>
						</div>
					@elseif($key == 1)						
						@foreach($value as $filekey=> $file)
							<div class="row">
								<div class="col-md-4 col-md-offset-4">
									<h3>{{ $file->filename }}</h3>
								</div>
							</div>
						@endforeach
					@endif
				@endforeach
			</div>
		</div>	
	@endforeach			
 </div>

@endsection