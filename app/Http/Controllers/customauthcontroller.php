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

        return ['userToken'=>$token, 'userId'=>$user->id, 'userName'=> $user->name,'userMail'=>$user->email,
        'userStatus'=>$user->status, 'vendorAddress'=>$user->address,'deliverySupport'=>$user->delivery,
    'phone'=>$user->phone]; //ok

    }

    public function reg(Request $request){
       
        //check if vendor reg
        if($request->input('vendor')){
            $this->validate($request, [
                'name' => 'required|string|max:15',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6', //|confirmed
                'address' => 'required|string|max:255',
                'phone' => 'required|string',
                'delivery'=> 'required|integer'
            ]);
    
            //create vendor
           $user = new User;
           $user->name = $request->name;
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

           session(['verifytoken' => $verifytoken]);
           //email to user
           try{
            Mail::to($user->email)->send(new Verify());  
         /* welcome email
            $when = now()->addMinutes(10);
                Mail::to($user->email)
                ->later($when, new Welcome());
             */    
              }
                 catch(\Exception $e){
            return ['msg' => 0,'userToken'=>$token, 'userId'=>$user->id, 'userName'=> $user->name,'userMail'=>$user->email,
            'userStatus'=>$user->status, 'vendorAddress'=>$user->address,'deliverySupport'=>$user->delivery];
             }

            

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
        ]);

        //create
       $user = new User;
       $user->name = $request->name;
       $user->email = $request->email;
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
        $when = now()->addMinutes(10);
            Mail::to($user->email)
            ->later($when, new Welcome());
             
          }
             catch(\Exception $e){
        return ['msg' => 0,'userToken'=>$token, 'userId'=>$user->id, 'userName'=> $user->name,'userMail'=>$user->email,
        'userStatus'=> 0, 'vendorAddress'=> null];
         }


   //response
   return ['msg' => 1,'userToken'=>$token, 'userId'=>$user->id, 'userName'=> $user->name,'userMail'=>$user->email,
   'userStatus'=> 0, 'vendorAddress'=> null];
    }




    public function password(Request $request){
        return view('auth.passwords.email');
    }
    



    public function verify($crypt){
        $user =User::where('verifytoken','=',$crypt)->select('verifytoken','id')->first();
        //if user not found
        if(!isset($user)){
            return '<a href="http://localhost:8000/user-login">Verification token expired. Click here to resend</a>';
        }
        $id = $user->id;
        $act = User::findorfail($id);
        $act->verification = 1;
        $act->verifytoken = Null;
        $act->save();
        return redirect('http://http://localhost:8000/user-login');
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
