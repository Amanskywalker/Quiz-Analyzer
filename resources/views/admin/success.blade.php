@extends('layouts.app')

@section('content')

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

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">  </div>

                <div class="panel-body">
                    <a href="{{ url('/admin/home') }}"> click Here to go back to your Dashboard </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
