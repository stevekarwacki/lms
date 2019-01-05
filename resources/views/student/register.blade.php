@extends($layout)
@if($menu)
@section('sidebar')
    @include($menu)
@endsection
@endif

<?php
    //write functionality for assigning to a parent by id or email
?>

@section('content')
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">Register a New Student</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="{{ url('/student/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Student Date of Birth</label>

                        <div class="col-md-6">
                            <input type="text" id="dob" class="form-control" name="dob" value="{{ old('dob') }}" required/>

                            @if ($errors->has('dob'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('mentor_contact') ? ' has-error' : '' }}">
                        <label for="mentor_contact" class="col-md-4 control-label">Mentor may contact Student</label>

                        <div class="col-md-6">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary active">
                                    <input type="radio" name="mentor_contact" value="1" checked>Yes
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="mentor_contact" value="0">No
                                </label>
                            </div>

                            @if ($errors->has('mentor_contact'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mentor_contact') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection