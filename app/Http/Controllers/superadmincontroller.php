<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\order;
use App\User;
use App\rating;

//mail
use Mail;
use App\Mail\Approve;
use App\Mail\Decline;
use App\Mail\Survey;

//resource
use App\Http\Resources\userresource as userres;
use App\Http\Resources\ratingresource as ratingres;

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
                    'url' => 'https://testing.henrymoby.tech/user-signin',
                    'contents' => $content,
                    'headings' => $headings,
                   'chrome_web_image' => 'https://testing.henrymoby.tech/images/push-images/approve.png',//512 or >
                   'chrome_web_badge' => 'https://testing.henrymoby.tech/images/app-icons/app-icon-96x96.png'
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
           
       //email vendor on approval
       try{
           $vendorEmail = user::where('id','=',$vendorId)->pluck('email')->first();
         Mail::to($vendorEmail)->send(new Approve());  
           }
              catch(\Exception $e){
         return 0;
          }
          

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
                    'url' => 'https://testing.henrymoby.tech/',
                    'contents' => $content,
                    'headings' => $headings,
                    'chrome_web_image' => 'https://testing.henrymoby.tech/images/push-images/decline.png',//512 or >
                    'chrome_web_badge' => 'https://testing.henrymoby.tech/images/app-icons/app-icon-96x96.png'
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
            //email vendor on approval
       try{
        $vendorEmail = user::where('id','=',$vendorId)->pluck('email')->first();
      Mail::to($vendorEmail)->send(new Decline());  
        }
           catch(\Exception $e){
      return 0;
       }

           return 1;

    }

    public function due_vendors(){
      // writing this one.

      /*code to show the exact money a vendor should be paid daily (1day)
      we pay them daily, paystack pays us daily*/
        
         $oneDaysAgo = \carbon\carbon::now()->subDays(1);
         $now = \carbon\carbon::now();

      return   $rec= \DB::table('orders')
          ->select('vendorName', \DB::raw('sum(total) as total'))
          ->whereBetween('created_at',array($oneDaysAgo,$now))
          ->groupBy('vendorName')->paginate(8);
         
     }


     public function get_surveys(){
     $surveys = rating::select('user_id','user_email','vendor_name','vendor_id','created_at')->paginate(5);
     return ratingres::collection($surveys);
     }


     public function send_survey(Request $request){
       $userId = $request->input('userId');
       $userEmail = $request->input('userEmail');

       //get user pId for push later
      $pId = user::where('id','=',$userId)->pluck('playerId')->toArray();

      //send the email ** /my-survey/userId
      session(['userId' => $userId]);
      try{
      Mail::to($userEmail)->send(new Survey());  
        }
           catch(\Exception $e){
      return 0;
       }

      //send the push
      if($pId){
            function sendMessage($pId, $userId){
                $content = array(
              "en" => 'Please click to rate vendors on GetFoods'
                    );
                    $headings = array(
                        "en" => 'Hello'
                              );
                
                $fields = array(
                    'app_id' => "da6349ad-e18f-471b-8d57-30444a9d158f",
                    'include_player_ids' => $pId,
                    'data' => array("foo" => "bar"),
                    'url' => 'https://testing.henrymoby.tech/my-surveys/'.$userId,
                    'contents' => $content,
                    'headings' => $headings,
                    'chrome_web_image' => 'https://testing.henrymoby.tech/images/push-images/survey.png',//512 or >
                    'chrome_web_badge' => 'https://testing.henrymoby.tech/images/app-icons/app-icon-96x96.png'
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
            
            $response = sendMessage($pId, $userId);
            $return["allresponses"] = $response;
            $return = json_encode( $return);
            
          //  print("\n\nJSON received:\n");
         //   print($return);
         // print("\n"); 
       }//if end


      //turn sent for all ratings for that user to 1
       
      
      return 1;
      }



}
