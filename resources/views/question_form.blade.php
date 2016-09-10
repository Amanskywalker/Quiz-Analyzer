@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome {{ $user->name }} Please submit your answer </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="questionid" class="col-md-4 control-label">Question Paper id</label>

                            <div class="col-md-6">
                                <input id="questionid" type="text" class="form-control" name="questionid" value="">

                            </div>
                        </div>
                <?php
                    for ($i=1; $i <= $NumberOfQuestions ; $i++)
                    {
                ?>
                        <div class="form-group">
                            <label for="question" class="col-md-4 control-label">{{ 'question'.$i }}</label>

                            <div class="col-md-6">
                <?php
                          for ($j=1; $j <= 4; $j++)
                          {
                ?>
                                <input id="question" type="radio" name="<?php echo "question".$i ;?>" value="<?php echo "$j"; ?>"> <?php echo "$j"; ?> 
                <?php
                          }
                ?>
                            </div>
                        </div>
              <?php
                    }
               ?>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                     Submit My Answers
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
