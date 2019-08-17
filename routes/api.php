<?php

use Illuminate\Http\Request;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Helps link the directory of Api Controllers
Route::group(['namespace' => 'Api'], function () {

    //Prefix api to api/v1
    Route::group(['prefix' => 'v1'], function () {
        //Un-Auth Route to Get token
        Route::post('login', 'AuthController@login');

        //Auth Route  using token
        Route::group(['middleware' => 'jwt.auth'], function () {
            //Get Details of Logged in user
            Route::get('users/me', 'AuthController@getUser');
        });

    });

    //Prefix api to api/v2
    Route::group(['prefix' => 'v2'], function () {

    });

});
