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
Route::get('/daily-cash', 'vendorcontroller@daily_cash');
Route::get('/monthly-cash', 'vendorcontroller@monthly_cash');
Route::get('/favorites', 'vendorcontroller@favorites');

Route::Post('/delete-food', 'vendorcontroller@delete_food');


//customer routes
Route::get('/my-orders/{id}', 'customercontroller@my_orders');