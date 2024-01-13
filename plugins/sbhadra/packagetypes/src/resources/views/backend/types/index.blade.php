@extends('juzaweb::layouts.backend')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h5>{{ trans('juzaweb::app.add_new') }}</h5>
             <form method="post" action="{{route('admin.package-type.store')}}" class="form-ajax" data-success="reload_data" id="form-add">
                {!! csrf_field() !!}
                @component('juzaweb::components.form_input', [
                    'name' => 'title',
                    'label' => trans('juzaweb::app.name'),
                    'value' => '',
                    'required' => true,
                ])
                @endcomponent
                
                <div class="form-group"><label class="control-label mb-10 text-left">Type</label> 
                    <select class="form-control valid" name="ptype" id="ptype" aria-invalid="false">
                        <option value="normal">Single Print</option>
                        <option value="album">Album </option>
                    </select>
                </div>

                <div class="form-group"><label class="control-label mb-10 text-left">Note</label> 
                    <textarea class="form-control valid" name="note" ></textarea>
                </div>
                   
                <div class="form-group"><label class="control-label mb-10 text-left">Status</label> 
                    <select class="form-control valid" name="status" id="status" aria-invalid="false">
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>
                    {{ trans('juzaweb::app.add') }} 
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
