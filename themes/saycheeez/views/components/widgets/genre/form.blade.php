@component('juzaweb::widgets.input', [
    'label' => trans('juzaweb::app.title'),
    'name' => 'title',
    'value' => $data['title'] ?? ''
])@endcomponent

@component('juzaweb::widgets.select', [
    'name' => 'tv_series',
    'label' => trans('theme::app.movie_type'),
    'value' => $data['tv_series'] ?? '',
    'options' => [
        0 => trans('theme::app.all'),
        1 => trans('theme::app.movie'),
        2 => trans('theme::app.tv_series'),
    ],
])@endcomponent

@component('juzaweb::widgets.select_taxonomy', [
    'name' => 'taxonomy',
    'value' => $data['taxonomy'] ?? '',
    'post_type' => 'movies',
    'label' => trans('theme::app.taxonomy'),
])@endcomponent

@component('juzaweb::widgets.select_taxonomy', [
    'name' => 'childs[]',
    'value' => $data['childs'] ?? [],
    'post_type' => 'movies',
    'multiple' => true,
    'label' => trans('theme::app.taxonomy_childs'),
])@endcomponent
