<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if (Auth::check())
      return redirect('/home');
    if (Auth::guard('admin')->check())
      return redirect('/admin/home');
    return view('welcome');
});

// for user to login
Route::get('/login', function(){
  return view('auth.login');
});

Route::post('/login', 'UserController@DoLogin');

// for user to register
Route::get('/register', function(){
    return view('auth.register');
});

Route::post('/register', 'UserController@AddNewUser');

// for user logout
Route::get('/logout', 'UserController@DoLogout');
// for user dashboard
Route::get('/home', function(){
  return view('home');
});

// to disaplay question response form
Route::get('/questions', 'QuizController@DisplayForm');

// to record the user response
Route::post('/questions', 'QuizController@AddQuizResponse');

//--------------------------< Admin Area >--------------------------------------

// for admin to login
Route::get('/admin/login', function(){
  return view('admin.auth.login');
});

Route::post('/admin/login', 'AdminController@DoLogin');

// for admin to register
Route::get('/admin/register', function(){
    return view('admin.auth.register');
});

Route::post('/admin/register', 'AdminController@AddNewAdmin');

// for admin logout
Route::get('/admin/logout', 'AdminController@DoLogout');
// for admin dashboard
Route::get('/admin/home', function(){
  return view('admin.home');
});
