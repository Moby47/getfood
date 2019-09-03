<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use App\order;

//resource
use App\Http\Resources\foodresource as foodres;
use App\Http\Resources\orderresource as orderres;

class vendorcontroller extends Controller
{
    //vendor create food
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


    //vendor to view orders made
    public function get_orders(){
        $orders = order::orderby('id','desc')->select('amt','qty','title')->paginate(6);
        return orderres::collection($orders);
        }
        //see only daily orders



        //view total cash
        public function total_cash(){
            $cash = order::select('amt')->sum('amt')->get();
            return orderres::collection($cash);
            }



            //view daily total cash
            public function daily_cash(){
             //   $dailycash = order::select('amt''created_at')where('created_at', '<', 'now+7days')->sum('amt')->get();
                return orderres::collection($dailycash);
                }
                
                
                
           //view monthly total cash     
                public function monthly_cash(){
               // $monthlycash = order::select('amt','created_at')where('created_at', '<', 'now+31days')->sum('amt')->get();
               return orderres::collection($monthlycash);
                }
                
                
                
                
                public function favorites(){
                //$fav =  favorite::select //list a title and count occurance.
                //return favres::collection($fav);
                }
                
                
                
                
                public function delete_food(Request $request){
                    $data = findorfail($request->input('id'));
                    $date->delete();
                    return 1;
                }
                

}//class end
