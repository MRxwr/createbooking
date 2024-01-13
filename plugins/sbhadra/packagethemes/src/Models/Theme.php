<?php

namespace Sbhadra\Packagethemes\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;


class theme extends Model
{
    
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'package_themes';
    public $translatable = ['title','description'];
    protected $postType = 'package-themes';
    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'status',
    ];
    // public function packages()
    // {
    //     return $this->belongsToMany('Sbhadra\Photography\Models\Package');
    // }
}
