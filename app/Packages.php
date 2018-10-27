<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';

    protected $primaryKey = 'package_id';

    protected $fillable = [
        'package_title', 'package_content', 'package_terms', 'regular_price', 'sale_price', 'discount_start', 'discount_end', 'status','is_featured'
    ];
}
