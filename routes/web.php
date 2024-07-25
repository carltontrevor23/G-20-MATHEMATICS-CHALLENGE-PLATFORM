<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
//route for accessing the guest view
Route::get('/guest-view', [App\Http\Controllers\GuestViewController::class, 'index'])->name('guest-view');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	//Route::resource('/typography', UploadSchoolController::class);
	//Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	//Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

//Route::resource('/typography', UploadSchoolController::class);
//Route::get('typography', ['as' => 'school.schoolUploadSuccess', 'uses' => 'App\Http\Controllers\SchoolController@schoolUploadSuccess']);
//Route::post('typography', [App\Http\Controllers\SchoolController::class, 'store']);

Route::get('uploadschools', [App\Http\Controllers\SchoolController::class, 'index'])->name('school.index');
Route::post('uploadschools', [App\Http\Controllers\SchoolController::class, 'store'])->name('school.store');

Route::get('challenges/upload-challenge', [App\Http\Controllers\ExcelController::class, 'index'])->name('upload.index');
Route::post('challenges/upload-challenge', [App\Http\Controllers\ExcelController::class, 'store'])->name('upload.excel');



