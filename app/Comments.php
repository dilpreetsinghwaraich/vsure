<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'user_id', 'post_id', 'comment_author_name', 'comment_author_email', 'comment_content', 'comment_parent', 'status'
    ];
}
