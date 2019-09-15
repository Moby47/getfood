<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use App\order;
use DB;

//Api resource
use App\Http\Resources\foodresource as foodres;
use App\Http\Resources\orderresource as orderres;
use App\Http\Resources\favresource as favres;

class vendorcontroller extends Controller
{
    //vendor create food record
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
            return $cash = order::select('amt')->sum('amt');
            }



            //view reporting based on date range 
            public function reporting(Request $request){
                $from = date('2018-01-01'); //$from = $request->input('from');
                $to = date('2018-05-02');   //$to = $request->input('to');
                $rep =order::whereBetween('amt', [$from, $to])->get();
                return orderres::collection($rep);
                }
               
                
                //see customer favorite food
                public function favorites(){

              return $fav = DB::table('favourites')
                    ->select('title', DB::raw('count(*) as total'))
                    ->groupBy('title')->get();
                    return favres::collection($fav);
                    
                }
                
                
                public function delete_food(Request $request){
                    $data = findorfail($request->input('id'));
                    $date->delete();
                    return 1;
                }
                

}//class end