@extends('juzaweb::layouts.backend')

@section('content')
@php
    $branch_services = array();
        if($model->services){
            foreach($model->services as $service){
               $branch_services[] = $service->id;
           } 
        }
    @endphp
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
                {{ Field::text($model, 'location') }}
                <div class="form-group">
                    <label class="col-form-label" for="services">@lang('sbph::app.services')</label>
                    <select name="services[]" id="services" class="form-control select2-default"  multiple="multiple">
                        @foreach($services ?? [] as $key => $service)
                        <option value="{{ $service->id }}" @if(in_array($service->id,$branch_services)) {{'selected'}} @endif>{{ $service->title }}</option>
                        @endforeach
                    </select>
                </div>
                {{ Field::image($model, 'thumbnail') }}
                @do_action('post_type.'. $postType .'.form.right', $model)
            </div>
        </div>
    @endcomponent

@endsection
