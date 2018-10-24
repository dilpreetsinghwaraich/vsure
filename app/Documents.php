<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = 'documents';

    protected $primaryKey = 'document_id';

    protected $fillable = [
        'document_title', 'document_promoter', 'document_company', 'document_terms'
    ];
}
