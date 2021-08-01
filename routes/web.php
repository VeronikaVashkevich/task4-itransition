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
});

Auth::routes();

Route::group(['middleware'=>'auth'], function(){
    Route::get('all', [App\Http\Controllers\UserController::class, 'showUsers']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/manage', [App\Http\Controllers\UserController::class, 'deleteCheckedUsers']);
    Route::post('/block', [App\Http\Controllers\UserController::class, 'blockSelectedUsers']);
    Route::post('/unblock', [App\Http\Controllers\UserController::class, 'unblockSelectedUsers']);
    Route::post('/home', [App\Http\Controllers\UserController::class, 'logout'])->name('home');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

});

//Route::get('all', [App\Http\Controllers\UserController::class, 'showUsers']);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::post('/manage', [App\Http\Controllers\UserController::class, 'deleteCheckedUsers']);
//Route::post('/block', [App\Http\Controllers\UserController::class, 'blockSelectedUsers']);
//Route::post('/unblock', [App\Http\Controllers\UserController::class, 'unblockSelectedUsers']);
//Route::post('/home', [App\Http\Controllers\UserController::class, 'logout'])->name('home');
//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
