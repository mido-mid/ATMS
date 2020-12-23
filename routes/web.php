<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/logout',function(){

    if(\Auth::check())
    {
        \Auth::logout();
        return redirect('/home');
    }
    else
    {
        return redirect('/');
    }
})->name('logout');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard','middleware' => ['auth']],function() {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('', 'HomeController@index')->name('home');
    Route::resource('admins', 'AdminController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('questions', 'QuestionController');
    Route::resource('heads', 'HeadController');

    Route::put('questions/status/{question_id}', 'QuestionController@status')->name('questions.status');


    Route::resource('employees', 'EmployeeController');

    Route::get('employee/{department_id?}','EmployeeController@index')->name('employee.index');


    Route::post('check_in/{employee_id}', 'RequestController@check_in')->name('check_in');
    Route::put('check_out/{request_id}', 'RequestController@check_out')->name('check_out');
    Route::get('requests/{request_id?}', 'RequestController@index')->name('requests.index');
    Route::get('employee_requests/{employee_id}', 'EmployeeController@employee_requests')->name('employee.requests');


    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

});
