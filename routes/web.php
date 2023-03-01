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
Route::get('/auth/redirect', 'GoogleLoginController@getGoogleAuth')->name('login.google');
Route::get('/login/google/callback', 'GoogleLoginController@authGoogleCallback');

Route::group(['middleware' => ['auth']], function() {
        Route::get('/memopad', 'MemoController@index')->name('memo.index');
        Route::get('/memopad/add', 'MemoController@showAddMemoPage')->name('memo.add');
        Route::post('/memopad/add', 'MemoController@add')->name('memo.insert');
        Route::get('/memopad/edit/{id}', 'MemoController@showEditMemoPage')->name('memo.edit');
        Route::put('/memopad/edit', 'MemoController@update')->name('memo.update');
        Route::delete('/memopad', 'MemoController@delete')->name('memo.delete'); 
});

// Route::get('/home', 'HomeController@index')->name('home');