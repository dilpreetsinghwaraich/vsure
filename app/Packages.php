<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';

    protected $primaryKey = 'package_id';

    protected $fillable = [
        'package_title', 'package_content', 'price'
    ];
}
