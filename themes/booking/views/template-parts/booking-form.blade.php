
<!-- rest of page -->
<form class="personal-information" method="post" action="{{url('payment')}}">
{!! csrf_field() !!}
<input class="form-control" id="booking_total_price" name="total_price" value="" type="hidden"  />
@if(isset($company))
<input class="form-control" id="company_id" name="company_id" value="{{$company->id}}" type="hidden"  />
@else
<input class="form-control" id="company_id" name="company_id" value="{{$post->company_id}}" type="hidden"  />

@endif
@php
 
 if(isset($company) && $company->usertype=='company'){
	$pay_amount = $company->config["pay_amount"];
  }else{
	$pay_amount = \Sbhadra\Photography\Models\Setting::where('field_key','pay_amount')->first()->field_value;
  }
@endphp
<div class="row m-0 w-100">
	<div class="col-md-12">
    <input type="hidden" id="id" name="id" value="{{ $post->id }}">
    <input type="hidden" id="booking_price" name="package_price" value="{{ $post->price }}">
		<label>Branch</label>
		<select id="branch" name="branch_id" class="form-control branch" required="">
			<option selected disabled value="">Please select a Branch</option>
            @if($post->branches)
                @foreach($post->branches as $branch)
                  <option value="{{$branch->id}}"> {{$branch->title}}  </option>
                @endforeach                        
            @endif
        </select>
	</div>
</div><div class="row m-0 w-100">
	<div class="col-12">
		<span>Services</span>
	</div>
	<div class="col-12 p-3">
		<div class="row m-0" id="package_services">
           @do_action('booking.reservation.services',$post)  
		</div>
	</div>
</div>
                        
<div class="row m-0 w-100">
	<div class="col-md-6">
		<label>@lang('theme::app.booking_date')</label>
		<input type="hidden" name="package_id" id="package_id" value="{{ $post->id }}">
        <input class="form-control" id="booking_date" name="booking_date" placeholder="MM/DD/YYY"  required="" />
	</div>
	<div class="col-md-6">
		<label>@lang('theme::app.booking_time')</label>
		
        <select class="form-control border" id="booking_time" name="booking_time" required="">
            <option value="">حدد الوقت</option>
        </select>
       
	</div>
</div>
<div class="row m-0">
	<div class="col-12">
		<div class="form-group">
			<label for="name"> @lang('theme::app.customer_name'): </label>
			<input type="text" class="form-control" id="name" name="customer_name" placeholder="Enter your name">
		</div>
	</div>
	<div class="col-6">
		<div class="form-group">
			<label for="mobile">@lang('theme::app.mobile_number'):</label>
			<input type="tel" class="form-control" name="mobile_number" id="mobile" placeholder="Enter your mobile number" required="">
		</div>
	</div>
	<div class="col-6">
		<div class="form-group">
			<label for="email">@lang('theme::app.email'):</label>
			<input type="email" class="form-control" name="customer_email" id="email" placeholder="Enter your email">
		</div>
	</div>
	<div class="col-12">
		<div class="form-group">
			<label for="email">@lang('theme::app.instructions'):</label>
			<input type="text" class="form-control" name="instructions" id="instructions" placeholder="Enter instructions">
		</div>
	</div>
</div>
   
<div class="row m-0 w-100">
       @do_action('theme.coupon.fields') 
</div> 
<div class="row m-0 w-100">
<div class="col-12">
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" required="">
        <label class="form-check-label" for="exampleCheck1">@lang('theme::app.check_me_out')</label>
    </div>
</div>
<div class="col-12 mt-3">
		<button type="submit" class="btn btn-primary btn-submit w-100">
		<div class="row m-0">
			<div class="col-2 text-center">
			@lang('theme::app.submit')
			</div>
			<div class="col-7 text-center"> </div>
			
			@if($post->is_type==1) 
			<div  class="col-2 bg-white text-black d-flex align-items-center justify-content-center btnPrice">
			{{$post->price}}KD
			</div>
		    @endif
			@if($post->is_type==2) 
			<div  class="col-2 bg-white text-black d-flex align-items-center justify-content-center btnPrice">
			  {{$pay_amount}}KD
			</div>
		    @endif
			@if($post->is_type==3) 
			<div id="totalprice" class="col-2 bg-white text-black d-flex align-items-center justify-content-center btnPrice">
			 {{$post->price}}KD
			</div>
		    @endif
			
			
		</div>
		</button>
	</div>
</div>
</form>	<!-- end of rest of page -->




