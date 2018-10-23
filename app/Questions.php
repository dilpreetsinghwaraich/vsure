<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';

    protected $primaryKey = 'question_id';

    protected $fillable = [
        'question_title', 'question_content'
    ];
}
