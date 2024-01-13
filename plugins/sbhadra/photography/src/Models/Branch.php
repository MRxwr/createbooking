<?php

namespace Sbhadra\Photography\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;
use Sbhadra\Photography\Models\Service;


class Branch extends Model
{
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'branches';
    public $translatable = ['title','description'];
    protected $postType = 'services';
    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'location',
        'status',
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
        return $this->BelongsToMany('Sbhadra\Photography\Models\Package');
    }
    public function services()
    {
        return $this->BelongsToMany(Service::class, 'branch_service')->withTimestamps();
    }
}
