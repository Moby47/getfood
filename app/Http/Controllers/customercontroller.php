<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\temp;
use DB;

//resource
use App\Http\Resources\orderresource as orderres;


class customercontroller extends Controller
{
  

   //view reporting based on date range  for customer
   public function my_reporting($userid, $from, $to){
    $rep =order::orderby('id','desc')->where('cusId','=',$userid)->select('id','amt','ref','title','address','delivery','created_at')
    ->whereBetween('created_at',array($from,$to))->paginate(4);

    return orderres::collection($rep);
    }


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
        ->select('id','amt','qty','ref','title','address','delivery','created_at')->paginate(3);
      //  $orderT = order::where('cusId','=',$userId)->select('amt')->sum('amt');

      // return $obj = ['orders' => $orders, 'orderT' => $orderT];

        return orderres::collection($orders);
      }

      
    public  function saveorder(Request $request){
      
//get temp data
$tempId = $request->input('tempId');
 $temp = temp::where('tempId','=',$tempId)->select('tempId','id','foodId','vendorId','qty','amt','foodName')->get();

//get checkout data
$cusId = $request->input('cusId');
$total = $request->input('total');
$ref = $request->input('ref');
$trans = $request->input('trans');
$add = $request->input('address');
$deli = $request->input('delivery');

//combine and save data to order table

$content = [];
foreach($temp as $t){
  $content[]= [
 'foodId'=> $t->foodId,
 'vendorId'=> $t->vendorId,
 'cusId'=> $cusId,
 'qty'=> $t->qty,
 'amt'=> $t->amt,
 'title'=> $t->foodName,
  'address' => $add,
  'delivery'=> $deli,
  'total'=> $total,
  'ref'=> $ref,
  'trans'=> $trans,
  'created_at'=> \Carbon\Carbon::now(),
  'updated_at'=> \Carbon\Carbon::now()
  ];
}
order::insert($content);

//clear my temp items
$ids = temp::where('tempId','=',$tempId)->select('id')->get()->toArray();
DB::table('temps')->whereIn('id', $ids)->delete();

return 1;
     }

     


}
