<?php

namespace Sbhadra\Survey\Models;

use Juzaweb\Models\Model;
use Juzaweb\Traits\PostTypeModel;
use Spatie\Translatable\HasTranslations;

class question extends Model
{
    
    use PostTypeModel;
    use HasTranslations;
    protected $table = 'questions';
    public $translatable = ['title',];
    protected $postType = 'question';
    protected $options =array();
    protected $fillable = [
        'title',
        'options',
        'question_type',
        'status',
    ];
   
}
