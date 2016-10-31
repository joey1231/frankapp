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

Route::get('/test',function(){
    echo "Sniper 3D Assassin: Shoot to Kill - by Fun Games For Free";
    echo "<br/>";
    echo substr("Sniper 3D Assassin: Shoot to Kill - by Fun Games For Free",0,40);
});
 Route::get('/', function () {

            // pass it off to the view
            return redirect('/dashboard');
        });
/// Login for Admins:
Route::get('logout', 'Auth\LoginController@logout');
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::group(['middleware' => 'auth:users'], function () {
        // pass the dashboard if / is requested AND if admin is authenticated.
        Route::get('/dashboard', function () {

            // pass it off to the view
            return view('dashboard.index',array('page'=>'dashboard'));
        });
        Route::get('/syncadx', 'AdexperienceController@syncAppThis');
        Route::get('/adx', 'AdexperienceController@index');

        Route::get('/synccpi', 'CpiController@syncAppThis');
        Route::get('/cpi', 'CpiController@index');


        Route::get('/synccrunch', 'CrunchController@syncAppThis');
        Route::get('/crunchmedia', 'CrunchController@index');

        Route::get('/syncwadogo', 'WadogoController@syncAppThis');
        Route::get('/wadogo', 'WadogoController@index');

        Route::get('/synconeapi', 'OneApiController@syncAppThis');
        Route::get('/oneapi', 'OneApiController@index');

     	Route::get('/appthis', 'AppController@index');
		Route::get('/syncappthis','AppController@syncAppThis');


		//Route::get('/test2','AppController@getOffer');
		//Route::get('/thumb','AppController@uploadThumbnail');
		//Route::get('/checkDeletedOffer','AppController@checkDeletedOffer');

});