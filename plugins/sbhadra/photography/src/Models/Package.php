<?php

namespace Sbhadra\Photography\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;
use Sbhadra\Photography\Models\Service;
use Sbhadra\Photography\Models\Branch;
use Sbhadra\Photography\Models\Timeslot;

class Package extends Model
{
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'packages';
    public $translatable = ['title','content','short_description'];
    protected $postType = 'packages';
    protected $fillable = [
        'title',
        'thumbnail',
        'content',
        'short_description',
        'slug',
        'is_extra',
        'price',
        'currency',
        'status',
        'views',
        'max_booking',
        'gallary_link',
        'is_type',
        'company_id',
        
    ];
    public function apply(Builder $builder, Model $model){
            if(Auth::user()->id!=1){
                $company_id = Auth::user()->id;
                $builder->where('company_id', $company_id);
            }
    }
    // public function services()
    // {
    //     return $this->BelongsToMany(Service::class, 'package_service')->withTimestamps();
    // }
    public function slots()
    {
        //return $this->BelongsToMany(Timeslot::class, 'package_slots')->withTimestamps();
        return $this->belongsToMany(Timeslot::class, 'package_slots', 'package_id', 'timeslot_id')->orderBy('timeslots.starttime', 'asc');
    }
    public function branches()
    {
        //return $this->BelongsToMany(Timeslot::class, 'package_slots')->withTimestamps();
        return $this->belongsToMany(Branch::class, 'package_branch', 'package_id', 'branch_id')->orderBy('branches.title', 'asc');
    }
}
