<?php

namespace Sbhadra\Photography\Http\Controllers;

use Juzaweb\Http\Controllers\BackendController;
use Juzaweb\Http\Controllers\FrontendController;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Service;
use Sbhadra\Photography\Models\Booking;
use Sbhadra\Photography\Models\Timeslot;
use Sbhadra\Photography\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends FrontendController
{
    public function doPayment()
    {
        $settings = Setting::all()->toArray();
        $config=array();
        foreach($settings as $setting){
            $config[$setting["field_key"]] = $setting["field_value"];
        }

        $payment_data = array();
        $payment_data= $request = \Request::all();
        $package = Package::find($request['id']);
        $payment_data['package_name'] = $package->title;
        $package_price=$package->price;
        $time = Timeslot::find($request['booking_time']);
        $bsid=base64_encode($package->id);
        if(!empty($request['service_item'])){
            $services = Service::whereIn('id', $request['service_item'])->get();
        }
        //dd($request);
        $booking_price =$package_price;
      
        sleep(5);
         $book = DB::table('bookings')->where('package_id',$package->id)->where('booking_date','=',$request['booking_date'])->where('timeslot_id',$request['booking_time'])->whereIn('status',['Yes','yes'])->count();
       
        $payment_data['booking_price'] = $booking_price;
        $total = 0.00;
        if(isset($payment_data['total_price'])){
            $total = $payment_data['total_price'];
        }
        if(isset($payment_data['discount_value'])){
            $total = $total - $payment_data['discount_value'];
        }
        
     
        //$payment_data['pay_amount'] =$total;
       // $payment_data['pay_amount'] =35.500;
       if($package->is_type==3){
          $payment_data['pay_amount'] =$total;  
          $booking_price =$total;  
       }else if($package ->is_type==2){
          $pay_amount = $config['pay_amount'];
          $payment_data['pay_amount'] =$pay_amount;
          $booking_price =$pay_amount;
        }else{
            $pay_amount =0.00;
            $booking_price =0.00;
            
        }
        $booking = new Booking;
        $booking->package_id = $package->id;
        $booking->slug = 'CPBK'.time();
        $booking->title = 'CPBK'.time();
        $booking->branch_id = $request['branch_id'];
        $booking->booking_date = $request['booking_date'];
        $booking->timeslot_id = $request['booking_time'];
        $booking->booking_price = $booking_price;
        $booking->customer_name = $request['customer_name'];
        $booking->customer_email = $request['customer_email'];
        $booking->mobile_number = $request['mobile_number'];
        $booking->instructions = $request['instructions'];
        $booking->btype = $package->is_type;
        if(isset($request['company_id']) && $request['company_id']>1){
            $booking->company_id = $request['company_id'];
         }else{
            $booking->company_id = $package->company_id;
         }
        if($package ->is_type==1){
             $booking->transaction_id = time().'-'.rand(1000,9999);
             $booking->status =  'Yes';
        }else{
             $booking->status = 'No';
        }
        if($booking->save()){
            if(!empty($request['service_item'])){
             $booking->services()->sync($request['service_item']);
            }
              $payment_data['booking_id'] = $booking->id;
              $payment_data['company_id'] = $booking->company_id;
              //$status = do_action('theme.booking.extra',$payment_data);
              if($package->is_type==1){
                
                      $bsid=base64_encode($payment_data['booking_id']);
                      $url = url('payment/success').'/?bsid='.$bsid;
                      header("Location: ".$url);
                      exit();
                      
              }else{
                Session::put('booking_data', $booking);
                session(['booking_data' => $booking]);
                $status = do_action('theme.payment.method',$payment_data);
              }
              
         }
    }
    public function doSuccess(){
        $status = do_action('theme.payment.method_success');
    }
    public function doFailed(){
        $status = do_action('theme.payment.method_failed');
    }



}
