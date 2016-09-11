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
                <div class="panel-heading">Thank You {{ Auth::user()->name }} </div>

                <div class="panel-body">
                    <a href="{{ url('/logout') }}"> Now you can logout peacefully </a> and wait for the result.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
