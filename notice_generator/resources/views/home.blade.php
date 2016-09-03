@extends('layouts.app')

@section('content')

<div class="container">    

    
    <div class="jumbotron">

        <form class="form-horizontal" action="{{ URL('home') }}" file=true enctype="multipart/form-data" method="post" >                    
    
            <div class="row">
    
                <div class="col-md-2 col-md-offset-2">
                    <select id="courses" multiple="multiple" name="courses[]">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course }}</option>
                        @endforeach                
                    </select>
                </div>        

                <div class="col-md-2">
                    <select id="branches" multiple="multiple" name="branches[]">
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select id="years" multiple="multiple" name="years[]">
                        @foreach($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select id="sections" multiple="multiple" name="sections[]">
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->section }}</option>
                        @endforeach
                    </select>
                </div>
            
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="subject">Subject</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2 col-md-offset-5">
                    <input type="file" name="file[]" id="file" class="file" multiple />                
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="additional-details">Additional Data</label>
                <div class="col-md-6">
                   <textarea class="form-control" rows="5" id="additional-details" name="additional_details" placeholder="Enter Any Additional Detail"></textarea>
                </div>
            </div>            

            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token" />
            
            <div class="form-group">
                <div class="col-md-10 col-md-offset-4">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>            

        </form>        

        <a href="uploads/Basic_English_Usage_[Oxford].pdf">PDF file</a>

        <a href="uploads/test.docx">docx file</a>


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

            
            
            

         

<script type="text/javascript">
        $(function () {
            $('#courses, #branches, #years, #sections').multiselect({
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

@endsection

