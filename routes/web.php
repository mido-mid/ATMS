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

Route::group(['prefix' => 'admin','middleware' => ['auth','admin']],function() {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('', 'HomeController@index')->name('home');
    Route::resource('admins', 'Admin\AdminController');
    Route::resource('departments', 'Admin\DepartmentController');
    Route::resource('employees', 'Admin\EmployeeController');
    Route::resource('questions', 'Admin\QuestionController');
});

Route::group(['prefix' => 'head','middleware' => ['auth','head']],function() {

    Route::resource('employees', 'Admin\EmployeeController', ['except' => ['store','create','delete']]);
});

Route::group(['prefix' => 'employee','middleware' => ['auth','employee','verified']],function() {

    Route::resource('admins', 'Admin\AdminController', ['except' => ['show']]);
});
