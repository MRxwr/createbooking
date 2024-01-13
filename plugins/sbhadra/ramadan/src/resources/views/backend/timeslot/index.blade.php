@extends('juzaweb::layouts.backend')

@section('content')

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="btn-group float-right">
                <a href="{{ route('timeslots.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> @lang('sbsl::app.add_new')</a>
            </div>
        </div>
    </div>
    
    <form action="{{route('admin.ramadan.setting')}}" method="POST" class="form-ajax">
    {!! csrf_field() !!}
    <div class="row mb-3">
        <div class="col-md-5">
            <label class="col-form-label" for="release">@lang('sbca::app.start_date')</label>
            <input id="timepicker112" name="ramadan_start_date" type="date" class="form-control input-small" value="{{@$setting->ramadan_start_date}}">
            <span class="input-group-addon"><i class="glyphicon glyphicon-date"></i></span>
        </div>

        <div class="col-md-5">
            <label class="col-form-label" for="release">@lang('sbca::app.end_date')</label>
            <input id="timepicker2123" name="ramadan_end_date" type="date" class="form-control input-small" value="{{@$setting->ramadan_end_date}}">
            <span class="input-group-addon"><i class="fa fa-watch"></i></span>
        </div>

        <div class="col-md-2">
            <div class="btn-group float-right">
                <button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save </button> 
                <button type="button" class="btn btn-warning cancel-button px-3"><i class="fa fa-refresh"></i> Reset</button>
            </div>
        </div>
      
    </div>
    </form>
    {{ $dataTable->render() }}

@endsection

         