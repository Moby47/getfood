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
        ->where('verification', 0)->get();
       //return as collection resource for API use
       return userres::collection($vendor);
       
    }

    public function approve_vendor(Request $request){
        //get the id sent as a post 
        $vendorId = $request->input('id');

        $user = User::where('id', $vendorId)->update(array('verification' => 1));

        //get Pid and push
        $vendorPId = user::where('status','=',1)->where('id', $vendorId)->pluck('playerId')->toArray();
        $vendorName = user::where('status','=',1)->where('id', $vendorId)->first()->name;

       if($vendorPId){
           
            function sendMessage($vendorPId,$vendorName){
                $content = array(
              "en" => 'Your account on GetFoods was approved! Login now'
                    );
                    $headings = array(
                        "en" => 'Hello '.$vendorName
                              );
                
                $fields = array(
                    'app_id' => "da6349ad-e18f-471b-8d57-30444a9d158f",
                    'include_player_ids' => $vendorPId,
                    'data' => array("foo" => "bar"),
                    'url' => 'http://localhost:8000/user-login',
                    'contents' => $content,
                    'headings' => $headings,
                   'chrome_web_image' => 'http://localhost:8000/images/push-images/approve.png',//512 or >
                   'chrome_web_badge' => 'http://localhost:8000/images/app-icons/app-icon-96x96.png'
                );
                
                $fields = json_encode($fields);
               // print("\nJSON sent:\n");
              //  print($fields);
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
                $response = curl_exec($ch);
                curl_close($ch);
                
            return $response;
            
            }
            
            $response = sendMessage($vendorPId,$vendorName);
            $return["allresponses"] = $response;
            $return = json_encode( $return);
            
          //  print("\n\nJSON received:\n");
         //   print($return);
         // print("\n"); 
       }//if end
           
          
            return 1;
       
    }

    public function decline_vendor(Request $request){
       //get the id sent as a post 
       $vendorId = $request->input('id');

       $user = User::where('id', $vendorId)->update(array('verification' => 2));

        //get Pid and push
        $vendorPId = user::where('status','=',1)->where('id', $vendorId)->pluck('playerId')->toArray();
        $vendorName = user::where('status','=',1)->where('id', $vendorId)->first()->name;

       if($vendorPId){
           
            function sendMessage($vendorPId,$vendorName){
                $content = array(
              "en" => 'Your account on GetFoods was declined! Please contact us'
                    );
                    $headings = array(
                        "en" => 'Hello '.$vendorName
                              );
                
                $fields = array(
                    'app_id' => "da6349ad-e18f-471b-8d57-30444a9d158f",
                    'include_player_ids' => $vendorPId,
                    'data' => array("foo" => "bar"),
                    'url' => 'http://localhost:8000',
                    'contents' => $content,
                    'headings' => $headings,
                    'chrome_web_image' => 'http://localhost:8000/images/push-images/decline.png',//512 or >
                    'chrome_web_badge' => 'http://localhost:8000/images/app-icons/app-icon-96x96.png'
                );
                
                $fields = json_encode($fields);
               // print("\nJSON sent:\n");
              //  print($fields);
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
                $response = curl_exec($ch);
                curl_close($ch);
                
            return $response;
            
            }
            
            $response = sendMessage($vendorPId,$vendorName);
            $return["allresponses"] = $response;
            $return = json_encode( $return);
            
          //  print("\n\nJSON received:\n");
         //   print($return);
         // print("\n"); 
       }//if end
           
           return 1;

    }

    public function due_vendors(){
      // writing this one.

      /*code to show the exact money a vendor should be paid after 7days (1wk)
      we pay them weekly, paystack pays us daily*/
        
         $sevenDaysAgo = \carbon\carbon::now()->subDays(7);
         $now = \carbon\carbon::now();

      return   $rec= \DB::table('orders')
          ->select('vendorName', \DB::raw('sum(total) as total'))
          ->whereBetween('created_at',array($sevenDaysAgo,$now))
          ->groupBy('vendorName')->paginate(8);
         
     }


}
