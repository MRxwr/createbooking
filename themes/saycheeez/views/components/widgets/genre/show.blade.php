<section id="mymo-advanced-widget-{{ $data['key'] }}">
    @php
        $tax = \Juzaweb\Models\Taxonomy::find($data['taxonomy'] ?? null);
        if ($tax) {
            $wdata = [
                'url' => $tax->getLink(),
            ];
        } else {
            $wdata = [
                'url' => '',
            ];
        }

        $query = \Juzaweb\Movie\Models\Movie\Movie::createFrontendBuilder();

        if ($data['tv_series'] ?? 0) {
            $query->where('tv_series', '=', $data['taxonomy'] - 1);
        }

        if ($data['taxonomy'] ?? null) {
            $query->whereTaxonomy($data['taxonomy']);
        }

        $items = $query->limit(6)->get();
    @endphp

    <h4 class="section-heading">
        <a href="{{ $wdata['url'] }}" title="{{ $data['title'] }}">
            <span class="h-text">{{ $data['title'] }}</span>
        </a>

        @if($data['childs'] ?? [])
            @php
                $childs = \Juzaweb\Models\Taxonomy::whereIn('id', $data['childs'])
                    ->get(['id', 'name']);
            @endphp
            <ul class="heading-nav pull-right hidden-xs">
                @foreach($childs as $child)
                    <li class="section-btn mymo_ajax_get_post" data-catid="{{ $child->id }}" data-showpost="12" data-widgetid="mymo-advanced-widget-{{ $child->id }}" data-layout="6col">
                        <span data-text="{{ $child->name }}"></span>
                    </li>
                @endforeach
            </ul>
        @endif
    </h4>

    <div id="mymo-advanced-widget-{{ $data['key'] }}-ajax-box" class="mymo_box">
        @if(!$items->isEmpty())
            @foreach($items as $item)
                <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-{{ $item->id }}">
                    {{ get_template_part($item, 'content') }}
                </article>
            @endforeach
        @endif

        <a href="{{ $wdata['url'] }}" class="see-more">@lang('theme::app.view_all') »</a>
    </div>

</section>
<div class="clearfix"></div>