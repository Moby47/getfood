<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;

//Api resource
use App\Http\Resources\cartresource as cartres;

class cartcontroller extends Controller
{
    
    
//add to cart 
public function addToCart(Request $request){

	//expected params, user id and food id
$userId = 5;//$request->input('id'); //rand and local

//return $request;
// add to cart for a specific user

\Cart::session($userId)->add(array(
    'id' => $request->input('id'),
    'name' => $request->input('title'),
    'price' => $request->input('amt'),
    'quantity' => $request->input('qty'),
    "attributes"=> ['image' => $request->input('img')],
	
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


// Getting cart's contents for a specific user
public function cartItems(){
   // $userId = $request->input('userId');
   //userid = 5
   //foodid = 9
    $cart = \Cart::session(5)->getContent(9);
    return cartres::collection($cart);
  // $cart = Cart::session($userId)->getContent($itemId);
    //$cartCollection->count();
    }


}
