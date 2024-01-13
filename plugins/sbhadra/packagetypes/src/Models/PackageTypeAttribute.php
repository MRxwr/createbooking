<?php

namespace Sbhadra\Packagetypes\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\ResourceModel;
use Spatie\Translatable\HasTranslations;

class PackageTypeAttribute extends Model
{
    use ResourceModel;
    use HasTranslations;
    protected $table = 'package_types_attribute';
    public $translatable = ['title'];
    protected $fillable = [
        'title',
        'price',
        'is_theme',
        'status',
    ];
   
}
