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
Route::group(['prefix' => 'register'], function(){
	Route::get('/public', function () {
				    return view('welcome');
				})->name('front.travel.pdf');
	Route::get('/politician', function () {
				    return view('welcome');
				})->name('front.travel.pdf');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
