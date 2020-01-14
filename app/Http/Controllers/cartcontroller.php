<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use App\temp;
use DB;

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
    "attributes"=> ['image' => $food->img, 'total'=> $total, 'vendor_id'=> $food->vendor_id],
	
));

if($foodId == \Cart::get($foodId)->id){
  \Cart::session($userId)->update($foodId,array(
    'quantity'=> array(
      'relative'=>false,
      'value'=>$qty )
  ));
}

//check if exist
$ok = temp::where('tempId','=',$userId)->where('foodId','=',$foodId)->select('id')->get()->first();

if($ok){
  //update
  $ok->tempId = $userId;
  $ok->vendorId = $food->vendor_id;
  $ok->vendorName = $food->vendor_name;
  $ok->foodId = $foodId;
  $ok->foodName = $food->title;
  $ok->amt = $food->amt;
  $ok->qty = $qty;
  $ok->save();

}else{
  //save new
  $ok = new temp;

$ok->tempId = $userId;
$ok->vendorId = $food->vendor_id;
$ok->vendorName = $food->vendor_name;
$ok->foodId = $foodId;
$ok->foodName = $food->title;
$ok->amt = $food->amt;
$ok->qty = $qty;
$ok->phone = $food->phone;
$ok->save();
}


//return latest quantity
return array('ok'=>'200 ok','qty'=>\Cart::get($foodId)->quantity, 'subtotal'=>\Cart::get($foodId)->attributes->total);
	
}


//remove from cart
public function removeFromCart(Request $request){
// removing cart item for a specific user's cart
//expected params, user id and food id
$userId = $request->input('userId'); //rand and local
 $foodId = $request->input('foodId');

\Cart::session($userId)->remove($foodId);

//clear my temp items
$del = temp::where('tempId','=',$userId)->where('foodId','=',$foodId)
->select('tempId','id','foodId')->get()->first();
$kill = temp::findorfail($del->id);
$kill->delete();

return 1;
}


// Getting cart's contents for a specific user
public function cartItems($id){
   
    $cart = \Cart::session($id)->getContent();
    return cartres::collection($cart);
    }


/*
    public function increaseQty(Request $request){
      $userId = $request->input('userId'); //rand and local
      $foodId = $request->input('foodId');
      

    $food=food::findorfail($foodId);

  //  $qty = 1;
   // $totalQty = $food->qty + $qty;

//check remaining qty
//if($food->qty < $qty){
 // return $food->qty;
//}

      //increament quantity (update)
      \Cart::session($userId)->update($foodId,array(
        'quantity'=> 1,
      ));

      //get total
      $total = \Cart::get($foodId)->getPriceSum();
     
      //get updated qty from session
      $qty = \Cart::get($foodId)->quantity; 

      //update total
      \Cart::session($userId)->update($foodId,array(
           "attributes"=> ['image' => $food->img,'total'=> $total]
        ));

        //check if exist
$ok = temp::where('tempId','=',$userId)->where('foodId','=',$foodId)->select('id')->get()->first();

if($ok){
  //update
  $ok->tempId = $userId;
  $ok->vendorId = $food->vendor_id;
  $ok->vendorName = $food->vendor_name;
  $ok->foodId = $food->id;
  $ok->foodName = $food->title;
  $ok->amt = $food->amt;
  $ok->qty = $qty;
  $ok->save();

}else{
  //save new
  $ok = new temp;

$ok->tempId = $userId;
$ok->vendorId = $food->vendor_id;
$ok->foodId = $food->id;
$ok->foodName = $food->title;
$ok->amt = $food->amt;
$ok->qty = $qty;
$ok->save();
}

        //return latest quantity
        return array('qty'=>\Cart::get($foodId)->quantity, 'subtotal'=>\Cart::get($foodId)->attributes->total);
      }
*/

/*
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
  
          //get updated qty from session
      $qty = \Cart::get($foodId)->quantity; 
      
        //update total
        \Cart::session($userId)->update($foodId,array(
             "attributes"=> ['image' => $food->img,'total'=> $total]
          ));

           //check if exist
$ok = temp::where('tempId','=',$userId)->where('foodId','=',$foodId)->select('id')->get()->first();

if($ok){
  //update
  $ok->tempId = $userId;
  $ok->vendorId = $food->vendor_id;
  $ok->vendorName = $food->vendor_name;
  $ok->foodId = $food->id;
  $ok->foodName = $food->title;
  $ok->amt = $food->amt;
  $ok->qty = $qty;
  $ok->save();

}else{
  //save new
  $ok = new temp;

$ok->tempId = $userId;
$ok->vendorId = $food->vendor_id;
$ok->vendorName = $food->vendor_name;
$ok->foodId = $food->id;
$ok->foodName = $food->title;
$ok->amt = $food->amt;
$ok->qty = $qty;
$ok->save();
}

          //return latest quantity
          return array('qty'=>\Cart::get($foodId)->quantity, 'subtotal'=>\Cart::get($foodId)->attributes->total);
        }
*/
//receives tempuserID
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

                //clear my temp items
            $ids = temp::where('tempId','=',$request->input('userId'))->select('id')->get()->toArray();
            DB::table('temps')->whereIn('id', $ids)->delete();

               return 1;
                }
              



}
