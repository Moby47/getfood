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
$userId = $request->input('userId'); //rand and local
$foodId = $request->input('foodId');
$food=food::findorfail($foodId);
// add to cart for a specific user
$qty = $request->input('qty');
$total = $qty * $food->amt;

\Cart::session($userId)->add(array(
    'id' => $food->id,
    'name' => $food->title,
    'price' => $food->amt,
    'quantity' => $qty,
    "attributes"=> ['image' => $food->img, 'total'=> $total],
	
));
	return 1;
}


//remove from cart
public function removeFromCart(Request $request){
// removing cart item for a specific user's cart
//expected params, user id and food id
$userId = $request->input('userId'); //rand and local
$foodId = $request->input('foodId');

\Cart::session($userId)->remove($foodId);

return 1;
}


// Getting cart's contents for a specific user
public function cartItems(){
   // $userId = $request->input('userId');
   //userid = 5
   //foodid = 9
    $cart = \Cart::session(3511)->getContent();
    return cartres::collection($cart);
  // $cart = Cart::session($userId)->getContent($itemId);
    //$cartCollection->count();
    }


}
