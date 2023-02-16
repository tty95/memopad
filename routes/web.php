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

Route::group(['middleware' => ['auth']], function() {
        Route::get('/memopad', 'MemoController@index')->name('memo.index');
        Route::get('/memopad/add', 'MemoController@add')->name('memo.add');
        Route::post('/memopad/add', 'MemoController@memoInsert')->name('memo.insert');
        Route::get('/memopad/detail/{id}', 'MemoController@detail')->name('memo.detail');
});

Route::get('/home', 'HomeController@index')->name('home');