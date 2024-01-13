@extends('juzaweb::layouts.backend')

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">

            @component('juzaweb::components.form', [
                'method' => 'post',
                'action' => route('admin.reading.save')
            ])

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">{{ trans('juzaweb::app.your_homepage_displays') }}</label>
                    <div class="col-md-6">
                        <div class="form-check mb-2">
                            <label class="form-check-label">
                                <input type="radio" name="show_on_front" value="posts" class="show_on_front-change" {{ get_config('show_on_front', 'posts') == 'posts' ? 'checked' : '' }}> {{ trans('juzaweb::app.your_latest_posts') }}
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <label class="form-check-label">
                                <input type="radio" name="show_on_front" value="page" class="show_on_front-change" {{ get_config('show_on_front', 'posts') == 'page' ? 'checked' : '' }}> {{ trans('juzaweb::app.a_static_page') }}
                            </label>
                        </div>

                        <div class="mb-2">
                            <select name="home_page" class="form-control select-show_on_front load-pages" data-placeholder="--- {{ trans('juzaweb::app.select', ['name' => trans('juzaweb::app.page')]) }} ---" {{ get_config('show_on_front', 'posts') == 'posts' ? 'disabled' : '' }}>
                                @if($page = jw_get_page(get_config('home_page')))
                                    <option value="{{ $page->id }}" selected>{{ $page->name }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-2">
                            <select name="post_page" class="form-control select-show_on_front load-pages" data-placeholder="--- {{ trans('juzaweb::app.select', ['name' => trans('juzaweb::app.page')]) }} ---" {{ get_config('show_on_front', 'posts') == 'posts' ? 'disabled' : '' }}>
                                @if($page = jw_get_page(get_config('post_page')))
                                    <option value="{{ $page->id }}" selected>{{ $page->name }}</option>
                                @endif
                            </select>
                        </div>
                        
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3 col-form-label">{{ trans('juzaweb::app.your_paymentpage') }}</label>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <select name="payment_page" class="form-control select-show_on_front load-pages" data-placeholder="--- {{ trans('juzaweb::app.select', ['name' => trans('juzaweb::app.page')]) }} ---">
                                @if($page = jw_get_page(get_config('payment_page')))
                                    <option value="{{ $page->id }}" selected>{{ $page->name }}</option>
                                @endif
                            </select>
                        </div>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">{{ trans('juzaweb::app.your_successpage') }}</label>
                    <div class="col-md-6">
                        
                        <div class="mb-2">
                            <select name="success_page" class="form-control select-show_on_front load-pages" data-placeholder="--- {{ trans('juzaweb::app.select', ['name' => trans('juzaweb::app.page')]) }} ---" >
                                @if($page = jw_get_page(get_config('success_page')))
                                    <option value="{{ $page->id }}" selected>{{ $page->name }}</option>
                                @endif
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">{{ trans('juzaweb::app.your_failedpage') }}</label>
                    <div class="col-md-6">
                        
                        <div class="mb-2">
                            <select name="failed_page" class="form-control select-show_on_front load-pages" data-placeholder="--- {{ trans('juzaweb::app.select', ['name' => trans('juzaweb::app.page')]) }} ---" >
                                @if($page = jw_get_page(get_config('failed_page')))
                                    <option value="{{ $page->id }}" selected>{{ $page->name }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> {{ trans('juzaweb::app.save') }}
                    </button>
                </div>

            @endcomponent

        </div>
    </div>
@endsection