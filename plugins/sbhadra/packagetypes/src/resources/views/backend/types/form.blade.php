@extends('juzaweb::layouts.backend')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <form method="post" action="{{route('admin.package-type.update', [$model->id])}}" class="form-ajax" data-success="reload_data" novalidate="novalidate">
                {!! csrf_field() !!}  
                <input type="hidden" name="_method" value="PUT"> 
                <input type="hidden" name="id" value="{{$model->id}}"> 
                @component('juzaweb::components.form_input', [
                    'name' => 'title',
                    'label' => trans('juzaweb::app.name'),
                    'value' => $model->title,
                    'required' => true,
                ])
                @endcomponent
                <div class="form-group"><label class="control-label mb-10 text-left">Type</label> 
                    <select class="form-control valid" name="ptype" id="ptype" aria-invalid="false">
                        <option value="normal" @if($model->ptype=='normal') selected @endif >SIngle Print</option>
                        <option value="album" @if($model->ptype=='album') selected @endif>Album </option>
                    </select>
                </div>
                <div class="form-group"><label class="control-label mb-10 text-left">Note</label> 
                    <textarea class="form-control valid" name="note">{{$model->note}}</textarea>
                </div>
                <div class="form-group"><label class="control-label mb-10 text-left">Status</label> 
                    <select class="form-control valid" name="status" id="status" aria-invalid="false">
                        <option value="1" @if($model->status==1) selected @endif >Active</option>
                        <option value="0" @if($model->status==0) selected @endif>In-Active</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>
                {{ trans('juzaweb::app.update') }} 
                </button>
            </form>
        </div>
        <div class="col-md-8">
        {{ $dataTable->render() }}
        </div>
    </div>

    <script type="text/javascript">
        function reload_data(form) {
            $('#form-add input[type="text"], #form-add textarea').val(null);
            $('#form-add #parent_id').val(null).trigger('change.select2');
            table.refresh();
        }
    </script>

@endsection
