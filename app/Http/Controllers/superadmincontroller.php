<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\order;
use App\User;


//resource
use App\Http\Resources\userresource as userres;

class superadmincontroller extends Controller
{
    
    public function customer_count(){
        
        $customers = User::where('status', 0)->where('verification','=',1)->count(); //should be verified too
        return $customers;

    }

    public function vendor_count(){
       
        $vendors = User::where('status', 1)->where('verification','=',1)->count();
        return $vendors;
    }

    public function all_vendors(){
        
        //no need for andwhere, you can use multiple just 'where'
        $unverified_vendors = User::where('status', 1)->where('verification', 0)->paginate(5); 
        //return as collection resource for API use
        return userres::collection($unverified_vendors);
    }

    public function vendor_search($vendorname){
        
        //anwhere() kept failing, using just where()
        //for search, use 'LIKE' so that searching for 'chi', can fetch 'chiazor'
        $vendor = User::where('status', 1)->where('name','LIKE','%'.$vendorname.'%')
        ->where('verification', 0)->paginate(5);
       //return as collection resource for API use
       return userres::collection($vendor);
       
    }

    public function approve_vendor(Request $request){
        //get the id sent as a post 
        $vendorId = $request->input('id');

        $user = User::where('id', $vendorId)->update(array('verification' => 1));
            return 1;
       
    }

    public function decline_vendor(Request $request){
       //get the id sent as a post 
       $vendorId = $request->input('id');

       $user = User::where('id', $vendorId)->update(array('verification' => 2));
           return 1;

    }

    public function due_vendors(){
      // writing this one.
         $sevenDaysAgo = \carbon\carbon::now()->subDays(7);
         $now = \carbon\carbon::now();

      return   $rec= \DB::table('orders')
          ->select('vendorName', \DB::raw('sum(total) as total'))
          ->whereBetween('created_at',array($sevenDaysAgo,$now))
          ->groupBy('vendorName')->paginate(8);
         
     }


}
