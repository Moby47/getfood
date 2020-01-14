<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use App\favourite;
use App\temp;
use App\user;
use DB;

//mail
use Mail;
use App\Mail\CusOrders;


//resource
use App\Http\Resources\foodresource as foodres;
use App\Http\Resources\favresource as favres;

class guestcontroller extends Controller
{
    //method to get food list for customers to see and buy
    public function get_foods(){

        $food = food::orderby('id','desc')->select('id','amt','qty','title','img','vendor_id',
        'vendor_name','vendorAddress','delivery')->paginate(10);
        return foodres::collection($food);
    }

    public function offline_foods(){

      $food = food::orderby('id','desc')->select('id','amt','qty','title','img','vendor_id',
      'vendor_name','vendorAddress')->paginate(20);
      return foodres::collection($food);
  }
   
    
public function addFavorite(Request $request){
    $userId = $request->input('userId');
    $foodId = $request->input('foodId');

      //check if user likes 6 already
      $count = favourite::where('cusId','=',$userId)->select('title')->count();
      if($count == 6){
          //maxed out
          return 2;
      }

    //check if user liked
    $like = favourite::where('cusId','=',$userId)->where('foodId','=',$foodId)->first();

    if($like){
        //you liked already
        return 0;
    }else{
        //like the food
      //No contraints, Add to fav
    $save = new favourite();
    $food = food::findorfail($foodId);
        $save->title = $food->title;
        $save->cusId = $userId;
        $save->foodId = $foodId;
        $save->amt = $food->amt;
        $save->qty = $food->qty;
        $save->img = $food->img;
        $save->vendor_name= $food->vendor_name;
        $save->vendorAddress= $food->vendorAddress;
        $save->save();
        return 1;
    }

}


public function removeFavorite(Request $request){
    $foodId = $request->input('foodId');
    $userId = $request->input('userId');

     $id = favourite::where('cusId','=',$userId)->where('foodId','=',$foodId)->pluck('id')->first();
    $del = favourite::findorfail($id);
    $del->delete();
    return 1;
}


public function getFavorites($id){
  $fav = favourite::orderby('id', 'desc')->where('cusId','=',$id)->select('id','foodId','title','amt','qty','img',
  'cusId','vendor_name','vendorAddress','delivery')->paginate(6);
    return favres::collection($fav);
}



public function removeFromFav(Request $request){
    //delete from table //food id for fav //Params: favid foodid . usercartid
   $favId = $request->input('favId');
   $fav = favourite::findorfail($favId);
     $fav->delete();

     //clear from cart if del from fav
     $userId = $request->input('userId');
     $foodId = $request->input('foodId');
     \Cart::session($userId)->remove($foodId);

     return 1;
  }


  //add fav to cart 
public function favAddToCart(Request $request){

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
$ok->save();
}


return '200 ok';

 /* return $request;
	//expected params, user id and food id and qty
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

if($foodId == \Cart::get($foodId)->id){
  \Cart::session($userId)->update($foodId,array(
    'quantity'=> array(
      'relative'=>false,
      'value'=>$qty )
  ));
}

  return 1;
  */
}


//remove from fav from cart
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





public function vendorFood($vendor){
  $food = food::orderby('id','desc')->where('vendor_name','=',$vendor)
  ->select('id','amt','qty','title','img','vendor_id','vendor_name','vendorAddress')->paginate(5);

  return foodres::collection($food);
  }


  public function vendorList(){
    return $list = user::orderby('id','desc')->where('status','=',1)
    ->select('id','name','address')->get()->toArray();
    /*
    return $fav = DB::table('foods')
    ->select('vendor_name', DB::raw('count(*) as total'))
    ->groupBy('vendor_name')->get();
*/
    }

   /* public function vendorListHome(){
      return $list = user::orderby('id','desc')->where('status','=',1)
      ->select('id','name','address')->paginate(5)->toArray();
      }
*/

public function playerId(Request $request){

    $playerId = $request->input('peter');
    $userId = $request->input('parker');

    if(!$userId){
      return 'no parker';
    }
    if(!$playerId){
      return 'no peter';
    }
    $user = user::findorfail($userId);

    $user->playerId = $playerId;
    $user->save();

    return 1;

  }

/*
  public function getPlayerId($id){
return $id;
    $playerId = $request->input('peter');
    $userId = $request->input('parker');

    if(!$userId){
      return 'no parker';
    }
    if(!$playerId){
      return 'no peter';
    }
    $user = user::findorfail($userId);

    $user->playerId = $playerId;
    $user->save();

    return 1;

  }
*/

}
