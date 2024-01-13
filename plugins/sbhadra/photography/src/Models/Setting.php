<?php

namespace Sbhadra\Photography\Models;

use Juzaweb\Models\Model;

class setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'key',
        'value'
    ];
}
