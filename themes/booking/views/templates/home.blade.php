@extends('juzaweb::layouts.frontend')
@section('header')

@endsection
@section('content')
        <!-- about-us -->
          <!-- hero_section -->
          @do_action('theme.home.about')
        <!-- hero_section -->
        <!-- package_section -->
        <section class="package_section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="fs107 CarrinadyB text-primary SegoeUIL">
                            <!-- choose a package -->
                            @lang('theme::app.our_packages')
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-11 offset-xl-1">
                        @do_action('theme.homepackages')
                    </div>
                </div>
            </div>
        </section>
        <!-- package_section -->

        <!-- instagram-section -->
         <!-- insta_feed -->
         <section class="insta_feed py-5">
            <div class="container">
                <div class="row mb-3 pb-3">
                    <div class="col-lg-12 pb-5">
                        <h4 class="fs107 CarrinadyB text-primary SegoeUIL">@lang('theme::app.picked_for_you')</h4>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @apply_filters('theme.instafeed.home2nd')
            </div>
        </section>
        <!-- insta_feed -->
        <!-- @do_action('theme.home_packages') -->
        <!-- @apply_filters('theme.instafeed.home'); -->
  
  
@endsection
