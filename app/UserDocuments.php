<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocuments extends Model
{
    protected $table = 'user_documents';

    protected $primaryKey = 'u_document_id';

    protected $fillable = [
        'user_id', 'type', 'file', 'created_at', 'updated_at'
    ];
}
