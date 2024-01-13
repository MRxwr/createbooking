<?php
namespace Sbhadra\kwtsms\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Sbhadra\Photography\Models\Setting;

use Illuminate\Support\Facades\DB;
class MainAction extends Action
{
    public function handle()
    {
        
       // $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addDoKwtSMSAction']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'addDoKwtSMSAction']);

    }

    public function addDoKwtSMSAction(){
        $this->addAction('booking.sms.index', function ($data) {
            $arabic = ['١','٢','٣','٤','٥','٦','٧','٨','٩','٠'];
            $english = [ 1 ,  2 ,  3 ,  4 ,  5 ,  6 ,  7 ,  8 ,  9 , 0];
	        $phone = str_replace($arabic, $english, $data['mobile']);
	        $mobile = $phone;
            $message=$data['message'];
            $code=$data['code'];
            $rsp = $this->sendkwtsms($mobile,$message,$code,0); 
            //dd($rsp);
        });  
    }

    static function sendkwtsms($mobile,$message,$code,$flag=0){
        $sms_username = Setting::where('field_key','sms_username')->first()->field_value;
        $sms_password = Setting::where('field_key','sms_password')->first()->field_value;
        $sms_sender = Setting::where('field_key','sms_sender')->first()->field_value;
		$message = str_replace(' ','+',$message);
		
		if($flag==0){
		    $url = 'http://www.kwtsms.com/API/send/?username='.$sms_username.'&password='.$sms_password.'&sender='.$sms_sender.'&mobile='.$code.$mobile.'&lang=1&message='.$message;
		       $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_CUSTOMREQUEST => "GET",
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
				curl_close($curl);
				if ($err){
					return $err;
				}else{
					return $response;	
				}
		    $flag=1;
		}	
	}

}