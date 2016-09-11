<?php

namespace App\Http\Controllers;

use App\Admin;                          // to use the admin class

use Validator;                          // to use the Validator functions to validate the user input

use Illuminate\Http\Request;
                                        // to use the request function
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;    // to use predefined auth process

use App\Http\Controllers\Controller;    // to use the Controller class

use DB;                                 // to acess to the database

use App\Http\Controllers\View;          // to acess the views functions

class AdminController extends Controller
{
  // adding new admin
  public function AddNewAdmin(Request $request)
  {
  // Validate the request...
  $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required|min:10|max:12|unique:admins',
            'password' => 'required|min:6|confirmed',
      ]);
      // if validation fails send back to register page
      if ($validator->fails()) {
          return redirect('/admin/register')
                      ->withErrors($validator)
                      ->withInput();
      }
    // storing the data
    $user = new Admin;
    // getting the users data
    $user->name = ucwords(strtolower($request->name));
    $user->phone = $request->phone;
    $user->password = bcrypt($request->password);

    //saving the data into table
    $user->save();
    if($user->save())
    {
        echo "data added to table";
        return redirect('/admin/home');
    }
    return redirect('/admin/login');
  }

  // to login the admin into the system
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
            return redirect('/admin/login')
                       ->withErrors($validator)
                       ->withInput();
        }
    //do login
    $user = Admin::where('phone', $request->phone)->value('phone');
    //var_dump($user);
    //die();
    if (Auth::guard('admin')->attempt(['phone' => $request->phone,'password' => $request->password]))
    {
        // codes to set sessions for functionality extention
        return redirect('/admin/home');
    }
    else
    {
        echo "attempt failed \n";
        var_dump(Auth::guard('admin')->attempt(['phone' => $request->phone,'password' => $request->password]));
        return redirect('/admin/login')
                      ->withErrors($request)
                      ->withInput();
    }
  }


  // function to logout
  public function DoLogout()
  {
      Auth::guard('admin')->logout();
      //Session::flush(); //clears out all the exisiting sessions
      return redirect('/admin/login');
  }

}
