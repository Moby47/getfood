<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Support\Str;

//mail
use Mail;
use App\Mail\Verify;
use App\Mail\Welcome;

class customauthcontroller extends Controller
{
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:6', //|confirmed
        ]);
        $cre = $request->only('email','password');

        if(!$token=JWTAuth::attempt($cre)){
            return ['result'=>'2']; //invalid cre
        }

        $user = User::where('email','=',$request->email)->first();
        
        if($user->verification == 0){
            //not verified
            return ['result'=>'1']; //not verified
        }

        if($user->verification == 2){
            //acct declined
            return ['result'=>'3']; //acct declined
        }

        return ['userToken'=>$token, 'userId'=>$user->id, 'userName'=> $user->name,'userMail'=>$user->email,
        'userStatus'=>$user->status, 'vendorAddress'=>$user->address,'deliverySupport'=>$user->delivery,
    'phone'=>$user->phone]; //ok

    }

    public function reg(Request $request){
       
        //check if vendor reg
        if($request->input('vendor')){
            $this->validate($request, [
                'name' => 'required|string|max:36',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6', //|confirmed
                'address' => 'required|string|max:255',
                'phone' => 'required|string',
                'delivery'=> 'required|integer'
            ]);
    
            //create vendor
           $user = new User;
           $user->name = $request->name;
           $user->slug =  str_slug($request->name, "-");
           $user->email = $request->email;
           $user->address = $request->address;
           $user->phone = $request->phone;
           $user->status = 1;
           $user->delivery = $request->input('delivery');
           $user->playerId = $request->input('pId');
           $user->password = bcrypt($request->password);
           $user->verifytoken = $verifytoken = Str::random(40);
           $user->save();
           
           $cre = $request->only('email','password');
           if(!$token=JWTAuth::attempt($cre)){
            return ['result'=>'no token']; //invalid cre
        }

        /*
        get admin Pid
        send push notification 
*/
        $adminPId = user::where('status','=',47)->pluck('playerId')->toArray();
        $vendorName = $request->name;

        if($adminPId){
           
            function sendMessage($adminPId,$vendorName){
                $content = array(
              "en" => 'You have a new Food Vendor. Click to view'
                    );
                    $headings = array(
                        "en" => 'Hello Creator'
                              );
                
                $fields = array(
                    'app_id' => "da6349ad-e18f-471b-8d57-30444a9d158f",
                    'include_player_ids' => $adminPId,
                    'data' => array("foo" => "bar"),
                    'url' => 'https://getfoods.ng/user-signin',
                    'contents' => $content,
                    'headings' => $headings,
                   'chrome_web_image' => 'https://getfoods.ng/images/push-images/new_user.png',//512 or >
                   'chrome_web_badge' => 'https://getfoods.ng/images/app-icons/app-icon-96x96.png'
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
            
            $response = sendMessage($adminPId,$vendorName);
            $return["allresponses"] = $response;
            $return = json_encode( $return);
            
          //  print("\n\nJSON received:\n");
         //   print($return);
         // print("\n"); 
       }//if end

        
         /*  session(['verifytoken' => $verifytoken]);
           //email to user
           try{
           //Will be reged by super admin  Mail::to($user->email)->send(new Verify());  
         // welcome email
            $when = now()->addMinutes(10);
                Mail::to($user->email)
                ->later($when, new Welcome());
                 
              }
                 catch(\Exception $e){
            return ['msg' => 0,'userToken'=>$token, 'userId'=>$user->id, 'userName'=> $user->name,'userMail'=>$user->email,
            'userStatus'=>$user->status, 'vendorAddress'=>$user->address,'deliverySupport'=>$user->delivery];
             }

          */  

       //response
       return ['msg' => 1,'userToken'=>$token, 'userId'=>$user->id, 'userName'=> $user->name,'userMail'=>$user->email,
       'userStatus'=>$user->status, 'vendorAddress'=>$user->address,'deliverySupport'=>$user->delivery];
        }
        //**** */

//here is the reg for a customer

        $this->validate($request, [
            'name' => 'required|string|max:15',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6', //|confirmed
            'phone' => 'required|string',
        ]);

        //create
       $user = new User;
       $user->name = $request->name;
       $user->slug =  str_slug($request->name, "-");
       $user->email = $request->email;
       $user->phone = $request->phone;
       $user->playerId = $request->input('pId');
       $user->password = bcrypt($request->password);
       $user->verifytoken = $verifytoken = Str::random(40);
       $user->save();
       

       $cre = $request->only('email','password');
       if(!$token=JWTAuth::attempt($cre)){
        return ['result'=>'no token']; //invalid cre
    }

       session(['verifytoken' => $verifytoken]);
       //email to user
       try{
        Mail::to($user->email)->send(new Verify());  
     // welcome email
      /*  $when = now()->addMinutes(10);
            Mail::to($user->email)
            ->later($when, new Welcome());
           */  
          }
             catch(\Exception $e){
        return ['msg' => 0,'userToken'=>$token, 'userId'=>$user->id,
        'phone'=>$user->phone, 'userName'=> $user->name,'userMail'=>$user->email,
        'userStatus'=> 0, 'vendorAddress'=> null];
         }


   //response
   return ['msg' => 1,'userToken'=>$token, 'userId'=>$user->id,
   'phone'=>$user->phone, 'userName'=> $user->name,'userMail'=>$user->email,
   'userStatus'=> 0, 'vendorAddress'=> null];
    }




    public function password(Request $request){
        return view('auth.passwords.email');
    }
    



    public function verify($crypt){
        $user =User::where('verifytoken','=',$crypt)->select('verifytoken','id')->first();
        //if user not found
        if(!isset($user)){
            return '<a href="https://getfoods.ng/user-signin">Verification token expired. Click here to resend</a>';
        }
        $id = $user->id;
        $act = User::findorfail($id);
        $act->verification = 1;
        $act->verifytoken = Null;
        $act->save();
        return redirect('https://getfoods.ng/user-signin');
   }


   public function resend(Request $request){
       
       $this->validate($request, [
           'email' => 'required|string|email|max:100',
       ]);

       $email = $request->input('email');
       $user = User::where('email','=',$email)->first();
       if(!isset($user)){
           //return not reged 0
           return 0;
       }
       $verifytok = User::where('email','=',$email)->pluck('verifytoken')->first();
       if($verifytok == Null){
           //return verified 1
           return 1;
       }
       
       session(['verifytoken' => $verifytok]);
           //email to user
           try{
               Mail::to($email)->send(new Verify());  
                 }
                 catch(\Exception $e){
            return 2; //err
             }
       //response
       return 3; //success
   }

}
