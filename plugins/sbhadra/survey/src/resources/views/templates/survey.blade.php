@extends('juzaweb::layouts.frontend')
@section('header')

@endsection
@section('content')
safasfsafsfsfsfsdfdsf
  <!-- survey-section -->
  <section class="survey-section py-5 my-sm-5">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-xxl-7 px-xxl-4">
                        <div class="survey-box border">
                            <div class="text-center pb-3">
                                <img src="{{ upload_url(get_config('logo')) }}" alt="img" class="mw-100">
                            </div>
                            <p class="fs23 pb-5">
                                How would you rate your satisfaction with experience of visiting our studio?
                            </p>
                            <form method="" action="">
                                @do_action('theme.survey.page')
                            <ul>
                                <li class="mb-3 pb-1">
                                    <label class="container_radio bg-light">
                                        Very satisfied
                                        <input type="radio" name="survey">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li class="mb-3 pb-1">
                                    <label class="container_radio bg-light">
                                        Satisfied
                                        <input type="radio" name="survey">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li class="mb-3 pb-1">
                                    <label class="container_radio bg-light">
                                        Neutral
                                        <input type="radio" name="survey">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li class="mb-3 pb-1">
                                    <label class="container_radio bg-light">
                                        Dissatisfied
                                        <input type="radio" name="survey">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li class="mb-3 pb-1">
                                    <label class="container_radio bg-light">
                                        Very dissatisfied
                                        <input type="radio" name="survey">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                            <div class="row px-xxl-5 pt-5">
                                <div class="col-sm-6 d-flex justify-content-sm-start justify-content-center">
                                    <!-- <button class="btn btn-sm btn-info text-600 fs19">
                                        Back / السابق
                                    </button> -->
                                </div>
                                <div class="col-sm-6 d-flex justify-content-sm-end justify-content-center mt-4 mt-sm-0">
                                    <button class="btn btn-sm btn-info text-600 fs19">
                                        Back / السابق
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- survey-section -->
        <!-- @lang('theme::app.our_packages') -->
  
@endsection
