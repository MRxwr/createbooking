@extends('juzaweb::layouts.frontend')

@section('content')
    <div class="container">
        <div class="row container" id="wrapper">
            <div class="mymo-panel-filter">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-8 hidden-xs">
                            <div class="yoast_breadcrumb">
                            <span>
                                <span>
                                    <a href="{{ route('home') }}">@lang('theme::app.home')</a> »
                                    <span class="breadcrumb_last" aria-current="page">{{ $title }}</span>
                                </span>
                            </span>
                            </div>
                        </div>

                        <div class="col-xs-4 text-right">
                            <a href="javascript:void(0)" id="expand-ajax-filter">@lang('theme::app.filter_movies') <i id="ajax-filter-icon" class="hl-angle-down"></i></a>
                        </div>

                        <div id="alphabet-filter" style="float: right;display: inline-block;margin-right: 25px;"></div>
                    </div>
                </div>

                <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                    <div class="ajax"></div>
                </div>

            </div><!-- end panel-default -->

            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-12">
                <section>
                    <div class="section-bar clearfix">
                        <h3 class="section-title">
                            <span>{{ $title }}</span>

                            {{--<span class="pull-right sortby">Sort by: <a href="?sortby=movie">Movie</a> / <a href="?sortby=tv_series">TV Series</a></span>--}}

                        </h3>
                    </div>

                    @php
                        $ads = mymo_get_ads('genre_header');
                    @endphp
                    @if($ads)
                        {!! $ads !!}
                    @endif

                    <div class="mymo_box">
                        @if($posts->isNotEmpty())
                            @foreach($posts as $post)
                                <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-{{ $post->id }}">
                                {{ get_template_part($post, 'content') }}
                                </article>
                            @endforeach
                        @else
                            {{ get_template_part(null, 'content', 'none' ) }}
                        @endif
                    </div>

                    <div class="clearfix"></div>
                    <div class="text-center">
                        {{ $posts->appends(request()->query())->links('theme::data.pagination') }}
                    </div>

                </section>
            </main>
        </div>
    </div>
@endsection
