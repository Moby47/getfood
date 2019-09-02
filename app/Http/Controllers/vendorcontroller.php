<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;

class vendorcontroller extends Controller
{
    public function create_food(Request $request){
        $save = new food();
        $save->title = $request->input('title');
        $save->qty = $request->input('qty');
        $save->amt = $request->input('amt');
        $save->stock = 1;
        //img
        $save->save();
        return 1;
    }
}
