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
Route::get('/registration', function () {
    return view('main.registration');
});

/*Admin*/
Route::get('/add_shelter','ShelterController@addShel');
Route::post('/create_shelter', 'ShelterController@create');
Route::get('/view_shelters', 'ShelterController@view');
Route::get('/delete_shelter/{id}', 'ShelterController@destroy');
Route::get('/active_shelter/{id}', 'ShelterController@active');
Route::get('/deactive_shelter/{id}', 'ShelterController@deactive');
Route::get('/view_users', 'UserController@view');
Route::get('/delete_user/{id}', 'UserController@destroy');
Route::get('/active_user/{id}', 'UserController@active');
Route::get('/deactive_user/{id}', 'UserController@deactive');
Route::get('/edit_shelter/{id}', 'ShelterController@edit');
Route::get('/userProfile', 'UserController@index');
Route::post('/update_profile', 'UserController@update');
Route::post('/update_shelter', 'ShelterController@update');

Route::get('/web_content','ContentController@index');
Route::post('/create_content','ContentController@createContent');
Route::get('/active_content/{id}','ContentController@active');
Route::get('/deactive_content/{id}','ContentController@deactive');
Route::get('/edit_content/{id}','ContentController@edit');
Route::post('/update_content','ContentController@update');
Route::get('/pass_reset','UserController@passReset');
Route::post('/update_password','UserController@updatePassword');




Route::get('/', 'WebController@index');
Route::get('/search_shelter', 'WebController@searchShelter');
Route::get('/live_search', 'WebController@liveSearch')->name('live_search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout');

/*Main*/
Route::get('/contact', function () {
    return view('main.contact');
});
Route::get('/about', function () {
    
    return view('main.about');
});
Route::get('/faqs', function () {
    
    return view('main.faqs');
});
//Send Message
Route::post('/send_message', 'WebController@sendMessage');