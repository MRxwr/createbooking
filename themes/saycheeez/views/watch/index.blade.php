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
                                        @if($genre)
                                            <a href="{{ $genre->getLink() }}">{{ $genre->getName() }}</a> »
                                        @endif

                                        <span class="breadcrumb_last" aria-current="page">{{ $post->getTitle() }}</span>

                                    </span>
                                </span>
                        </div>
                    </div>

                    <div class="col-xs-4 text-right">
                        <a href="javascript:;" id="expand-ajax-filter">@lang('theme::app.filter_movies') <i id="ajax-filter-icon" class="hl-angle-down"></i></a>
                    </div>
                    <div id="alphabet-filter" style="float: right;display: inline-block;margin-right: 25px;"></div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div><!-- end panel-default -->

        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content">
                <div class="clearfix wrap-content">

                    @include('theme::watch.component.global_script')

                    <div class="mymo-movie-wrapper">
                        <div class="title-block watch-page">
                            <a href="javascript:;" data-toggle="tooltip" title="{{ trans('theme::app.add_to_bookmark') }}">
                                <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-post_id="{{ $post->id }}" data-thumbnail="{{ $post->getThumbnail() }}" data-href="" data-title="{{ $post->name }}" data-date="{{ $post->release }}">
                                    <!-- <div class="mymo-pulse-ring"></div> -->
                                </div>
                            </a>

                            <div class="title-wrapper">
                                <h1 class="entry-title" data-toggle="tooltip" title="{{ $post->getTitle() }}">{{ $post->getTitle() }} @if($post->year) <span class="title-year"> (<a href="" rel="tag">{{ $post->year }}</a>)</span> @endif</h1>
                            </div>

                            <div class="ratings_wrapper hidden-xs">
                                <div class="mymo_imdbrating taq-score">
                                    <span class="score">{{ $star }}</span><i>/</i>
                                    <span class="max-ratings">5</span>
                                    <span class="total_votes">{{ $post->countRating() }}</span><span class="vote-txt"> @lang('theme::app.votes')</span>
                                </div>

                                <div class="rate-this">
                                    <div data-rate="{{ $star * 100 / 5 }}" data-id="{{ $post->id }}" class="user-rate user-rate-active">
                                            <span class="user-rate-image post-large-rate stars-large">
                                                <span style="width: {{ $star * 100 / 5 }}%"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>

                            <div class="more-info">
                                @if($post->tv_series == 0)
                                    <span>Full</span>
                                    <span>{{ $post->runtime }}</span>
                                @else
                                    <span>@lang('theme::app.episode') {{ $post->current_episode }}{{ $post->max_episode ? '/' . $post->max_episode : '' }}</span>
                                @endif
                                <span>
                                    @foreach($genres as $genre)
                                        <a href="{{ $genre->getLink() }}" rel="category tag">{{ $genre->getName() }}</a>,
                                    @endforeach
                                    </span>
                            </div>
                        </div>

                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-3">
                                <img class="movie-thumb" src="{{ $post->getThumbnail(false) }}" alt="{{ $post->getTitle() }}">
                                <div class="mymo_imdbrating"><span>{{ $post->rating }}</span></div>
                                <a href="" class="btn btn-sm btn-danger watch-movie visible-xs-block"><i class="hl-play"></i>@lang('watch')</a>

                                <span id="show-trailer" data-url="{{ $post->getTrailerLink() }}" class="btn btn-sm btn-primary show-trailer">
                                    <i class="hl-youtube-play"></i> @lang('theme::app.trailer')</span>

                                <span class="btn btn-sm btn-success quick-eps" data-toggle="collapse" href="#collapseEps" aria-expanded="false" aria-controls="collapseEps">
                                        <i class="hl-sort-down"></i> @lang('theme::app.episodes')
                                    </span>
                            </div>

                            <div class="film-poster col-md-9">
                                <div class="film-poster-img" style="background: url('{{ $post->getPoster() }}'); background-size: cover; background-repeat: no-repeat;background-position: 30% 25%;height: 300px;/*-webkit-filter: grayscale(100%); filter: grayscale(100%);*/"></div>
                                @if($player_id)
                                    <div class="mymo-play-btn hidden-xs">
                                        <a href="" class="play-btn" title="@lang('theme::app.click_to_play')" data-toggle="tooltip" data-placement="bottom" rel="nofollow">@lang('theme::app.click_to_play')</a>
                                    </div>
                                @endif

                                <div class="movie-trailer hidden"></div>
                                <div class="movie-detail">
                                    @if($countries->isNotEmpty())
                                        <p class="actors">@lang('theme::app.countries'):
                                            @foreach($countries as $country)
                                                <a href="{{ $country->getLink() }}" title="{{ $country->name }}">{{ $country->name }}</a>
                                            @endforeach
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="clearfix"></div>

                    <div id="mymo_trailer"></div>

                    <div class="collapse" id="collapseEps">
                        <div class="text-center mymo-ajax-list-server">
                            <div id="mymo-ajax-list-server">
                                <script>var svlists = [];</script>
                            </div>
                        </div>

                        <div id="mymo-list-server" class="list-eps-ajax">
                            @foreach($servers as $server)
                                @php
                                    $video_files = $server->videoFiles()
                                        ->whereEnabled()
                                        ->orderBy('order', 'asc')
                                        ->get(['id', 'label']);
                                @endphp
                                <div class="mymo-server show_all_eps" data-episode-nav="">
                                    <span class="mymo-server-name">
                                        <span class="hl-server"></span> {{ $server->name }}
                                    </span>

                                    <ul id="listsv-{{ $server->id }}" class="mymo-list-eps">
                                        @foreach($video_files as $file)
                                            <li class="mymo-episode mymo-episode-{{ $file->id }}"><a href="{{ $post->getLink() }}?video={{ $file->id }}" title="{{ $file->label }}" rel="nofollow"><span class="mymo-info-{{ $file->id }} box-shadow mymo-btn" data-post-id="{{ $post->id }}" data-server="{{ $server->id }}" data-episode-slug="{{ $file->id }}" data-position="first" data-embed="0">{{ $file->label }}</span></a></li>
                                        @endforeach
                                    </ul>

                                    <div class="clearfix"></div>
                                </div>
                                <div id="pagination-{{ $server->id }}"></div>
                            @endforeach

                            @if($post->downloadLinks->isNotEmpty())
                                <div class="mymo-server show_all_eps">
                                    <span class="mymo-server-name">
                                        <span class="hl-download"></span> {{ trans('theme::app.download') }}
                                    </span>

                                    <ul id="listsv-download" class="mymo-list-eps">
                                        @foreach($post->downloadLinks as $download_link)
                                            <li class="mymo-episode"><a href="" target="_blank" rel="nofollow" title="{{ $download_link->label }}"><span class="mymo-download-{{ $download_link->id }} box-shadow mymo-btn" data-post-id="{{ $post->id }}">{{ $download_link->label }}</span></a></li>
                                        @endforeach
                                    </ul>

                                    <div class="clearfix"></div>
                                </div>

                                <div id="pagination-download"></div>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    @php($ads = mymo_get_ads('player_bottom'))
                    @if($ads)
                    <!-- Ads -->
                        <div class="mb-3">
                            {!! $ads !!}
                        </div>

                    @endif

                    {{--<div class="mymo--notice">
                    </div>--}}

                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item mymo-entry-box">
                            <article id="post-{{ $post->id }}" class="item-content">
                                {!! $post->getContent() !!}
                            </article>

                            <div class="item-content-toggle">
                                <div class="item-content-gradient"></div>
                                <span class="show-more" data-single="true" data-showmore="@lang('theme::app.show_more')" data-showless="@lang('theme::app.show_less')">@lang('theme::app.show_more')</span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="comments">

                    </div>
                </div>
            </section>

            <section class="related-movies">

                <div id="mymo_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>@lang('theme::app.similar_movies')</span></h3>
                    </div>
                    <div id="mymo_related_movies-2" class="owl-carousel owl-theme related-film">
                        @foreach($relatedMovies as $item)
                            <article class="thumb grid-item post-{{ $item->id }}">
                                {{ get_template_part($item, 'content') }}
                            </article>
                        @endforeach
                    </div>
                    <script>
                        $(document).on("turbolinks:load", function() {
                            var owl = $('#mymo_related_movies-2');
                            owl.owlCarousel({
                                loop: true,
                                margin: 4,
                                autoplay: true,
                                autoplayTimeout: 4000,
                                autoplayHoverPause: true,
                                nav: true,
                                navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
                                responsiveClass: true,
                                responsive: {
                                    0: {items:2},
                                    480: {items:3},
                                    600: {items:4},
                                    1000: {items: 4}
                                }
                            });
                        });
                    </script>
                </div>
            </section>

            <div class="the_tag_list">
                @foreach($tags as $tag)
                    <a href="{{ $tag->getLink() }}" title="{{ $tag->name }}" rel="tag">{{ $tag->name }}</a>
                @endforeach
            </div>
        </main>

        <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
            {!! dynamic_sidebar('sidebar') !!}
        </aside>
    </div>
</div>