<?php

namespace Sbhadra\Photography\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Photography\Http\Datatables\BookingDatatable;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Service;
use Sbhadra\Photography\Models\Booking;
use Sbhadra\Photography\Models\Timeslot;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Illuminate\Http\Request;

class BookingController extends BackendController
{
   
    use PostTypeController;

    protected $viewPrefix = 'sbph::backend.booking'; // View prefix for resource

    // Make validator for store and update
    protected function validator(array $attributes)
    {
        $validator = Validator::make($attributes, [
            'title' => 'required|string|max:250',
        ]);

        return $validator;
    }

    

    // Make data json for index datatable
    protected function getDataTable()
    {
        $dataTable = new BookingDatatable();
        $dataTable->mountData('bookings', 0);
        return $dataTable;
    }


    protected function getModel()
    {
        return Booking::class;
    }

    protected function getTitle()
    {
        return trans('sbph::app.bookings');
    }

    public function edit(Request $request, $id){
        $pid=($request->id?$request->id:null);
        $model = Booking::firstOrNew(['id' => $id]);
        $id=($request->id?$request->id:null);
        $post = Package::firstOrNew(['id' =>$pid]);
        $packages= Package::all(); 
        return view('sbph::backend.booking.edit', [
            'model' => $model,
            'post' => $post,
            'packages' => $packages,
            'postType'=>'booking',
            'title' => $model->name ?: trans('sbph::app.booking')
        ]);;
    }

    public function getBookingDetails($id){
        $model = Booking::firstOrNew(['id' => $id]);
        return view('sbph::backend.booking.show', [
            'model' => $model,
            'postType'=>'booking',
            'title' => $model->name ?: trans('sbph::app.booking')
        ]);;
    }

    public function create(Request $request) {
        $id=($request->id?$request->id:null);
        $model = Package::firstOrNew(['id' => 0]);
        $packages= Package::all();  
        return view('sbph::backend.booking.create', [
            'model' => $model,
            'post' => $model,
            'packages' => $packages,
            'postType'=>'booking',
            'title' => $model->name ?: trans('sbph::app.add_new')
        ]);
    }
    // public function store(Request $request){
    //     return $request->all;
    // }
    protected function afterSave(Request $request, $model){
         if(!empty($request['service_item'])){
             $services = Service::whereIn('id', $request['service_item'])->get();
         }
        $booking_price =$request['package_price'];
        // foreach($services as $service){
        //     $booking_price =$booking_price+$service->price;
        // }

        $model->total_price =$request['total_price'];
        $model->booking_price = $request['package_price'];
        $model->timeslot_id = $request['booking_time'];
        $model->number_of_baby = $request['number_of_baby'];
        $model->btype = $request['btype'];
        // if(isset($request['theme_id'][0])){
        //     $model->theme_id =  $request['theme_id'][0] ;
        // }
        // if(isset($request['theme_id'][1])){
        //     $model->theme_2id =  $request['theme_id'][1] ;
        // }
        if(isset($request['pictures_type'])){
            $model->pictures_type =  $request['pictures_type'] ;
        }
        if(isset($request['number_of_pieces'])){
            $model->number_of_pieces =  $request['number_of_pieces'] ;
        }
        if(isset($request['rate_per_pieces'])){
            $model->rate_per_pieces =  $request['rate_per_pieces'] ;
        }
        if(isset($request['pictures_type_price'])){
            $model->pictures_type_price =  $request['pictures_type_price'] ;
        }
       
        $model->save();
        if(!empty($request['service_item'])){
           $model->services()->sync($request['service_item']);
         }
        
       }
    
    public function getBookingCancel(Request $request){
        $model = Booking::find($request->id);
        $model->status ='cancel';
        if($model->save()){
            $slot = $model->timeslot->starttime .'To'. $model->timeslot->endtime;
            $booking_date = $model->booking_date;
            $rptest=["[bdate]","[time]","[orderId]"];
            $orderid = $model->title;
            $nptext = [$booking_date,$slot,$orderid];
            $data= array(
            'message'=>str_replace($rptest,$nptext,trans('sbph::app.cancel_message')),
            'mobile'=>$model->mobile_number,
            'email'=>$model->customer_email,
            'bookingId'=>$orderid,
            'code'=>'+965',
            );
             do_action('booking.email.index',$data);
             do_action('booking.sms.index',$data);
            $res['status']=true;
            $res['data'] = array(
                'message'=>'This booking successfully canceled',
                'redirect'=>route('bookings.index'),
            );
            echo json_encode($res);
            die();
   
        } 
       
        
    }
   public function getBookingComplete(Request $request){
        $model = Booking::find($request->id);
        $model->status ='completed';
        if($model->save()){
            //do_action('booking.complete.index',$model);
           $res['status']=true;
           $res['data'] = array(
               'message'=>'This booking successfully completed',
               'redirect'=>route('bookings.index'),
           );
           echo json_encode($res);
           die(); 
        }


  
    }
    
    public function getBookingCompleted(Request $request){
        $model = Booking::find($request->id);
        $model->status ='completed';
        if($model->save()){
            //do_action('booking.complete.index',$model);
            
           $res['status']=true;
           $res['data'] = array(
               'message'=>'This booking successfully completed',
               'redirect'=>route('bookings.index'),
           );
           echo json_encode($res);
           die();
           
        }        

    }

    public function getBookingRefund(Request $request){
        $model = Booking::find($request->id);
        $model->refunded =1;
        if($model->save()){
            do_action('booking.refund.index',$model);
            
          $res['status']=true;
          $res['data'] = array(
               'message'=>'This booking successfully refunded',
               'redirect'=>route('bookings.index'),
           );
           echo json_encode($res);
           die();
        }       
        
        

    }
    public function getBookingSurveySendSMS(Request $request){
        $model = Booking::find($request->id);
        $model->sms =1;
        if($model->save()){
            do_action('booking.complete.index',$model);
           $res['status']=true;
           $res['data'] = array(
               'message'=>'Survey SMS Successfully Sended ',
               'redirect'=>route('bookings.index'),
           );
           echo json_encode($res);
           die();
        }           
         
      
    }
    public function getBookingSendSMS(Request $request){
        $model = Booking::find($request->id);
        $model->sms =1;
        if($model->save()){
            $slot = $model->timeslot->starttime .'To'. $model->timeslot->endtime;
            $booking_date = $model->booking_date;
            $orderid = $model->title;
            $rptest=["[bdate]","[time]","[orderId]"];
            $nptext = [$booking_date,$slot,$orderid];
            $data= array(
            'message'=>str_replace($rptest,$nptext,trans('sbph::app.sussess_message')),
            'mobile'=>$model->mobile_number,
            'email'=>$model->customer_email,
            'bookingId'=>$orderid,
            'code'=>'+965',
            );
            do_action('booking.email.index',$data);
            do_action('booking.sms.index',$data);
           $res['status']=true;
           $res['data'] = array(
               'message'=>'This Sms successfully Sended',
               'redirect'=>route('bookings.index'),
           );
           echo json_encode($res);
           die();
        }           
         
      
    }

    public function changeBookingTheme(Request $request){
        $model = Booking::find($request->id);
        if(isset($request->theme_id[0])){
            $model->theme_id =$request->theme_id[0];
        }
        if(isset($request->theme_id[1])){
            $model->theme_2id =$request->theme_id[1];
        }
        
        if($model->save()){
           $res['status']=true;
           $res['data'] = array(
               'message'=>'This booking  Theme successfully added',
               'redirect'=>route('admin.success.booking'),
           );
           echo json_encode($res);
           die();
           
        }        
    }

  
      public function AddBookingEmployee(Request $request){
        $model = Booking::find($request->id);
        $model->employee_id = $request->employee_id;
        if($model->save()){
           $res['status']=true;
           $res['data'] = array(
               'message'=>'This booking  Employee  successfully added',
               'redirect'=>route('admin.success.booking'),
           );
           echo json_encode($res);
           die();
           
        }        
    }
    
     public function AddBookingNote(Request $request){
        $model = Booking::find($request->id);
        $model->booking_notes = $request->booking_notes;
        if($model->save()){
           $res['status']=true;
           $res['data'] = array(
               'message'=>'This booking  Notes successfully added',
               'redirect'=>route('admin.success.booking'),
           );
           echo json_encode($res);
           die();
           
        }        
    }
    
    
}

