@extends('juzaweb::layouts.frontend')

@section('content')

  <!-- filter-section -->
  <section class="filter-section pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 pb-5">
                        <div class="site-title position-relative d-flex align-items-center">
                            <div class="bg-white">
                                <h3 class="fs30 text-300 SegoeUIL pe-4 ">
                                    @lang('theme::app.Gallery')
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                @apply_filters('theme.cstudio.galleries');
            </div>
        </section>
@endsection
