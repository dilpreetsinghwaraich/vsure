<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'user_id', 'post_title', 'post_slug', 'post_excerpt', 'post_content', 'image', 'post_type', 'status', 'post_parent', 'post_parent_type'
    ];
}
