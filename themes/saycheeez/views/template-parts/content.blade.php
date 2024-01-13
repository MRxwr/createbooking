<div class="row mt-3">
    <div class="col-md-3 col-xs-12 col-sm-12">
        <div class="image">
            <img src="{{ $post->getThumbnail() }}" alt="">
        </div>
    </div>

    <div class="col-md-9 col-xs-12 col-sm-12">
        <div class="title">
            <h4><a href="{{ $post->getLink() }}">{{ $post->getTitle() }}</a></h4>
            <p>{{ $post->getDescription() }}</p>
        </div>
    </div>
</div>