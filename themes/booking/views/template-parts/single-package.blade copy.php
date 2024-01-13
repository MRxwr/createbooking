@extends('juzaweb::layouts.frontend')
@section('content')
  <!-- package-section -->
  <section class="package-section py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <div class="row">
                            <div class="col-xl-12 pb-5">
                                <div class="site-title position-relative d-flex align-items-center">
                                    <div class="bg-white">
                                        <h3 class="fs30 text-300 SegoeUIL pe-4">
                                        {{ $post->getTitle() }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <!-- package-item -->
                        <div class="px-xxl-5">
                            <div class="row package-item">
                                <div class="col-sm-6 ps-xl-5 mb-sm-5 mb-5 d-block d-sm-none">
                                    <img src="{{ $post->getThumbnail() }}" alt="{{ $post->getTitle() }}"  class="w-100 mt-xl-0 mt-4">
                                </div>
                                <div class="col-sm-6 pe-xl-5">
                                    <div class="package-head bg-light radius15 mh53 py-1 px-3 mb-3 d-inline-flex align-items-center">
                                        <h4 class="fs23">
                                            @lang('theme::app.Included_In_This_Package'):
                                        </h4>
                                    </div>
                                    <div class="package-body text-muted mb-5 pb-4 pt-3">
                                        
                                        {!! str_replace('<ul>','<ul class="package-list ps-4">',$post->getContent()) !!} 
                                          @do_action('theme.package_data')                                 
                                    </div>
                                    <div class="package-head bg-light radius15 mh53 py-1 px-3 mb-3 d-inline-flex align-items-center">
                                        <h4 class="fs23 SegoeUIL">
                                        @lang('theme::app.extra_charges')
                                            
                                        </h4>
                                    </div>
                                    <div class="package-body text-muted mb-5 pb-4 pt-3">
                                    @if($post->services)
                                        <!-- <h5>@lang('theme::app.extra_charges')</h5> -->
                                        <ul class="package-list ps-4">
                                          @foreach($post->services as $service)
                                              <li> {{$service->title}}  {{$service->price}} KD</li>
                                          @endforeach                        
                                        </ul>
                                      @endif
                                        
                                    </div>
                                    <!-- @apply_filters('theme.cstudio.theme_category') -->
                                    
                                </div>
                                <div class="col-sm-6 ps-xl-5 mb-sm-5 mb-5 d-none d-sm-block">
                                    <img src="{{ $post->getThumbnail() }}" alt="{{ $post->getTitle() }}" class="w-100 mt-xl-0 mt-4">
                                </div>
                            </div>
                        </div>
                        <!-- package-item -->
                    </div>
                </div>
            </div>
            
            

            <div class="container">
                <div class="px-xxl-5">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="package-head bg-light radius15 mh53 py-1 px-3 mb-5 d-inline-flex align-items-center">
                                <h4 class="fs23">
                                    @lang('theme::app.Choose_Preferred_Day'):
                                </h4>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <input type="hidden" name="package_id" id="package_id" value="{{ $post->id }}">
                            <input type="hidden" name="theme_category" id="theme_category" value="@if($_REQUEST['cat']){{$_REQUEST['cat']}} @endif">
                            <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="hidden"  />
                            <div id="bookingdate"></div>
                        </div>
                        <div class="col-xl-4 pt-5 mt-xl-4">
                            <ul class="pb-3">
                                <li class="mb-3">
                                    <div class="d-flex align-items-start">
                                        <img src="{{asset('/')}}jw-styles/themes/cstudio/assets/img/available.svg" alt="img" class="ms-2 me-3 mt-2">
                                        <div>
                                            <h4 class="fs25 mb-2">
                                               @lang('theme::app.available'):
                                            </h4>
                                            <h6 class="fs18">
                                                @lang('theme::app.Available_Sessions'):
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex align-items-start">
                                        <img src="{{asset('/')}}jw-styles/themes/cstudio/assets/img/reserved.svg" alt="img" class="ms-2 me-3 mt-2">
                                        <div>
                                            <h4 class="fs25 mb-2">
                                            @lang('theme::app.reserved')
                                            </h4>
                                            <h6 class="fs18">
                                                
                                                @lang('theme::app.Fully_Booked')
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex align-items-start">
                                        <img src="{{asset('/')}}jw-styles/themes/cstudio/assets/img/vacation.svg" alt="img" class="ms-2 me-3 mt-2">
                                        <div>
                                            <h4 class="fs25 mb-2">
                                                @lang('theme::app.Vacation')
                                            </h4>
                                            <h6 class="fs18">
                                                @lang('theme::app.Holiday_Or_Weekends')
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-lg btn-light fs32 radius30" id="booknow">@lang('theme::app.book_now')</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- package-section -->

@endsection
