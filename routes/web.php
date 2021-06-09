<?php

// DB::listen(function($query){var_dump($query->sql, $query->bindings);});
// 可檢查在User中的getRouteKeyName()

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/tweets', 'App\Http\Controllers\TweetsController@index')->name('home');
    Route::post('/tweets', 'App\Http\Controllers\TweetsController@store');
    Route::delete('/tweets/{tweet}/delete', 'App\Http\Controllers\TweetsController@destroy');

    Route::post('/tweets/{tweet}/like', 'App\Http\Controllers\TweetLikesController@store');
    Route::delete('/tweets/{tweet}/like', 'App\Http\Controllers\TweetLikesController@destroy');
    
    Route::post('/profiles/{user:username}/follow', 'App\Http\Controllers\FollowsController@store')->name('follow');

    Route::get('/profiles/{user:username}/edit', 'App\Http\Controllers\ProfilesController@edit')->middleware('can:edit,user');
    // 在route這邊做像Policy的做法，此使用者可做edit動作，此使用者為這個{user:name}
    
    Route::patch('/profiles/{user:username}', 'App\Http\Controllers\ProfilesController@update')->middleware('can:edit,user');

    Route::get('/explore', 'App\Http\Controllers\ExploreController');

    Route::get('/notifications', 'App\Http\Controllers\UserNotificationsController@show');
    // 將以上Route加上middleware('auth')
});

Route::get('/profiles/{user:username}', 'App\Http\Controllers\ProfilesController@show')->name('profile');
// {user:name}此寫法等同於User中的getRouteKeyName()

