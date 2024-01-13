@extends('juzaweb::layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-6"></div>

        <!-- <div class="col-md-6">
            <div class="btn-group float-right">
                <a href="{{ route('admin.plugin.install') }}" class="btn btn-success" data-turbolinks="false"><i class="fa fa-plus-circle"></i> @lang('juzaweb::app.add_new')</a>
            </div>
        </div> -->
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <form method="post" class="form-inline">
                @csrf
                <select name="bulk_actions" class="form-control w-60 mb-2 mr-1">
                    <option value="">{{ trans('juzaweb::app.bulk_actions') }}</option>
                    <option value="activate">{{ trans('juzaweb::app.activate') }}</option>
                    <option value="deactivate">{{ trans('juzaweb::app.deactivate') }}</option>
                    <option value="delete">{{ trans('juzaweb::app.delete') }}</option>
                </select>

                <button type="submit" class="btn btn-primary px-2 mb-2" id="apply-action">{{ trans('juzaweb::app.apply') }}</button>
            </form>
        </div>
        
        <div class="col-md-9">
            <form method="get" class="form-inline" id="form-search">
                <div class="form-group mb-2 mr-1">
                    <label for="search" class="sr-only">@lang('juzaweb::app.search')</label>
                    <input name="search" type="text" id="search" class="form-control" placeholder="@lang('juzaweb::app.search')" autocomplete="off">
                </div>

                <div class="form-group mb-2 mr-1">
                    <label for="status" class="sr-only">@lang('juzaweb::app.status')</label>
                    <select name="status" id="status" class="form-control select2-default">
                        <option value="">@lang('juzaweb::app.all_status')</option>
                        <option value="1">@lang('juzaweb::app.enabled')</option>
                        <option value="0">@lang('juzaweb::app.disabled')</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mb-2">@lang('juzaweb::app.search')</button>
            </form>
        </div>
    </div>
        <div class="col-md-12">
            <div class="row">
                @foreach($plugins as $plugin)
                    <div class="col-md-6 col-xl-3">
                        <div class="card rounded-lg m-3">
                            <div class="height-150 d-flex flex-column jw__g13__head bg-success text-white p-3" >
                                <h4 class="text-white text-uppercase font-weight-bold mr-auto">{{$plugin['name']}}</h4>
                            </div>
                            <div class="height-50 d-flex flex-column jw__g13__head  p-3" >
                                <p>{{$plugin['description']}}</p>
                                <h5>Version : {{$plugin['version']}}</h5>
                                <h5>Author : CreateKW</h5>
                            </div>
                            <div class="card card-borderless mb-0">
                                <div class="card-header border-bottom-0">
                                    <div class="d-flex">
                                            <div class="text-dark text-uppercase font-weight-bold mr-auto">
                                                @if($plugin['status']=='active')
                                                        <button class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>
                                                        </button>
                                                @endif
                                            </div>                                
                                            <div class="text-gray-6">
                                                @if($plugin['status']=='active')
                                                    <form action="{{ route('admin.plugin.bulk-actions') }}" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <input type="hidden" name="ids[]" value="{{$plugin['id']}}">
                                                        <input type="hidden" name="action" value="deactivate">
                                                        <button class="btn btn-danger">Deactivate</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.plugin.bulk-actions') }}" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <input type="hidden" name="ids[]" value="{{$plugin['id']}}">
                                                    <input type="hidden" name="action" value="activate">
                                                    <button class="btn btn-success">Activate</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                     @endforeach   

            </div>
        </div>

        
    

    <div class="table-responsive mb-5">
        <table class="table juzaweb-table">
            <thead>
                <tr>
                    <th data-width="3%" data-field="state" data-checkbox="true"></th>
                    <th data-field="name" data-width="20%" data-formatter="nameFormatter">@lang('juzaweb::app.name')</th>
                    <th data-field="description">@lang('juzaweb::app.description')</th>
                    <th data-width="15%" data-field="status" data-formatter="statusFormatter">@lang('juzaweb::app.status')</th>
                </tr>
            </thead>
        </table>
    </div>

    <script type="text/javascript">
        function nameFormatter(value, row, index) {
            return value;
        }
        
        function statusFormatter(value, row, index) {
            switch (value) {
                case 'inactive':
                    return `<span class='text-disable'>${juzaweb.lang.inactive}</span>`;
            }

            return `<span class='text-success'>${juzaweb.lang.active}</span>`;
        }

        // var table = new JuzawebTable({
        //     url: '{{ route('admin.plugin.get-data') }}',
        //     action_url: '{{ route('admin.plugin.bulk-actions') }}',
        // });
    </script>
@endsection