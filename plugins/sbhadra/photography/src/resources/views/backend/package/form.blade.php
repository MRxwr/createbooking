@extends('juzaweb::layouts.backend')

@section('content')
    @php
    $package_slots = array();
    $package_branches = array();
        if($model->slots){
            foreach($model->slots as $slot){
               $package_slots[] = $slot->id;
           } 
        } 
        
        if($model->branches){
            foreach($model->branches as $branch){
               $package_branches[] = $branch->id;
           } 
        }  
    @endphp
    @component('juzaweb::components.form_resource', [
        'model' => $model,
    ])
        <div class="row">
            <div class="col-md-8">
            <input type="hidden" name="company_id" class="form-control" id="company_id" value="{{ Auth::user()->id }}" >
                {{ Field::text($model, 'title', [
                    'required' => true,
                    'class' => empty($model->slug) ? 'generate-slug' : '',
                ]) }}
                {{ Field::slug($model, 'slug') }}
                {{ Field::editor($model, 'content') }}
                {{ Field::editor($model, 'short_description') }}
                @do_action('post_type.'. $postType .'.form.left')

            </div>

            <div class="col-md-4"> 

                {{ Field::select($model, 'status', [
                    'options' => $model->getStatuses()
                ]) }}

                {{ Field::image($model, 'thumbnail') }}
                
                
                
                <!--<div class="form-group">-->
                <!--    <label class="col-form-label" for="release">@lang('sbph::app.gallery_link')</label>-->
                <!--    <input type="text" name="gallary_link" class="form-control" id="gallary_link" value="{{ $model->gallary_link }}" >-->
                <!--</div>-->

                <div class="form-group">
                    <label class="col-form-label" for="release">@lang('sbph::app.price')</label>
                    <input type="number" name="price" class="form-control" id="price" value="{{ $model->price }}" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="services">@lang('sbph::app.branches')</label>
                    <select name="branches[]" id="branches" class="form-control select2-default"  multiple="multiple">
                        @foreach($branches ?? [] as $key => $branch)
                        <option value="{{ $branch->id }}" @if(in_array($branch->id,$package_branches)) {{'selected'}} @endif>{{ $branch->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="release">Is Type</label>
                    <label class="radio-inline" for="norl"><input type="radio" id="norl" name="is_type" value="1" @if($model->is_type==1) {{'checked'}} @endif > Free </label>
                    <label class="radio-inline" for="albm"><input type="radio" id="albm" name="is_type" value="2" @if($model->is_type==2) {{'checked'}} @endif > Fixed </label>
                    <label class="radio-inline" for="both"><input type="radio" id="both" name="is_type" value="3" @if($model->is_type==3) {{'checked'}} @endif > As Service </label>
                </div>
                
                <div class="form-group ">
                    <label class="col-form-label" for="release">Normal Interval</label>
                    <?php $slotintArrs=array('1h'=>'1 Hour','2h'=>'2 Hours','3h'=>'3 Hours','4h'=>'4 Hours','5h'=>'5 Hours','6h'=>'6 Hours') ?>
                    <select name="normal_period" class="form-control  input-small">
                        @foreach($slotintArrs as $k=>$slotint)
                        <option value="{{$k}}" @if($model->normal_period==$k) {{'selected'}} @endif>{{$slotint}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group ">
                    <label class="col-form-label" for="release">Album Interval</label>
                    <?php $slotintArrs=array('1h'=>'1 Hour','2h'=>'2 Hours','3h'=>'3 Hours','4h'=>'4 Hours','5h'=>'5 Hours','6h'=>'6 Hours') ?>
                    <select name="album_period" class="form-control  input-small">
                        @foreach($slotintArrs as $k=>$slotint)
                        <option value="{{$k}}" @if($model->album_period==$k) {{'selected'}} @endif>{{$slotint}}</option>
                        @endforeach
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label class="col-form-label" for="timeslots">@lang('sbph::app.timeslots')</label>
                    <select name="slots[]" id="timeslots" class="form-control select2-default"  multiple="multiple">
                        @foreach($timeslots ?? [] as $key => $slot)
                          <option value="{{ $slot->id }}" @if(in_array($slot->id,$package_slots)) {{'selected'}} @endif>{{ $slot->title }} [{{ $slot->starttime }} - {{ $slot->endtime }}] </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group ">
                    <label class="col-form-label" for="release">Max Booking on Same Slot</label>
                    <input name="max_booking" type="number" class="form-control  input-small" value="{{ $model->max_booking }}" data-step="1">
                   
                </div>
                
                @do_action('post_type.'. $postType .'.form.right', $model)
            </div>
        </div>
    @endcomponent

@endsection
