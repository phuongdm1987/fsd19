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
Route::get('/post/{post}-{slug}', 'BlogController@show')->name('posts.show');
Route::get('/search', 'SearchController@index')->name('quickSearch');
Route::get('/danh-muc/{category}-{name}', 'CategoryController@show')->name('categories.show');
Route::get('/tag/{tag}', 'TagController@show')->name('categories.show');
Route::get('/user/{user}', 'UserController@show')->name('users.show');
Route::get('/user/{user}/{follow}', 'UserController@showFollow')->name('users.follow');
Route::post('/subscribe', 'SubscriberController@subscribe')->name('subscribes.subscribe');

Route::get('/unsubscribe/{subscriber}', 'SubscriberController@unSubscribe')
    ->name('subscribes.unsubscribe');

Route::get('/rss', 'RssController@index')->name('rss.index');
Route::get('/account', 'AccountController@index')->name('account.index');

Auth::routes();
