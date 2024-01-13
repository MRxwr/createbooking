<?php

namespace Sbhadra\Photography\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;

class Calendar extends Model
{
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'calendars';
    protected $fillable = [];
}
