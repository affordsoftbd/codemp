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
    return redirect('/home');
})->name('welcome');

<<<<<<< HEAD
/*Authentication route*/
Route::get('login','AuthController@login');
Route::post('login','AuthController@postLogin');
Route::get('logout','AuthController@logout');

=======

/*Authentication route*/
Route::get('login','AuthController@login');
Route::post('login','AuthController@postLogin');
Route::get('logout','AuthController@logout');

>>>>>>> 31fcc469de5fb7e87a84b6b3cfeed75a08b4ba0e
Route::get('/register/politician','AuthController@politicianRegister')->name('register.politician');
Route::get('/register/public','AuthController@publicRegister')->name('register.public');
Route::post('save_public_user','AuthController@savePublicUser');
Route::post('save_politician_user','AuthController@savePoliticianUser');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Post routes*/
<<<<<<< HEAD
=======
Route::get('/post', 'HomeController@post')->name('post');
Route::get('/image', 'HomeController@image')->name('image');
Route::get('/video', 'HomeController@video')->name('video');
>>>>>>> 31fcc469de5fb7e87a84b6b3cfeed75a08b4ba0e
Route::post('saveTextPost', 'PostController@saveTextPost');

/*Common routes*/
Route::post('leader_by_role', 'CommonController@getLeaderByRole');
Route::post('district_by_division', 'CommonController@getDistrictByDivision');
Route::post('thana_by_district', 'CommonController@getThanaByDistrict');
Route::post('zip_by_thana', 'CommonController@getZipByThana');
