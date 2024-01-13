@extends('juzaweb::layouts.backend')
@section('head')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
@endsection

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
              
                <div class="form-group bootstrap-timepicker timepicker">
                    <label class="col-form-label" for="release">@lang('sbph::app.starttime')</label>
                    <input id="timepicker1" name="starttime" type="time" class="form-control input-small" value="{{ $model->starttime }}">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
                
                <div class="form-group bootstrap-timepicker timepicker">
                    <label class="col-form-label" for="release">@lang('sbph::app.endtime')</label>
                    <input id="timepicker2" name="endtime" type="time" class="form-control input-small" value="{{ $model->endtime }}">
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
    //$('#timepicker1').timepicker();
    //$('#timepicker2').timepicker();
</script>
@endsection
