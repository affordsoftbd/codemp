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

/*Message routes*/
Route::resource('messages', 'MessageController');
Route::post('/message/subject/add', 'MessageController@addMessageSubject')->name('message.subject.add');

/*Authentication route*/
Route::get('login','AuthController@login')->name('login');
Route::post('retry','AuthController@retry')->name('retry');
Route::get('recovery','AuthController@recovery')->name('recovery');
Route::post('reset','AuthController@reset')->name('reset');
Route::get('login','AuthController@login')->name('login');
Route::post('login','AuthController@postLogin')->name('postLogin');
Route::get('logout','AuthController@logout')->name('logout');

Route::get('/register/politician','AuthController@politicianRegister')->name('register.politician');
Route::get('/register/public','AuthController@publicRegister')->name('register.public');
Route::post('save_user','AuthController@saveUser');

// Auth::routes();

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/news', 'HomeController@news')->name('news');
Route::get('/requests', 'HomeController@requests')->name('requests');
Route::get('/followers', 'HomeController@followers')->name('followers');
Route::get('/news/{headline}', 'HomeController@newsDetails')->name('news.details');
Route::get('/politicians', 'HomeController@politicians')->name('politicians');
Route::get('/{username}', 'HomeController@profilePosts')->name('profile');
Route::get('/{username}/posts', 'HomeController@profilePosts')->name('profile.posts');
Route::post('get_user_post_ajax/{id}', 'PostController@getUserPostAjax');
Route::get('/{username}/albums', 'HomeController@profileAlbums')->name('profile.albums');
Route::get('/{username}/videos', 'HomeController@profileVideos')->name('profile.videos');
Route::get('/{username}/update', 'HomeController@editProfile')->name('profile.edit');
Route::get('/{username}/update/politican', 'HomeController@editPoloticanProfile')->name('profile.edit.politican');
Route::get('/{username}/update/password', 'HomeController@editProfilePassword')->name('profile.edit.password');
Route::post('/save_user_profile', 'UserController@saveProfile');
Route::post('/update_user_password', 'UserController@updatePassword');
Route::put('/update_profile_image/{id}', 'UserController@updateProfileImage')->name('profile.update.image');

/*Post routes*/
Route::get('/post/{id?}', 'PostController@postDetails')->name('post');
Route::get('/post/{id}/edit', 'PostController@editPostDetails')->name('post.edit');
Route::put('/post/{id}/update', 'PostController@updatePostDetails')->name('post.update');
Route::get('/image/{id?}', 'PostController@imageDetails')->name('image');
Route::post('/image/add', 'PostController@addImage')->name('image.add');
Route::delete('/image/{id}/delete', 'PostController@deleteImage')->name('image.delete');
Route::get('/video/{id?}', 'PostController@videoDetails')->name('video');
Route::post('saveTextPost', 'PostController@saveTextPost');
Route::post('saveImagePost', 'PostController@saveImagePost')->name('image.save');
Route::post('saveVideoPost', 'PostController@saveVideoPost')->name('video.save');
Route::post('get_post_ajax', 'PostController@getPostAjax');
Route::post('save_comment', 'PostController@saveComment');
Route::post('save_post_like', 'PostController@savePostLike');
Route::delete('/post/{id?}/delete', 'PostController@deletePost')->name('post.delete');

/*Profile route*/
// Route::get('/{id}', 'PostController@postDetails')->name('profile'); 

/*Common routes*/
Route::post('leader_by_role', 'CommonController@getLeaderByRole');
Route::post('district_by_division', 'CommonController@getDistrictByDivision');
Route::post('thana_by_district', 'CommonController@getThanaByDistrict');
Route::post('zip_by_thana', 'CommonController@getZipByThana');

Route::post('error_404', 'CommonController@error404');
