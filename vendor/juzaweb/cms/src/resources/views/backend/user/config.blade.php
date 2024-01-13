@extends('juzaweb::layouts.backend')

@section('content')
    @php
      $fields=array(
        'logo'=>'',
        'title'=>'',
        'description'=>'',
        'primary_color'=>'',
        'primary_text_color'=>'',
        'enable_single_package'=>'',
        'enable_multiservice'=>'',
        'booking_type'=>'',
        'api_key'=>'',
        'pay_amount'=>'',
        'facebook_url'=>'',
        'twitter_url'=>'',
        'instagram_url'=>'',
        'snapchat_url'=>'',
        'youtube_url'=>'',
        'whatsapp'=>'',
        'email'=>'',
        'package_id'=>'',
        'background'=>'',
     );
     foreach($fields as $key=>$val){
       if(isset($config[$key])) {
        $fields[$key] = $config[$key];
       }
     }
    @endphp
<form method="post" action="{{ route('admin.users.config',['id'=>$user->id]) }}" class="form-ajax">
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="row mt-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="btn-group float-right">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> @lang('juzaweb::app.save')
                </button>

                <button type="reset" class="btn btn-default">
                    <i class="fa fa-refresh"></i> @lang('juzaweb::app.reset')
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h5>General</h5>
            
            <div class="form-group">
                <label class="col-form-label" for="title">@lang('juzaweb::app.site_title')</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$fields['title']}}" autocomplete="off">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="description">@lang('juzaweb::app.tagline')</label>
                <textarea class="form-control" name="description" id="description" rows="4">{{$fields['description']}}</textarea>
                <p class="description"></p>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="title">Primary Color</label>
                <input type="color" name="primary_color" class="form-control" id="primary_color" value="{{$fields['primary_color']}}" autocomplete="off">
            </div>
             <div class="form-group">
                <label class="col-form-label" for="title">Primary Color</label>
                <input type="color" name="primary_text_color" class="form-control" id="primary_text_color" value="{{$fields['primary_text_color']}}" autocomplete="off">
            </div>
            <h5>Booking</h5>
            <div class="form-group">
                <label class="col-form-label" for="service">
                    <input type="hidden" name="enable_single_package" value="0">
                    <input Type="checkbox" name="enable_single_package" value="1" @if($fields['enable_single_package']==1) checked @endif>
                    Enable Single package Booking
                </label>
                
            </div>
            <div class="form-group">
                <label class="col-form-label" for="package_id">Enter Package Id</label>
                <input type="number" name="package_id" class="form-control" id="package_id" value="{{$fields['package_id']}}" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="service">
                    <input type="hidden" name="enable_multiservice" value="0">
                    <input Type="checkbox" name="enable_multiservice" value="1" @if($fields['enable_multiservice']==1) checked @endif>
                    Enable multi service Booking
                </label>
            </div>
            <div class="form-group">
               <label class="col-form-label" for="title">Booking System type</label>
                <select class="form-control" name="booking_type">
                    <option value="1" @if($fields['booking_type']==1) selected="" @endif > Studio </option>
                    <option value="2" @if($fields['booking_type']==2) selected="" @endif > Salon </option>
                    <option value="3" @if($fields['booking_type']==3) selected="" @endif > Resturant </option>
                    <option value="4" @if($fields['booking_type']==4) selected="" @endif > Chalet </option>
                </select>
            </div>


            <div class="form-group">
                <label class="col-form-label" for="title">Api key</label>
                <input type="text" name="api_key" class="form-control" id="api_key" value="{{$fields['api_key']}}" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="title">Pay amount </label>
                <input type="text" name="pay_amount" class="form-control" id="pay_amount" value="{{$fields['pay_amount']}}" autocomplete="off">
            </div>
        </div>

        <div class="col-md-4">
             <h5>Social</h5>
            <div class="form-group">
                <label class="col-form-label" for="title">Facebook URL</label>
                <input type="text" name="facebook_url" class="form-control" id="facebook_url" value="{{$fields['facebook_url']}}" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="title">twitter URL</label>
                <input type="text" name="twitter_url" class="form-control" id="twitter_url" value="{{$fields['twitter_url']}}" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="title">Instagram URL</label>
                <input type="text" name="instagram_url" class="form-control" id="instagram_url" value="{{$fields['instagram_url']}}" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="title">Snapchat URL</label>
                <input type="text" name="snapchat_url" class="form-control" id="snapchat_url" value="{{$fields['snapchat_url']}}" autocomplete="off">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="title">Youtube URL</label>
                <input type="text" name="youtube_url" class="form-control" id="youtube_url" value="{{$fields['youtube_url']}}" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="title">Whatsapp</label>
                <input type="text" name="whatsapp" class="form-control" id="whatsapp" value="{{$fields['whatsapp']}}" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="title">Email</label>
                <input type="text" name="email" class="form-control" id="email" value="{{$fields['email']}}" autocomplete="off">
            </div>

            
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">  
                <label class="col-form-label">Background</label>
                    <div class="form-image text-center  previewing ">
                        <a href="javascript:void(0)" class="image-clear"><i class="fa fa-times-circle fa-2x"></i></a> 
                           <input type="hidden" name="background" class="input-path" value="{{$fields['background']}}"><div class="dropify-preview image-hidden" style="display: block"><span class="dropify-render">
                            <img src="{{upload_url($fields['background'])}}" alt="">  </span><div class="dropify-infos"><div class="dropify-infos-inner">
                            <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                            </div>
                        </div>
                    </div>
                        <div class="icon-choose">
                            <i class="fa fa-cloud-upload fa-5x"></i>
                         <p>Click here to select file</p>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="btn-group float-right">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> {{ trans('juzaweb::app.save') }}
                </button>
                 <button type="reset" class="btn btn-default">
                    <i class="fa fa-refresh"></i> {{ trans('juzaweb::app.reset') }}
                </button>
            </div>
        </div>
    </div>
</form>


   

@endsection
