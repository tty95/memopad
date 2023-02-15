<?php

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

// Route::get('/', function () {
    // return view('welcome');
// });

Auth::routes();

///userログイン前
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.index');

Route::get('/memopad', function() {
        return view("memo.index");
})->name('memopad.index');

Route::get('/home', 'HomeController@index')->name('home');