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

      public  function vendor_food($userId){
        $food = food::orderby('id','desc')->where('vendor_id','=',$userId)
        ->select('id','amt','qty','title','created_at')->paginate(7);
        return foodres::collection($food);
      }

        public  function weekly_ex_vendor($userId){
       
            $start = \carbon\carbon::now()->subDays(7);
            $now =  $expiration  = \carbon\carbon::now();
          return $rec = order::select('total')->where('vendorId','=',$userId)
          ->whereBetween('created_at',array($start,$now))->sum('total');
        }
    
        public  function monthly_ex_vendor($userId){
         
            $start = \carbon\carbon::now()->subMonth();
            $now =  $expiration  = \carbon\carbon::now();
          return $rec = order::select('total')->where('vendorId','=',$userId)->whereBetween('created_at',array($start,$now))->sum('total');
        }
    
        public  function total_ex_vendor($userId){
          
          return $rec = order::select('total')->where('vendorId','=',$userId)->sum('total');
        }


        public  function order_ref($ref,$userid){
          $result = order::where('ref','=',$ref)->where('vendorId','=',$userid)
          ->select('id','amt','qty','total','ref','cusName','confirmation','title','address','delivery','created_at')->get();
          return orderres::collection($result);
          }


           //vendor to view orders made
    public  function vendor_orders($userId){
      $orders = order::orderby('id','desc')->where('vendorId','=',$userId)
      ->select('id','amt','qty','ref','cusName','total','confirmation','title','address','delivery','created_at')->paginate(7);
    //  $orderT = order::where('cusId','=',$userId)->select('amt')->sum('amt');
    // return $obj = ['orders' => $orders, 'orderT' => $orderT];
      return orderres::collection($orders);
    }

            //view reporting based on date range  
   public function vendor_reporting($userid, $from, $to){
    $rep =order::orderby('id','desc')->where('vendorId','=',$userid)
    ->select('id','amt','qty','total','ref','cusName','trans','title','confirmation','address','delivery','created_at')
    ->whereBetween('created_at',array($from,$to))->paginate(5);

    return orderres::collection($rep);
    }
               
            
                //see customer favorite food
                public function vendor_favorites($userName){

             return  $fav = DB::table('favourites')
                    ->select('title', DB::raw('count(*) as total'))
                    ->groupBy('title')->where('vendor_name', '=', $userName)->paginate(8);
                    //groupby wont alow collection
                   // return favres::collection($fav);
                }
                 
            
                public function delete_food(Request $request){
                    $data = food::findorfail($request->input('id'));
                    $data->delete();
                    return 1;
                }
              


                public function new_food(Request $request){
                  
                    $food = $request->input('food');
                    $price = $request->input('price');
                    $quantity = $request->input('quantity');
                    $vendorId = $request->input('vendorId');
                    $vendorName = $request->input('vendorName');
                    $phone = $request->input('phone');
                    $deliverySupport = $request->input('deliverySupport');
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
                  $save->phone = $phone;
                  $save->title = $food;
                  $save->amt = $price;
                  $save->qty =$quantity;
                 $save->delivery =$deliverySupport;
                  $save->img = $filenametostore;
                  $save->vendorAddress = $request->input('address');

                  $save->save();
                  
                    return 1;
                }
                





                public function edit_food(Request $request){
                  
                  $food = $request->input('food');
                  $price = $request->input('price');
                  $quantity = $request->input('quantity');
                  $id = $request->input('id');

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

                $save = food::findorfail($id);

                $save->title = $food;
                $save->amt = $price;
                $save->qty =$quantity;
                $save->img = $filenametostore;

                $save->save();
                
                  return 1;
              }
              


}//class end