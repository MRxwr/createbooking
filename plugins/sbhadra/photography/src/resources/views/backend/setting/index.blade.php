@extends('juzaweb::layouts.backend')

@section('content')

<!-- @dd(\Sbhadra\Photography\Models\Setting::where('field_value','api_key')->first()) -->
    <div class="row mb-3">
        <div class="col-md-8">
        <form action="{{route('admin.setting.post')}}" method="post" class="form-ajax" id="Be4MBcHP47k9METK" novalidate="novalidate">
        {!! csrf_field() !!}
               <div class="form-group row">
                    <label class="col-form-label" for="release">Pay Api Key</label>
                    <input id="timepicker1" name="api_key" type="text" class="form-control input-small" value="{{$settings['api_key']}}">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>

                <div class="form-group row">
                    <label class="col-form-label" for="release">Payment Type</label>
                    <label class="col-form-label" for="release">
                        <input  name="payment_type" type="radio"  value="1" @if(@$settings['payment_type']=='1') checked @endif> Fixed Price
                    </label>
                    <label class="col-form-label" for="release">
                        <input  name="payment_type" type="radio"  value="2" @if(@$settings['payment_type']=='2') checked @endif> Dynamic price
                    </label>
                    <input id="pay_amount" name="pay_amount" type="text" class="form-control input-small" value="{{@$settings['pay_amount']}}">
                </div>

                <div class="form-group row">
                    <label class="col-form-label" for="release">Send SMS before days</label>
                    <input id="number_day" name="number_day" type="text" class="form-control input-small" value="{{@$settings['number_day']}}">
                    <span class="input-group-addon"><i class="fa fa-watch"></i></span>
                </div>

                <div class="form-group row">
                    <label class="col-form-label" for="release">KWT SMS Username</label>
                    <input id="timepicker2" name="sms_username" type="text" class="form-control input-small" value="{{$settings['sms_username']}}">
                    <span class="input-group-addon"><i class="fa fa-watch"></i></span>
                </div>
                <div class="form-group row">
                    <label class="col-form-label" for="release">KWT SMS Password</label>
                    <input id="timepicker2" name="sms_password" type="text" class="form-control input-small" value="{{$settings['sms_password']}}">
                    <span class="input-group-addon"><i class="fa fa-watch"></i></span>
                </div>
                <div class="form-group row">
                    <label class="col-form-label" for="release">SMS Sender ID</label>
                    <input id="timepicker2" name="sms_sender" type="text" class="form-control input-small" value="{{$settings['sms_sender']}}">
                    <span class="input-group-addon"><i class="fa fa-watch"></i></span>
                </div>
                <div class="mt-3"><button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save </button></div>
                </form>
            </div>

    </div>

   

@endsection