<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use App\favourite;

//resource
use App\Http\Resources\foodresource as foodres;

class guestcontroller extends Controller
{
    //method to get food list for customers to see and buy
    public function get_foods(){
        $food = food::orderby('id','desc')->select('id','amt','qty','title','stock','img')->paginate(3);
        return foodres::collection($food);
    }

   
    
public function addFavorite(Request $request){
    $userId = $request->input('userId');
    $foodId = $request->input('foodId');

      //check if user likes 3 already
      $count = favourite::where('cusId','=',$userId)->select('title')->count();
      if($count == 39){
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

}
