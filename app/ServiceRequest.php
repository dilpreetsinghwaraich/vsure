<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'service_request';

    protected $primaryKey = 'request_id';

    protected $fillable = [
        'user_id', 'service_id', 'ticket', 'country', 'state', 'city', 'created_at','updated_at'
    ];
}
