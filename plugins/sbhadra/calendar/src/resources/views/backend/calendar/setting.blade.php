@extends('juzaweb::layouts.backend')
@section('head')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
@endsection

@section('content')

        <div class="row">
        <form action="{{route('admin.calendar-setting')}}" method="POST">
      {!! csrf_field() !!}
      <input   type="hidden" name="id" value="{{$setting->id}}" >
            <div class="col-md-8">
                <div class="row">
                <label class="col-form-label" for="release">@lang('sbca::app.calender_open_date')</label>
                    <div class="col-md-6 form-group bootstrap-timepicker timepicker">
                        <label class="col-form-label" for="release">@lang('sbca::app.start_date')</label>
                        <input id="timepicker1" name="start_date" type="date" class="form-control input-small" value="{{$setting->start_date}}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-date"></i></span>
                    </div>
                    <div class="col-md-6 form-group bootstrap-timepicker timepicker">
                        <label class="col-form-label" for="release">@lang('sbca::app.end_date')</label>
                        <input id="timepicker2" name="end_date" type="date" class="form-control input-small" value="{{$setting->end_date}}">
                        <span class="input-group-addon"><i class="fa fa-watch"></i></span>
                    </div> 
                    @php 
                     $close_days =json_decode($setting->close_days) 
                    @endphp
                    <div class="col-md-8 form-group bootstrap-timepicker timepicker">
                        <label class="col-form-label" for="release">@lang('sbca::app.close_days')</label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="close_days[]" value="1" @if(in_array(1,$close_days)) checked @endif> @lang('sbca::app.monday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="close_days[]" value="2"  @if(in_array(2,$close_days)) checked @endif> @lang('sbca::app.tuesday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="close_days[]" value="3"  @if(in_array(3,$close_days)) checked @endif> @lang('sbca::app.wednesday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="close_days[]" value="4"  @if(in_array(4,$close_days)) checked @endif> @lang('sbca::app.thursday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="close_days[]" value="5"  @if(in_array(5,$close_days)) checked @endif> @lang('sbca::app.friday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="close_days[]" value="6"  @if(in_array(6,$close_days)) checked @endif> @lang('sbca::app.saturday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="close_days[]" value="0"  @if(in_array(0,$close_days)) checked @endif> @lang('sbca::app.sunday')
                        </label>
                    </div>
                    <div class="col-md-4 form-group bootstrap-timepicker ">
                        <label class="col-form-label" for="release">Close current day with</label>
                        <input id="cwith_days" name="cwith_days" type="number" class="form-control input-small" min="0" max="6" value="{{$setting->cwith_days}}">
                        <span class="input-group-addon">Days</span>
                    </div>
                    <div class="col-md-12"><div class="btn-group float-right"><button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button> <button type="button" class="btn btn-warning cancel-button px-3"><i class="fa fa-refresh"></i> Reset</button></div></div>
                <div>  
            </div>
            </form>
        </div>
   

@endsection
@section('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
    //$('#timepicker1').timepicker();
    //$('#timepicker2').timepicker();
</script>
@endsection
