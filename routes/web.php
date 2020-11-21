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
    Route::resource('admins', 'Admin\AdminController', ['except' => ['show']]);
    Route::resource('departments', 'Admin\DepartmentController', ['except' => ['show']]);
    Route::resource('employees', 'Admin\EmployeeController', ['except' => ['show']]);
});

Route::group(['prefix' => 'head','middleware' => ['auth','head']],function() {

    Route::resource('categories', 'Admin\CategoryController', ['except' => ['show']]);
});

Route::group(['prefix' => 'employee','middleware' => ['auth','employee','verified']],function() {

    Route::resource('admins', 'Admin\AdminController', ['except' => ['show']]);
});
