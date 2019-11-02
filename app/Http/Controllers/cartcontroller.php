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

//required params to add to cart for a specific user
$qty = $request->input('qty');
$total = $qty * $food->amt;

//check remaining qty
if($food->qty < $qty){
  return $food->qty;
}

\Cart::session($userId)->add(array(
    'id' => $food->id,
    'name' => $food->title,
    'price' => $food->amt,
    'quantity' => $qty,
    "attributes"=> ['image' => $food->img, 'total'=> $total],
	
));

if($foodId == \Cart::get($foodId)->id){
  \Cart::session($userId)->update($foodId,array(
    'quantity'=> array(
      'relative'=>false,
      'value'=>$qty )
  ));
}

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
public function cartItems($id){
   
    $cart = \Cart::session($id)->getContent();
    return cartres::collection($cart);
    }



    public function increaseQty(Request $request){
      $userId = $request->input('userId'); //rand and local
      $foodId = $request->input('foodId');
      $food=food::findorfail($foodId);
     

      //increament quantity (update)
      \Cart::session($userId)->update($foodId,array(
        'quantity'=> 1,
      ));

      //get total
      $total = \Cart::get($foodId)->getPriceSum();

      //update total
      \Cart::session($userId)->update($foodId,array(
           "attributes"=> ['image' => $food->img,'total'=> $total]
        ));
        //return latest quantity
        return array('qty'=>\Cart::get($foodId)->quantity, 'subtotal'=>\Cart::get($foodId)->attributes->total);
      }



      public function decreaseQty(Request $request){
        $userId = $request->input('userId'); //rand and local
        $foodId = $request->input('foodId');
        $food=food::findorfail($foodId);
       
        //increament quantity (update)
        \Cart::session($userId)->update($foodId,array(
          'quantity'=> -1,
        ));
  
        //get total
        $total = \Cart::get($foodId)->getPriceSum();
  
        //update total
        \Cart::session($userId)->update($foodId,array(
             "attributes"=> ['image' => $food->img,'total'=> $total]
          ));
          //return latest quantity
          return array('qty'=>\Cart::get($foodId)->quantity, 'subtotal'=>\Cart::get($foodId)->attributes->total);
        }


        public function cartCount($id){
          $cart = \Cart::session($id)->getContent();
          return $cart->count();
          }



          public function checkout($id){
            $cart = \Cart::session($id)->getContent();
            return cartres::collection($cart);
            }


            public function sumtotal($id){
              return \Cart::session($id)->getTotal();
              }


              public function clearcart(Request $request){
                \Cart::clear();
                \Cart::session($request->input('userId'))->clear();
               return 1;
                }
              


}
