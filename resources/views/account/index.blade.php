@extends($layout)
@if($menu)
@section('sidebar')
    @include($menu)
@endsection
@endif

@section('content')
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">My Account</div>

            <div class="panel-body">
                Welcome {{ $user->name }}, this is your account.
            </div>
        </div>
    </div>
@endsection