<?php

namespace Sbhadra\Slider\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;

class Slider extends Model
{
    use PostTypeModel;
    protected $table = 'sliders';
    protected $postType = 'sliders';
    protected $fillable = [
        'title',
        'content',
        'status',
        'views',
        'thumbnail',
        'slug',
    ];

    protected $searchFields = [
        'title',
    ];
}
