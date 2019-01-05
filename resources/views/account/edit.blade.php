@extends($layout)
@if($menu)
@section('sidebar')
    @include($menu)
@endsection
@endif

@section('content')
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">Edit your Account</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="{{ url('/account/edit') }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="form-group">
                        <label class="col-md-4 control-label">Account Type</label>

                        <div class="col-md-6">
                            <p class="form-control-static text-capitalize">{{ $user->type }}</p>

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="<?php echo (old('name') ? old('name') : $user->name ) ?>" autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="<?php echo (old('email') ? old('email') : $user->email ) ?>">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update Account
                            </button>
                        </div>

                        <div class="col-md-2">
                            <a class="btn btn-secondary" href="/account">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
