<?php

namespace App\Http\Controllers;

use App\User;                           // to use the User class
use App\Admin;                          // to use the Admin class
use App\Submission;                     // to use the Submission class
use App\Question;                       // to use the Question class
use App\Score;                          // to use the Score class


use Validator;                          // to use the Validator functions to validate the user input

use Illuminate\Http\Request;
                                        // to use the request function
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;    // to use predefined auth process

use App\Http\Controllers\Controller;    // to use the Controller class

use DB;                                 // to acess to the database

use App\Http\Controllers\View;          // to acess the views functions

class QuizController extends Controller
{
    private $NumberOfQuestions = 20;            //keep it same as the $NumberOfQuestions mentioned in migrations

    // function to display quiz response form
    public function DisplayForm (Request $request)
    {
      $user = Auth::user();           // get the user details;

      return View('question_form',[
                      'DangerMessage' => 'Be careful with your clicks Once selected it can\'t be changed',
                      'WarningMessage' => 'You can\'t Change the response once submitted',
                      'user' => $user,
                      'NumberOfQuestions' => $this->NumberOfQuestions,
                    ]);
    }

    // function to record the user response
    public function AddQuizResponse (Request $request)
    {

      $validator = Validator::make($request->all(), [
                'key' => 'required|max:255',
          ]);
          // if validation fails send back to register page
      if ($validator->fails())
        {        return redirect('/questions')
                          ->withErrors($validator)
                          ->withInput();
        }
        $sub = new Submission;
        $sub->uid = Auth::user()->id;
        $sub->key = $request->key;

        for ($i=1; $i <= $this->NumberOfQuestions ; $i++)
        {
          $a='question'.$i;
          //echo "$a";
          //echo $request->$a;
          $sub->$a = $request->$a;
        }

        $sub->save();

        if( !($sub->save()) )         // redirect to the success page with error message
          return view('success',[
                      'message' => 'I am not able to accept your Response now <br> Contact admin right now',
                      'level' => 'danger',
                      ]);

        // now calaculate the user score
        $CorrectResponse=0;
        $IncorrectResponse=0;
        $NotAttempt=0;
        $submittedanswer = Submission::where('uid',Auth::user()->id)->get();
        $answer = Question::where('key', $submittedanswer[0]->key)->get();

        for ($i=1; $i <= $this->NumberOfQuestions ; $i++)
        {
          $a='question'.$i;
          if($submittedanswer[0]->$a == NULL)
            $NotAttempt++;
          elseif($answer[0]->$a==$submittedanswer[0]->$a)
            $CorrectResponse++;
          else
            $IncorrectResponse++;
        }

        $Points =(($CorrectResponse*4)-($IncorrectResponse));

        // save the score
        $score = new Score;
        $score->uid = Auth::user()->id;
        $score->key = $submittedanswer[0]->key;
        $score->correct = $CorrectResponse;
        $score->incorrect = $IncorrectResponse;
        $score->score = $Points;

        $score->save();

        if($score->save())
          return view('success',[
                      'message' => 'We got Your Response :)',
                      'level' => 'success',
                      ]);
        else
          return view('success',[
                      'message' => 'Our system encounter some problem In calculating your Score :( <br> Contact admin Right now',
                      'level' => 'danger',
                      ]);

    }

    // function to display the score card
    public function DisplayScorecard (Request $request)
    {
      // check wether user is admin or not
      if(! Auth::guard('admin')->check())
        redirect('/home');          // if not redirect it to somewhere

      // now get the latest scores and generate the view
      $Scorecards = DB::table('scores')
                        ->join('users', 'scores.uid', '=', 'users.id')
                        ->orderBy('score', 'desc')->get();

      date_default_timezone_set('Asia/Kolkata');
      return view('admin.Score', [
                  'message' => "Score generated at ".date('m/d/Y h:i:s a', time()),
                  'scorecards' => $Scorecards,
      ]);

    }

    // function to display Question addition form
    public function AddQuestionsForm (Request $request)
    {
      return View('admin.question_form',[
                      'DangerMessage' => 'Be careful with your clicks Once selected it can\'t be changed',
                      'WarningMessage' => 'You can\'t Change the response once submitted',
                      'NumberOfQuestions' => $this->NumberOfQuestions,
                    ]);
    }


    // function to add the questions
    public function AddQuestions (Request $request)
    {
      $validator = Validator::make($request->all(), [
                'key' => 'required|max:255|unique:questions',
          ]);
          // if validation fails send back to register page
      if ($validator->fails())
        {        return redirect('/questions')
                          ->withErrors($validator)
                          ->withInput();
        }
        $sub = new Question;
        $sub->key = $request->key;

        for ($i=1; $i <= $this->NumberOfQuestions ; $i++)
        {
          $a='question'.$i;
          $sub->$a = $request->$a;
        }

        $sub->save();
        if($sub->save())
          return view('admin.success',[
                      'message' => 'Question added succesfully :)',
                      'level' => 'success',
                      ]);
        else
          return view('admin.success',[
                      'message' => 'Not able to add the questions :(',
                      'level' => 'danger',
                      ]);
    }
}
