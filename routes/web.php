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

//initial page load
Route::get('/', function () {
    return view('welcome');
});

//guest
Route::get('/get-foods', 'guestcontroller@get_foods');


//vendor routes
Route::get('/get-orders', 'vendorcontroller@get_orders');
Route::get('/total-cash', 'vendorcontroller@total_cash');
Route::get('/reporting', 'vendorcontroller@reporting');
Route::get('/favorites', 'vendorcontroller@favorites');

Route::Post('/delete-food', 'vendorcontroller@delete_food');
Route::get('/create-food', 'vendorcontroller@create_food');


//customer routes
Route::get('/my-orders/{id}', 'customercontroller@my_orders');
Route::get('/my-reporting/{id}', 'vendorcontroller@my_reporting');


//cart
Route::Post('/add-cart', 'vendorcontroller@addToCart');
Route::Post('/remove-cart', 'vendorcontroller@removeFromCart');

//don't delete, will be used later to fix route bug
/*
Route::get('/{vue_capture?}', function () {
    return view('welcome');
  })->where('vue_capture', '[\/\w\.-]*');
  */