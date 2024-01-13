<?php

namespace Sbhadra\Employees\Models;

use Juzaweb\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Juzaweb\Traits\ResourceModel;
use Tymon\JWTAuth\Contracts\JWTSubject;

class employee extends Model
{
    protected $table = 'users';
    use Notifiable;
    use ResourceModel;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'status',
        'verification_token',
        'password',
    ];

    public static function getAllStatus()
    {
        return [
            'active' => trans('juzaweb::app.active'),
            'unconfirmed' => trans('juzaweb::app.unconfimred'),
            'banned' => trans('juzaweb::app.banned'),
            'verification' => trans('juzaweb::app.verification'),
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @param Builder $builder
     * @return Builder
     * */
    public function scopeActive($builder)
    {
        return $builder->where('status', '=', 'active');
    }

    public function getAvatar()
    {
        if ($this->avatar) {
            return upload_url($this->avatar);
        }

        return asset('jw-styles/juzaweb/styles/images/avatar.png');
    }
}
