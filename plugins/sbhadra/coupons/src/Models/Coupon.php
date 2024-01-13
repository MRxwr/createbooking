<?php

namespace Sbhadra\Coupons\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;

class coupon extends Model
{
    
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'coupons';
    public $translatable = ['title'];
    protected $postType = 'coupons';
    protected $fillable = [
        'title',
        'coupon_code',
        'coupon_discount',
        'coupon_type',
        'source',
        'validity_from',
        'validity_to',
        'status',
    ];
}
