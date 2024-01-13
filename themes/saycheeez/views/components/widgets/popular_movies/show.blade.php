<div id="mymo_tab_popular_videos-widget-5" class="widget mymo_tab_popular_videos-widget">
    <div class="section-bar clearfix">
        <div class="section-title">
            <span>{{ $data['title'] ?? '' }}</span>
            <ul class="mymo-popular-tab" role="tablist">
                <li role="presentation" class="active">
                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="day">@lang('theme::app.day')</a>
                </li>
                <li role="presentation">
                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="week">@lang('theme::app.week')</a>
                </li>
                <li role="presentation">
                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="month">@lang('theme::app.month')</a>
                </li>
                <li role="presentation">
                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="all">@lang('theme::app.all')</a>
                </li>
            </ul>
        </div>
    </div>

    <section class="tab-content">
        <div role="tabpanel" class="tab-pane active mymo-ajax-popular-post">
            <div class="mymo-ajax-popular-post-loading hidden"></div>
            <div id="mymo-ajax-popular-post" class="popular-post"></div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>
