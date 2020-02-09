<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use App\favourite;
use App\temp;
use App\User;
use App\rating;
use DB;

//mail
use Mail;
use App\Mail\CusOrders;


//resource
use App\Http\Resources\userresource as userres;
use App\Http\Resources\foodresource as foodres;
use App\Http\Resources\favresource as favres;
use App\Http\Resources\ratingresource as ratingres;

class guestcontroller extends Controller
{
    //method to get food list for customers to see and buy
    public function get_foods(){

        $food = food::orderby('id','desc')->select('id','amt','slug','qty','unit','title','img','vendor_id',
        'vendor_name','vendorAddress','delivery')->paginate(10);
        return foodres::collection($food);
    }

    public function offline_foods(){

      $food = food::orderby('id','desc')->select('id','amt','qty','unit','title','img','vendor_id',
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
        $save->delivery = $food->delivery;
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
  $food = food::orderby('id','desc')->where('slug','=',$vendor)
  ->select('id','amt','qty','title','img','unit','vendor_id','slug','vendor_name','vendorAddress','delivery')->paginate(5);

  return foodres::collection($food);
  }


  public function vendorList(){
    return $list = User::orderby('id','desc')->where('status','=',1)->where('verification','=',1)
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


public function get_my_surveys($userId){
  $surveys = rating::select('user_id','vendor_name','vendor_id')
  ->where('sent','=',1)->where('user_id','=',$userId)->where('rated','=',0)
  ->groupBy('user_id','vendor_name','vendor_id')->get();
  return ratingres::collection($surveys);
    }



    public function rateVendor(Request $request){
      $vendorId = $request->input('vendorId');
      $rating = $request->input('rating');
      $vendorName = $request->input('vendorName');

      //update rating  in user table
      $vendor = user::findorfail($vendorId);
      $vendor->rating = $vendor->rating + $rating;
      $vendor->raters = $vendor->raters + 1;
      $vendor->save();

      $sumRating = $vendor->rating;
      $frq = $vendor->raters;

      $result = $sumRating / $frq;

      $vendor->score = $result;
      $vendor->save();

      //get vendor Pid and push link - /vendor-reviews
      $vendorPId = $vendor->playerId;
      if($vendorPId){
           
        function sendMessage($vendorPId,$vendorName){
            $content = array(
          "en" => 'A customer just rated your services. Click to view'
                );
                $headings = array(
                    "en" => 'Hello '.$vendorName
                          );
            
            $fields = array(
                'app_id' => "da6349ad-e18f-471b-8d57-30444a9d158f",
                'include_player_ids' => array($vendorPId),
                'data' => array("foo" => "bar"),
                'url' => 'https://getfoods.ng/vendor-reviews/'.$vendorName,
                'contents' => $content,
                'headings' => $headings,
                'chrome_web_image' => 'https://getfoods.ng/images/push-images/survey.png',//512 or >
                'chrome_web_badge' => 'https://getfoods.ng/images/app-icons/app-icon-96x96.png'
            );
            
            $fields = json_encode($fields);
           // print("\nJSON sent:\n");
          //  print($fields);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
            $response = curl_exec($ch);
            curl_close($ch);
            
        return $response;
        
        }
        
        $response = sendMessage($vendorPId,$vendorName);
        $return["allresponses"] = $response;
        $return = json_encode( $return);
        
      //  print("\n\nJSON received:\n");
     //   print($return);
     // print("\n"); 
   }//if end


      //mark as rated, rather than delete
      //turn rated for all vendor ratings for that user to 1
      $rated = rating::where('vendor_id','=',$vendorId )->update(['rated' => 1]);
      return 1;
        }


        public function vendors($vendorName){

           //user selected all from drop down, fetch all
           if($vendorName == 'all'){
            $vendors = user::orderby('id','desc')->where('verification','=',1)->where('status','=',1)
          ->select('id','slug','score','name','email','address','phone')
          ->paginate(7);
          return userres::collection($vendors);
          }
          //selection made, fetch by vendorname
          if($vendorName != 'undefined'){
            $vendors = user::where('verification','=',1)->where('status','=',1)
            ->where('slug','=',$vendorName)
           ->select('id','slug','score','name','email','address','phone')
           ->paginate(7);
           return userres::collection($vendors);
          }

          //failsafe where $vendorName == undefined 
          $vendors = user::orderby('id','desc')->where('verification','=',1)->where('status','=',1)
          ->select('id','slug','score','name','email','address','phone')
          ->paginate(7);
          return userres::collection($vendors);
          }


}
