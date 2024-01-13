<?php

namespace Sbhadra\Employees\Http\Controllers;

use Juzaweb\Http\Controllers\ApiController;
use Juzaweb\Models\User;
use Juzaweb\Models\UserConfig;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Service;
use Sbhadra\Photography\Models\Booking;
use Sbhadra\Photography\Models\Timeslot;
use Sbhadra\Photography\Models\Branch;
use Sbhadra\Calendar\Models\CalendarSetting;
use Illuminate\Http\Request;


class EmployeesController extends ApiController
{
    public function index()
    {
      $vendors=  User::where('usertype','company')->get();
      return $vendors;
    }

    public function add(Request $request){
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'username' => 'required|unique:users,username',
            ]);
        //$file = $request->file('image')->store('public/images/teams');
            $password = \Hash::make($request->password);
            $team = new User;
            $team->name = $request->name;
            $team->username = $request->username;
            $team->email = $request->email;
            $team->password =  $password;
            $team->usertype = 'company';
            $team->is_admin = 1;
            $team->status = 'active';
            $team->permissions = '{"dashboard":{"dashboard":"1","updates":"1"},"media":"0","posts":{"posts":"0","posts-create":"0","post-categories":"0","post-tags":"0","post-comments":"0"},"pages":{"pages":"0","pages-create":"0"},"packages":{"packages":"1","packages-create":"1"},"services":{"services":"1","services-create":"1"},"timeslots":{"timeslots":"1","timeslots-create":"1","timeslot\/ramadan":"1"},"branches":{"branches":"1","branches-create":"1"},"bookings":{"bookings":"1","success-bookings":"1","cancel-bookings":"1","complete-bookings":"1","calendar-setting":"1","bookings-create":"1","booking-calendar":"1","employee-calendar":"1"},"appearance":{"themes":"0","widgets":"0","menus":"0","customize":"0"},"coupons":{"coupons":"1","coupons-create":"1"},"plugin":{"plugins":"0","plugins-install":"0"},"users":"0","setting":{"setting-system":"1","reading":"1","permalinks":"1","setting\/maintenance":"1","setting\/booking":"1","customize":"1"},"translations":"0","logs":{"logs-email":"0","logs-error":"0"}}';
            if($team->save()){
                $company_id=$team->id;
                if(isset($request->config)){
                    $configs = json_decode($request->config);
                    foreach ($configs as $key => $config) {
                        if( $uConfig = UserConfig::where('code',$key)->where('company_id',$company_id)->first()){
                            $conf= UserConfig::find($uConfig->id);
                            $conf->value = $config;
                            $conf->save();
                        }else{
                            $conf= new UserConfig;
                            $conf->code = $key;
                            $conf->value = $config;
                            $conf->company_id = $company_id;
                            $conf->save();
                        }
                    }
                    $package_id =  $this->createSlotServiceBranchPackage($request,$company_id);
                    if($package_id>0){
                        $pConfig = UserConfig::where('code','package_id')->where('company_id',$company_id)->first();
                        $pConfig->value = $package_id;
                        $pConfig->save();
                     }
              }
            }
         //return $team; 
         return ['status'=>'success','message'=>'Done','data'=>$team];
    }

    public function getVendorByUsername(Request $request){
        if($username=$request->username){
            $vendor =  User::where('username',$username)->first();
            if($vendor){
               // return $vendor;
                return ['status'=>'success','message'=>'Done','data'=>$vendor];
            }else{
                return ['status'=>'error','message'=>'Vendoe not exist!'];
            }
            
        } else{
            return ['status'=>'error','message'=>'Username is required'];
        }
    }
    public function updateVendor(Request $request){
            
            if($request->user_id>0){
                $password = \Hash::make($request->password);
                $team =  User::find($request->user_id);
                $team->name = $request->name;
                //$team->email = $request->email;
                //$team->password =  $password;
                //$team->usertype = 'company';
                //$team->is_admin = 1;
                //$team->status = 'active';
                //$team->permissions = '{"dashboard":{"dashboard":"1","updates":"1"},"media":"0","posts":{"posts":"0","posts-create":"0","post-categories":"0","post-tags":"0","post-comments":"0"},"pages":{"pages":"0","pages-create":"0"},"packages":{"packages":"1","packages-create":"1"},"services":{"services":"1","services-create":"1"},"timeslots":{"timeslots":"1","timeslots-create":"1","timeslot\/ramadan":"1"},"branches":{"branches":"1","branches-create":"1"},"bookings":{"bookings":"1","success-bookings":"1","cancel-bookings":"1","complete-bookings":"1","calendar-setting":"1","bookings-create":"1","booking-calendar":"1","employee-calendar":"1"},"appearance":{"themes":"0","widgets":"0","menus":"0","customize":"0"},"coupons":{"coupons":"1","coupons-create":"1"},"plugin":{"plugins":"0","plugins-install":"0"},"users":"0","setting":{"setting-system":"1","reading":"1","permalinks":"1","setting\/maintenance":"1","setting\/booking":"1","customize":"1"},"translations":"0","logs":{"logs-email":"0","logs-error":"0"}}';
                if($team->save()){
                    $company_id=$team->id;
                    if(isset($request->config)){
                        $configs = json_decode($request->config);
                        foreach ($configs as $key => $config) {
                            if( $uConfig = UserConfig::where('code',$key)->where('company_id',$company_id)->first()){
                                $conf= UserConfig::find($uConfig->id);
                                $conf->value = $config;
                                $conf->save();
                            }else{
                                $conf= new UserConfig;
                                $conf->code = $key;
                                $conf->value = $config;
                                $conf->company_id = $company_id;
                                $conf->save();
                            }
                        }
                  }
                }
            }else{
               $request->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|confirmed|min:6',
                    'username' => 'required|unique:users,username',
                ]);
            $password = \Hash::make($request->password);
            $team = new User;
            $team->name = $request->name;
            $team->username = $request->username;
            $team->email = $request->email;
            $team->password =  $password;
            $team->usertype = 'company';
            $team->is_admin = 1;
            $team->status = 'active';
            $team->permissions = '{"dashboard":{"dashboard":"1","updates":"1"},"media":"0","posts":{"posts":"0","posts-create":"0","post-categories":"0","post-tags":"0","post-comments":"0"},"pages":{"pages":"0","pages-create":"0"},"packages":{"packages":"1","packages-create":"1"},"services":{"services":"1","services-create":"1"},"timeslots":{"timeslots":"1","timeslots-create":"1","timeslot\/ramadan":"1"},"branches":{"branches":"1","branches-create":"1"},"bookings":{"bookings":"1","success-bookings":"1","cancel-bookings":"1","complete-bookings":"1","calendar-setting":"1","bookings-create":"1","booking-calendar":"1","employee-calendar":"1"},"appearance":{"themes":"0","widgets":"0","menus":"0","customize":"0"},"coupons":{"coupons":"1","coupons-create":"1"},"plugin":{"plugins":"0","plugins-install":"0"},"users":"0","setting":{"setting-system":"1","reading":"1","permalinks":"1","setting\/maintenance":"1","setting\/booking":"1","customize":"1"},"translations":"0","logs":{"logs-email":"0","logs-error":"0"}}';
            if($team->save()){
                $company_id=$team->id;
                //$package_id =  $this->createSlotServiceBranchPackage($request,$company_id);
                if(isset($request->config)){
                    $configs = $request->config;
                    foreach ($configs as $key => $config) {
                        if( $uConfig = UserConfig::where('code',$key)->where('company_id',$company_id)->first()){
                            $conf= UserConfig::find($uConfig->id);
                            $conf->value = $config;
                            $conf->save();
                        }else{
                            $conf= new UserConfig;
                            $conf->code = $key;
                            $conf->value = $config;
                            $conf->company_id = $company_id;
                            $conf->save();
                        }
                    }
                }
              
              }
            }
           //$file = $request->file('image')->store('public/images/teams');
          
         //return $team; 
         return ['status'=>'success','message'=>'Done','data'=>$team];
    }
    public function UpdateVendorData(Request $request){
        if($request->user_id){
            $password = \Hash::make($request->password);
            $team =  User::find($request->user_id);
            $team->name = $request->name;
            //$team->email = $request->email;
            //$team->password =  $password;
            //$team->usertype = 'company';
            //$team->is_admin = 1;
            //$team->status = 'active';
            //$team->permissions = '{"dashboard":{"dashboard":"1","updates":"1"},"media":"0","posts":{"posts":"0","posts-create":"0","post-categories":"0","post-tags":"0","post-comments":"0"},"pages":{"pages":"0","pages-create":"0"},"packages":{"packages":"1","packages-create":"1"},"services":{"services":"1","services-create":"1"},"timeslots":{"timeslots":"1","timeslots-create":"1","timeslot\/ramadan":"1"},"branches":{"branches":"1","branches-create":"1"},"bookings":{"bookings":"1","success-bookings":"1","cancel-bookings":"1","complete-bookings":"1","calendar-setting":"1","bookings-create":"1","booking-calendar":"1","employee-calendar":"1"},"appearance":{"themes":"0","widgets":"0","menus":"0","customize":"0"},"coupons":{"coupons":"1","coupons-create":"1"},"plugin":{"plugins":"0","plugins-install":"0"},"users":"0","setting":{"setting-system":"1","reading":"1","permalinks":"1","setting\/maintenance":"1","setting\/booking":"1","customize":"1"},"translations":"0","logs":{"logs-email":"0","logs-error":"0"}}';
            if($team->save()){
                $company_id=$team->id;
                if(isset($request->config)){
                    $configs = json_decode($request->config);
                    foreach ($configs as $key => $config) {
                        if( $uConfig = UserConfig::where('code',$key)->where('company_id',$company_id)->first()){
                            $conf= UserConfig::find($uConfig->id);
                            $conf->value = $config;
                            $conf->save();
                        }else{
                            $conf= new UserConfig;
                            $conf->code = $key;
                            $conf->value = $config;
                            $conf->company_id = $company_id;
                            $conf->save();
                        }
                    }   
               }
            }
            return ['status'=>'success','message'=>'Done','data'=>$team];
        }else{
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'username' => 'required|unique:users,username',
            ]);
            $password = \Hash::make($request->password);
            $team = new User;
            $team->name = $request->name;
            $team->username = $request->username;
            $team->email = $request->email;
            $team->password =  $password;
            $team->usertype = 'company';
            $team->is_admin = 1;
            $team->status = 'active';
            $team->permissions = '{"dashboard":{"dashboard":"1","updates":"1"},"media":"0","posts":{"posts":"0","posts-create":"0","post-categories":"0","post-tags":"0","post-comments":"0"},"pages":{"pages":"0","pages-create":"0"},"packages":{"packages":"1","packages-create":"1"},"services":{"services":"1","services-create":"1"},"timeslots":{"timeslots":"1","timeslots-create":"1","timeslot\/ramadan":"1"},"branches":{"branches":"1","branches-create":"1"},"bookings":{"bookings":"1","success-bookings":"1","cancel-bookings":"1","complete-bookings":"1","calendar-setting":"1","bookings-create":"1","booking-calendar":"1","employee-calendar":"1"},"appearance":{"themes":"0","widgets":"0","menus":"0","customize":"0"},"coupons":{"coupons":"1","coupons-create":"1"},"plugin":{"plugins":"0","plugins-install":"0"},"users":"0","setting":{"setting-system":"1","reading":"1","permalinks":"1","setting\/maintenance":"1","setting\/booking":"1","customize":"1"},"translations":"0","logs":{"logs-email":"0","logs-error":"0"}}';
            if($team->save()){
                $company_id=$team->id;
                if(isset($request->config)){
                    $configs = $request->config;
                    foreach ($configs as $key => $config) {
                        if( $uConfig = UserConfig::where('code',$key)->where('company_id',$company_id)->first()){
                            $conf= UserConfig::find($uConfig->id);
                            $conf->value = $config;
                            $conf->save();
                        }else{
                            $conf= new UserConfig;
                            $conf->code = $key;
                            $conf->value = $config;
                            $conf->company_id = $company_id;
                            $conf->save();
                        }
                    }
                }
                
                $setting = CalendarSetting::where('user_id',$team->id)->first();
                 if(!$setting){
                    $setting = new CalendarSetting;
                    $setting ->start_date = '2023-03-04';
                    $setting ->end_date = '2023-06-30';
                    $setting ->close_days = '["5","6"]';
                    $setting ->cwith_days =1;
                    $setting ->status ='yes';
                    $setting ->user_id =$team->id;
                    $setting ->save();
                 }

            }
            return ['status'=>'success','message'=>'Done','data'=>$team];
        }
        
    }
    static function createSlotServiceBranchPackage($request,$company_id){
       $package_id =0;
       $slot = new Timeslot;
       $slot->title =$request->username.'-'.$company_id;
       $slot->slug =$request->username.'-'.$company_id;
       $slot->starttime ='4 : 00 PM';
       $slot->endtime ='6 : 00 PM';
       $slot->slot_interval ='2h';
       $slot->status ='publish';
       $slot->max_booking_no =1;
       $slot->slot_type ='normal';
       $slot->company_id =$company_id;
       if($slot->save()){
         $slots[]=$slot->id;
            $service = new Service;
            $service->title = $request->username.' '.$company_id;
            $service->slug =$request->username.'-'.$company_id;
            $service->price = 30.00;
            $service->status ='publish';
            $service->slots ='["'.$slot->id.'"]';
            $service->company_id =$company_id;
           if($service->save()) {
                $Branch = new Branch;
                $Branch -> title =$request->username.' '.$company_id;
                $Branch -> slug =$request->username.'-'.$company_id;
                $Branch -> description ='';
                $Branch -> location ='change the location';
                $Branch->status ='publish';
                $Branch->company_id =$company_id;
                if($Branch->save()) {
                    $services[] = $service->id;
                    $Branch->services()->sync($services);
                    $package = new Package;
                    $package->title =$request->username.' '.$company_id;
                    $package->slug =$request->username.'-'.$company_id;
                    $package->content ='';
                    $package->short_description ='';
                    $package->price =10.00;
                    $package->currency ='KD';
                    $package->max_booking =1;
                    $package->is_type =1;
                    $package->normal_period  ='2h';
                    $package->album_period  ='3h';
                    $package->status ='publish';
                    $package->company_id =$company_id;
                    if($package->save()) {
                        $branches[]= $Branch->id;
                        $package->branches()->sync($branches);
                        $package->slots()->sync($slots);
                        $package_id = $package->id;
                    }
                    
                }
            }
        }
        return $package_id;
    }   
}
