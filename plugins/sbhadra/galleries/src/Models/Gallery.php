<?php

namespace Sbhadra\Galleries\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;


class Gallery extends Model
{
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'galleries';
    public $translatable = ['title','description'];
    protected $postType = 'galleries';
    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'status',
    ];
    
}
