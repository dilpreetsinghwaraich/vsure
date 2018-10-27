<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessResults extends Model
{
    protected $table = 'process_results';

    protected $primaryKey = 'process_id';

    protected $fillable = [
        'process_title', 'process_subtitle', 'process_content', 'process_image', 'process_terms'
    ];
}
