@extends('student.master-student')

@section('script')

	<link href="../../resources/assets/css/student-style.css" rel="stylesheet" />
	
@endsection

@section('content')

<div class="container fluid">
	@foreach($noticesAndFilesArray as $noticesAndFiles)		
		<div class="col-md-8 col-md-offset-2">
			@foreach($noticesAndFiles as $key => $value)
				@if($key == 0)
					<div class="notice-timestamps-container">
						<span class="glyphicon glyphicon-time glyphicon-clock">
						<!-- changing date format of notice created_at to more readable form -->
							<div class="notice-timestamps">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('l jS \\of F Y h:i:s A') }}</div>							
						</span>
					</div>
				@endif
			@endforeach
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
										@if (pathinfo($file->filename, PATHINFO_EXTENSION) == 'jpg' || pathinfo($file->filename, PATHINFO_EXTENSION) == 'jpeg' || pathinfo($file->filename, PATHINFO_EXTENSION) == 'png')										
											<a href="#" class="pop"><img src="{{ url('/uploads/'.$file->filename) }}" /></a>											
										@elseif(pathinfo($file->filename, PATHINFO_EXTENSION) == 'docx' || pathinfo($file->filename, PATHINFO_EXTENSION) == 'doc')
											<a href="{{ url('/uploads/'.$file->filename) }}" target="_blank"><img src="{{ url('/uploads/docx.png') }}" /><a>
										@elseif(pathinfo($file->filename, PATHINFO_EXTENSION) == 'pdf')
											<a href="{{ url('/uploads/'.$file->filename) }}" target="_blank"><img src="{{ url('/uploads/pdf.png') }}" /><a>
										@endif
										<div class="gyphicon-container">
											<a download="{{ $file->filename }}" href="{{ url('/uploads/'.$file->filename) }}" ><span class="glyphicon glyphicon-download-alt"></span></a>											
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
						@if(count($value->additional_details))
							<div class="row">
								<div class="col-md-8">
									<h5>{{ $value->additional_details }}</h5>
								</div>
							</div>
						@endif
					@endif
				@endforeach
			</div>
		</div>	
	@endforeach			
</div>

<div class="modal fade" id="imageModal" tab-index="-1" role="dialog" aria-labelledby="myModallabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    			<img src="" class="imagepreview" style="width: 100%;" >
    		</div>	
    	</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('.pop').on('click',function(){
			$('.imagepreview').attr('src', $(this).find('img').attr('src'));
			$('#imageModal').modal('show');
		});
	});
</script>	

@endsection