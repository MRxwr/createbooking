@extends('juzaweb::layouts.backend')

@section('content')

    @component('juzaweb::components.form_resource', [
        'model' => $model,
    ])
        <div class="row">
            <div class="col-md-8">

                {{ Field::text($model, 'title', [
                    'required' => true,
                    'class' => empty($model->slug) ? 'generate-slug' : '',
                ]) }}
                {{ Field::text($model, 'coupon_code') }}
                <!-- {{ Field::text($model, 'coupon_discount') }} -->
                <input type="text" class="form-control" name="coupon_discount" min=""  id="coupon_discount" value="{{($model->coupon_discount?$model->coupon_discount:'0.00')}}">
                <div class="form-group">
                    <label class="control-label mb-10 text-left">{{trans('sbco::app.coupon_type')}}</label>
                        <select class="form-control" name="coupon_type" id="coupon_type">
                            <option value="1" @if( $model->coupon_type=='1') selected="selected" @endif >Percentage(%)</option>
                            <option value="2" @if( $model->coupon_type=='2') selected="selected" @endif >Fixed</option>
                        </select>
                </div>

                @do_action('post_type.'. $postType .'.form.left')

            </div>

            <div class="col-md-4">

                {{ Field::select($model, 'status', [
                    'options' => $model->getStatuses()
                ]) }}
                <!-- <input type="hidden" name="source" value="web"> -->

                <div class="form-group">
                    <label class="control-label mb-10 text-left">{{trans('sbco::app.coupon_type')}}</label>
                        <select class="form-control" name="source" id="source">
                            <option value="web" @if( $model->source=='web') selected="selected" @endif >Coupon</option>
                            <option value="survey" @if( $model->source=='survey') selected="selected" @endif >Referral</option>
                        </select>
                </div>
                
                <div class="form-group">
                    <label class="control-label mb-10 text-left">{{trans('sbco::app.validity_from')}}</label>
                    <input type="date" class="form-control" name="validity_from" min=""  id="validity_from" value="{{$model->validity_from}}">  
                </div>
                <div class="form-group">
                    <label class="control-label mb-10 text-left">{{trans('sbco::app.validity_to')}}</label>
                    <input type="date" class="form-control" name="validity_to"  min="" id="validity_to" value="{{$model->validity_from}}">  
                </div>

                @do_action('post_type.'. $postType .'.form.right', $model)
            </div>
        </div>
    @endcomponent
<script>
    $(document).ready( function() {
        ntoDay =  new Date();
        y = ntoDay.getFullYear();
        m = ntoDay.getMonth() + 1;
        d = ntoDay.getDate();
        var mindate = m + "-" + d + "-" + y;
       $('#validity_from').attr("min",mindate);
    });​
</script>
@endsection
