<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceForm extends Model
{
    protected $table = 'service_form';

    protected $primaryKey = 'form_id';

    protected $fillable = [
        'service_id', 'service_title', 'form_fields', 'created_at','updated_at'
    ];
}
