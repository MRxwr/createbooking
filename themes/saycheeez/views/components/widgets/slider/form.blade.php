@php
$sliders = \Juzaweb\ImageSlider\Models\Slider::get()->keyBy('id')->map(function ($item) {
    return $item->name;
})->toArray();
@endphp

{{ Field::select(trans('theme::app.slider'), 'slider', [
    'class' => 'load-select2',
    'options' => $sliders,
]) }}
