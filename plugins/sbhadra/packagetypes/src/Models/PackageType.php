<?php

namespace Sbhadra\Packagetypes\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\ResourceModel;
use Spatie\Translatable\HasTranslations;

class PackageType extends Model
{
    use ResourceModel;
    use HasTranslations;
    protected $table = 'package_types';
    public $translatable = ['title'];
    protected $fillable = [
        'title',
        'ptype',
        'note',
        'status'
    ];
   
}


