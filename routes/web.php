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

Route::group(['as' => 'page.',
              'namespace' => 'Pages'], function () {

	Route::get('/', 'HomeController@getHome')->name('home');
	Route::get('/about', 'AboutController@getAbout')->name('about');
	Route::get('/skills', 'SkillsController@getSkills')->name('skills');
});

Route::group(['as' => 'auth.',
              'namespace' => 'Auth',
              'prefix' => 'auth'], function () {

	//Route::group(['middleware' => 'auth'], function () {
	//Route::get('logout', 'LoginController@getLogout')->name('logout');
	//});

	Route::group(['middleware' => 'guest'], function () {
		//Route::get('login', 'LoginController@getLogin')->name('login');
		//Route::post('login', 'LoginController@postLogin');

		Route::get('github', 'GitHubController@redirectToProvider')->name('github');
		Route::get('github/callback', 'GitHubController@handleProviderCallback');
	});
});

Route::group(['as' => 'blog.',
              'namespace' => 'Blog',
              'prefix' => 'blog'], function () {

	Route::get('/', 'BlogController@getList')->name('list');
	Route::get('/{article}', 'BlogController@getArticle')->name('article');
	Route::get('/tag/{tag}', 'BlogController@getTagsSearch')->name('tags');
});

Route::group(['as' => 'admin.',
              'namespace' => 'Admin',
              'prefix' => 'admin',
              'middleware' => 'auth'], function () {

	Route::get('/', 'AdminController@getIndex')->name('index');

	Route::group(['as' => 'blog.',
	              'namespace' => 'Blog',
	              'prefix' => 'blog'], function () {

		Route::group(['as' => 'article.',
		              'prefix' => 'article'], function () {

			Route::get('/list', 'ArticleController@getList')->name('list');
			Route::get('/create', 'ArticleController@getCreate')->name('create');
			Route::post('/create', 'ArticleController@postCreate');
			Route::get('/{article}/edit', 'ArticleController@getEdit')->name('edit');
			Route::post('/{article}/edit', 'ArticleController@postEdit');
			Route::post('/{article}/delete', 'ArticleController@postDelete')->name('delete');
		});
	});
});