@extends('admin.layouts.app')

@if(isset($Message))
<!-- Message trigger for the events -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <div class="panel-body">
                  <div class="alert alert-{{$level}}" role="alert">
                    <strong>{{ $Message }}</strong>
                  </div>
                </div>
        </div>
    </div>
</div>
@endif

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

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Question</div>

                <div class="panel-body">
                  <a href="{{ url('/admin/questions') }}" > click here to add new Question set </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Generate Scorecard</div>

                <div class="panel-body">
                  <a href="{{ url('/admin/score') }}" > click here </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
