<?php

namespace Sbhadra\Photography\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Juzaweb\Traits\ResourceModel;
use Spatie\Translatable\HasTranslations;

class Timeslot extends Model
{
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'timeslots';
    protected $postType = 'timeslots';
    protected $fillable = [
        'title',
        'slug',
        'starttime',
        'endtime',
        'status',
        'max_booking_no',
        'slot_interval',
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
