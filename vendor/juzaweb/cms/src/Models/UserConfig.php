<?php

namespace Juzaweb\Models;

use Illuminate\Support\Facades\Cache;

/**
 * Juzaweb\Models\Config
 *
 * @property int $id
 * @property string $code
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Juzaweb\Models\Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Juzaweb\Models\Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Juzaweb\Models\Config query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Juzaweb\Models\Config whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Juzaweb\Models\Config whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Juzaweb\Models\Config whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Juzaweb\Models\Config whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Juzaweb\Models\Config whereValue($value)
 * @mixin \Eloquent
 */
class UserConfig extends Model
{
    public $timestamps = false;
    protected $table = 'company_config';
    protected $fillable = [
        'code',
        'value',
        'company_id',
    ];

    

}
