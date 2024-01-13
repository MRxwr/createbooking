@extends('juzaweb::layouts.frontend')

@section('content')
 <!-- reservation-details -->
 <section class="reservation-details py-5">
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
                <div class="row justify-content-center pb-5 mb-3">
                    @do_action('theme.page.before.'.$post->slug,$post)
                        <div class="col-xl-11 mb-4">
                        
                        {!! $post->getContent() !!}
                          @do_action('theme.page.'.$post->slug,$post)
                        </div>
                    @do_action('theme.page.after.'.$post->slug,$post)
                </div>
                
            </div>
        </section>
        <!-- reservation-details -->

@endsection

