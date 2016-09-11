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

Route::auth();

Route::get('/home', 'HomeController@index');

// to disaplay question response form
Route::get('/questions', 'QuizController@DisplayForm');

// to record the user response
Route::post('/questions', 'QuizController@AddQuizResponse');

// for admin to login
Route::get('/admin/login', function(){
  return view('admin.auth.login');
});

Route::post('/admin/login', 'AdminController@DoLogin');

// for admin to register
Route::get('/admin/regiseter', function(){
    return view('admin.auth.register');
});

Route::post('/admin/register', 'AdminController@AddAdmin');

// for admin logout
Route::get('/admin/logout', 'AdminController@DoLogout');
// for admin dashboard
Route::get('/admin/home', function(){
  return view('admin.home');
});
