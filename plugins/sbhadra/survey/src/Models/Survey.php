<?php

namespace Sbhadra\Survey\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;

class survey extends Model
{
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'surveys';
    public $translatable = ['title','result'];
    protected $postType = 'survey';
    protected $casts = [
        //'result' => 'array'
    ];
    protected $fillable = [
        'title',
        'booking_id',
        'customer_name',
        'customer_mobile',
        'result',
        'survey_coupon',
        'status',
    ];
   
}
