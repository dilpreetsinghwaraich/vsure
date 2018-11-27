<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationInbox extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid', 'notification_type', 'sender_id', 'receiver_id', 'message', 'status', 'admin', 'user', 'target_id', 'target_url', 'created_at', 'updated_at'
    ];
}
