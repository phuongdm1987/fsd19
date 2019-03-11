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
Route::get('/tag/{tag}', 'TagController@show')->name('tags.show');
Route::get('/user/{user}', 'UserController@show')->name('users.show');
Route::get('/user/{user}/{follow}', 'UserController@showFollow')->name('users.follow');
Route::post('/subscribe', 'SubscriberController@subscribe')->name('subscribes.subscribe');

Route::get('/unsubscribe/{subscriber}', 'SubscriberController@unSubscribe')
    ->name('subscribes.unsubscribe');

Route::get('/rss', 'RssController@index')->name('rss.index');
Route::get('/site-map', 'SiteMapController@index');

Route::middleware('auth')->prefix('account')->group(function() {
    Route::namespace('Account')->group(function() {
        Route::get('/profile', 'ProfileController@profile')->name('account.show');
        Route::match(['put', 'patch'], '/profile', 'ProfileController@updateProfile')->name('account.updateProfile');
        Route::match(['put', 'patch'], '/change-password', 'ProfileController@changePassword')->name('account.changePassword');

        Route::get('/', 'BlogController@index')->name('account.blog.index');

        Route::get('/posts/create', 'BlogController@blogCreate')->name('account.blog.create');
        Route::post('/posts', 'BlogController@blogStore')->name('account.blog.store');

        Route::get('/posts/{post}', 'BlogController@blogShow')
            ->name('account.blog.show')
            ->middleware('can:show,post');

        Route::get('/posts/{post}/edit', 'BlogController@blogEdit')
            ->name('account.blog.edit')
            ->middleware('can:show,post');
        Route::match(['put', 'patch'], '/posts/{post}', 'BlogController@blogUpdate')
            ->name('account.blog.update')
            ->middleware('can:update,post');

        Route::get('/posts/{post}/delete', 'BlogController@blogDelete')->name('account.blog.delete');
    });




    Route::get('/logout', 'Auth\LoginController@logout')->name('logout.get');
});

Route::middleware('auth')->prefix('ajax')->namespace('Ajax')->group(function() {
    Route::post('/posts/recommend', 'BlogController@recommend');
    Route::get('/posts/suggest', 'BlogController@getSuggest');
    Route::get('/tags/suggest', 'TagController@getSuggest');
});

Auth::routes();
