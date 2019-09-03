<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;

//resource
use App\Http\Resources\orderresource as orderres;


class customercontroller extends Controller
{
     //method to show customer's orders
     public function my_orders($id){
        $id =47;
        $orders = order::orderby('id','desc')->where('cusId','=',$id)->select('amt','qty','title')->paginate(6);
        return orderres::collection($orders);
    }
}
