<?php
declare(strict_types=1);

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

Route::get('/', 'BlogController@index')->name('home');
Route::get('/posts/{post}-{slug}', 'BlogController@show')->name('posts.show');
Route::get('/search', 'SearchController@index')->name('quickSearch');
Route::get('/categories/{category}-{name}', 'CategoryController@show')->name('categories.show');
Route::get('/tag/{tag}', 'TagController@show')->name('categories.show');
Route::get('/user/{user}', 'UserController@show')->name('users.show');
Route::get('/user/{user}/{follow}', 'UserController@showFollow')->name('users.follow');
Route::post('/subscribe', 'SubscriberController@subscribe')->name('subscribes.subscribe');

Route::get('/unsubscribe/{subscriber}', 'SubscriberController@unSubscribe')
    ->name('subscribes.unsubscribe');

Route::get('/rss', 'RssController@index')->name('rss.index');

Route::middleware('auth')->prefix('account')->group(function() {
    Route::get('/', 'AccountController@index')->name('account.index');
    Route::get('/profile', 'AccountController@show')->name('account.show');
    Route::get('/posts', 'AccountController@postIndex')->name('account.posts.index');
    Route::get('/posts/{post}', 'AccountController@postShow')->name('account.posts.show');
    Route::get('/posts/create', 'AccountController@postCreate')->name('account.posts.create');
    Route::get('/posts/{post}/edit', 'AccountController@postEdit')->name('account.posts.edit');
    Route::get('/posts/{post}/delete', 'AccountController@postDelete')->name('account.posts.delete');
    Route::post('/posts', 'AccountController@postStore')->name('account.posts.store');
});

Auth::routes();
