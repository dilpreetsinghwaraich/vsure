<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $table = 'features';

    protected $primaryKey = 'feature_id';

    protected $fillable = [
        'feature_title', 'feature_content', 'feature_image'
    ];
}
