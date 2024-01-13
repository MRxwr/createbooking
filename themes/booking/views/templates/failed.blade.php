@extends('juzaweb::layouts.frontend')

@section('content')
@php
	$booking = \Sbhadra\Photography\Models\Booking::find(base64_decode($_REQUEST['bsid']));
	$bsid= base64_encode($booking->id);
    $booking_url = url('payment/success').'/?bsid='.$bsid;
@endphp

 @do_action('after.booking.faild')
 <!-- rest of page -->
<div class="row m-0">
	<div class="col-12">
		<div class="row m-0 successBody">
			<div class="col-12 p-3 text-center">
                @lang('theme::app.reservation_details')
			</div>
			<div class="col-md-12 p-2">
				<div class="row m-0 p-2 successInfoSection">
					<div class="col-4">
						<label>@lang('theme::app.status')</label>
					</div>
					<div class="col-8 text-center">
						<label>{{$booking->status}}</label>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2">
				<div class="row m-0 p-2 successInfoSection">
					<div class="col-4">
						<label> @lang('theme::app.bookingid'):</label>
					</div>
					<div class="col-8 text-center">
						<label> {{$booking->title}}</label>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2">
				<div class="row m-0 p-2 successInfoSection">
					<div class="col-4">
						<label>@lang('theme::app.booking_date'):</label>
					</div>
					<div class="col-8 text-center">
						<label>{{$booking->booking_date}}</label>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2">
				<div class="row m-0 p-2 successInfoSection">
					<div class="col-4">
						<label>Branch</label>
					</div>
					<div class="col-8 text-center">
						<label>{{$booking->branch->title}}</label>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2">
				<div class="row m-0 p-2 successInfoSection">
					<div class="col-4">
						<label>@lang('theme::app.booking_time'):</label>
					</div>
					<div class="col-8 text-center">
						<label>[{{$booking->timeslot->starttime}} to {{$booking->timeslot->endtime}}]</label>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2">
				<div class="row m-0 p-2 successInfoSection">
					<div class="col-4">
						<label>Service</label>
					</div>
					<div class="col-8 text-center">
					@if($booking->services)
					   @foreach($booking->services as $key=>$service)
					      @if($key>0) <label>, </label>@endif
						[ <label>{{$service->title}}</label> ]
						@endforeach
					@endif	
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2">
				<div class="row m-0 p-2 successInfoSection">
					<div class="col-4">
						<label>@lang('theme::app.customer_name')</label>
					</div>
					<div class="col-8 text-center">
						<label> {{$booking->customer_name}}</label>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2">
				<div class="row m-0 p-2 successInfoSection">
					<div class="col-4">
						<label>@lang('theme::app.mobile_number')</label>
					</div>
					<div class="col-8 text-center">
						<label>{{$booking->mobile_number}}</label>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2">
				<div class="row m-0 p-2 successInfoSection">
					<div class="col-4">
						<label>@lang('theme::app.email')</label>
					</div>
					<div class="col-8 text-center">
						<label>{{$booking->customer_email}}</label>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-2 pt-4 text-center">
			    @do_action('booking.generate.qrcode',$booking)
				<!-- <img src="https://i.imgur.com/GPTcUl3.png" style="width:200px; height:200px"> -->
			</div>
		</div>
	</div>
</div>	<!-- end of rest of page -->
        <!-- reservation-details -->
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
