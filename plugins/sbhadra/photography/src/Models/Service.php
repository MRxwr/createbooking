<?php

namespace Sbhadra\Photography\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;


class Service extends Model
{
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'services';
    public $translatable = ['title','description'];
    protected $postType = 'services';
    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'price',
        'status',
        'available_date',
        'days',
        'slots',
        'company_id',
    ];
    public function apply(Builder $builder, Model $model){
        if(Auth::user()->id!=1){
            $company_id = Auth::user()->id;
            $builder->where('company_id', $company_id);
        }
    }
    public function packages()
    {
        return $this->belongsToMany('Sbhadra\Photography\Models\Package');
    }
}
