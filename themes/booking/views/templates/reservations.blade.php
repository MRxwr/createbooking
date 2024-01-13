@extends('juzaweb::layouts.frontend')

@section('content')
<!-- breadcrumbs -->
<!-- @do_action('theme.breadcrumbs')  -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
      .owl-carousel .owl-stage-outer {
        overflow: hidden!important;
        }
  </style>
  <!-- breadcrumbs -->
 <!-- Personal Informations -->
 <section class="personal-info py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <div class="row">
                            <div class="col-xl-12 pb-5">
                                <div class="site-title position-relative d-flex align-items-center">
                                    <div class="bg-white">
                                        <h3 class="fs30 text-300 SegoeUIL pe-4">
                                             @lang('theme::app.Personal_Informations')
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="personal-information" method="post" action="{{url('payment')}}">
            <div class="container">
                 <div class="row">
                    <div class="col-xxl-12 justify-content-center">
                        <div class="ps-xxl-5 ms-xxl-5">
                            <div class="row ps-xxl-4">
                                @apply_filters('theme.cstudio.themes') 
                            </div>
                        </div>
                    </div>
                </div>
                
                {!! csrf_field() !!}
                <!-- <input type="hidden" id="theme_id" name="theme_id[]" value="" /> -->
                <input class="form-control" id="booking_total_price" name="total_price" value="" type="hidden"  />
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <!-- package-item -->
                        <div class="px-xxl-5">
                            <div class="row package-item">
                            @apply_filters('theme.reservation.data')
                            @apply_filters('cstudio.reservation.time')
                            @do_action('theme.reservation.exfields')
                            @apply_filters('cstudio.reservation.services')
                                <div class="col-sm-12 pe-xl-5 pt-4">
                                    <div class="package-head bg-light radius15 mh53 py-1 px-3 mb-4 d-inline-flex align-items-center">
                                        <h4 class="fs23 SegoeUIL">
                                          @lang('theme::app.informations'):
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-xxl-8 pe-xl-5 pt-4">
                                    <div class="personal-form row">
                                        <div class="col-xxl-10 pb-3">
                                            <label>
                                               @lang('theme::app.customer_name'): 
                                            </label>
                                            <input type="text" class="border" id="customer_name" name="customer_name" required >
                                        </div>
                                        <input type="hidden" class="form-control form-control-lg" id="customer_email" name="customer_email" value="hello@myshootskw.com" required>
                                        <div class="col-xxl-10 pb-3" style="display:none">
                                            <label>
                                            @lang('theme::app.baby_name'):
                                            </label>
                                            <input type="text" class="border" id="baby_name" name="baby_name">
                                        </div>
                                        <div class="col-xxl-10 pb-3">
                                            <label>
                                              @lang('theme::app.mobile_number'):
                                            </label>
                                            <input type="text" class="border" id="mobile_number" name="mobile_number" required>
                                        </div>
                                        <div class="col-xxl-10 pb-3">
                                            <label>@lang('theme::app.baby_age'):</label>
                                            <input type="text" class="border"  id="baby_age" name="baby_age">
                                        </div>
                                        <div class="col-xxl-10 py-3">
                                            <label class=".opacity0">
                                                @lang('theme::app.instructions'):
                                            </label>
                                            <textarea class="border" rows="6" placeholder="@lang('theme::app.instructions')" name="instructions" id="instructions"></textarea>
                                        </div>
                                        @apply_filters('theme.reservation.fields')
                                        @do_action('theme.coupon.fields') 
                                    </div>
                                </div>
                                <div class="col-sm-12 pe-xl-5 pt-4">
                                    <div style="width:220px;"  class="package-head bg-success radius15 mh67 py-1 px-3 mb-4   align-items-center"> 
                                       <h4 id="totalprice" class="fs23 text-success" style="padding: 20px;"></h4>
                                    </div>
                                    <div class="package-head bg-danger radius15 mh67 py-1 px-3 mb-4 d-inline-flex align-items-center">
                                        <h4 class="fs23 text-danger">
                                            @lang('theme::app.Deposit')
                                             <!--<span class="text-600">35.500 KD</span> -->
                                             @do_action('theme.fixedprice.text') 
                                            @lang('theme::app.deposit_note')  
                                        </h4>
                                    </div>
                                    <div class="package-head bg-danger radius15 mh67 py-1 px-3 mb-4 d-inline-flex align-items-center">
                                        <h4 class="fs23 text-danger">
                                             @lang('theme::app.transaction_fees')  
                                        </h4>
                                       
                                    </div>
                                    <!-- <label class="container_radio d-flex align-items-center">
                                              I agree with the <a href="index551d.html?page=terms-and-condition" targer="_blank">Terms and Condition</a> 
                                                <input type="checkbox" name="extras"  name="termsandcondition" required>
                                                <span class="checkmark"></span>
                                                <div class="bg-light text-dark radius15 mh53 py-1 px-3 ms-2 d-inline-flex align-items-center">
                                                    <h4 class="fs23">
                                                        tick
                                                    </h4>
                                                </div>
                                    </label> -->
                                    
                                </div>
                                <div class="col-sm-12 pe-xl-5 pt-4">
                                <!-- data-bs-toggle="modal" data-bs-target="#exampleModal" -->
                                      <a href="#" class="btn btn-lg btn-light fs32 radius30" id="booking_modal_now" >
                                         @lang('theme::app.continue_to_payment')
                                      </a>

                                     <!-- custom-popup -->
                                      <div class="custom-popup modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-lg  modal-dialog-centered">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <div class="package-head bg-light radius15 mh53 py-1 px-4 d-inline-flex align-items-center">
                                                          <h4 class="fs24">
                                                              @lang('theme::app.terms_and_condition')
                                                          </h4>
                                                      </div>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                          <img src="{{asset('/')}}jw-styles/themes/hbqhaya/assets/img/popup_close.svg" alt="img">
                                                      </button>
                                                  </div>
                                                  <div class="modal-body px-sm-5">
                                                     @do_action('theme.terms.content')  
                                                     <div class="d-flex align-items-center justify-content-center mb-3"> <input type="checkbox" id="agree" name="agree" value="1" required="required" style="margin:5px;"> Agree with   @lang('theme::app.terms_and_condition') </div>
                                                  </div>
                                                  <div class="modal-footer d-flex align-items-center justify-content-center mb-3">
                                                    <button  type="submit"  name="submit"  class="btn bbtn btn-md btn-light fs25 radius30" id="loader" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Booking">@lang('theme::app.Procced_to_payment')</button>
                                                  </div>
                                                  
                                              </div>
                                          </div>
                                      </div>
                                      <!-- custom-popup -->
                                </div>
                            </div>
                        </div>
                        <!-- package-item -->
                    </div>
                </div>
           
            </div>
            </form>
        </section>
        <!-- Personal Informations -->
@endsection
@section('footer')
     <script>
        $(".open_time").on('click', function(event){
            $( ".open_time" ).removeClass("active");
            $(this).addClass("active");
            $('#booking_time').val(this.id);
            //alert(this.id);
        });
    </script>
    <script>
    $(document).ready(function(){
        $("#booking_modal_now").on('click', function(event){
            var booking_time = $('#booking_time').val();
            var booking_total_price = $('#booking_total_price').val();
            var stat=0;
           // alert(booking_time);
            if(booking_total_price>0 && booking_time!='' ){
                stat=1;
            }
            if(stat==1){
                $('#exampleModal').modal('show'); 
            }else{
                alert('Please select time slot and Package type');
            }
            //$('#exampleModal').modal('show');
        });

        var limit = 2;
        $('input.theme_checkbox').on('change', function(evt) {
           
        if($('.theme_checkbox').filter(':checked').length >limit) {
            alert('You can select max 2 themes');
            this.checked = false;
          }
        });
    });
</script>
@endsection