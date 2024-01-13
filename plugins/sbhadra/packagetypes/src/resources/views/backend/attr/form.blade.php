@extends('juzaweb::layouts.backend')

@section('content')

    <div class="row">
        <div class="col-md-4">
          
            <form method="post" action="{{route('admin.package-type-attributes.update', [$model->id])}}" class="form-ajax" data-success="reload_data" id="form-add">
                {!! csrf_field() !!} 
                <input type="hidden" name="_method" value="PUT"> 
                @component('juzaweb::components.form_input', [
                    'name' => 'title',
                    'label' => trans('juzaweb::app.name'),
                    'value' => $model->title,
                    'required' => true,
                ])
                @endcomponent
                <input type="hidden" name="package_type_id" value="{{$model->package_type_id}}"/>
                @component('juzaweb::components.form_input', [
                    'name' => 'price',
                    'label' => 'Price',
                    'value' => $model->price,
                    'required' => true,
                ])
                @endcomponent

                <div class="form-group"><label class="control-label mb-10 text-left">Status</label> 
                    <select class="form-control valid" name="status" id="status" aria-invalid="false">
                        <option value="1" @if($model->status==1) selected @endif >Active</option>
                        <option value="0" @if($model->status==0) selected @endif>In-Active</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label mb-10 text-left"><input  type="radio" name="is_theme" value="1" @if($model->is_theme==1) checked @endif /> Album </label> 
                    <label class="control-label mb-10 text-left"><input type="radio" name="is_theme" value="0" @if($model->is_theme==0) checked @endif /> Single Print</label> 
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>
                    {{ trans('juzaweb::app.update') }} 
                </button>
            </form>
        </div>

        <div class="col-md-8">
          <!-- {{ $dataTable->render() }} -->
          <table id="package_type_attr" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                   <th><input name="btSelectAll" type="checkbox"></th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $dataTable as $row)
                <tr>
                    <td class="bs-checkbox ">
                     <label>
                        <input data-index="0" name="btSelectItem" type="checkbox" value="{{$row->id}}"><span></span>
                    </label>
                    </td>
                    <td>{{$row->title}}</td>
                    <td>{{$type_title}}</td>
                    <td>{{$row->price}}KD</td>
                    <td>{{($row->status==1?'Active':'In-active')}}</td>
                    <td>{{jw_date_format($row->created_at)}}</td>
                    <td>
                         <a class="btn btn-sm btn-primary" href="{{route('admin.package-type-attributes.edit',['id'=>$row->id])}}"> Edit </a>
                         <!-- <a href="{{route('admin.package-type-attributes.edit',['id'=>$row->id])}}"> Delete </a> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
