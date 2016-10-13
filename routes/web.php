<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'AppController@index');
Route::get('/syncappthis','AppController@syncAppThis');
Route::get('/test2','AppController@getOffer');
Route::get('/thumb','AppController@uploadThumbnail');
Route::get('/checkDeletedOffer','AppController@checkDeletedOffer');
