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

Route::get('/', function () {
    return view('auth.login');
})->name('welcome');

Route::get('/register/politician', function () {
    return view('auth.politician_register');
})->name('register.politician');

Route::get('/register/public', function () {
    return view('auth.public_register');
})->name('register.public');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post', 'HomeController@post')->name('post');
Route::get('/image', 'HomeController@image')->name('image');
Route::get('/video', 'HomeController@video')->name('video');
