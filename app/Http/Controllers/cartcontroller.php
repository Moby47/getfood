<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cartcontroller extends Controller
{
    
    
//add to cart 
public function addToCart(Request $request){

	//expected params, user id and food id
$userId = $request->input('id');
$foodId =  $request->input('id');

//fetch food details
$food = food::findorfail($foodId);

// add to cart for a specific user

Cart::session($userId)->add(array(
    'id' => $food->id,
    'name' => $food->names,
    'price' => $food->price,
    'quantity' => $food->quantity,
	'image' => $food->image
));
	return 1;
}


//remove from cart
public function removeFromCart(Request $request){
// removing cart item for a specific user's cart
//expected params, user id and food id
$userId = $request->input('id');
$foodId =  $request->input('id');

Cart::session($userId)->remove($foodId);

return 1;
}



}
