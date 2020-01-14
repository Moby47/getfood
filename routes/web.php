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
//laravel auth routes # carries default url for auth modules (reset password etc)
Auth::routes();

//Route::get('/forgot-password', 'customauthcontroller@password');

//initial page load
Route::get('/', function () {
    return view('welcome');
});



//Auth routes
Route::get('/forgot-password', 'customauthcontroller@password');
Route::Post('/login-user', 'customauthcontroller@login');
Route::Post('/register-user', 'customauthcontroller@reg');
Route::get('/verify/{crypt}', 'customauthcontroller@verify');
Route::Post('/resend-veri', 'customauthcontroller@resend');

//guest routes
Route::Post('/add-to-cart', 'cartcontroller@addToCart');
//Route::Post('/increase-qty', 'cartcontroller@increaseQty');
//Route::Post('/decrease-qty', 'cartcontroller@decreaseQty');
Route::Post('/remove-from-cart', 'cartcontroller@removeFromCart');
Route::Post('/add-favorite', 'guestcontroller@addFavorite');
Route::Post('/remove-favorite', 'guestcontroller@removeFavorite');
Route::Post('/remove-from-fav', 'guestcontroller@removeFromFav');

Route::Post('/remove-fav-from-cart', 'guestcontroller@removeFromCart');
Route::Post('/add-fav-to-cart', 'guestcontroller@favAddToCart');

Route::get('/cart-items/{id}', 'cartcontroller@cartItems');
Route::get('/get-foods', 'guestcontroller@get_foods');
Route::get('/offline-foods', 'guestcontroller@offline_foods');
Route::get('/cartCount/{id}', 'cartcontroller@cartCount');
Route::get('/checkout/{id}', 'cartcontroller@checkout');
Route::get('/sumtotal/{id}', 'cartcontroller@sumtotal');
Route::get('/get-fav/{id}', 'guestcontroller@getFavorites');
Route::get('/vendor-food/{vendor}', 'guestcontroller@vendorFood');
Route::get('/vendor-list', 'guestcontroller@vendorList');

Route::post('/player-id','guestcontroller@playerId');
Route::get('/get-player-id/{id}','guestcontroller@getPlayerId');

//vendor list for home
//Route::get('/vendor-list-home', 'guestcontroller@vendorListHome');

//vendor routes
Route::get('/get-orders', 'vendorcontroller@get_orders');
Route::get('/total-cash', 'vendorcontroller@total_cash');
Route::get('/reporting', 'vendorcontroller@reporting');
Route::get('/favorites', 'vendorcontroller@favorites');

Route::get('/weekly-ex-vendor/{userId}', 'vendorcontroller@weekly_ex_vendor');
Route::get('/monthly-ex-vendor/{userId}', 'vendorcontroller@monthly_ex_vendor');
Route::get('/total-ex-vendor/{userId}', 'vendorcontroller@total_ex_vendor');
Route::get('/vendor-reporting/{userid}/{from}/{to}', 'vendorcontroller@vendor_reporting');
Route::get('/vendor-orders/{userId}', 'vendorcontroller@vendor_orders');
Route::get('/vendor-food-list/{userId}', 'vendorcontroller@vendor_food');
Route::get('/vendor-favorites/{userName}', 'vendorcontroller@vendor_favorites');
Route::get('/order-ref/{ref}/{userid}', 'vendorcontroller@order_ref');

Route::Post('/delete-food', 'vendorcontroller@delete_food');
Route::post('/edit-food', 'vendorcontroller@edit_food');
Route::Post('/new-food', 'vendorcontroller@new_food');


//customer routes
//Route::get('/my-orders', 'customercontroller@my_orders');
Route::get('/my-reporting/{userid}/{from}/{to}', 'customercontroller@my_reporting');
///{id}
Route::get('/weekly-ex/{userId}', 'customercontroller@weekly_ex');
Route::get('/monthly-ex/{userId}', 'customercontroller@monthly_ex');
Route::get('/total-ex/{userId}', 'customercontroller@total_ex');
Route::get('/orders/{userId}', 'customercontroller@orders');

Route::post('/save-order', 'customercontroller@saveorder'); 
Route::post('/clear-cart', 'cartcontroller@clearcart');
Route::post('/push-to-vendors', 'customercontroller@pushToVendors'); 
Route::post('/clear-temp', 'customercontroller@clearTempData'); 
Route::post('/approve-collection', 'customercontroller@approve_col'); 


//Super admin routes
Route::get('/customer-count', 'superadmincontroller@customer_count');
Route::get('/vendor-count', 'superadmincontroller@vendor_count');

Route::get('/all-vendors', 'superadmincontroller@all_vendors');
Route::get('/vendor-search/{vendorname}', 'superadmincontroller@vendor_search');
Route::post('/approve-vendor', 'superadmincontroller@approve_vendor');
Route::post('/decline-vendor', 'superadmincontroller@decline_vendor');
Route::get('/due-vendors', 'superadmincontroller@due_vendors');


//don't delete,fixes route bug
Route::get('/{vue_capture?}', function () {
    return view('welcome');
  })->where('vue_capture', '[\/\w\.-]*');
Auth::routes();


//Route::POST('/test-sync', 'guestcontroller@test');