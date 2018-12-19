<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliverable extends Model
{
    protected $table = 'deliverable';

    protected $primaryKey = 'deliverable_id';

    protected $fillable = [
        'ticket', 'title', 'document', 'created_at', 'updated_at'
    ];
}
