@extends('juzaweb::layouts.backend')

@section('content')
        @do_action('admin.booking.before',$model)
        <div class="row">
        <div class="col-md-4">
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.created_at')</div>
            <div class="col-md-8">{{$model->created_at}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.status')</div>
            <div class="col-md-8">{{($model->status=='yes'?'Free':$model->status)}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.bookingid')</div>
            <div class="col-md-8">{{$model->title}} </div>
        </div>
        
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.invoiceId')</div>
            <div class="col-md-8">{{$model->transaction_id}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.package')</div>
            <div class="col-md-8">{{$model->package->title}} </div>
        </div>
        @if($model->services)
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.services')</div>
            <div class="col-md-8">
                @foreach($model->services as $service)
                <span  class="btn btn-info btn-sm"> {{$service->title}} </span>
                @endforeach
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.booking_price')</div>
            <div class="col-md-8">{{$model->booking_price}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.customer_name')</div>
            <div class="col-md-8">{{$model->customer_name}} </div>
        </div>
         <div class="row">
            <div class="col-md-4"> @lang('sbph::app.email')</div>
            <div class="col-md-8">{{$model->customer_email}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.mobile_number')</div>
            <div class="col-md-8">{{$model->mobile_number}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.booking_date')</div>
            <div class="col-md-8">{{$model->booking_date}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.booking_time')</div>
            <div class="col-md-8">{{$model->timeslot->title}} [{{$model->timeslot->starttime}} to {{$model->timeslot->endtime}}] </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.baby_name')</div>
            <div class="col-md-8">{{$model->baby_name}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.baby_age')</div>
            <div class="col-md-8">{{$model->baby_age}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.number_of_baby')</div>
            <div class="col-md-8">{{$model->number_of_baby}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.instructions')</div>
            <div class="col-md-8">{{$model->instructions}} </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.btype')</div>
            <div class="col-md-8">
                @if($model->btype=='normal') @lang('sbph::app.normal_type') @endif
                @if($model->btype=='album') @lang('sbph::app.album') @endif
                </div>
        </div>
        <div class="row">
            <div class="col-md-4"> @lang('sbph::app.refunded')</div>
            <div class="col-md-8">@if($model->refunded==0) No @else Yes @endif </div>
        </div>
        
         @do_action('admin.booking.after',$model)
         @php
            $view_edit = URL('admin/bookings/'.$model->id.'/edit').'?id='.$model->package_id.'&package_id='.$model->package_id.'&date='.$model->booking_date;
         @endphp
         
         <div class="row">
            <div class="col-md-4"> @lang('sbph::app.employee')</div>
            <div class="col-md-8">@if($model->employee) $model->employee->name @else Not assign @endif </div>
        </div>
        
         <div class="row">
            <div class="col-md-4"><a href="{{$view_edit}}" class="btn  btn-primary btn-sm"> <i class=" fa fa-edit"></i> Reschedule</a></div>
            
        </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6"> @lang('sbph::app.booking_price')</div>
                <div class="col-md-6 text-right"> <strong> {{number_format((float)$model->booking_price, 2, '.', '')}} KD</strong></div>
            </div>
            @if($model->services)
                <div class="row">
                    <div class="col-md-6"> @lang('sbph::app.services') @lang('sbph::app.price')</div>
                    <div class="col-md-6 text-right">
                        @php $service_price=0; @endphp
                        @foreach($model->services as $service)
                            @php $service_price= $service_price+$service->price; @endphp
                         
                        @endforeach
                        <strong> {{number_format((float)$service_price, 2, '.', '')}} KD</strong>
                    </div>
                </div>
             @endif
             @do_action('admin.booking.prices',$model)
             @do_action('admin.booking.discount',$model)
             @do_action('admin.booking.total',$model)
        </div>
   </div>
        <!-- <div class="row">
            <div class="col-md-3"> @lang('sbph::app.action')</div>
            <div class="col-md-9">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Cancel</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myReschedule">Reschedule</button>
                    <button type="button" class="btn btn-primary">SMS</button>
                    <button type="button" class="btn btn-primary">Refund</button>
                </div> 
                
                    <div id="myReschedule" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Booking Reschedule</h4>
                            </div>
                            <div class="modal-body">
                                <p>Some text in the modal.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </div>

                        </div>
                    </div>
            </div>
        </div> -->
        
@endsection
