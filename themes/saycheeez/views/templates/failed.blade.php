@extends('juzaweb::layouts.frontend')

@section('content')
 @do_action('after.booking.faild')
   <!-- reservation-details -->
   <section class="reservation-details py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <div class="row">
                            <div class="col-xl-12 pb-5">
                                <div class="site-title position-relative d-flex align-items-center">
                                    <div class="bg-white">
                                        <h3 class="fs30 text-300 SegoeUIL pe-4">
                                            @lang('theme::app.reservation_details')
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-8">
                        <!-- reservation-item -->
                        <div class="row package-item">
                            <div class="col-sm-12 mb-5 d-flex align-items-center justify-content-center">
                                <div class="package-head bg-danger radius15 mh53 py-1 px-3 d-inline-flex align-items-center">
                                    <h4 class="fs23 text-danger">
                                        @lang('theme::app.your_rsurvation_faild')
                                    </h4>
                                    <img src="{{asset('/')}}jw-styles/themes/cstudio/assets/img/cancel.svg" alt="img" class="ms-3">
                                </div>
                            </div>
                            <div class="col-sm-12 pt-4 d-flex align-items-center justify-content-center">
                                <a href="{{url('/')}}" class="btn btn-lg btn-light fs32 radius30" >
                                @lang('theme::app.go_to_home')
                                </a>
                            </div>
                        </div>
                        <!-- reservation-item -->
                    </div>
                </div>
            </div>
        </section>
        <!-- reservation-details -->
@endsection
