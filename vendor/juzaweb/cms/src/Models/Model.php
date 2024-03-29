<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Arr;

/**
 * Juzaweb\Models\Model
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model query()
 * @mixin \Eloquent
 */
class Model extends EloquentModel
{
    public function attributeLabel($key)
    {
        return Arr::get($this->attributeLabels(), $key);
    }

    public function attributeLabels()
    {
        return [];
    }
}
