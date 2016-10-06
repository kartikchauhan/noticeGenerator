@extends('student.master-student')

@section('stylesheets')

    <link href="../resources/assets/css/student-style.css" rel="stylesheet" />
    <link href="../resources/assets/css/date-picker.css" rel="stylesheet" />

@endsection

@section('scripts')

    <script src="../resources/assets/js/date-picker.js" type="text/javascript"></script>

 @endsection

@section('content')

<div class="container">

    <div class="col-md-3 col-md-offset-2 date-picker-container">
        <div class="form-group has-feedback">            
            <label for="date-picker">Select notice via Date</label>                            
            <input type="text" class="form-control" placeholder="Click to select notices via Date" id="date-picker" name="date-picker" style="cursor:pointer">
            <i class="glyphicon glyphicon-calendar form-control-feedback"></i>            
        </div>                
    </div>

    <div class="col-md-3 col-md-offset-2 select-department-container">
        <div class="form-group">
            <label for="departments">Select Department</label>
            <select class="form-control" id="departments" name="departments">
                <option value="" disabled selected style="display:none">Department</option>
                <option value="6">CS</option>
                <option value="14">Director</option>
                <option value="3">T&P</option>
                <option value="4">Mechanical</option>
                <option value="5">IT</option>
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token" />
            </select>
        </div>
    </div>

    @foreach($noticesAndFilesArray as $noticesAndFiles)     
        <div class="col-md-8 col-md-offset-2 notice-container">
            @foreach($noticesAndFiles as $key => $value)
                @if($key == 0)
                    <input type="hidden" name="department-id" id="department-id" class="department-id" value="{{ $value->department_id }}" />
                    <div class="notice-timestamps-container">
                        <span class="glyphicon glyphicon-time glyphicon-clock">
                        <!-- changing date format of notice created_at to more readable form -->
                            <div class="notice-timestamps" data-id="{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('Y-m-d')}}">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('l jS \\of F Y h:i:s A') }}</div>
                        <input type="hidden" value="{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('Y-m-d')}}" id="compare-date">
                            
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
    
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
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
        $('#date-picker').datepicker({
            format: "yyyy-mm-dd"
        });

        $('.pop').on('click',function(){
            $('.imagepreview').attr('src', $(this).find('img').attr('src'));
            $('#imageModal').modal('show');
        });

        $('#departments').on('change', function(){
            $('.notice-container').each(function(){
                if($(this).find('.department-id').val() != $('#departments').val())
                    $(this).hide();
                else
                    $(this).show();
            });
        });

        $('#date-picker').on('change', function(){            
            var userDate = Date.parse($('#date-picker').val());
            console.log(userDate);
            var noticeDate;
            $('.notice-container').each(function(){
                noticeDate = Date.parse($(this).find('#compare-date').val());
                if(noticeDate<userDate)
                    $(this).hide();
                else
                    $(this).show();
            });
        });

        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');
    });
</script>   

@endsection
