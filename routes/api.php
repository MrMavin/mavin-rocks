<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
                 'namespace' => 'Admin',
                 'prefix'    => 'admin',
             ], function () {

    Route::get('articles', 'AdminAPI@getArticles');
    Route::get('article/{article}', 'AdminAPI@getArticle');
    Route::post('article/create', 'AdminAPI@postArticleCreate');
    Route::post('article/{article}', 'AdminAPI@postArticle');
    Route::post('article/{article}/delete', 'AdminAPI@postArticleDelete');
    Route::get('categories', 'AdminAPI@getCategories');
});