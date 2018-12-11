<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\User;
use App\Terms;
use App\NotificationInbox;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

class NotificationsController extends Controller
{
    public function notifications()
    {
    	$inboxs = NotificationInbox::where('receiver_id', Helper::getCurrentUserByKey('user_id'))->get(); 
        $html = view('Notifications.Notifications', compact('inboxs'));
        $view = 'Dashboard.Dashboard';
        return view('Includes.commonTemplate',compact('view','html'));
    }
    public function save(Request $request)
    {
    	if (empty($request->input('subject'))) {
    		echo 'subject';
    		die();
    	}
    	if (empty($request->input('message'))) {
    		echo 'message';
    		die();
    	}

        $inbox = new NotificationInbox();      
        $inbox->uuid = (string) Str::uuid();
        $inbox->notification_type = 'Mail';
        $inbox->sender_id = 1;
        $inbox->receiver_id = Helper::getCurrentUserByKey('user_id');
        $inbox->message = $request->input('message');
        $inbox->subject = $request->input('subject');
        $inbox->admin = 'Received'; 
        $inbox->user = 'Send';            
        $inbox->status = 0;       
        $inbox->created_at = date('Y-m-d h:i:s');
        $inbox->updated_at = date('Y-m-d h:i:s');
        $inbox->save();
        $user = Helper::getUser(1);
        Helper::SendEmail($user->email, $request->input('subject'), $request->input('message'), '');
    }
}
