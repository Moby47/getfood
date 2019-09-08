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

//guest routes
Route::Post('/add-to-cart', 'cartcontroller@addToCart');
Route::Post('/remove-from-cart', 'cartcontroller@removeFromCart');
Route::get('/cart-items', 'cartcontroller@cartItems');
Route::Post('/add-favorite', 'guestcontroller@addFavorite');
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




//don't delete, will be used later to fix route bug
/*
Route::get('/{vue_capture?}', function () {
    return view('welcome');
  })->where('vue_capture', '[\/\w\.-]*');
  */