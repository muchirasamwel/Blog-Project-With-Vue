<?php

use App\Blog;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getblogs','ApiController@index');
Route::get('/gettodaysblogs','ApiController@todaysBlog');
Route::get('/getloggeduser','ApiController@getLoggedUser');
Route::post('/addblog','ApiController@store');
Route::post('/deleteblog','ApiController@destroy');
Route::post('/updateblog','ApiController@update');


