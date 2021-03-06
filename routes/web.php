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

Route::group([
                 'as'        => 'page.',
                 'namespace' => 'Pages',
             ], function () {

    Route::get('/', 'HomeController@getHome')->name('home');
    Route::get('/about', 'AboutController@getAbout')->name('about');
    Route::get('/skills', 'SkillsController@getSkills')->name('skills');
});

Route::group([
                 'as'        => 'webhooks.',
                 'namespace' => 'WebHooks',
                 'prefix'    => 'webhooks',
             ], function () {
    Route::post('telegram/{token}', 'Telegram@postWebHook')->name('telegram');
    Route::post('github', 'GitHub@postWebHook')->name('github');
});

Route::group([
                 'as'        => 'auth.',
                 'namespace' => 'Auth',
                 'prefix'    => 'auth',
             ], function () {

    //Route::group(['middleware' => 'auth'], function () {
    //Route::get('logout', 'LoginController@getLogout')->name('logout');
    //});

    Route::group(['middleware' => 'guest'], function () {
        Route::get('github', 'GitHubController@redirectToProvider')->name('github');
        Route::get('github/callback', 'GitHubController@handleProviderCallback');
    });
});

Route::group([
                 'as'        => 'blog.',
                 'namespace' => 'Blog',
                 'prefix'    => 'blog',
             ], function () {

    Route::get('/', 'BlogController@getList')->name('list');
    Route::get('/{article}', 'BlogController@getArticle')->name('article');
    Route::get('/category/{category}', 'BlogController@getCategorySearch')->name('category');
    Route::get('/tag/{tag}', 'BlogController@getTagSearch')->name('tag');
});

Route::group([
                 'as'         => 'admin.',
                 'namespace'  => 'Admin',
                 'prefix'     => 'admin',
                 'middleware' => 'auth',
             ], function () {

    Route::view('/{path?}', 'layouts.admin')->where('path', '.*')->name('index');
});