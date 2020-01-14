<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\temp;
use App\food;
use App\User;
use DB;

//mail
use Mail;
use App\Mail\CusOrders;
use App\Mail\VenOrders;

//resource
use App\Http\Resources\orderresource as orderres;


class customercontroller extends Controller
{
  

  


    public  function weekly_ex($userId){
       
        $start = \carbon\carbon::now()->subDays(7);
        $now =  $expiration  = \carbon\carbon::now();
      return $rec = order::select('amt')->where('cusId','=',$userId)->whereBetween('created_at',array($start,$now))->sum('amt');
    }

    public  function monthly_ex($userId){
     
        $start = \carbon\carbon::now()->subMonth();
        $now =  $expiration  = \carbon\carbon::now();
      return $rec = order::select('amt')->where('cusId','=',$userId)->whereBetween('created_at',array($start,$now))->sum('amt');
    }

    public  function total_ex($userId){
      
      return $rec = order::select('amt')->where('cusId','=',$userId)->sum('amt');
    }


    public  function orders($userId){
      
        $orders = order::orderby('id','desc')->where('cusId','=',$userId)
        ->select('id','amt','qty','total','ref','title','confirmation','address','phone','delivery','created_at')->paginate(5);
      //  $orderT = order::where('cusId','=',$userId)->select('amt')->sum('amt');

      // return $obj = ['orders' => $orders, 'orderT' => $orderT];

        return orderres::collection($orders);
      }

       //view reporting based on date range  for customer
   public function my_reporting($userid, $from, $to){
    $rep =order::orderby('id','desc')->where('cusId','=',$userid)
    ->select('id','amt','qty','total','ref','title','address','confirmation','phone','delivery','created_at')
    ->whereBetween('created_at',array($from,$to))->paginate(5);

    return orderres::collection($rep);
    }


    public  function saveorder(Request $request){
    
//get temp data
$tempId = $request->input('tempId');
 $temp = temp::where('tempId','=',$tempId)->select('tempId','id','foodId','vendorName','vendorId',
 'qty','amt','foodName','phone')->get();

//get checkout data

$cusId = $request->input('cusId');
$total = $request->input('total');
$ref = $request->input('ref');
$trans = $request->input('trans');
$add = $request->input('address');
$deli = $request->input('delivery');
$cusName = $request->input('userName');


//combine and save data to order table

$content = [];
foreach($temp as $t){
  $content[]= [
 'foodId'=> $t->foodId,
 'vendorId'=> $t->vendorId,
 'vendorName'=> $t->vendorName,
 'cusName'=> $cusName,
 'cusId'=> $cusId,
 'qty'=> $t->qty,
 'amt'=> $t->amt,
 'title'=> $t->foodName,
  'address' => $add,
  'phone' => $t->phone,
  'delivery'=> $deli,
  'total'=> $t->amt * $t->qty,
  'ref'=> $ref,
  'trans'=> $trans,
  'created_at'=> \Carbon\Carbon::now(),
  'updated_at'=> \Carbon\Carbon::now()
  ];
}
order::insert($content);

//update food qty 
$tempFood= temp::where('tempId','=',$tempId)->select('foodId','qty')->get();
foreach($tempFood as $t){
  $updateFood = food::where('id','=',$t->foodId)->select('id','qty')->get();
  foreach($updateFood as $f){
    $f->qty =  $f->qty - $t->qty;
    $f->save();
  }
}

//email  to check  orders
try{
  Mail::to($request->input('userMail'))->send(new CusOrders());  
  
 session(['customerMail' => $request->input('userMail')]);

  //get ven id array
    $arr = temp::where('tempId','=',$tempId)->select('vendorId')->pluck('vendorId');
     //get ven email by the array of id
     $admins = user::where('status','=',1)->whereIn('id', $arr)->select('email')->get();
       //loop through emails and send  email to vens
       foreach($admins as $admin){
  Mail::to($admin->email)->send(new VenOrders());
         }

    }
       catch(\Exception $e){
  return 'backend error occured';
   }


return 1;
     }


     public function cleartempData(Request $request){
//clear my temp items  
$ids = temp::where('tempId','=',$request->input('userId'))->select('id')->get()->toArray();
DB::table('temps')->whereIn('id', $ids)->delete();
return 1;
     }


 public function pushToVendors(Request $request){

//get temp data
   $tempId = $request->input('tempId');
  //get ven id array
   $arr = temp::where('tempId','=',$tempId)->select('vendorId','tempId')->pluck('vendorId');
  //get ven player idemail by the array of id
  return $vendorPId = user::where('status','=',1)->whereIn('id', $arr)->pluck('playerId')->toArray();


     } //meth end


public function approve_col(Request $request){

   $orders = order::findorfail($request->input('orderId'));
   $orders ->confirmation = 1;
   $orders->save();
   return 1;
}

}
