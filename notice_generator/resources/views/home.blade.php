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
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject" value="{{ old('subject') }}">
                </div>
            </div>

            <div class="col-md-10 col-md-offset-2">
                <div id="drop">         
                    <div class="msg-drop">
                        <span class="glyphicon glyphicon-cloud-upload cloud"></span>
                        Drop files here or click to
                        <div class="fileUpload btn btn-primary" id="fileUpload">
                            <span>Browse</span>
                        </div>
                    </div>                    
                </div>
                <ul id="fileList"></ul>
            </div>
            <input type="file" id="file" name="files[]" class="file upload" multiple style="display:none" />
            
            <div class="form-group">
                <label class="control-label col-md-2" for="additional-details">Additional Details<span style="color:gray"> (Optional)</span></label>
                <div class="col-md-10">
                   <textarea class="form-control" rows="5" id="additional-details" name="additional_details" placeholder="Enter Any Additional Detail">{{ old('additional_details') }}</textarea>
                </div>
            </div>            
            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token" />
            
            <div class="form-group">
                <button type="submit" class="btn btn-success col-md-10 col-md-offset-2">Submit</button>                
            </div>
                       
        </form>        
        
        @if(count($errors)>0)
            <?php
                echo '<script type="text/javascript">';
                echo 'toastr.options = {"positionClass": "toast-top-center", "closeButton": true}';                    
                echo '</script>';
            ?>
            @foreach($errors->all() as $error)
                <?php 
                    echo '<script type="text/javascript">';
                    echo 'toastr.error("'.$error.'");';                    
                    echo '</script>';
                ?>
            @endforeach            
        @endif

    </div>

    <div class="jumbotron col-md-3 col-md-offset-1">

        @if($last_notice!=null)

            <h4>Last Notice Details</h4>  

            <div class="row">
                <div class="span4">
                    <div class="well">
                        <div>
                            <ul class="nav nav-list">
                                <li>
                                    <label class="tree-toggle nav-header">Courses</label>
                                    <ul class="nav nav-list tree last_notice_courses" id="last_notice_courses" name="last_notice_courses">
                                        <div class="col-md-offset-1">
                                            @foreach($courses_for_last_notice as $courses)
                                                <li value="{{ $courses->id }}">{{ $courses->course }}</li>                                            
                                            @endforeach  
                                        </div>
                                    </ul>
                                </li>
                                <hr>
                                <li>
                                    <label class="tree-toggle nav-header">Branches</label>
                                    <ul class="nav nav-list tree last_notice_branches" id="last_notice_branches" name="last_notice_branches">
                                        <div class="col-md-offset-1">
                                            @foreach($branches_for_last_notice as $branches)
                                                <li value="{{ $branches->id }}">{{ $branches->branch }}</li>                                            
                                            @endforeach
                                        </div>
                                    </ul>
                                </li>
                                <hr>
                                <li>
                                    <label class="tree-toggle nav-header">Years</label>
                                    <ul class="nav nav-list tree last_notice_years" id="last_notice_years" name="last_notice_years">
                                        <div class="col-md-offset-1">
                                            @foreach($years_for_last_notice as $years)
                                                <li value="{{ $years->id }}">{{ $years->year }}</li>
                                            @endforeach
                                        </div>
                                    </ul>
                                </li>
                                <hr>
                                <li>
                                    <label class="tree-toggle nav-header">Sections</label>
                                    <ul class="nav nav-list tree last_notice_sections" id="last_notice_sections" name="last_notice_sections">
                                        <div class="col-md-offset-1">
                                            @foreach($sections_for_last_notice as $sections)
                                                <li value="{{ $sections->id }}">{{ $sections->section }}</li>
                                            @endforeach
                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">                    
                    <label class="switch">
                        <input type="checkbox" name="check_last_notice_details" id="check_last_notice_details">
                        <div class="slider round"></div>                                                    
                    </label>                    
                        <label data-toggle="tooltip" title="Toggle this to select last notice categories" for="check_last_notice_details" style="cursor:pointer">Select last notice Details</label>
                </div>
                <!-- <label for="check_last_notice_details">Select last notice categories</label>
                <input type="checkbox" name="check_last_notice_details" id="check_last_notice_details"> -->
            </div>

        @else

            <h4>Sorry, you haven't added any notice yet</h4>
        
        @endif

    </div>
</div>

<script type="text/javascript">
        $(function () {             
            $('#courses').multiselect({
                includeSelectAllOption: true,
                templates: {
                    ul: '<ul class="multiselect-container dropdown-menu courses-override"></ul>',
                }                
            });
            $('#branches').multiselect({
                includeSelectAllOption: true,
                templates: {
                    ul: '<ul class="multiselect-container dropdown-menu branches-override"></ul>',
                }
            });
            $('#years').multiselect({
                includeSelectAllOption: true,
                templates: {
                    ul: '<ul class="multiselect-container dropdown-menu years-override"></ul>',
                }
            });
            $('#sections').multiselect({
                includeSelectAllOption: true,
                templates: {
                    ul: '<ul class="multiselect-container dropdown-menu sections-override"></ul>',
                }
            }); 

            toastr.options = {"positionClass": "toast-top-center", "closeButton": true};
        });        
</script>

@endsection

