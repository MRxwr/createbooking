@extends('juzaweb::layouts.backend')

@section('content')
   <div class="row">
        <div class="col-md-8">
        <div class="row">
                    <div class="col-sm-12 col-md-3"><h4 style="font-size: 16px;"><strong> Booking Id</strong> : {{$model->booking_id}}</h4></div>
                    <div class="col-sm-12 col-md-3"><h4 style="font-size: 16px;"><strong>Customer Name</strong> : {{$model->customer_name}}</h4></div>
                    <div class="col-sm-12 col-md-3"><h4 style="font-size: 16px;"><strong>Customer Mobile</strong> : {{$model->customer_mobile}}</h4></div>
                    <div class="col-sm-12 col-md-3"><h4 style="font-size: 16px;"><strong>Coupon Code</strong> :{{$model->survey_coupon}}</h4></div>
                    <hr class="solid">
                    <div class="col-sm-12 col-md-8">
                        @php
                        $surveys = (object) json_decode($model->survey_result);
                        //dd($surveys);
                        $sn=1;
                            foreach($surveys as $key=>$survey){
                                $survey = (object) $survey;
                                //dd($survey);
                            echo '<div class="question_ans" style="margin-top:25px;">';
                            echo '<h4 style="font-size: 17px;">'.$sn.'. '.$survey->question.'</h4>';
                            echo '<ul style="margin-top:15px;padding-left:15px;">';
                            if($survey->type ==3 ||$survey->type ==4){
                                echo '<li style="color:green;">'.$survey->answer.'</li>';
                            }else{
                                if(is_object($survey->answer)){
                                    $ans = (array) $survey->answer;
                                }else{
                                    $ans = explode(',',$survey->answer);
                                }
                                foreach($survey->option as $opt){
                                    echo '<li>';
                                    if(in_array($opt,$ans )){
                                            echo '<li style="color:green;">';
                                            echo '<i class="fa fa-heart mr-20"></i>';
                                            echo $opt;
                                            echo '</li>';
                                            }else{
                                            echo '<li>';
                                            echo '<i class="fa fa-heart mr-20"></i>';
                                            echo $opt;
                                            echo '</li>';

                                            }
                                    
                                }
                            }
                            echo '</ul>';
                            echo '</div>';
                            $sn++;
                            }
                        @endphp
                    </div>
                </div>
        </div>

        <div class="col-md-4">
        </div>
    </div>
@endsection
