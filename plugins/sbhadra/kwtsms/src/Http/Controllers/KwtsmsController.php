<?php

namespace Sbhadra\Kwtsms\Http\Controllers;

use Juzaweb\Http\Controllers\BackendController;

class KwtsmsController extends BackendController
{
    public function sendkwtsms($mobile,$message,$code){
		$message = str_replace(' ','+',$message);
		    $url = 'http://www.kwtsms.com/API/send/?username=badertov&password=471990Bader&sender=HBQ+Studio&mobile='.$code.$mobile.'&lang=1&message='.$message;
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
	}
}
