@extends('juzaweb::layouts.frontend')

@section('content')
@php
	$booking = \Sbhadra\Photography\Models\Booking::find(base64_decode($_REQUEST['bsid']));
	$bsid= base64_encode($booking->id);
    $booking_url = url('payment/success').'/?bsid='.$bsid;
@endphp
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
						<label> {{$booking->status}}</label>
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

@endsection
