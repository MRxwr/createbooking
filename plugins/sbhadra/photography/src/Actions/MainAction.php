<?php

namespace Sbhadra\Photography\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Models\User;
use Juzaweb\Facades\HookAction;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Service;
use Sbhadra\Photography\Models\Booking;
use Sbhadra\Photography\Models\Timeslot;
use Sbhadra\Photography\Models\Branch;
use Sbhadra\Photography\Models\Setting;
use Sbhadra\Photography\Http\Controllers\PaymentController;
use Sbhadra\Calendar\Models\Calendar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Session;
use Auth;
class MainAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle()
    {
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerPackage']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerBooking']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerTaxonomies']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'getBookingDetailsAjax']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addPackagesInHomepage']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addReservationHooks']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addDoPaymentsAction']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'getCalenderHooksAdmin']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addReservationHooksAdmin']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'GetDashboardHooks']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'getEmployeeList']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'checkActiveSlote']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'checkTempSlot']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'clearSession']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'CronBookingNotification']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'addDoEmailAction']);
        
    }

    public function registerPackage()
    {
        HookAction::registerPostType('packages', [
            'label' => trans('sbph::app.packages'),
            'model' => Package::class,
            'menu_position' => 32,
            'menu_icon' => 'fa fa-list',
        ]);
        HookAction::registerPostType('services', [
            'label' => trans('sbph::app.services'),
            'model' => Service::class,
            'menu_position' => 34,
            'menu_icon' => 'fa fa-list',
        ]);
        HookAction::registerPostType('timeslots', [
            'label' => trans('sbph::app.timeslots'),
            'model' => Timeslot::class,
            'menu_position' => 34,
            'menu_icon' => 'fa fa-list',
        ]);
        HookAction::registerPostType('branches', [
            'label' => trans('sbph::app.branches'),
            'model' => Branch::class,
            'menu_position' => 35,
            'menu_icon' => 'fa fa-list',
        ]);
        HookAction::addAdminMenu(
            trans('sbph::app.setting'),
            'setting/booking',
            [
                'icon' => 'fa fa-book',
                'position' => 30,
                'parent' => 'setting',
            ]
        );
    }
    public function addPackagesInHomepage()
    {
        $this->addAction('theme.home_packages', function () {
            $packages = Package::where('status','publish')->get();
            if($packages){
                //var_dump($packages);
                foreach($packages as $key=>$package){
                    echo '<div class="col-md-6 col-sm-6 col-12">
                    <a href="'.url('package/'.$package->slug).'">
                    <div class="package-card card m-2">
                      <div class="card-body p-2">
                        <div class="row align-items-center no-gutters">
                          <div class="col-lg-7 col-md-8 col-sm-12 order-lg-1 order-md-1 order-sm-2 order-2">
                          <h5 class="package-head">'.$package->title.'</h5>
                            '.$package->content.'                    
                            <p class="theme-color package-price-tag text-right"><span>Price:</span><span class="ml-2">'.$package->price.' KD</span></p>
                          </div>
                          <div class="col-lg-5 col-md-4 order-lg-3 order-md-2 order-sm-1 order-1">
                            <img src="'. upload_url($package->thumbnail) .'" class="img-rounded img-fluid d-block mx-auto mb-md-0 mb-3">
                          </div>
                        </div>
                      </div>
                    </div>
                    </a>
                  </div>';
                }
             }
        });

    }
    public function addReservationHooks(){
        if(\Request::segment(1) =="reservations" && !empty($_REQUEST)){
            if(isset($_REQUEST['id'])){
              $package = Package::find($_REQUEST['id']);
                add_filters('theme.reservation.data', function($type) {
                    $theme_field='';
                    $package = Package::find($_REQUEST['id']);
                      if(isset($_REQUEST['theme_id'])){
                        $theme_field ='<input type="hidden" id="theme_id" name="theme_id" value="'. $_REQUEST['theme_id'].'" />';
                      }
                      return '<input type="hidden" id="id" name="id" value="'. $package->id.'" />
                                '.$theme_field.'
                                <input type="hidden" id="booking_price" name="package_price" value="'. $package->price.'" />
                            <div class="col-sm-12 pe-xl-5">
                                <div class="package-head bg-light radius15 mh53 py-1 px-3 mb-3 d-inline-flex align-items-center">
                                    <h4 class="fs23"> '.trans('theme::app.Package_Choosen').': '. $package->title.'</h4>
                                    <input type="hidden" readonly class="form-control-plaintext" id="" value="'. $package->title.'">
                                </div>
                            </div>
                            <div class="col-sm-12 pe-xl-5">
                                <div class="package-head bg-light radius15 mh53 py-1 px-3 mb-3 d-inline-flex align-items-center">
                                    <h4 class="fs23"> '.trans('theme::app.Date').': '.$_REQUEST['date'].'</h4>
                                    <input type="hidden" readonly class="form-control-plaintext" name="booking_date" id="booking_date" value="'.$_REQUEST['date'].'">
                                </div>
                            </div>';
               }, 10, 1);
 
            }
        }
    }
    public function addReservationHooksAdmin(){
            if(isset($_REQUEST['id'])){
              $package = Package::find($_REQUEST['id']);
               $this->addAction('admin.reservation.data', function() {
                $package = Package::find($_REQUEST['id']);
                echo '<input type="hidden" id="package_id" name="package_id" value="'. $package->id.'" />
                        <input type="hidden" id="package_price" name="package_price" value="'. $package->price.'" />
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-md-4 col-form-label">Package Choosen:</label>
                            <div class="col-sm-7 col-md-8">
                                <input type="text" readonly class="form-control-plaintext" id="" value="'. $package->title.'">
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-5 col-md-4 col-form-label">Date:</label>
                        <div class="col-sm-7 col-md-8">
                        <input type="text" readonly class="form-control-plaintext" name="booking_date" id="booking_date" value="'.$_REQUEST['date'].'">
                    </div>
                   </div>';
           }, 10, 1);

           $this->addAction('admin.reservation.time', function() {
            $package = Package::find($_REQUEST['id']);
               echo $this->getAdminPackageTimeslots($package);
           }, 10, 1);

           $this->addAction('admin.reservation.services', function() {
            $package = Package::find($_REQUEST['id']);
               echo $this->getPackageExService($package);
           }, 10, 1);

 
            }
        
    }
    public function registerBooking()
    {
        HookAction::registerPostType('bookings', [
            'label' => trans('sbph::app.bookings'),
            'model' => Booking::class,
            'menu_position' => 36,
            'menu_icon' => 'fa fa-list',
        ]);
    }
    public function registerTaxonomies()
    {
        // HookAction::registerTaxonomy('types', 'packages', [
        //     'label' => trans('sbph::app.types'),
        //     'menu_position' => 6, 
        // ]); 
       HookAction::addAdminMenu(
            'Success bookings',
            'success-bookings',
            [
                'icon' => 'fa fa-book',
                'position' => 2.1,
                'parent' => 'bookings',
            ]
        );
        HookAction::addAdminMenu(
            'Cancel bookings',
            'cancel-bookings',
            [
                'icon' => 'fa fa-book',
                'position' => 2.2,
                'parent' => 'bookings',
            ]
        );
        HookAction::addAdminMenu(
            'Completed bookings',
            'complete-bookings',
            [
                'icon' => 'fa fa-book',
                'position' =>2.4,
                'parent' => 'bookings',
            ]
        );
    }

    static function getPackageTimeslots($package){
        $html ='';
        $disable_slots=array();
        //dd($package);
        if(isset($_REQUEST['date'])){
            $date = new \DateTime($_REQUEST['date']);
            $bdate = $date->format('Y-m-d');
            $calendar = Calendar::where('package_id',$package->id)->whereDate('from_date', '<=', $date)->whereDate('to_date', '>=', $date)->first();
            if($calendar){
                $disable_slots = json_decode($calendar->slots);
            }
           // $booked_slot =Booking::where('package_id',$package->id)->where('booking_date',$_REQUEST['date'])->where('status','yes')->pluck('timeslot_id')->toArray();
            $booked_slot =Booking::where('booking_date',$_REQUEST['date'])->where('status','yes')->pluck('timeslot_id')->toArray();
        }else{
            //$booked_slot =Booking::where('package_id',$package->id)->where('status','yes')->pluck('timeslot_id')->toArray();
             $booked_slot =Booking::where('status','yes')->pluck('timeslot_id')->toArray();
            
        }
        //dd($disable_slots);
        if($package->slots){
            $html .='<div class="col-xxl-8 pe-xl-5 pt-4"><div class="personal-form row">';
            $html .=' <div class="col-xxl-10 pb-3"><label for="" >'.trans('theme::app.Preffered_Time').':</label>';
            //$html .='<div class="col-sm-7 col-md-8">';
            $html .='<select class="form-control border xyz" id="booking_time" name="booking_time"  required>';
            $html .='<option>'.trans('theme::app.Select_Time').'</option>';
             foreach($package->slots as $slot){
                 $pmax_booking_sameslot = Booking::where('booking_date',$_REQUEST['date'])->where('package_id',$package->id)->where('status','yes')->where('timeslot_id',$slot->id)->count();
                 $max_booking_slot = Booking::where('booking_date',$_REQUEST['date'])->where('status','yes')->where('timeslot_id',$slot->id)->count();
                 if($package->max_booking<=$pmax_booking_sameslot || $slot->max_booking_no <= $max_booking_slot){
                     $disable_slots[] = $slot->id;
                 }
                if(!in_array($slot->id,$disable_slots) ){
                    //if(!in_array($slot->id,$booked_slot)){
                        $html .='<option value="'.$slot->id.'" '.(app()->getLocale()=='ar'?'style="direction: ltr;"':'' ).'>'.$slot->starttime.' - '.$slot->endtime.'</option>';
                    //}
                 }
               }
            $html .='</select>';
            $html .='</div>';
            $html .='</div>';
            $html .='</div>';
        }
        return $html;
    }


    static function getAdminPackageTimeslots($package){
        $html ='';
        $disable_slots=array();
        if(isset($_REQUEST['date'])){
            $date = new \DateTime($_REQUEST['date']);
            $bdate = $date->format('Y-m-d');
            $calendar = Calendar::where('package_id',$package->id)->whereDate('from_date', '<=', $date)->whereDate('to_date', '>=', $date)->first();
            if($calendar){
                $disable_slots = json_decode($calendar->slots);
            }
            //$booked_slot =Booking::where('package_id',$package->id)->where('booking_date',$_REQUEST['date'])->where('status','yes')->pluck('timeslot_id')->toArray();
            $booked_slot =Booking::where('booking_date',$_REQUEST['date'])->where('status','yes')->pluck('timeslot_id')->toArray();
        }else{
            //$booked_slot =Booking::where('package_id',$package->id)->where('status','yes')->pluck('timeslot_id')->toArray();
            $booked_slot =Booking::where('status','yes')->pluck('timeslot_id')->toArray();
        }
        
        //dd($booked_slot);
        if($package->slots){
            $html .='<div class="form-group row">';
            $html .='<label class="col-sm-5 col-md-4" for="" >'.trans('sbph::app.Preffered_Time').':</label>';
            $html .='<div class="col-sm-7 col-md-8">';
            $html .='<select class="form-control border xx" id="booking_time" name="booking_time"  required>';
             foreach($package->slots as $slot){
                  $pmax_booking_sameslot = Booking::where('booking_date',$_REQUEST['date'])->where('package_id',$package->id)->where('status','yes')->where('timeslot_id',$slot->id)->count();
                 $max_booking_slot = Booking::where('booking_date',$_REQUEST['date'])->where('status','yes')->where('timeslot_id',$slot->id)->count();
                 if($package->max_booking<=$pmax_booking_sameslot || $slot->max_booking_no <= $max_booking_slot){
                     $disable_slots[] = $slot->id;
                 }
                if(!in_array($slot->id,$disable_slots)){
                   // if(!in_array($slot->id,$booked_slot)){
                        $html .='<option value="'.$slot->id.'">'.$slot->starttime.' - '.$slot->endtime.'</option>';
                    //}
                 }
               }
            $html .='</select>';
            $html .='</div>';
            $html .='</div>';
            
        }
        return $html;
    }

static function getPackageCstudioTimeslots($package){
        $html ='';
        $booked_slot =Booking::where('package_id',$package->id)->where('status','yes')->pluck('timeslot_id')->toArray();
        //dd($booked_slot);
        if($package->slots){
           
            $html .='<div class="col-sm-12 pe-xl-5">';
            $html .='<div class="package-head bg-light radius15 mh53 py-1 px-3 mb-3 d-inline-flex align-items-center">';
            $html .='<h4 class="fs23">'.trans('theme::app.Available_Time_Slots').':</h4><input type="hidden" id="booking_time" name="booking_time">';
            $html .='</div></div>';
            $html .='<div class="col-sm-12 pe-xl-5 timeSelect">';
             foreach($package->slots as $slot){
                if(!in_array($slot->id,$booked_slot)){
                    $html .='<div id="'.$slot->id.'" class="package-head open_time bg-white border radius15 mh53 py-1 px-2 mb-3 me-2 d-inline-flex align-items-center">
                    '.$slot->starttime.' - '.$slot->endtime.'
                        </div>';
                    
                }else{
                    $html .='<div id="'.$slot->id.'" class="package-head disable bg-white border radius15 mh53 py-1 px-2 mb-3 me-2 d-inline-flex align-items-center">
                    '.$slot->starttime.' - '.$slot->endtime.'
                        </div>';
                }
               }
            
            $html .='</div>';
        }
        return $html;
    }

    


    public function addDoPaymentsAction(){
        $this->addAction('theme.payment.index', function () {
             app('Sbhadra\Photography\Http\Controllers\PaymentController')->doPayment();
        });
        $this->addAction('theme.payment.success', function () {
            app('Sbhadra\Photography\Http\Controllers\PaymentController')->doSuccess();
       });
       $this->addAction('theme.payment.failed', function () {
            app('Sbhadra\Photography\Http\Controllers\PaymentController')->doFailed();
         });
    }

    static function getCalenderHooks($post){
        add_filters('theme.calendar.hooks', function($post){
            $package_id = $post->id; 
            $slots = count($post->slots);
            $bookings = DB::table('bookings')
                 ->select('booking_date', DB::raw('count(*) as total'))
                 ->where('status','Yes')
                 ->where('package_id',$package_id)
                 ->groupBy('booking_date')
                 ->get();  
                 $datesDisabled_array =array();
                 foreach($bookings as $booking){
                    if($booking->total ==$slots ){
                        $datesDisabled_array[] =  $booking->booking_date;
                    }
                 }
               $datesDisabled = implode(',', $datesDisabled_array );
            return '<script>
                   var datesDisabled = ['.$datesDisabled.'];
               </script>';
       }, 10, 1);
        
    }

    public function getCalenderHooksAdmin(){
        $this->addAction('admin.calendar.hooks', function(){
            if(isset($_REQUEST['id'])){
            $post = Package::find($_REQUEST['id']);
            //var_dump($post);
             $package_id = $post->id; 
            $slots = count($post->slots);
            $bookings = DB::table('bookings')
                 ->select('booking_date', DB::raw('count(*) as total'))
                 ->where('status','Yes')
                 ->where('package_id',$package_id)
                 ->groupBy('booking_date')
                 ->get();  
                 $datesDisabled_array =array();
                 foreach($bookings as $booking){
                    if($booking->total ==$slots ){
                        $datesDisabled_array[] =  $booking->booking_date;
                    }
                 }
               $datesDisabled = implode(',', $datesDisabled_array );
            echo '<script>
                   var datesDisabled = ['.$datesDisabled.'];
               </script>';
                }
       }, 10, 1);
        
    }

    public   function GetDashboardHooks(){
        $this->addAction('backend.dashboard.view', function () {
            $html ='<div class="row">';
            if(\Auth::user()->usertype=='company'){
                $incomplete_booking =Booking::where('status','No')->where('company_id',Auth::user()->id)->count();
            }else{
                $incomplete_booking =Booking::where('status','No')->count();
            }
           
            $html .='<div class="col-md-3">
                        <div class="card  border-0 bg-gray-2">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <i class="fa fa-list font-size-50 mr-3"></i>
                                    <div>
                                        <div class="font-size-21 font-weight-bold">'. trans('sbph::app.total_incomplete_bookings').'</div>
                                        <div class="font-size-15">'.$incomplete_booking.'</div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>';
            
            if(\Auth::user()->usertype=='company'){
                $success_booking =Booking::where('status','Yes')->where('company_id',Auth::user()->id)->count();
            }else{
                $success_booking =Booking::where('status','Yes')->count();
            }
            
            $html .='<div class="col-md-3">
                        <div class="card  border-0 bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <i class="fa fa-list font-size-50 mr-3"></i>
                                    <div>
                                        <div class="font-size-21 font-weight-bold">'.trans('sbph::app.total_success_bookings').'</div>
                                        <div class="font-size-15">'.$success_booking.'</div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>';
            
            if(\Auth::user()->usertype=='company'){
                $complete_booking =Booking::where('status','Completed')->where('company_id',Auth::user()->id)->count();
            }else{
                $complete_booking = Booking::where('status','Completed')->count();
            }
            $html .='<div class="col-md-3">
                        <div class="card  border-0 bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <i class="fa fa-list font-size-50 mr-3"></i>
                                    <div>
                                        <div class="font-size-21 font-weight-bold">'.trans('sbph::app.total_complete_bookings').'</div>
                                        <div class="font-size-15">'.$complete_booking.'</div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>';
                if(\Auth::user()->usertype=='company'){
                    $cancel_booking =Booking::where('status','cancel')->where('company_id',Auth::user()->id)->count();
                }else{
                    $cancel_booking =Booking::where('status','cancel')->count();
                }
            
            $html .='<div class="col-md-3">
                        <div class="card  border-0 bg-danger text-white">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <i class="fa fa-list font-size-50 mr-3"></i>
                                    <div>
                                        <div class="font-size-21 font-weight-bold">'.trans('sbph::app.total_cancel_bookings').'</div>
                                        <div class="font-size-15">'.$cancel_booking.'</div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>';
            
            $html .='</div>';
            
            $today = date('d-m-Y');
            if(\Auth::user()->usertype=='company'){ 
                $todays_booking =Booking::whereIn('status',['Yes','yes'])->where("booking_date", "=", $today)->where('company_id',Auth::user()->id)->orderBy('timeslot_id', 'asc')->get();
            }else{
                $todays_booking =Booking::whereIn('status',['Yes','yes'])->where("booking_date", "=", $today)->orderBy('timeslot_id', 'asc')->get();
            }
            //->where("booking_date", ">=",)
            //dd($todays_booking);
            if(!empty($todays_booking)){
                    $html .='<div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Taday\'s Booking</h5>
                            </div>
            
                            <div class="card-body">
                                <table class="table" id="booking-table">
                                    <thead>
                                        <tr>
                                            <th data-formatter="index_formatter" data-width="2%">#</th>
                                            <th data-field="name" data-width="10%">Package Theme</th>
                                            <th data-field="name" data-width="10%">BookingId</th>
                                            <th data-field="name" data-width="10%">Package</th>
                                            <th data-field="name" data-width="10%">Customer name</th>
                                            <th data-field="name" data-width="10%">Mobile number</th>
                                            <th data-field="name" data-width="10%">Booking date</th>
                                            <th data-field="name" data-width="10%">Booking Time</th>
                                            <th data-field="name" data-width="10%">Status</th>
                                            <th data-field="created" data-width="10%" data-align="center">Action</th>
                                        </tr>
                                    </thead>';
                                    foreach($todays_booking as $booking){
                                        $view_details = route('admin.bookings.view', [$booking->id]);
                                        $theme = '';
                                        if($booking->theme_id>0){
                                            $theme =  '<img src="'. $booking->theme->getThumbnail() .'"  style="width:100px" />';
                                        }
                                        $html .=' <tr> 
                                                    <td data-formatter="index_formatter" data-width="2%">#</td>
                                                    <td data-field="name" data-width="10%">'.$theme.'</td>
                                                    <td data-field="name" data-width="10%">'.$booking->title.'</td>
                                                    <td data-field="name" data-width="10%">'.$booking->package->title.'</td>
                                                    <td data-field="name" data-width="10%">'.$booking->customer_name.'</td>
                                                    <td data-field="name" data-width="10%">'.$booking->mobile_number.'</td>
                                                    <td data-field="name" data-width="10%">'.$booking->booking_date.'</td>
                                                    <td data-field="name" data-width="10%">'.$booking->timeslot->starttime.' '.$booking->timeslot->endtime.'</td>
                                                    <td data-field="name" data-width="10%">'.$booking->status.'</td>
                                                    <td data-field="created" data-align="center"><a href="'.$view_details.'" class="dropdown-item"> <i class=" fa fa-eye"></i> View</a></td>
                                                </tr>';
                                    }

                                $html .='</table>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            echo $html;
       });
       
    } 
    
    public function getBookingDetailsAjax(){
        if(isset($_REQUEST['ajaxpage']) && $_REQUEST['ajaxpage']=='getBookingDetailsAjax'){
           $searchquery = $_REQUEST['searchquery'];
           $bookings = Booking::where('transaction_id',$searchquery)->get();
           if(!$bookings->isEmpty()){
            echo $this->bookingViewRander($bookings);
           }else{
               $bookings = Booking::where('title',$searchquery)->get();
               if(!$bookings->isEmpty()){
                   echo $this->bookingViewRander($bookings);
                }else{
                    $bookings = Booking::where('mobile_number',$searchquery)->get();
                    if(!$bookings->isEmpty()){
                        echo $this->bookingViewRander($bookings);
                    }else{
                        echo 'No Search Data Found!!!';
                    }
                }

           }
        exit;
        }
    }

    static function bookingViewRander($bookings){
       //dd($bookings);
       $html = '';
//        $html .= ' <div class="panel panel-default card-view">
//        <div class="panel-heading">
//            <div class="pull-left">
//                <h2 class="shoots-Head">'.trans('sbph::app.search_result').'</h2>
//            </div>
//            <div class="clearfix"></div>
//        </div>
//        <div class="panel-wrapper">
//            <div class="panel-body">
//                <div class="table-wrap">
//                    <div class="table-responsive">
//                        <table id="datable_1" class="table table-hover display  pb-30" >
//                            <thead>
//                                <tr>
//                                    <th>'.  trans('theme::app.bookingid').'</th>
//                                    <th>'.  trans('theme::app.invoiceId').'</th>
//                                    <th>'. trans('theme::app.package').'</th>
//                                    <th>'.  trans('theme::app.booking_date').'</th>
//                                    <th>'.  trans('theme::app.booking_time').'</th>
//                                    <th>'.  trans('theme::app.booking_price').'</th>
//                                    <th>'.  trans('theme::app.customer_name').'</th>
//                                    <th>'.  trans('theme::app.mobile_number').'</th>
//                                    <th>'.  trans('theme::app.baby_name').'</th>
//                                    <th>'.  trans('theme::app.baby_age').'</th>
//                                    <th>'.  trans('theme::app.instructions').'</th>
                                  
                                  
//                                </tr>
//                            </thead>
//                            <tfoot>
//                                <tr>
//                                <th>'.  trans('theme::app.bookingid').'</th>
//                                <th>'.  trans('theme::app.invoiceId').'</th>
//                                <th>'. trans('theme::app.package').'</th>
//                                <th>'.  trans('theme::app.booking_date').'</th>
//                                <th>'.  trans('theme::app.booking_time').'</th>
//                                <th>'.  trans('theme::app.booking_price').'</th>
//                                <th>'.  trans('theme::app.customer_name').'</th>
//                                <th>'.  trans('theme::app.mobile_number').'</th>
//                                <th>'.  trans('theme::app.baby_name').'</th>
//                                <th>'.  trans('theme::app.baby_age').'</th>
//                                <th>'.  trans('theme::app.instructions').'</th>
                               
//                                </tr>
//                            </tfoot>
//                            <tbody>';
//                                foreach($bookings as $key=>$booking){ 
//                                     $html .= '<tr>';
//                                     $html .= '<td>'.$booking->title.'</td>';
//                                     $html .= '<td>'.$booking->transaction_id.'</td>';
//                                     $html .= '<td>'.$booking->package->title.'</td>';
//                                     $html .= '<td>'.$booking->booking_date.'</td>';
//                                     $html .= '<td>'.$booking->timeslot->title.' ['.$booking->timeslot->starttime.' to '.$booking->timeslot->endtime.'] </td>';
//                                     $html .= '<td>'.$booking->booking_price.' KD</td>';
//                                     $html .= '<td>'.$booking->customer_name.'</td>';
//                                     $html .= '<td>'.$booking->mobile_number.'</td>';
//                                     $html .= '<td>'.$booking->baby_name.'</td>';
//                                     $html .= '<td>'.$booking->instructions.'</td>';
//                                     $html .= '<td> </td>';
//                                     $html .= ' </tr>';
//                                }
//                             $html .= '</tbody>
//                        </table>
//                    </div>
//                </div>
//            </div>
//        </div>
//    </div>';
foreach($bookings as $key=>$booking){ 
            $html .=' <div class="row package-item">
               <div class="col-sm-12 mb-xl-4 pb-5">
                <div class="details-form">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">
                                    '.  trans('sbph::app.bookingid').'
                                    </p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                    '.$booking->title.'
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">
                                    '.  trans('sbph::app.invoiceId').'
                                        
                                    </p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                        '.$booking->transaction_id.'
                                    </p>
                                </div>
                            </div>
                         </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">
                                    '.  trans('sbph::app.customer_name').'
                                    </p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                    '.$booking->customer_name.'
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">'. trans('sbph::app.package').'</p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                    '.$booking->package->title.'
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">
                                    '.  trans('sbph::app.mobile_number').'
                                    </p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                     '.$booking->mobile_number.'
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">
                                    '.  trans('sbph::app.booking_date').'
                                    </p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                    '.$booking->booking_date.'
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">
                                    '.  trans('sbph::app.baby_name').'
                                    </p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                    '.$booking->baby_name.'
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">
                                    '.  trans('sbph::app.booking_time').'
                                    </p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                    '.$booking->timeslot->title.' ['.$booking->timeslot->starttime.' to '.$booking->timeslot->endtime.']
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">
                                    '.trans('sbph::app.baby_age').'
                                    </p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                    '.$booking->baby_age.'
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-sm-4 col-6 bg-light">
                                    <p class="fs20">
                                    '.  trans('sbph::app.status').'
                                        
                                    </p>
                                </div>
                                <div class="col-sm-8 col-6">
                                    <p class="fs20">
                                        '.$booking->status.'
                                    </p>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 pb-5">
                <div class="package-head bg-light radius15 mh53 py-1 px-3 mb-2 d-inline-flex align-items-center">
                    <h4 class="fs23">
                    '.  trans('sbph::app.instructions').'
                    </h4>
                </div>
                <p class="fs20">
                '.$booking->instructions.'
                </p>
            </div>
            </div>';
        }
   
       $html .= '';
        return $html ;
    }

    public function checkTempSlot(){
        if(isset($_REQUEST['ajaxpage']) && $_REQUEST['ajaxpage'] =='checkSlotExist' ){
            if(isset($_REQUEST['booking_time'])){
                session_start();
                $session_id = session_id();
                $id = $_REQUEST['id'];
                $booking_date = $_REQUEST['booking_date'];
                $booking_time = $_REQUEST['booking_time'];
                if($this->getTempSlotByWithDateTimetSession($id,$booking_date,$booking_time,$session_id)>0){
                    echo '1';
                }elseif($this->getTempSlotByWithDateSession($booking_date,$session_id)==0){
                    DB::table('slots_temp')->insert([
                        'package_id' => $id,
                        'booking_date' => $booking_date,
                        'timeslot_id' => $booking_time,
                        'session' => $session_id
                    ]);
                }else{
                    DB::table('slots_temp')
                    ->where('session',$session_id)
                    ->update(['package_id' => $id,
                    'booking_date' => $booking_date,
                    'timeslot_id' => $booking_time]);
                }  
            }
        exit;
       }
    }

    static function getTempSlotByWithDateSession($date,$session_id){
        //$session_id = session_id();
       // return $slots = DB::table('slots_temp')->where('booking_date', $date)->where('session', $session_id)->count();
       return $slots = DB::table('slots_temp')->where('session', $session_id)->count();
    }
    static function getTempSlotByWithDateTimetSession($id,$date,$time,$session_id){
        //$session_id = session_id();
        return $slots = DB::table('slots_temp')->where('package_id', $id)->where('booking_date', $date)->where('timeslot_id', $time)->where('session', '!=',$session_id)->count();
    }
    public function checkActiveSlote(){
        add_action('theme.footer', function() {
            $html = '<script>
            $("body").on("change", "#booking_time", function(e) {
                var booking_time = $("#booking_time").val();
                var booking_date = $("#booking_date").val();
                var id = $("#id").val();
                if(booking_time>0){
                   $.ajax({
                       type: "GET",
                       url: "?ajaxpage=checkSlotExist",
                       data: "booking_time=" + booking_time +"&booking_date=" + booking_date +"&id=" + id,
                       success:function(result){
                            if(result == 1){
                                //$("#continue_to_payment").prop("disabled", true);
                                $("#booking_time").prop("selectedIndex",0);
                                alert("Someone hold this time please try again later Or Please select other time!");
                                setTimeout( function(){
                                    fetchdata()  
                                }, 600000);
                            }else{
                                //$("#continue_to_payment").prop("disabled", false);
                                setTimeout( function(){
                                    fetchdata()  
                                }, 600000);
                            }       
                        }
                   });
                }
                
               });
               </script>';
           echo  $html;
        }, 45, 1);
        add_action('theme.footer', function() {
            $html = '<script>
            function fetchdata(){
                    $.ajax({
                        type: "GET",
                        url: "?ajaxpage=sessionOutExist",
                        data: "",
                        success:function(result){
                            if(result == 1){
                                alert("Your max session time out!!!");
                                $("#booking_time").prop("selectedIndex",0);
                                 location.reload();
                                }
                        }
                    }); 
			     }
                 function cleanSlotdata(){
                    $.ajax({
                        type: "GET",
                        url: "?ajaxpage=checkSlotAndDelete",
                        data: "",
                        success:function(result){
                            if(result == 1){
                                
                                }
                        }
                    }); 
			     } 
			     setInterval(cleanSlotdata,10000);
               </script>';
           echo  $html;
        }, 55, 1);
    }

    public function clearSession(){
        add_action('after.booking.faild', function() {
            session_start();
            $session_id = session_id();
            DB::table('slots_temp')->where('session', '=',$session_id)->delete();
        }, 20, 1);

        // add_action('theme.booking.extra', function() {
        //     session_start();
        //     $session_id = session_id();
        //     DB::table('slots_temp')->where('session', '=',$session_id)->delete();
        // }, 20, 1);

        if(isset($_REQUEST['ajaxpage']) && $_REQUEST['ajaxpage'] =='sessionOutExist' ){
            session_start();
            $session_id = session_id();
            DB::table('slots_temp')->where('session', '=',$session_id)->delete();
            echo '1';
          exit;
       }  

       if(isset($_REQUEST['ajaxpage']) && $_REQUEST['ajaxpage'] =='checkSlotAndDelete' ){
        $date = new \DateTime;
        $date->modify('-10 minutes');
      
            echo $formatted_date = $date->format('Y-m-d H:i:s');
            $result = DB::table('slots_temp')->where('created_at','<',$formatted_date)->delete();
            // DB::table('slots_temp')->delete();
             exit;

       }  
    }
   
    public function CronBookingNotification(){
        if(isset($_REQUEST['cronpage']) && $_REQUEST['cronpage'] =='notification' ){
            $settings = Setting::all()->toArray();
            $config=array();
            foreach($settings as $setting){
                $config[$setting["field_key"]] = $setting["field_value"];
            }
            $days=1;
            if(isset($config['number_day'])){
                $days=$config['number_day'];
            }
            //dd($config['number_day']);
            $datetime = new \DateTime();
            $datetime->modify('+'.$days.' days');
            $tody = $datetime->format('d-m-Y');
            $bookings = Booking::whereIn('status',['yes','Yes'])->where('booking_date',$tody)->get();
            if(!empty($bookings)){
                foreach($bookings as $key=>$booking){
                    $slot = $booking->timeslot->starttime .'To'. $booking->timeslot->endtime;
                    $booking_date = $booking->booking_date;
                    $orderid = $booking->title;
                    $rptest=["[bdate]","[time]","[orderId]"];
                    $nptext = [$booking_date,$slot,$orderid];
                    $data= array(
                    'message'=>str_replace($rptest,$nptext,trans('sbkw::app.sussess_message')),
                    'mobile'=>$booking->mobile_number,
                    'email'=>$booking->customer_email,
                    'bookingId'=>$orderid,
                    'code'=>'+965',
                    );
                    do_action('booking.email.index',$data);
                    do_action('booking.sms.index',$data);
                }
             }
             exit;
           }   
        }
        
    public function getEmployeeList(){
       
       add_action('admin.employees.option', function() {
           $employees = User::where('usertype','employee')->get();
           $option='';
           if($employees){
               foreach($employees as $key=>$employee){
                   $option .='<option value="'.$employee->id.'">'.$employee->name.'</option>';
               }
            }
           echo $option;
           }, 5, 1);
       
    }    
    
     public function addDoEmailAction(){
        $this->addAction('booking.email.index', function ($data) {
	        $email = $data['email'];
            $message=$data['message'];
            $code=$data['code'];
            $bookingId=$data['bookingId'];
            $rsp = $this->sendEmail($email,$message,$bookingId,0); 
            //dd($rsp);
        });  
    }

    static function sendEmail($email,$message,$bookingId,$flag=0){
        $settingsTitle=get_config("title");
        $settingsWebsite=asset('/');
        $settingslogo='https://saycheeez.createkwservers.com/storage/2023/01/17/header-logo-oTTLqGJ7tjI4UzF.png';
        $settingsEmail='info@createkwservers.com';
    	  
    		$sendEmail = $email;
    			$title = "Booking From - {$settingsTitle}";
    			$msg = "<center>
                        <img src='{$settingslogo}' style='width:200px;'>
    					<p>&nbsp;</p>
    					<p>'.$message.'</p>
    					<p>Best regards,<br>
    					<strong>{$settingsTitle}</strong></p>
    					</center>";
    					
    		$curl = curl_init();
    		curl_setopt_array($curl, array(
    			CURLOPT_URL => 'https://createid.link/api/v1/send/notify',
    			CURLOPT_RETURNTRANSFER => true,
    			CURLOPT_ENCODING => '',
    			CURLOPT_MAXREDIRS => 10,
    			CURLOPT_TIMEOUT => 0,
    			CURLOPT_FOLLOWLOCATION => true,
    			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    			CURLOPT_CUSTOMREQUEST => 'POST',
    			CURLOPT_POSTFIELDS => array(
    				'site' => $title,
    				'subject' => "Booking #{$bookingId}",
    				'body' => $msg,
    				'from_email' => $settingsEmail,
    				'to_email' => $sendEmail
    			),
    		));
    		$response = curl_exec($curl);
    		curl_close($curl);
    		
	}

}
