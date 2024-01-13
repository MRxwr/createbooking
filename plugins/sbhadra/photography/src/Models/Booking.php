<?php

namespace Sbhadra\Photography\Models;

use Juzaweb\Models\Model;
use Juzaweb\Models\User;
use Juzaweb\Traits\PostTypeModel;
use Sbhadra\Photography\Models\Service;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Branch;
use Sbhadra\Photography\Models\Timeslot;
use Sbhadra\Packagethemes\Models\Theme;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder; 
use Auth;

class Booking extends Model
{
    use PostTypeModel;
    use HasTranslations;
    
    protected $company_id;
   // protected $postType = 'sliders';
    protected $table = 'bookings';
  
    protected $fillable = [
        'title',
        'slug',
        'package_id',
        'transaction_id',
        'booking_date',
        'timeslot_id',
        'is_filming',
        'rating',
        'booking_price',
        'customer_name',
        'customer_email',
        'mobile_number',
        'baby_name',
        'baby_age',
        'number_of_baby',
        'instructions',
        'status',
        'btype',
        'branch_id',
        'company_id',
    ];
    
    public function services(){
        return $this->BelongsToMany(Service::class, 'booking_service')->withTimestamps();
    }
    public function package(){
        return $this->belongsTo(Package::class);
    }
    public function timeslot(){
        return $this->belongsTo(Timeslot::class);
    }  
    public function employee(){
        return $this->belongsTo(User::class,'employee_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
