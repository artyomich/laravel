<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return view('welcome');
});

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
});

//This route is for customer's orders
Route::get('orders', ['uses' => 'OrderController@index', 'as' => 'orders', 'middleware' => array('web', 'auth')]);

//This route is for customer's orders
Route::get('new', ['uses' => 'NewOrderController@index', 'as' => 'new', 'middleware' => array('web', 'auth')]);


//This route is for editing orders by customers 
Route::get('orders/{id}/edit', ['uses' => 'OrderItemController@show', 'as' => 'order.edit', 'middleware' => array('web', 'auth')])->where(['id' => '[0-9]+']);
// API ROUTES ==================================  
Route::group(['prefix' => 'api', 'middleware' => array('web', 'auth')], function() {

    // since we will be using this just for CRUD, we won't need create and edit
    // Angular will handle both of those forms
    // this ensures that a user can't access api/create or api/edit when there's nothing there

    Route::resource('orders.items', 'OrderItemController');
    Route::post('orders/{id}/items/{itemId}/quantity', 'OrderItemController@quantity');
    Route::post('orders/{id}/receiver', 'OrderItemController@receiver');
    Route::post('orders/{id}/sender', 'OrderItemController@sender');
    Route::post('orders/{id}/add', 'OrderItemController@add');
});

// CATCH ALL ROUTE =============================  
// all routes that are not home or api will be redirected to the frontend 
// this allows angular to route them 
//App::missing(function($exception) {

    //return View::make('index');
//});
