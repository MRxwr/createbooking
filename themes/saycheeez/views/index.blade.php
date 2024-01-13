@extends('juzaweb::layouts.frontend')
@section('header')

@endsection
@section('content')
 <!-- hero-slider -->
    <section class="hero-slider">
        <div class="container-fluid">
                   <div class="row">
                        <div class="col-lg-12 px-0 d-block d-sm-none">
                            <img src="{{asset('/')}}jw-styles/themes/saycheeez/assets/img/hero_img_mobile.png" alt="img" class="w-100">
                        </div>
                        <div class="col-lg-12 px-0 d-none d-sm-block">
                            <img src="{{asset('/')}}jw-styles/themes/saycheeez/assets/img/hero_img.png" alt="img" class="w-100">
                        </div>
                    <div class="col-lg-6 px-0">
                      @do_action('theme.Haya.slider')
                   </div>
               </div>
        </div>
    </section> 
        <!-- hero-slider -->
        <!-- about-us -->
         <!-- @do_action('theme.home.about')-->
          <!-- signature_section -->
        <!--<section class="signature_section d-flex justify-content-center align-items-center">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-xl-12 d-flex justify-content-center align-items-center py-4">-->
        <!--                <img src="{{asset('/')}}jw-styles/themes/hbqhaya/assets/img/logo_big.svg" alt="img" class="mw-100">-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- signature_section -->
        <!-- package_section -->
        <section class="package-section py-5">
        <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 px-xxl-5">
                        <div class="row">
                            <div class="col-xl-12 pb-5">
                                <div class="site-title position-relative d-flex align-items-center justify-content-center">
                                    <div class="bg-white">
                                        <h3 class="fs30 text-600 SegoeUISB text-uppercase SegoeUIL px-5">
                                            <!--@lang('theme::app.our_packages')-->
                                            SAYCHEEEZ STUDIO
                                        </h3>
                                        <p class="text-600 SegoeUISB text-uppercase SegoeUIL">BY DALAL ALDUGHAISHEM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                        @do_action('theme.homepackages')
                </div>
            </div>
        </section>
        <!-- package_section -->

        <!-- instagram-section -->
         <!-- insta_feed -->
        <!-- <section class="instagram-section py-sm-5 pt-5 mb-sm-5">-->
        <!-- <div class="container pb-sm-3">-->
        <!--        <div class="row justify-content-center">-->
        <!--            <div class="col-xl-10 px-xxl-5">-->
        <!--                <div class="row">-->
        <!--                    <div class="col-xl-12 pb-5">-->
        <!--                        <div class="site-title position-relative d-flex align-items-center justify-content-center">-->
        <!--                            <div class="bg-white">-->
        <!--                                <h3 class="fs30 text-300 SegoeUIL px-5">-->
        <!--                                @lang('theme::app.picked_for_you')-->
        <!--                                </h3>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        @apply_filters('theme.instafeed.home1st')-->
        <!--    </div>-->
        <!--</section>-->
        <!-- insta_feed -->
        <!-- @do_action('theme.home_packages') -->
        <!-- @apply_filters('theme.instafeed.home'); -->
  
  
@endsection
