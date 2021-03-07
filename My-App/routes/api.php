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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
/* Route::middleware('auth:admin')->get('/admin', function (Request $request) {
    return $request->admin();
}); */

//////// admin


///////categories
Route::get('category', 'GetCategoryController@index');
Route::get('category/{id}', 'CategoryController@show');

// /////messages branch

Route::post('messages', 'MessageController@store');
Route::post('/testimonial', 'TestimonialController@store');
// Route::put('messages/{id}', 'MessageController@update');
Route::get('/homeitem', 'GetItemController@getHomeItem');
Route::get('/item', 'GetItemController@index');
Route::get('/item/{id}', 'GetItemController@show');

////////// admin routes
Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admin']], function () {
    Route::post('register', 'AdminController@register');
    Route::post('login', 'AdminController@login');
});

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admin','jwt.auth']], function () {
    Route::post('logout', 'AdminController@logout');
    Route::post('refresh', 'AdminController@refresh');
    Route::get('profile', 'AdminController@profile');
    Route::post('/verify', 'AdminController@verifytokens');
    Route::delete('/{id}', 'AdminController@destroy');
    Route::put('/{id}', 'AdminController@update');
    Route::get('/show', 'AdminController@index');
    ////user
    Route::get('/user/show', 'AdminController@indexuser');
    Route::delete('/user/{id}', 'AdminController@destroyuser');
    Route::put('/user/{id}', 'AdminController@updateuser');

    ////////////////
    Route::delete('messages/{id}', 'MessageController@destroy');

    //////////////
    // Route::get('/item', 'ItemController@index');
    Route::post('/item', 'ItemController@store');
    Route::put('/item/{id}', 'ItemController@update');
    Route::delete('/item/{id}', 'ItemController@destroy');


    Route::get('/testimonial', 'TestimonialController@index');


    ////////////
    
    Route::post('category', 'CategoryController@store');
    Route::put('/category/{id}', 'CategoryController@update');
    Route::delete('/category/{id}', 'CategoryController@destroy');

    ///////////// /Route::get('/order', 'OrderController@index');
    Route::get('/order', 'OrderController@index');
    Route::post('/order', 'OrderController@store');
    Route::get('/order/{id}', 'OrderController@show');
    Route::put('/order/{id}', 'OrderController@update');
    Route::delete('/order/{id}', 'OrderController@destroy');
    Route::post('/status', 'StatusController@store');
    Route::get('/status/{id}', 'StatusController@show');
    Route::get('/status', 'StatusController@index');
    //////////////
    Route::get('messages', 'MessageController@index');
    Route::get('messages/{id}', 'MessageController@show');
    //////
    
    Route::get('/testimonial', 'TestimonialController@index');
    Route::get('/testimonial/{id}', 'TestimonialController@show');
    Route::delete('/testimonial/{id}', 'TestimonialController@destroy');
    //////////////
    Route::put('/usdRate/{id}', 'UsdRateController@update');
});


///////// user routes


Route::group(['prefix' => 'user','middleware' => ['assign.guard:api']], function () {
    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login');
});




Route::group(['prefix' => 'user','middleware' => ['assign.guard:api','jwt.auth']], function () {
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::get('profile', 'JWTAuthController@profile');
    Route::delete('/{id}', 'JWTAuthController@destroy');
    Route::put('/{id}', 'JWTAuthController@update');
    
    
    ///////////////
    Route::get('/order', 'OrderController@index');
    Route::post('/order', 'OrderController@store');
    Route::get('/order/{id}', 'OrderController@show');
    
    ///////////////
    Route::get('/orderItem', 'OrderItemController@index');
    Route::post('/orderItem', 'OrderItemController@store');
    Route::get('/orderItem/{id}', 'OrderItemController@show');
    Route::put('/orderItem/{id}', 'OrderItemController@update');
    Route::delete('/orderItem/{id}', 'OrderItemController@destroy');

    ///////////////
    Route::get('/cart', 'CartController@index');
    Route::get('/cart/{id}', 'CartController@show');
     
    ///////////////
    Route::get('/cartItem', 'CartItemController@index');
    Route::post('/cartItem', 'CartController@store');
    Route::get('/cartItem/{id}', 'CartController@show');
    //  Route::put('/cartItem/{id}', 'CartController@update');
    Route::delete('/cartItem/{id}', 'CartController@destroy');
});