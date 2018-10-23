<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $primaryKey = 'contact_id';

    protected $fillable = [
        'name', 'email', 'subject','comment',
    ];
}
