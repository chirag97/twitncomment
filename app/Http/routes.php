<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     // session()->flush();
//     // dd(session()->all());    

//     return view('welcome');

// });

Route::get('/', 'TwitterController@home');

Route::get('twitter/login', 'TwitterController@login')->name('twitter.login');
Route::get('twitter/callback', 'TwitterController@callback')->name('twitter.callback');
Route::get('twitter/error', ['as' => 'twitter.error', function () {
    // Something went wrong, add your own error handling here
}]);
Route::get('twitter/logout', ['as' => 'twitter.logout', function () {
    Session::forget('access_token');
    return Redirect::to('/')->with('flash_notice', 'You\'ve successfully logged out!');
}]);
Route::post('/twitter/profile/postTweet','TwitterController@postTweet');


Route::get('/trends/index','TrendsController@index');
Route::get('/trends/tweets','TrendsController@tweets');

Route::get('/commenting/index','CommentsController@index');
Route::post('/commenting/store','CommentsController@store');