<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use App\order;
use DB;
use Image;

//Api resource
use App\Http\Resources\foodresource as foodres;
use App\Http\Resources\orderresource as orderres;
use App\Http\Resources\favresource as favres;

class vendorcontroller extends Controller
{
   
    //vendor to view orders made
    
    public  function vendor_orders($userId){
      
        $orders = order::orderby('id','desc')->where('vendorId','=',$userId)
        ->select('id','amt','qty','ref','title','address','delivery','created_at')->paginate(5);
      //  $orderT = order::where('cusId','=',$userId)->select('amt')->sum('amt');

      // return $obj = ['orders' => $orders, 'orderT' => $orderT];

        return orderres::collection($orders);
      }



        public  function weekly_ex_vendor($userId){
       
            $start = \carbon\carbon::now()->subDays(7);
            $now =  $expiration  = \carbon\carbon::now();
          return $rec = order::select('amt')->where('vendorId','=',$userId)
          ->whereBetween('created_at',array($start,$now))->sum('amt');
        }
    
        public  function monthly_ex_vendor($userId){
         
            $start = \carbon\carbon::now()->subMonth();
            $now =  $expiration  = \carbon\carbon::now();
          return $rec = order::select('amt')->where('vendorId','=',$userId)->whereBetween('created_at',array($start,$now))->sum('amt');
        }
    
        public  function total_ex_vendor($userId){
          
          return $rec = order::select('amt')->where('vendorId','=',$userId)->sum('amt');
        }


        public  function order_ref($ref,$userid){
          $result = order::where('ref','=',$ref)->where('vendorId','=',$userid)
          ->select('id','amt','qty','ref','title','address','delivery','created_at')->get();
          return orderres::collection($result);
          }


            //view reporting based on date range  
   public function vendor_reporting($userid, $from, $to){
    $rep =order::orderby('id','desc')->where('vendorId','=',$userid)->select('id','amt','qty','ref','trans','title','address','delivery','created_at')
    ->whereBetween('created_at',array($from,$to))->paginate(4);

    return orderres::collection($rep);
    }
               
              /*  
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
               */ 


                public function new_food(Request $request){
                  
                    $food = $request->input('food');
                    $price = $request->input('price');
                    $quantity = $request->input('quantity');
                    $vendorId = $request->input('vendorId');
                    $vendorName = $request->input('vendorName');

                    //.................compression algorithm...............//
    
           if($request->hasfile('img')){
            //get filename with extension
            $filenamewithextension = $request->file('img')->getClientOriginalName();
    
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('img')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
    
            //#original
                //Upload File
               // $request->file('img')->storeAs('public/food_original', $filenametostore);
                //#resized
                $request->file('img')->storeAs('public/food', $filenametostore);
        
                // #resized
                //Resize image here
                $thumbnailpath = public_path('/storage/food/'.$filenametostore);
                $img = Image::make($thumbnailpath)->resize(550, 340, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
    
           // return redirect('images')->with('success', "Image uploaded successfully.");
          // return response()->Json('success!');
        }else{
            $filenametostore = 'noimage.jpg';
        }
    
        //.................compression algorithm...............//

                  $save = new food;

                  $save->vendor_id = $vendorId;
                  $save->vendor_name = $vendorName;
                  $save->title = $food;
                  $save->amt = $price;
                  $save->qty =$quantity;
                  $save->img = $filenametostore;
                  $save->vendorAddress = $request->input('address');

                  $save->save();
                  
                    return 1;
                }
                

}//class end