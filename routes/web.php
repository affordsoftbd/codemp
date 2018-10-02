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

/*Route::get('/', function () {
    return redirect('/home');
})->name('welcome');*/

/*Authentication route
Route::get('login','AuthController@login');
Route::post('login','AuthController@postLogin');
Route::get('logout','AuthController@logout');*/

/*Authentication route*/
Route::get('login','AuthController@login')->name('login');
Route::post('login','AuthController@postLogin')->name('postLogin');
Route::get('logout','AuthController@logout')->name('logout');

Route::get('/register/politician','AuthController@politicianRegister')->name('register.politician');
Route::get('/register/public','AuthController@publicRegister')->name('register.public');
Route::post('save_public_user','AuthController@savePublicUser');
Route::post('save_politician_user','AuthController@savePoliticianUser');

// Auth::routes();

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/{username}', 'HomeController@profilePosts')->name('profile');
Route::get('/{username}/posts', 'HomeController@profilePosts')->name('profile.posts');
Route::get('/{username}/albums', 'HomeController@profileAlbums')->name('profile.albums');
Route::get('/{username}/videos', 'HomeController@profileVideos')->name('profile.videos');
Route::get('/{username}/update', 'HomeController@editProfile')->name('profile.edit');

/*Post routes*/
Route::get('/post/{id?}', 'PostController@postDetails')->name('post');
Route::get('/image/{id?}', 'PostController@imageDetails')->name('image');
Route::get('/video/{id?}', 'PostController@videoDetails')->name('video');
Route::post('saveTextPost', 'PostController@saveTextPost');
Route::post('saveImagePost', 'PostController@saveImagePost')->name('image.save');
Route::post('saveVideoPost', 'PostController@saveVideoPost')->name('video.save');
Route::post('get_post_ajax', 'PostController@getPostAjax');
Route::post('save_comment', 'PostController@saveComment');
Route::post('save_post_like', 'PostController@savePostLike');

/*Profile route*/
// Route::get('/{id}', 'PostController@postDetails')->name('profile'); 

/*Common routes*/
Route::post('leader_by_role', 'CommonController@getLeaderByRole');
Route::post('district_by_division', 'CommonController@getDistrictByDivision');
Route::post('thana_by_district', 'CommonController@getThanaByDistrict');
Route::post('zip_by_thana', 'CommonController@getZipByThana');

Route::post('error_404', 'CommonController@error404');
