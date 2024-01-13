<?php

namespace Sbhadra\Advertisement\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;

class Advertise extends Model
{

    use PostTypeModel;
    use HasTranslations;
    protected $table = 'advertises';
    protected $postType = 'advertise';
    public $translatable = ['title','content'];
    protected $fillable = [
        'title',
        'content',
        'status',
        'url',
        'thumbnail',
        'slug',
    ];

    protected $searchFields = [
        'title',
    ];
}
