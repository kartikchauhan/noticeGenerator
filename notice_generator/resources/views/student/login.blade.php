@extends('student.master-student')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Student Login</div>
                <div class="panel-body">                
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/student/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('student_no') ? ' has-error' : '' }}">
                            <label for="student_no" class="col-md-4 control-label">Student No.</label>

                            <div class="col-md-6">
                                <input id="student_no" type="text" class="form-control" name="student_no" value="{{ old('student_no') }}">

                                @if ($errors->has('student_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('student_no') }}</strong>
                                    </span>
                                @endif

                                @if (Session::has('incorrectStudentNo'))
                                    <span class="help-block">
                                        <strong>{{ Session::get('incorrectStudentNo') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                @if (Session::has('incorrectPassword'))
                                    <span class="help-block">
                                        <strong>{{ Session::get('incorrectPassword') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
