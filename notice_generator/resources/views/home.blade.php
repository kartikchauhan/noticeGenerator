@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-1">
            Course
        </div>
        <div class="col-md-2">                        
            <select id="course" multiple="multiple">
                @foreach($courses as $course)
                    <option value="{{$course->id}}">{{ $course->course }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            Branch
        </div>
        <div class="col-md-2">        
            <select id="branch" multiple="multiple">
                @foreach($branches as $branch)
                    <option value="{{$branch->id}}">{{ $branch->branch }}</option>
                @endforeach
            </select>
        </div> 
        <div class="col-md-1">
            Year
        </div>         
        <div class="col-md-2">
            <select id="year" multiple="multiple">
                @foreach($years as $year)
                    <option value="{{$year->id}}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            Section
        </div>        
        <div class="col-md-2">
            <select id="section" multiple="multiple">
                @foreach($sections as $section)
                    <option value="{{$section->id}}">{{ $section->section }}</option>
                @endforeach
            </select>
        </div>      
    </div>

    <div class="row">
        <div id="image-holder" class="col-md-8 col-md-offset-2 image-holder">
            <div class="row">
                <div class="image-holder-text" id="image-holder-text-place-your">
                    Place Your
                </div>
            </div>
            <div class="row">
                <div class="image-holder-text">
                    File
                </div>
            </div>
            <div class="row">
                <div class="image-holder-text">
                    Here
                </div>
            </div>
        </div>
    </div>

    <div class="row">        
        <button type="button" class="btn btn-success col-md-2 col-md-offset-5"> Upload </button>
    </div>
</div>


<script type="text/javascript">
        $(function () {
            $('#course, #branch, #year, #section').multiselect({
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

