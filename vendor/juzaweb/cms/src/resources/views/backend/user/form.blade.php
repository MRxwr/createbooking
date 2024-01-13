@extends('juzaweb::layouts.backend')

@section('content')

    @component('juzaweb::components.form_resource', [
        'action' => $model->id ?
            route('admin.users.update', [$model->id]) :
            route('admin.users.store'),
        'method' => $model->id ? 'put' : 'post'
    ])
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="col-form-label" for="name">@lang('juzaweb::app.name')</label>

                    <input type="text" name="name" class="form-control" id="name" value="{{ $model->name }}" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="name">Username</label>
                    <input type="text"  class="form-control" id="name" value="{{ $model->username }}"  @if($model->username) disabled @else name="username" required @endif autocomplete="off" >
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="email">@lang('juzaweb::app.email')</label>
                    <input type="text" class="form-control" id="email" value="{{ $model->email }}" autocomplete="off" @if($model->id) disabled @else name="email" required @endif>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="password">@lang('juzaweb::app.password')</label>
                    <input type="password" name="password" class="form-control" id="password" autocomplete="off" @if(empty($model->id)) required @endif>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="password_confirmation">@lang('juzaweb::app.confirm_password')</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" autocomplete="off" @if(empty($model->id)) required @endif>
                </div>
                @do_action('post_type.users.form.right', $model)
             
            </div>

            <div class="col-md-4">
                @component('juzaweb::components.form_image', [
                    'label' => trans('juzaweb::app.avatar'),
                    'name' => 'avatar',
                    'value' => $model->avatar
                ])
                @endcomponent
                <div class="form-group">
                    <label class="col-form-label" for="status">@lang('juzaweb::app.status')</label>
                    <select name="status" id="status" class="form-control" required>
                        @foreach($allStatus as $key => $name)
                        <option value="{{ $key }}" @if($model->status == $key) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                @if(isset($model->usertype))
                <div class="form-group">
                    <label class="col-form-label" for="usertype">@lang('juzaweb::app.permission')</label>
                    <select name="usertype" id="usertype" class="form-control" required>
                        <option value="user" @if($model->usertype == "user") selected @endif>@lang('juzaweb::app.user')</option>
                        <option value="employee" @if($model->usertype == "employee") selected @endif>Employee</option>
                        <option value="company" @if($model->usertype == "company") selected @endif>Company</option>
                        <option value="admin" @if($model->usertype == "admin") selected @endif>@lang('juzaweb::app.admin')</option>
                    </select>
                </div>
               @else
                  <div class="form-group">
                    <label class="col-form-label" for="usertype">@lang('juzaweb::app.permission')</label>
                    <select name="usertype" id="usertype" class="form-control" required>
                        <option value="user" @if($model->usertype == "user") selected @endif>@lang('juzaweb::app.user')</option>
                        <option value="employee" @if($model->usertype == "employee") selected @endif>Employee</option>
                        <option value="company" @if($model->usertype == "company") selected @endif>Company</option>
                        <option value="admin" @if($model->usertype == "admin") selected @endif>@lang('juzaweb::app.admin')</option>
                    </select>
                </div>
                @endif
                @do_action('post_type.users.form.left', $model)
            </div>
        </div>

        <input type="hidden" name="id" value="{{ $model->id }}">
    @endcomponent

@endsection
