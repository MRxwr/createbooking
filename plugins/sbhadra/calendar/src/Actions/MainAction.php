<?php

namespace Sbhadra\Calendar\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Models\User;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Sbhadra\Calendar\Models\Calendar;
use Sbhadra\Calendar\Models\CalendarSetting;
use Sbhadra\Photography\Models\Booking;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Timeslot;
use Illuminate\Support\Facades\DB;
class MainAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle()
    {
          $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerCalender']);
          $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'getCalenderHooks']);
          $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'getCalenderHooksAdmin']);
          $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'getEmployeeListforCheckbox']);
    }

    public function registerCalender()
    {
       
        HookAction::addAdminMenu(
            trans('sbca::app.calendar_setting'),
            'calendar-setting',
            [
                'icon' => 'fa fa-cogs',
                'position' => 3,
                'parent' => 'bookings',
            ]
        );
        HookAction::addAdminMenu(
            trans('sbca::app.booking_calendar'),
            'booking-calendar',
            [
                'icon' => 'fa fa-calendar',
                'position' => 4,
                'parent' => 'bookings',
            ]
        );
         HookAction::addAdminMenu(
            trans('sbca::app.employee_calendar'),
            'employee-calendar',
            [
                'icon' => 'fa fa-calendar',
                'position' => 5,
                'parent' => 'bookings',
            ]
        );
        
    }
    public function getCalenderHooks($post){
        
        add_filters('theme.calendar.hooks', function($post){
            $datesDisabled_array =array();
            $package_id = $post->id; 
            $slots = count($post->slots);

            if($post->company_id>0){
               $user = User::find($post->company_id);
               if($user->usertype=='company'){
                $sys_dates = DB::table('calendar_settings')->select('start_date','end_date','close_days','cwith_days')->where('user_id',$post->company_id)->first();
                $setting =  $sys_dates ;
               }else{
                $sys_dates = DB::table('calendar_settings')->select('start_date','end_date','close_days','cwith_days')->where('id',1)->first();
                $setting =  $sys_dates ;
               }
            }else{
                $sys_dates = DB::table('calendar_settings')->select('start_date','end_date','close_days','cwith_days')->where('id',1)->first();
                $setting =  $sys_dates ;
            }
            //dd($setting);
            
            //$calendar_dates = Calendar::where('package_id',$package_id)->where('slots','all')->get();
            $calendar_dates = Calendar::where('package_id',$package_id)->get();
            if(!empty( $calendar_dates)){
                foreach($calendar_dates as $cdate){
                    if($cdate->slots=='all'){
                        $dates = $this->getDatesFromRange($cdate->from_date, $cdate->to_date);
                        $datesDisabled_array = array_merge($datesDisabled_array,$dates);
                    }else{
                        $dates =  $this->getBookedDateWithdisableSlots( $format = 'd-m-Y',$cdate,$post);
                        $datesDisabled_array = array_merge($datesDisabled_array,$dates);
                        // $cslot = count(json_decode($cdate->slots));
                        // if($slots==$cslot){
                        //     $dates = $this->getDatesFromRange($cdate->from_date, $cdate->to_date);
                           $datesDisabled_array = array_merge($datesDisabled_array,$dates);
                        // }
                    }
                    
                }
            }

            $calendar_dates_all = Calendar::where('package_id',0)->get();
            if(!empty( $calendar_dates_all)){
                foreach($calendar_dates_all as $cdate){
                    if($cdate->slots=='all'){
                        $dates = $this->getDatesFromRange($cdate->from_date, $cdate->to_date);
                        $datesDisabled_array = array_merge($datesDisabled_array,$dates);
                    }else{
                        $dates =  $this->getBookedDateWithdisableSlots( $format = 'd-m-Y',$cdate,$post);
                        $datesDisabled_array = array_merge($datesDisabled_array,$dates);
                    }
                    
                }
            }
             
             $all_sys_dates = $this->getDatesFromRange($setting->start_date, $setting->end_date);
             foreach($all_sys_dates as $sdate){
                 $dates =  $this->getBookedDateWithCalendarDate( $format = 'd-m-Y',$sdate,$post);
                        $datesDisabled_array = array_merge($datesDisabled_array,$dates);
             }
           // dd($sys_dates);
          if($setting->cwith_days>0){
              $today = date('d-m-Y');
              $NewDate=Date('d-m-Y', strtotime('+'.$setting->cwith_days.' days'));
              $currnt_close_date = $this->getDatesFromRange($today, $NewDate);
              $datesDisabled_array = array_merge($datesDisabled_array,$currnt_close_date);
          }
            $datesDisabled = json_encode($datesDisabled_array);
            
            $close_days = '[9]';
            if($setting->close_days!=null){
                $close_days = $setting->close_days;
            }
            return '<script>
            var startDate="'.$setting->start_date.'";
            var endDate="'.$setting->end_date.'";
            var datesDisabled = '.$datesDisabled.';
            var daysOfWeekDisabled = '.$close_days.'
            </script>';
       }, 20, 1);
        
    }

    public function getCalenderHooksAdmin(){
        
        $this->addAction('admin.calendar.hooks', function(){
            $slot_limits=5;
            if(isset($_REQUEST['id'])){
                $datesDisabled_array =array();
                $post = Package::find($_REQUEST['id']);
            $package_id = $_REQUEST['id']; 
            $slots = count($post->slots);
            if($post->company_id>0){
                $user = User::find($post->company_id);
                if($user->usertype=='company'){
                 $sys_dates = DB::table('calendar_settings')->select('start_date','end_date','close_days','cwith_days')->where('user_id',$post->company_id)->first();
                 $setting =  $sys_dates ;
                }else{
                 $sys_dates = DB::table('calendar_settings')->select('start_date','end_date','close_days','cwith_days')->where('id',1)->first();
                 $setting =  $sys_dates ;
                }
             }else{
                 $sys_dates = DB::table('calendar_settings')->select('start_date','end_date','close_days','cwith_days')->where('id',1)->first();
                 $setting =  $sys_dates ;
             }
            $calendar_dates = Calendar::where('package_id',$package_id)->get();
            if(!empty( $calendar_dates)){
                foreach($calendar_dates as $cdate){
                    if($cdate->slots=='all'){
                        $dates = $this->getDatesFromRange($cdate->from_date, $cdate->to_date);
                        $datesDisabled_array = array_merge($datesDisabled_array,$dates);
                    }else{
                        $dates =  $this->getBookedDateWithdisableSlots( $format = 'd-m-Y',$cdate,$post);
                        $datesDisabled_array = array_merge($datesDisabled_array,$dates);
                        
                    }
                    
                }
            }
          
            $bookings = DB::table('bookings')
                 ->select('booking_date', DB::raw('count(*) as total'))
                 ->whereIn('status',['Yes','yes'])
                 ->groupBy('booking_date')
                 ->get();  
                 $datesDisabled_array =array('13-01-2022');
                 foreach($bookings as $booking){
                    if($booking->total >=($slots*$slot_limits) ){
                        array_push($datesDisabled_array,$booking->booking_date);
                    }
                 }
               $datesDisabled = json_encode($datesDisabled_array);
             
            $close_days = '[9]';
            if($setting->close_days!=null){
                $close_days = $setting->close_days;
            }
            echo '<script>
            var startDate="'.$setting->start_date.'";
            var endDate="'.$setting->end_date.'";
            var datesDisabled = '.$datesDisabled.';
            var daysOfWeekDisabled = '.$close_days.'
            </script>';
                }
       }, 20, 1);
        
    }

    static function getBookedDateWithdisableSlots($format = 'd-m-Y',$cdate=array(),$post=array()){
        
        $slot_limits=5;
        $package_id = $post->id; 
        $slots = count($post->slots); 
       // Declare an empty array 
        $cslot = count(json_decode($cdate->slots));
                       
       $array = array(); 
       $start= $cdate->from_date;
       $end= $cdate->to_date;
      // Variable that store the date interval 
      // of period 1 day 
      $interval = new \DateInterval('P1D'); 
    
      $realEnd = new \DateTime($end); 
      $realEnd->add($interval); 
    
      $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd); 
    
      // Use loop to store date into array 
      foreach($period as $date) {   
         $booked_date = $date->format($format);  
            $pmax=0;
            $smax =0;
            $pmax_booking_sameslot = 0;
            $max_booking_slot=0;
            foreach($post->slots as $slot ){
                $pmax = $pmax+$post->max_booking;
                $smax = $smax + $slot->max_booking_no;
                        $pmax_booking_sameslot = DB::table('bookings')->where('package_id',$post->id)->where('booking_date','=',$booked_date)->where('timeslot_id',$slot->id)->whereIn('status',['Yes','yes'])->count();
                        $max_booking_slot = $max_booking_slot + DB::table('bookings')->where('booking_date','=',$booked_date)->where('timeslot_id',$slot->id)->whereIn('status',['Yes','yes'])->count(); 
                }
            
            if($pmax<=$pmax_booking_sameslot || $smax <= $max_booking_slot){
                 $array[] = $booked_date;
            }
            
      } 
    
      // Return the array elements 
      return $array; 

    }
    
    static function getBookedDateWithCalendarDate($format = 'd-m-Y',$cdate="",$post=array()){
        $package_id = $post->id; 
        $array = array(); 
        $date = new \DateTime($cdate); 
        $booked_date = $date->format($format);  
            $pmax=0;
            $smax =0;
            $pmax_booking_sameslot = 0;
            $max_booking_slot=0;
            foreach($post->slots as $slot ){
                $pmax = $pmax+$post->max_booking;
                $smax = $smax + $slot->max_booking_no;
                       $pmax_booking_sameslot = DB::table('bookings')->where('package_id',$post->id)->where('booking_date','=',$booked_date)->where('timeslot_id',$slot->id)->whereIn('status',['Yes','yes'])->count();
                       $max_booking_slot = $max_booking_slot + DB::table('bookings')->where('booking_date','=',$booked_date)->where('timeslot_id',$slot->id)->whereIn('status',['Yes','yes'])->count(); 
                }
            
            if($pmax<=$pmax_booking_sameslot || $smax <= $max_booking_slot){
                 $array[] = $booked_date;
            }

      return $array; 

    }
    
    static function getDatesFromRange($start, $end, $format = 'd-m-Y') { 
          
      // Declare an empty array 
      $array = array(); 
        
      // Variable that store the date interval 
      // of period 1 day 
      $interval = new \DateInterval('P1D'); 
    
      $realEnd = new \DateTime($end); 
      $realEnd->add($interval); 
    
      $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd); 
    
      // Use loop to store date into array 
      foreach($period as $date) {                  
          $array[] = $date->format($format);  
      } 
    
      // Return the array elements 
      return $array; 
    } 
    
    
    static function getSlotBookingCount($booked_date,$post){
        $pmax=0;
        $smax =0;
        $pmax_booking_sameslot = 0;
        $max_booking_slot=0;
        foreach($post->slots as $slot ){
            $pmax = $pmax+$post->max_booking;
            $smax = $smax + $slot->max_booking_no;
                 $pmax_booking_sameslot =  Booking::where('booking_date',$booked_date)->where('package_id',$post->id)->whereIn('status',['Yes','yes'])->where('timeslot_id',$slot->id)->count();
                 $max_booking_slot = $max_booking_slot + Booking::where('booking_date',$_REQUEST['date'])->whereIn('status',['Yes','yes'])->where('timeslot_id',$slot->id)->count();
                 
        }
        if($pmax<=$pmax_booking_sameslot || $smax <= $max_booking_slot){
            return $booked_date;
        }
                 
    }

    public function getEmployeeListforCheckbox(){
       
       add_action('admin.employees.ckeckbox', function() {
           $employees = User::where('usertype','employee')->get();
           $option='';
           if($employees){
               $option .='<h4>Employee list</h4>';
               $option .='<lebel class="checkbox-inline mr-2" for="empall"><input class="mr-2" id="empall"  type="checkbox" name="employee" value="0" checked>All</lebel>';
               $option .='<span id="emp_users">';
               foreach($employees as $key=>$employee){
                   $option .='<lebel class="checkbox-inline  mr-2" for="emp'.$employee->id.'"><input class="mr-2 option " id="emp'.$employee->id.'"  type="checkbox" name="employee" value="'.$employee->id.'">'.$employee->name.'</lebel>';
               }
             $option .='</span>';
            }
           echo $option;
           }, 5, 1);
       
    } 

}
