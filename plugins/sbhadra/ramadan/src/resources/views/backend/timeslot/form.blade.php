@extends('juzaweb::layouts.backend')
@section('head')
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css"> -->

@endsection

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
              
                <div class="form-group bootstrap-timepicker timepicker">
                    <label class="col-form-label" for="release">@lang('sbph::app.starttime')</label>
                    <input id="timepicker1" name="starttime" type="text" class="form-control timepicker input-small" value="{{ $model->starttime }}" data-time-format="h:i A" data-step="30">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
                
                <div class="form-group bootstrap-timepicker timepicker">
                    <label class="col-form-label" for="release">@lang('sbph::app.endtime')</label>
                    <input id="timepicker2" name="endtime" type="text" class="form-control timepicker input-small" value="{{ $model->endtime }}" data-time-format="h:i A" data-step="30">
                    <span class="input-group-addon"><i class="fa fa-watch"></i></span>
                </div>
               
                @do_action('post_type.'. $postType .'.form.left')

            </div>

            <div class="col-md-4">
                {{ Field::select($model, 'status', [
                    'options' => $model->getStatuses()
                ]) }}
                <div class="d-none">
                {{ Field::text($model, 'slug') }}
                </div>
                @do_action('post_type.'. $postType .'.form.right', $model)
            </div>
        </div>
    @endcomponent

@endsection
@section('footer')
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script> -->
<script src="{{asset('/')}}jw-styles/plugins/sbhadra/photography/timepicker/dist/wickedpicker.min.js"></script>
<link rel="stylesheet" href="{{asset('/')}}jw-styles/plugins/sbhadra/photography/timepicker/dist/wickedpicker.min.css">
<style>
     .wickedpicker {
      height: 150px!important;
      font-size: 16px!important;
    }
    .clearable-picker input.form-control {width: 95%;}
    .clearable-picker span {
                        float: right;
                        top: 3px;
                        margin: -27px auto;
                        width: 20px;
                        height: 20px;
                        background-image: url('{{asset('/')}}jw-styles/plugins/sbhadra/photography/timepicker/clear.png');
                        background-size: 20px;
                        color: #fff;
                        padding: 7px; 
                }
</style>
<script>
//   var twelveHour = $('.timepicker-12-hr').wickedpicker();
//             $('.time').text('//JS Console: ' + twelveHour.wickedpicker('time'));
//             $('.timepicker-24-hr').wickedpicker({twentyFour: true});
            $('#timepicker1').wickedpicker({now: "12:00", clearable: true, minutesInterval: 30});
            $('#timepicker2').wickedpicker({now: "12:00", clearable: true, minutesInterval: 30});
</script>
@endsection
