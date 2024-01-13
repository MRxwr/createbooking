@extends('juzaweb::layouts.frontend')

@section('content')
@php($booking = \Sbhadra\Photography\Models\Booking::find(base64_decode($_REQUEST['bsid'])))

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
                                <div class="package-head bg-success radius15 mh53 py-1 px-3 d-inline-flex align-items-center">
                                    <h4 class="fs23 text-success">
                                        @lang('theme::app.reservation_complete')
                                    </h4>
                                    <img src="{{asset('/')}}jw-styles/themes/cstudio/assets/img/check_green.svg" alt="img" class="ms-3">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-xl-4 pb-5">
                                <div class="details-form">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                        @lang('theme::app.bookingid'):
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                    {{$booking->title}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                      @lang('theme::app.invoiceId')
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                      {{$booking->transaction_id}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                      @lang('theme::app.customer_name')
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                      {{$booking->customer_name}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                      @lang('theme::app.mobile_number'):
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                     {{$booking->mobile_number}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                    @lang('theme::app.package_chosen'):
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                    {{$booking->package->title}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                      @lang('theme::app.booking_date'):
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                      {{$booking->booking_date}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                      @lang('theme::app.baby_name'):
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                      {{$booking->baby_name}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                       @lang('theme::app.booking_time'):
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                      {{$booking->timeslot->title}} [{{$booking->timeslot->starttime}} to {{$booking->timeslot->endtime}}]
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                        @lang('theme::app.baby_age'):
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                        {{$booking->baby_age}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-6 bg-light">
                                                    <p class="fs20">
                                                        @lang('theme::app.status'):
                                                    </p>
                                                </div>
                                                <div class="col-sm-8 col-6">
                                                    <p class="fs20">
                                                        {{$booking->status}}
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
                                      @lang('theme::app.instructions'):
                                    </h4>
                                </div>
                                <p class="fs20">
                                  {{$booking->instructions}}
                                </p>
                            </div>
                            <div class="col-sm-12 pb-5">
                                <div class="package-head bg-danger radius15 mh53 py-1 px-3 mb-2 d-inline-flex align-items-center">
                                    <h4 class="fs23 text-danger">
                                      @lang('theme::app.note'): 
                                    </h4>
                                </div>
                                <ul class="fs20 text-danger" style="display:none;">
                                    <li class="mb-3">
                                        - You'll receive an SMS with you reservation details.
                                    </li>
                                    <li class="mb-3">
                                        - 10 days before the session you'll get a remainder SMS with the studio location.
                                    </li>
                                    <li class="mb-3">
                                        - 10 days before the session to reschedule your reservation. 
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-12 pb-5">
                                <a href="{{url('/')}}" class="btn btn-lg btn-light fs32 radius30" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
