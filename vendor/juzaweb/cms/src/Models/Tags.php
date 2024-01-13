<?php

namespace Juzaweb\Models;

use Juzaweb\Traits\UseSlug;
use Spatie\Translatable\HasTranslations;

/**
 * Juzaweb\Models\Tags
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tags query()
 * @mixin \Eloquent
 */
class Tags extends Model
{
    use UseSlug;
    use HasTranslations;

    protected $table = 'tags';
    protected $primaryKey = 'id';
    public $translatable = ['name'];
    protected $fillable = ['name'];
}
