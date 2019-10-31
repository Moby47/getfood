<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;

//resource
use App\Http\Resources\orderresource as orderres;


class customercontroller extends Controller
{
  

   //view reporting based on date range  for customer
   public function my_reporting(Request $request){
    $userId = $request->input('userId');
    $from = $request->input('from'); 
    $to = $request->input('to');   

    $rep =order::orderby('id','desc')->where('cusId','=',$userId)->select('id','amt','qty','title','created_at')
    ->whereBetween('created_at',array($from,$to))->get();

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
      
        $orders = order::orderby('id','desc')->where('cusId','=',$userId)->select('id','amt','qty','title','created_at')->paginate(3);
        $orderT = order::where('cusId','=',$userId)->select('amt')->sum('amt');

      // return $obj = ['orders' => $orders, 'orderT' => $orderT];

        return orderres::collection($orders);
      }

      
    public  function saveorder(Request $request){
      
      $content = $request->input('content');
       //return $request->input('cusId');

       foreach($content as $con){
         return $con->data;
       }

     }

}
