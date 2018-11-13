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
Route::get('/messages/new', 'MessageController@newMessages')->name('messages.new');
Route::get('/messages/administrated/', 'MessageController@administratedMessages')->name('messages.administrated');
Route::get('/messages/subject/{id}/edit', 'MessageController@getMessageSubject')->name('messages.subject.edit');
Route::get('/messages/subject/{id}/receipent/{receipent}/add', 'MessageController@addReceipent');
Route::get('/messages/subject/{id}/add/followers', 'MessageController@addFollowers')->name('messages.add.followers');
Route::resource('messages', 'MessageController');
Route::post('/messages/subject/{id}/getUserList', 'MessageController@getUserList')->name('messages.user.list');
Route::delete('/messages/{id}/receipent/{receipent}/remove', 'MessageController@removeReceipent')->name('messages.receipent.remove');
Route::post('/messages/subject/add', 'MessageController@addMessageSubject')->name('messages.subject.add');
Route::put('/messages/subject/{id}/update', 'MessageController@updateMessageSubject')->name('messages.subject.update');
Route::delete('/messages/subject/{id}/delete', 'MessageController@deleteMessageSubject')->name('messages.subject.delete');

/*Event routes*/
Route::get('/events/organized/', 'MessageController@organizedEvents')->name('events.organized');
Route::resource('events', 'EventController');


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
Route::get('/summeries', 'HomeController@summeries')->name('summeries');
Route::get('/requests', 'HomeController@requests')->name('requests');
Route::post('/send_request', 'HomeController@saveRequests')->name('send_request');
Route::post('/cancel_request', 'HomeController@cancelRequests')->name('cancel_request');
Route::post('/accept_request', 'HomeController@acceptRequests')->name('accept_request');
Route::post('/reject_request', 'HomeController@rejectRequests')->name('reject_request');
Route::post('/new_request_ajax', 'HomeController@newRequestsAjax')->name('new_request_ajax');
Route::get('/followers', 'HomeController@followers')->name('followers');
Route::post('/remove_follower', 'HomeController@removeFollowers')->name('remove_follower');
Route::get('/news/{headline}', 'HomeController@newsDetails')->name('news.details');

Route::get('group', 'GroupController@index')->name('group');
Route::post('save_group', 'GroupController@saveGroup')->name('save_group');
Route::delete('delete_group/{id}', 'GroupController@deleteGroup')->name('group.delete');

Route::post('/save_news_comment', 'HomeController@saveNewsComment')->name('save_news_comment');
Route::get('/politicians', 'HomeController@politicians')->name('politicians');
Route::get('public_profile', 'HomeController@publicProfile');
Route::post('/follow_leader', 'HomeController@followLeader')->name('follow_leader');
Route::post('/un_follow_leader', 'HomeController@unFollowLeader')->name('un_follow_leader');

Route::post('get_user_post_ajax/{id}', 'PostController@getUserPostAjax');

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


Route::get('/{username}', 'HomeController@profilePosts')->name('profile');
Route::get('/{username}/posts', 'HomeController@profilePosts')->name('profile.posts');
Route::get('/{username}/albums', 'HomeController@profileAlbums')->name('profile.albums');
Route::get('/{username}/videos', 'HomeController@profileVideos')->name('profile.videos');
Route::get('/{username}/update', 'HomeController@editProfile')->name('profile.edit');
Route::get('/{username}/update/politican', 'HomeController@editPoloticanProfile')->name('profile.edit.politican');
Route::get('/{username}/update/password', 'HomeController@editProfilePassword')->name('profile.edit.password');
