@extends('admin.layouts.app')

@section('content')
<!-- Message trigger for the events -->
@if(isset($message))
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <div class="panel-body">
                  <div class="alert alert-success" role="alert">
                    <strong>{{ $message }}</strong>
                  </div>
                </div>
        </div>
    </div>
</div>
@endif

<?php $i=0;?>
<!-- Template container -->
@foreach( $scorecards as $scorecard)
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{++$i}}<br>{{ $scorecard->name }}</div>
                    <div class="panel-body">
                      score = {{ $scorecard->score }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
