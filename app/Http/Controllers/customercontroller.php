<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;

//resource
use App\Http\Resources\orderresource as orderres;


class customercontroller extends Controller
{
     //method to show a customer his/her orders
     public function my_orders($id){
        $orders = order::orderby('id','desc')->where('cusId','=',$id)->select('amt','qty','title')->paginate(6);
        return orderres::collection($orders);
    }

   //view reporting based on date range  for customer
   public function my_reporting(Request $request){
    $from = date('2018-01-01'); //$from = $request->input('from');
    $to = date('2018-05-02');   //$to = $request->input('to');
    $rep =order::whereBetween('amt', [$from, $to])->get();
    return orderres::collection($rep);
    }

}
