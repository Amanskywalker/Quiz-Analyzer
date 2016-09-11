@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome {{ Auth::guard('admin')->user()->name }}  Admin</div>

                <div class="panel-body">
                    This is your flight control cockpit
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
