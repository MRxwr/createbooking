<?php

namespace Sbhadra\Instafeeds\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;


class FeedGallery extends Model
{
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'feed_galleries';
    public $translatable = ['title','description'];
    protected $postType = 'instafeed';
    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'url',
        'status',
    ];
    
}
