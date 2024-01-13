@extends('juzaweb::layouts.backend')

@section('content')
  <style>
      #package_type_attr_filter{ float:right}
      #package_type_attr_paginate{ float:right}
  </style>
    <div class="row">
        <div class="col-md-4">
            <h5>{{ trans('juzaweb::app.add_new') }}</h5>
             <form method="post" action="{{route('admin.package-type-attributes.store')}}" class="form-ajax" data-success="reload_data" id="form-add">
                {!! csrf_field() !!}
                @component('juzaweb::components.form_input', [
                    'name' => 'name',
                    'label' => trans('juzaweb::app.name'),
                    'value' => '',
                    'required' => true,
                ])
                @endcomponent
                <input type="hidden" name="package_type_id" value="{{$package_type_id}}"/>
                

                @component('juzaweb::components.form_input', [
                    'name' => 'price',
                    'label' => 'Price',
                    'value' => '',
                    'required' => true,
                ])
                @endcomponent

                <div class="form-group"><label class="control-label mb-10 text-left">Status</label> 
                    <select class="form-control valid" name="status" id="status" aria-invalid="false">
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label mb-10 text-left"><input type="radio" name="is_theme" value="1"/> Album</label> 
                    <label class="control-label mb-10 text-left"><input type="radio" name="is_theme" value="0"/>Single Print</label> 
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>
                    {{ trans('juzaweb::app.add') }} 
                </button>
            </form>
        </div>

        <div class="col-md-8">
          <!-- {{ $dataTable->render() }} is_theme -->
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

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#package_type_attr').DataTable();
        });
    </script>

@endsection
