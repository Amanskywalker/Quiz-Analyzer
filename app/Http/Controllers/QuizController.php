<?php

namespace App\Http\Controllers;

use App\User;                        // to use the user class

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

    public function DisplayForm (Request $request)
    {
      $user = Auth::user();           // get the user details;

      return View('question_form',[
                      'user' => $user,
                      'NumberOfQuestions' => $this->NumberOfQuestions,
                    ]);
    }

}
