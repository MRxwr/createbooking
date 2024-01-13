<?php

namespace Sbhadra\Survey\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Sbhadra\Survey\Models\Survey;
use Sbhadra\Survey\Models\Question;
use Sbhadra\Photography\Models\Booking;
use Illuminate\Support\Facades\DB;
use Sbhadra\Coupons\Models\Coupon;
use Illuminate\Http\Request;

class MainAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle()
    {
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerSurvey']);
//$this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerTemplates']);
        // $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerTaxonomies']);
        // $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'getBookingDetailsAjax']);
       $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'randerSurveyViews']);
       $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'saveSurveyPost']);
       $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'sendSurveySms']);
    }
   

    public function registerSurvey()
    {
        
        HookAction::registerPostType('survey', [
            'label' => trans('sbsu::app.survey'),
            'model' => Survey::class,
            'menu_position' => 38,
            'menu_icon' => 'fa fa-list',
        ]);
        HookAction::registerPostType('question', [
            'label' => trans('sbsu::app.questions'),
            'model' => Question::class,
            'parent' => 'survey',
            'menu_position' => 39,
            'menu_icon' => 'fa fa-list',
        ]);
        HookAction::addAdminMenu(
            trans('sbsu::app.survey_reffarel'),
            'survey/referral-code',
            [
                'icon' => 'fa fa-doller',
                'position' => 4,
                'parent' => 'survey',
            ]
        );
        // HookAction::addAdminMenu(
        //     trans('sbsu::app.survey_reffarel'),
        //     'survey/referral-code',
        //     [
        //         'icon' => 'fa fa-doller',
        //         'position' => 7,
        //         'parent' => 'coupons',
        //     ]
        // );
        
    }

    public function sendSurveySms(){
        $this->addAction('booking.complete.index', function($model) {
            $code =base64_encode($model->id);
            $link = url('attend-survey/').'?code='. $code;
            $rptest=["[link]"];
            $nptext = [$link];
            $data= array(
               'message'=>str_replace($rptest,$nptext,trans('sbkw::app.survey_success_message')),
               'mobile'=>$model->mobile_number,
               'code'=>'+965',
            );
            do_action('booking.sms.index',$data);
        }, 10, 1);
    }
    public function randerSurveyViews(){
        $this->addAction('theme.page.after.attend-survey', function($model) {
            $html='';
            if(isset($_REQUEST['code'])){
                //dd($_REQUEST['code']);
                if($this->checkSurveyCode($_REQUEST['code'])){
                    $questions = Question :: all();
                    $booking = $this->getSurveyBooking($_REQUEST['code']);
                    //echo $_REQUEST['survey'];
                    //dd($booking);
                    $html='';
                    $html .='<div class="col-xxl-7 px-xxl-4">
                        <div class="survey-box border">
                            <div class="text-center pb-3">
                                <img src="'.upload_url(get_config('logo')).'" alt="img" class="mw-100">
                            </div>';
                            if(!empty($questions)){
                                $html .='<form id="regForm" method="post" action="" >
                                <input type="hidden" name="surveyPost" value="true">
                                '.csrf_field().'
                                <input type="hidden" name="booking_id" value="'.$booking->id.'">
                                <input type="hidden" name="customer_name" value="'.$booking->customer_name.'">
                                <input type="hidden" name="customer_mobile" value="'.$booking->mobile_number.'">';
                                foreach($questions as $question){
                                $html .='<div class="tab">
                                         <p class="fs23 pb-5">'.$question->title.'</p>
                                         <input type="hidden" name="survey['.$question->id.'][question]" value="'.$question->title.'">
                                         <input type="hidden" name="survey['.$question->id.'][type]" value="'.$question->question_type.'">
                                            <ul>';
                                            if($question->question_type==1){
                                                $options = json_decode($question->options);
                                                if(!empty($options)){ 
                                                 foreach($options as $keys=>$option){
                                                      $html .='<li class="mb-3 pb-1">
                                                                <input type="hidden" name="survey['.$question->id.'][option]['.$keys.']" value="'.$option.'">
                                                                    <label class="container_radio bg-light" style="width: 100%;">
                                                                    <span style="margin: 0px 35px;">'.$option.'</span>
                                                                        <input type="radio" name="survey['.$question->id.'][answer]" value="'.$option.'"  oninput="this.className ="" ">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </li>';
                                                    }
                                                  }
                                                
                                            }
                                            elseif($question->question_type==2){
                                                $options = json_decode($question->options);
                                                if(!empty($options)){ 
                                                 foreach($options as $keys=>$option){
                                                      $html .='<li class="mb-3 pb-1">
                                                                <input type="hidden" name="survey['.$question->id.'][option]['.$keys.']" value="'.$option.'">
                                                                    <label class="container_radio bg-light" style="width: 100%;">
                                                                    <span style="margin: 0px 35px;"> '.$option.'</span>
                                                                        <input type="checkbox" name="survey['.$question->id.'][answer]" value="'.$option.'"  oninput="this.className ="" ">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </li>';
                                                    }
                                                  }
                                            }
                                            elseif($question->question_type==3){
                                                $html .='<li class="mb-3 pb-1">
                                                <label class="container_radio bg-light" style="width: 100%;">
                                                    <span style="margin: 0px 35px;">True</span>
                                                    <input type="radio" name="survey['.$question->id.'][answer]" value="true" >
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li class="mb-3 pb-1">
                                                <label class="container_radio bg-light">
                                                    <span style="margin: 0px 35px;">False</span>
                                                    <input type="radio" name="survey['.$question->id.'][answer]" value="false" >
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>';
                                            }
                                            elseif($question->question_type==4){
                                                $html .='<li class="mb-3 pb-1">
                                                <label class="bg-light col-sm-12" style="width: 100%;">
                                                    <input type="text" class="form-control" name="survey['.$question->id.'][answer]">
                                                </label>
                                            </li>';
                                            }
                                            $html .='</ul>
                                    </div>';
                               }
                                $html .='<div class="row px-xxl-5 pt-5">
                                    <div class="col-sm-6 d-flex justify-content-sm-end justify-content-center mt-4 mt-sm-0">
                                        <button class="btn btn-sm btn-info text-600 fs19" type="button" id="prevBtn" onclick="nextPrev(-1)" >Previous</button>
                                    </div>
                                    <div class="col-sm-6 d-flex justify-content-sm-end justify-content-center mt-4 mt-sm-0">
                                        <button class="btn btn-sm btn-info text-600 fs19" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>
                                <div style="text-align:center;margin-top:40px;">';
                                foreach($questions as $k=>$question){
                                    if($k>=0){
                                        $html .='<span class="step"></span>';
                                    }
                                    
                                }
                                $html .='</div>
                    </form>';

                    }
                    $html .='</div>
                    </div>';
                }else{
                    $html .='<div class="col-xxl-7 px-xxl-4"></div>';
                }
                  
            }else{
                $html .='<div class="col-xxl-7 px-xxl-4"></div>';
            }
            echo $html;
        }, 10, 1);

        add_action('theme.header', function() {
            $html = '<style>
              /* Mark input boxes that gets an error on validation: */
               .container_radio:not(.themeCheck) .checkmark {
                top: 4px;
               }
                input.invalid {
                background-color: #ffdddd;
                }

                /* Hide all steps by default: */
                .tab {
                display: none;
                }

                /* Make circles that indicate the steps of the form: */
                .step {
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbbbbb;
                border: none;
                border-radius: 50%;
                display: inline-block;
                opacity: 0.5;
                }

                /* Mark the active step: */
                .step.active {
                opacity: 1;
                }

                /* Mark the steps that are finished and valid: */
                .step.finish {
                background-color: #04AA6D;
                }
            </style>';
           echo  $html;
        }, 11, 1);
        add_action('theme.footer', function() {
            $html = '<script>var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab
            
            function showTab(n) {
              // This function will display the specified tab of the form ...
              var x = document.getElementsByClassName("tab");
              x[n].style.display = "block";
              // ... and fix the Previous/Next buttons:
              if (n == 0) {
                document.getElementById("prevBtn").style.visibility = "hidden";
              } else {
                document.getElementById("prevBtn").style.visibility = "visible";
              }
              if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
              } else {
                document.getElementById("nextBtn").innerHTML = "Next";
              }
              // ... and run a function that displays the correct step indicator:
              fixStepIndicator(n)
            }
            
            function nextPrev(n) {
              // This function will figure out which tab to display
              var x = document.getElementsByClassName("tab");
              // Exit the function if any field in the current tab is invalid:
              if (n == 1 && !validateForm()) return false;
              // Hide the current tab:
              x[currentTab].style.display = "none";
              // Increase or decrease the current tab by 1:
              currentTab = currentTab + n;
              // if you have reached the end of the form... :
              if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
              }
              // Otherwise, display the correct tab:
              showTab(currentTab);
            }
            
            function validateForm() {
              // This function deals with validation of the form fields
              var x, y, i, valid = true;
              x = document.getElementsByClassName("tab");
              y = x[currentTab].getElementsByTagName("input");
              // A loop that checks every input field in the current tab:
              for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                  // add an "invalid" class to the field:
                  y[i].className += " invalid";
                  // and set the current valid status to false:
                  valid = false;
                }
              }
              // If the valid status is true, mark the step as finished and valid:
              if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
              }
              return valid; // return the valid status
            }
            
            function fixStepIndicator(n) {
              // This function removes the "active" class of all steps...
              var i, x = document.getElementsByClassName("step");
              for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
              }
              //... and adds the "active" class to the current step:
              x[n].className += " active";
            }
               </script>';
           echo  $html;
        }, 99, 1);
    }

    public function saveSurveyPost(){
        $this->addAction('theme.page.after.attend-survey', function($model) {
         if (\Request::isMethod('post') && $this->checkSurveyCode($_REQUEST['code'])) {
            if(isset($_POST['surveyPost']) && ($_POST['surveyPost']=='true')){
                //dd($_POST);
                  $booking_id = $_POST['booking_id'];
                  $customer_name = $_POST['customer_name'];
                  $customer_mobile = $_POST['customer_mobile'];
                  $survey_coupon = 'DMS'.$this->random_coupon(5);
                  $survey = New Survey;
                  $survey ->title = time();
                  $survey ->slug = time();
                  $survey ->booking_id = $booking_id;
                  $survey ->customer_name = $customer_name;
                  $survey ->customer_mobile = $customer_mobile;
                  $survey ->survey_result =  json_encode($_POST['survey']);
                  $survey ->survey_coupon = $survey_coupon;
                  if($survey ->save()){
                    $today= date('Y-m-d');
                    $coupon_discount = 0.00;
                    $coupon_type = 2;
                    $source = 'survey';
                    $coupon = New Coupon;
                    $coupon->title =$survey_coupon;
                    $coupon->coupon_code =$survey_coupon;
                    $coupon->coupon_discount =0.00;
                    $coupon->coupon_type =$coupon_type;
                    $coupon->validity_from =  $today;
                    $coupon->validity_to = date('Y-m-d', strtotime($today . ' +365 day'));
                    $coupon->source = $source;
                    if($coupon->save()){
                        $message='Thank you for participated  to survey , Your referral  code is '.$survey_coupon ;
                        //str_replace($rptest,$nptext,trans('sbkw::app.survey_message'))
                        $data= array(
                            'message'=> $message,
                            'mobile'=>$customer_mobile,
                            'code'=>'+965',
                         );
                         do_action('booking.sms.index',$data);
                         
                            $html = '';
                            $html .='<div class="col-xxl-7 px-xxl-4">
                                    <div class="survey-box border">
                                        <div class="text-center pb-3">
                                            <img src="'.upload_url(get_config('logo')).'" alt="img" class="mw-100">
                                        </div>';
                            $html .= '<div class="alert alert-success"><strong> Success! Your Survey is Successfully done ! Your Referral  Code : </strong>  '.$survey_coupon.'</div>';
                            $html .=  '<br>';
                            $html .=  '<p><strong>شكرا لوقتكم ورايكم ..';
                            $html .=  'وتستاهلون كود خصم ١٠% للجلسه القادمه</strong></p>';
                            $html .='</div>
                                </div>';
                           echo $html;
                        
                    }
                    
                  }

            }
              
        }
      }, 5, 1);  
    }

    static function checkSurveyCode($code){
        //$code = base64_decode($code);
        //dd($code );
        $booking_id =  base64_decode($code);
      
        $survey=Survey::where('booking_id',$booking_id)->count();
        if($survey>0){
            return false;
        }else{
            return true;
        }
         
    }

    static function getSurveyBooking($code){
        //$code = base64_decode($code);
        $booking_id =  base64_decode($code);
        return $booking = Booking::find($booking_id);  
    }

    static function random_coupon($length_of_string){
  
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      
        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result), 
                           0, $length_of_string);
    }
   

}
