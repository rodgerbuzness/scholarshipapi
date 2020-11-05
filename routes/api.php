<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@do']);

Route::prefix('auth')->group(function(){
    Route::post('/register','AuthController@register');
    Route::post('/login','AuthController@login');
    Route::get('/user','AuthController@user')->middleware('auth:api');
    Route::get('/logout','AuthController@logout')->middleware('auth:api');
    Route::get('auth-failed','AuthController@authFailed')->name('auth-failed');
});

// Route::get('opportunities','OpportunityController@index');
// Route::get('opportunity/{opportunity}','OpportunityController@show');

Route::resource('opportunity','OpportunityController')->middleware('auth:api');;

Route::group(['prefix' => 'lookups', 'middleware' => 'auth:api'], function(){   
    Route::resource('category','CategoryController');
    Route::resource('country','CountryController');
});

Route::group(['middleware' => 'auth:api'], function(){

});

