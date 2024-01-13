@php
    $slider = \Juzaweb\ImageSlider\Models\Slider::find($data['slider'] ?? null);
@endphp

@if($slider)
<div class="container">
    <div class="text-center"></div>
    @php
    $items = !empty($slider->content) ? (array) $slider->content : [];
    @endphp

    <div class="row fullwith-slider">
    <!-- Wrapper For Slides -->
        <div id="mymo-fullwith-slider-widget-2" class="owl-carousel owl-carousel-fullwidth owl-theme">
            @if($items)
                @foreach($items as $index => $item)
                    @php
                        $item = collect($item);
                    @endphp
                    <div class="post-{{ $index }} item">
                        <a href="{{ $item->get('link') }}" title="{{ $item->get('title') }}" @if($item->get('new_tab') == 1) target="_blank" @endif>
                            <img src="{{ upload_url($item->get('image')) }}" alt="{{ $item->get('title') }}"  class="slide-image" />
                            <div class="slide-text">
                                <h3 class="slider-title">{{ $item->get('title') }}</h3>
                                <div class="slider-meta hidden-xs">
                                    <p>{{ $item->get('description') }}</p>										            </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div><!-- End of Wrapper For Slides -->
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var owl = $('#mymo-fullwith-slider-widget-2');
                owl.owlCarousel({
                    rtl:false,
                    items: 1,
                    loop: true,
                    animateOut: 'fadeOutLeft',
                    animateIn: 'fadeInRight',
                    smartSpeed: 450,
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoHeight: true,
                    autoplayHoverPause: true,
                    nav: true,
                    navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
                    responsiveClass: true,
                });
            });
        </script>
    </div>
</div>
@endif