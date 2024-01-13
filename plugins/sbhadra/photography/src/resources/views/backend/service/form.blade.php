@extends('juzaweb::layouts.backend')

@section('content')

    @component('juzaweb::components.form_resource', [
        'model' => $model,
    ])
        <div class="row">
            <div class="col-md-8">
            <input type="hidden" name="company_id"  id="company_id" value="{{ Auth::user()->id }}" >
                {{ Field::text($model, 'title', [
                    'required' => true,
                    'class' => empty($model->slug) ? 'generate-slug' : '',
                ]) }}
                
                {{ Field::editor($model, 'content') }}

                @do_action('post_type.'. $postType .'.form.left')

            </div>
           
            <div class="col-md-4">

                {{ Field::select($model, 'status', [
                    'options' => $model->getStatuses()
                ]) }}
                {{ Field::text($model, 'price') }}

                @php 
                     $close_days =json_decode($model->days);
                     if(empty($close_days)){
                        $close_days=array();
                        
                     }
                    @endphp
                    <div class="col-md-12 form-group bootstrap-timepicker timepicker">
                        <label class="col-form-label" for="release">Open</label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="days[]" value="1" @if(in_array(1,$close_days)) checked @endif> @lang('sbca::app.monday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="days[]" value="2"  @if(in_array(2,$close_days)) checked @endif> @lang('sbca::app.tuesday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="days[]" value="3"  @if(in_array(3,$close_days)) checked @endif> @lang('sbca::app.wednesday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="days[]" value="4"  @if(in_array(4,$close_days)) checked @endif> @lang('sbca::app.thursday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="days[]" value="5"  @if(in_array(5,$close_days)) checked @endif> @lang('sbca::app.friday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="days[]" value="6"  @if(in_array(6,$close_days)) checked @endif> @lang('sbca::app.saturday')
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="days[]" value="0"  @if(in_array(0,$close_days)) checked @endif> @lang('sbca::app.sunday')
                        </label>
                    </div>
                @php
                 $timeslots = Sbhadra\Photography\Models\Timeslot::all();
                 $package_slots = ($model->slots ? json_decode($model->slots) :[]);
                @endphp
                <div class="form-group">
                    <label class="col-form-label" for="timeslots">@lang('sbph::app.timeslots')</label>
                    <select name="slots[]" id="timeslots" class="form-control select2-default"  multiple="multiple">
                        @foreach($timeslots ?? [] as $key => $slot)
                          <option value="{{ $slot->id }}" @if(in_array($slot->id,$package_slots)) {{'selected'}} @endif>{{ $slot->title }} [{{ $slot->starttime }} - {{ $slot->endtime }}] </option>
                        @endforeach
                    </select>
                </div>

                {{ Field::image($model, 'thumbnail') }}
                @do_action('post_type.'. $postType .'.form.right', $model)
            </div>
        </div>
    @endcomponent

@endsection
