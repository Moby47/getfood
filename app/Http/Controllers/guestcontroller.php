<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;

//resource
use App\Http\Resources\foodresource as foodres;

class guestcontroller extends Controller
{
    //method to get food list for customers to see and buy
    public function get_foods(){
        $food = food::orderby('id','desc')->select('amt','qty','title','stock','image')->paginate(6);
        return foodres::collection($food);
    }

   
}
