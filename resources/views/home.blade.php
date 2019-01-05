@extends($layout)
@if($menu)
@section('sidebar')
    @include($menu)
@endsection
@endif

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>
            <div class="panel-body">
                You are logged in!
            </div>
        </div>
    </div>
@endsection
