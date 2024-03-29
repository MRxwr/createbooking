<form method="post" action="{{ route('admin.setting.save') }}" class="form-ajax">
    <input type="hidden" name="form" value="general">
    @php
        $registration = get_config('user_registration');
        $verification = get_config('user_verification');
        $enable_multilanguage = get_config('enable_multilanguage');
        $enable_multiservice  = get_config('enable_multiservice');
        $enable_single_package  = get_config('enable_single_package');
        $booking_type  = get_config('booking_type');
        $timezones = timezone_identifiers_list();
        $sitetimezone = get_config('timezone', 'UTC');
        $dateFormat = get_config('date_format', 'F j, Y');
        $timeFormat = get_config('time_format', 'g:i a');

        $dateFormats = [
            'F j, Y' => now()->format('F j, Y'),
            'Y-m-d' => now()->format('Y-m-d'),
            'm/d/Y' => now()->format('m/d/Y'),
            'd/m/Y' => now()->format('d/m/Y'),
        ];

        $timeFormats = [
            'g:i a' => now()->format('g:i a'),
            'g:i A' => now()->format('g:i A'),
            'H:i' => now()->format('H:i'),
        ]
    @endphp

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
        <div class="col-md-8">
            <h5>{{ trans('juzaweb::app.general') }}</h5>

            <div class="form-group">
                <label class="col-form-label" for="title">@lang('juzaweb::app.site_title')</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ get_config('title') }}" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="description">@lang('juzaweb::app.tagline')</label>
                <textarea class="form-control" name="description" id="description" rows="4">{{ get_config('description') }}</textarea>
                <p class="description">{{ trans('juzaweb::app.site_description_note') }}</p>
            </div>

            <div class="form-group">
                <label class="col-form-label" for="timezone">{{ trans('juzaweb::app.timezone') }}</label>
                <select name="timezone" class="form-control select2">
                    @foreach($timezones as $timezone)
                        <option value="{{ $timezone }}" @if($sitetimezone == $timezone) selected @endif>{{ $timezone }}</option>
                    @endforeach
                </select>
                <p class="description">{{ trans('juzaweb::app.timezone_description') }}</p>
                <p class="description">{{ trans('juzaweb::app.current_time') }} {{ now()->format('Y-m-d H:i:s') }}</p>
            </div>

            <div class="form-group">
                <label class="col-form-label" for="language">
                    <input type="hidden" name="enable_multilanguage" value="0">
                    <input Type="checkbox" name="enable_multilanguage" value="1" @if($enable_multilanguage ==1) checked @endif>
                     @lang('juzaweb::app.enable_multilanguage')
                </label>
                
            </div>

            <div class="form-group">
                <label class="col-form-label" for="language">@lang('juzaweb::app.site_language')</label>
                <select name="language" class="form-control load-locales">
                    @if($locale = get_config('language'))
                        <option value="{{ $locale }}" selected>{{ config("locales.{$locale}.name") }}</option>
                    @endif    
                </select>
            </div>

            <div class="form-group">
                <label class="col-form-label" for="date_format">@lang('juzaweb::app.date_format')</label>
                <fieldset>
                    @foreach($dateFormats as $key => $item)
                    <label class="mb-2">
                        <input type="radio" name="date_format" value="{{ $key }}" @if($key == $dateFormat) checked="checked" @endif>
                        <span class="date-time-text format-i18n mr-2">{{ $item }}</span><code>{{ $key }}</code>
                    </label><br>
                    @endforeach

                        {{--<label>
                            <input type="radio" name="date_format" id="date_format_custom_radio" value="custom">
                            <span class="date-time-text date-time-custom-text">Custom:<span class="screen-reader-text"> enter a custom date format in the following field</span></span>
                        </label>

                        <label for="date_format_custom" class="screen-reader-text">Custom date format:</label>
                        <input type="text" name="date_format_custom" id="date_format_custom" value="F j, Y" class="form-control w-25">
                        <br>

                        <p><strong>Preview:</strong>
                            <span class="example">September 2, 2021</span><span class="spinner"></span>
                        </p>--}}
                </fieldset>
            </div>

            <div class="form-group">
                <label class="col-form-label" for="time_format">@lang('juzaweb::app.time_format')</label>
                <fieldset>
                    @foreach($timeFormats as $key => $item)
                    <label><input type="radio" name="time_format" value="{{ $key }}" @if($key == $timeFormat) checked="checked" @endif> <span class="date-time-text format-i18n mr-2">{{ $item }}</span><code>{{ $key }}</code></label><br>
                    @endforeach

                    {{--<label for="time_format_custom" class="screen-reader-text">Custom time format:</label>
                    <input type="text" name="time_format_custom" id="time_format_custom" value="g:i a" class="form-control w-25">
                    <br>

                    <p><strong>Preview:</strong> <span class="example">6:47 am</span><span class="spinner"></span>
                    </p>--}}

                    <p class="date-time-doc"><a href="https://wordpress.org/support/article/formatting-date-and-time/" target="_blank" rel="nofollow">Documentation on date and time formatting</a>.</p>

                </fieldset>
            </div>
        </div>

        <div class="col-md-4">
            <h5>{{ trans('juzaweb::app.analytics') }}</h5>
            <div class="form-group">
                <label class="col-form-label" for="site_key">@lang('juzaweb::app.site_key')</label>
                <input type="text" name="site_key" class="form-control" id="site_key" value="{{ get_config('site_key') }}" autocomplete="off">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="service">
                    <input type="hidden" name="enable_multiservice" value="0">
                    <input Type="checkbox" name="enable_multiservice" value="1" @if($enable_multiservice ==1) checked @endif>
                   Enable multi service Booking
                </label>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="service">
                    <input type="hidden" name="enable_single_package" value="0">
                    <input Type="checkbox" name="enable_single_package" value="1" @if($enable_single_package ==1) checked @endif>
                    Enable Single package Booking
                </label>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="package_id">Enter Package Id</label>
                <input type="number" name="package_id" class="form-control" id="package_id" value="{{ get_config('package_id') }}" autocomplete="off">
            </div>
            <div class="form-group">
               <label class="col-form-label" for="title">Booking Tupy</label>
                <select class="form-control" name="booking_type">
                    <option value="1" @if($booking_type==1) selected="" @endif > Studio </option>
                    <option value="2" @if($booking_type==2) selected="" @endif > Salon </option>
                    <option value="3" @if($booking_type==3) selected="" @endif > Resturant </option>
                    <option value="4" @if($booking_type==4) selected="" @endif > Chalet </option>
                </select>
            </div>

            <div class="form-group">
                <label class="col-form-label" for="fb_app_id">@lang('juzaweb::app.fb_app_id')</label>
                <input type="text" name="fb_app_id" class="form-control" id="fb_app_id" value="{{ get_config('fb_app_id') }}" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="google_analytics">@lang('juzaweb::app.google_analytics_id')</label>
                <input type="text" name="google_analytics" class="form-control" id="google_analytics" value="{{ get_config('google_analytics') }}" autocomplete="off">
            </div>

            <h5>{{ trans('juzaweb::app.registration') }}</h5>

            <div class="form-group">
                <label class="col-form-label" for="user_registration">@lang('juzaweb::app.user_registration')</label>
                <select name="user_registration" id="user_registration" class="form-control">
                    <option value="1" @if($registration == 1) selected @endif>@lang('juzaweb::app.enabled')</option>
                    <option value="0" @if($registration == 0) selected @endif>@lang('juzaweb::app.disabled')</option>
                </select>
            </div>

            <div class="form-group">
                <label class="col-form-label" for="user_verification">@lang('juzaweb::app.user_e_mail_verification')</label>
                <select name="user_verification" id="user_verification" class="form-control">
                    <option value="1" @if($verification == 1) selected @endif>@lang('juzaweb::app.enabled')</option>
                    <option value="0" @if($verification == 0) selected @endif>@lang('juzaweb::app.disabled')</option>
                </select>
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