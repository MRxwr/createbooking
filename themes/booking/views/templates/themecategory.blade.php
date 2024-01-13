@extends('juzaweb::layouts.frontend')
@section('header')

@endsection
@section('content')
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
                         @do_action('theme.categories.page')
                    </div>
                </div>
            </div>
        </section>
        <!-- package_section -->

  
@endsection
