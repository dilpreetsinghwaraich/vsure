<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    protected $table = 'terms';

    protected $primaryKey = 'term_id';

    protected $fillable = [
        'term_title', 'term_slug', 'term_content', 'term_type'
    ];
}
