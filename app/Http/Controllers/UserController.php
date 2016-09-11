<?php

namespace App\Http\Controllers;

use App\User;                          // to use the admin class

use Validator;                          // to use the Validator functions to validate the user input

use Illuminate\Http\Request;
                                        // to use the request function
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;    // to use predefined auth process

use App\Http\Controllers\Controller;    // to use the Controller class

use DB;                                 // to acess to the database

use App\Http\Controllers\View;          // to acess the views functions


class UserController extends Controller
{
  // adding new User
  public function AddNewUser(Request $request)
  {
  // Validate the request...
  $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required|min:10|max:12|unique:users',
            'password' => 'required|min:6|confirmed',
      ]);
      // if validation fails send back to register page
      if ($validator->fails()) {
          return redirect('/register')
                      ->withErrors($validator)
                      ->withInput();
      }
    // storing the data
    $user = new User;
    // getting the users data
    $user->name = ucwords(strtolower($request->name));
    $user->phone = $request->phone;
    $user->password = bcrypt($request->password);

    //saving the data into table
    $user->save();
    if($user->save())
    {
        echo "data added to table";
        if (Auth::attempt(['phone' => $request->phone,'password' => $request->password]))
        {
            // codes to set sessions for functionality extention
            return redirect('/home');
        }
        return redirect('/login');
    }
    return redirect('/login');
  }

  // to login the user into the system
  public function DoLogin(Request $request)
  {
    // Validate the request...
    $validator = Validator::make($request->all(), [
            'phone' => 'required|min:10',
            'password' => 'required|min:6'
        ]);
        // if validation fails send back to login page
        if ($validator->fails())
        {
            return redirect('/login')
                       ->withErrors($validator)
                       ->withInput();
        }
    //do login
    $user = User::where('phone', $request->phone)->value('phone');
    //var_dump($user);
    //die();
    if (Auth::attempt(['phone' => $request->phone,'password' => $request->password]))
    {
        // codes to set sessions for functionality extention
        return redirect('/home');
    }
    else
    {
        echo "attempt failed \n";
        var_dump(Auth::attempt(['phone' => $request->phone,'password' => $request->password]));
        return redirect('/login')
                      ->withErrors($request)
                      ->withInput();
    }
  }


  // function to logout
  public function DoLogout()
  {
      Auth::logout();
      //Session::flush(); //clears out all the exisiting sessions
      return redirect('/login');
  }

}
