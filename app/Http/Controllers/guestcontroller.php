<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;

//resource
use App\Http\Resources\foodresource as foodres;

class guestcontroller extends Controller
{
    public function get_foods(){
        return 8;
        $food = food::orderby('id','desc')->select('amt','qty','title','stock','image')->paginate(6);
        return foodres::collection($food);
    }
}
