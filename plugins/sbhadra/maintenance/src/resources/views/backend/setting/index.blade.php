@extends('juzaweb::layouts.backend')

@section('content')

<!-- @dd(\Sbhadra\Photography\Models\Setting::where('field_value','api_key')->first()) -->
    <div class="row mb-3">
        <div class="col-md-8">
        <form action="{{route('admin.setting.post')}}" method="post" class="form-ajax" id="Be4MBcHP47k9METK" novalidate="novalidate">
        {!! csrf_field() !!}
               <div class="form-group row">
                    <label class="col-form-label" for="release">Maintenance</label>
                    <input  name="is_maintenance" type="hidden"  value="0">
                    <input  name="is_maintenance" type="checkbox"  value="1" @if(@$settings['is_maintenance']==1) checked @endif>
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
                <div class="form-group row">
                    <label class="col-form-label" for="release"> Title text</label>
                    <textarea name="page_title_text" type="text" class="form-control input-small">{{@$settings['page_title_text']}}</textarea>
                </div>
                <div class="form-group row">
                    <label class="col-form-label" for="release">Body</label>
                    <textarea name="body_text" type="text" class="form-control input-small">{{@$settings['body_text']}}</textarea>
                    
                </div>
                <div class="form-group row">
                    <label class="col-form-label" for="release">Header Text</label>
                    <textarea name="header_text" type="text" class="form-control input-small">{{@$settings['header_text']}}</textarea>
                </div>
                <div class="form-group row">
                    <label class="col-form-label" for="release">Footer Text</label>
                    <textarea name="footer_text" type="text" class="form-control input-small">{{@$settings['footer_text']}}</textarea>
                </div>

                <div class="form-group row">
                    <label class="col-form-label" for="release">Facebook Url</label>
                    <input id="timepicker2" name="mt_facebook_url" type="text" class="form-control input-small" value="{{@$settings['mt_facebook_url']}}">
                </div>
                <div class="form-group row">
                    <label class="col-form-label" for="release">Twitter Url</label>
                    <input id="timepicker2" name="mt_twitter_url" type="text" class="form-control input-small" value="{{@$settings['mt_twitter_url']}}">
                    
                </div>
                <div class="form-group row">
                    <label class="col-form-label" for="release">Instagram Url</label>
                    <input id="timepicker2" name="mt_instagram_url" type="text" class="form-control input-small" value="{{@$settings['mt_instagram_url']}}">
                   
                </div>
                
                <div class="form-group row">
                    <label class="col-form-label">slide 1</label>
                    <div class="form-image text-center ">
                          <a href="javascript:void(0)" class="image-clear"  @if(isset($settings['slide_1'])) style="display: block" @endif><i class="fa fa-times-circle fa-2x"></i></a>
                          <input type="hidden" name="slide_1" class="input-path" value="{{$settings['slide_1']}}">
                          <div class="dropify-preview image-hidden" @if(isset($settings['slide_1'])) style="display: block" @endif>
                              <span class="dropify-render">  <img src="{{upload_url($settings['slide_1'])}}" alt="">   </span>
                            <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                  <p class="dropify-filename">
                                      <span class="dropify-filename-inner"></span>
                                  </p>
                                </div>
                            </div>
                          </div>
                        <div class="icon-choose"><i class="fa fa-cloud-upload fa-5x"></i><p>Click here to select file</p></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label">slide 2</label>
                    <div class="form-image text-center ">
                          <a href="javascript:void(0)" class="image-clear"  @if(isset($settings['slide_2'])) style="display: block" @endif><i class="fa fa-times-circle fa-2x"></i></a>
                          <input type="hidden" name="slide_2" class="input-path" value="{{$settings['slide_2']}}">
                          <div class="dropify-preview image-hidden" @if(isset($settings['slide_2'])) style="display: block" @endif>
                              <span class="dropify-render">  <img src="{{upload_url($settings['slide_2'])}}" alt="">   </span>
                            <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                  <p class="dropify-filename">
                                      <span class="dropify-filename-inner"></span>
                                  </p>
                                </div>
                            </div>
                          </div>
                        <div class="icon-choose"><i class="fa fa-cloud-upload fa-5x"></i><p>Click here to select file</p></div>
                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-form-label">slide 3</label>
                    <div class="form-image text-center ">
                          <a href="javascript:void(0)" class="image-clear"  @if(isset($settings['slide_3'])) style="display: block" @endif><i class="fa fa-times-circle fa-2x"></i></a>
                          <input type="hidden" name="slide_3" class="input-path" value="{{$settings['slide_3']}}">
                          <div class="dropify-preview image-hidden" @if(isset($settings['slide_3'])) style="display: block" @endif>
                              <span class="dropify-render">  <img src="{{upload_url($settings['slide_3'])}}" alt="">   </span>
                            <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                  <p class="dropify-filename">
                                      <span class="dropify-filename-inner"></span>
                                  </p>
                                </div>
                            </div>
                          </div>
                        <div class="icon-choose"><i class="fa fa-cloud-upload fa-5x"></i><p>Click here to select file</p></div>
                    </div>
                </div>

                <div class="mt-3"><button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save </button></div>
                </form>
            </div>
           
       

    </div>

   

@endsection