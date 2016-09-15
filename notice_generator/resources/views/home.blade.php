@extends('layouts.app')

@section('content')

<div class="container">    

    <div class="jumbotron col-md-8">

        <form class="form-horizontal" action="{{ URL('save') }}" file=true enctype="multipart/form-data" method="post" >

             <div class="row">
    
                <div class="col-md-2">
                    <select id="courses" multiple="multiple" name="courses[]" class="courses">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course }}</option>
                        @endforeach        
                    </select>
                </div>        

                <div class="col-md-2 col-md-offset-1">
                    <select id="branches" multiple="multiple" name="branches[]" class="branches">
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 col-md-offset-1">
                    <select id="years" multiple="multiple" name="years[]" class="years">
                        @foreach($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 col-md-offset-1">
                    <select id="sections" multiple="multiple" name="sections[]" class="sections">
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->section }}</option>
                        @endforeach                        
                    </select>
                </div>
    
            </div>
            
            <div class="form-group" style="margin-top:20px">
                <label class="control-label col-md-2" for="subject">Subject</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
                </div>
            </div>

            <!-- <div id="upload">
                <div id="drop">Drop Here
                <a>Browse</a>
                <input type="file" id="file" class="file" name="file[]" multiple  />
                </div>
            <ul>
                
            </ul>
            </div> -->
            <div class="form-group">
                <div class="col-md-2 col-md-offset-5">
                    <input type="file" name="files[]" id="file" class="file" multiple />                
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="additional-details">Additional Data</label>
                <div class="col-md-10">
                   <textarea class="form-control" rows="5" id="additional-details" name="additional_details" placeholder="Enter Any Additional Detail"></textarea>
                </div>
            </div>            
            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token" />
            
            <div class="form-group">
                <button type="submit" class="btn btn-success col-md-10 col-md-offset-2">Submit</button>                
            </div>
                       
        </form>        
        
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>


</div>
<!-- 
<script type="text/javascript">
        $(function () {
            $('#courses, #branches, #years, #sections, #last_notice_courses, #last_notice_branches, #last_notice_years, #last_notice_sections').multiselect({
                includeSelectAllOption: true
            });
            // $('#btnSelected').click(function () {
            //     var selected = $("#lstFruits option:selected");
            //     var message = "";
            //     selected.each(function () {
            //         message += $(this).text() + " " + $(this).val() + "\n";
            //     });
            //     alert(message);
            // });
        });
</script>
 -->
@endsection

