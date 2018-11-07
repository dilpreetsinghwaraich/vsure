<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Helper;

class NotificationsController extends Controller
{
    public function notifications()
    {
        echo view('Notifications.Notifications');
        die;
    }
}
