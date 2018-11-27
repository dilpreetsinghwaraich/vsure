<?php

namespace App\Http\Controllers\Admin\NotificationInbox;

use App\Http\Controllers\Controller;
use App\User;
use App\Terms;
use App\NotificationInbox;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

class AdminNotificationInboxController extends Controller
{
    public function index()
    {
        $view = 'Admin.NotificationInbox.Index';
        $inboxs = NotificationInbox::join('users','users.user_id','=','notifications.receiver_id')
                                    ->where('notifications.sender_id',1)
                                    ->groupBY('notifications.receiver_id')
                                    ->orderBy('notifications.created_at','DESC')
                                    ->paginate(50);    
    
        return view('Includes.adminCommonTemplate',compact('view','inboxs'));
    }
    public function rules()
    {
        return array(
            'receiver_id' => 'required',
            'message' => 'required',
            'subject' => 'required',
        );
    }
    public function save(Request $request)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            if (empty($request->input('receiver_id')) || !is_array($request->input('receiver_id'))) {
                Session::flash('error', 'Please select user to send notification');
                return Redirect::back()->withInput(Input::all());
            }
            foreach ($request->input('receiver_id') as $receiver_id) {
                $inbox = new NotificationInbox();      
                $inbox->uuid = (string) Str::uuid();
                $inbox->notification_type = 'Mail';
                $inbox->sender_id = 1;
                $inbox->receiver_id = $receiver_id;
                $inbox->message = $request->input('message');
                $inbox->subject = $request->input('subject');
                $inbox->admin = 'Send'; 
                $inbox->user = 'Received';            
                $inbox->status = 0;       
                $inbox->created_at = date('Y-m-d h:i:s');
                $inbox->updated_at = date('Y-m-d h:i:s');
                $inbox->save();
                $user = Helper::getUser($receiver_id);
                Helper::SendEmail($user->email, $request->input('subject'), $request->input('message'), '');
            }
            Session::flash('success','Notification Send Successfully');
            return Redirect::back()->withInput(Input::all());
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function getInboxRemoteUser(Request $request)
    {
        $search_keyword = $request->input('q');
        $search_keyword = (isset($search_keyword['term'])?$search_keyword['term']:'');
        $rows = User::where('email', 'LIKE', '%'.$search_keyword.'%')
                    ->where('role','subcriber')
                    ->paginate(10);

        $results = [];
        if ($rows) {
            $index = 0;
            foreach ($rows as $row) {
                $results['results'][$index]['text'] = $row->email;
                $results['results'][$index]['id'] = $row->user_id;
                $index++;
            }
        }

        echo json_encode($results);
    }
    public function view($uuid = null)
    {
    	$view = 'Admin.NotificationInbox.View';
        $inbox = NotificationInbox::join('users','users.user_id','=','receiver_id')->where('uuid',$uuid)->get()->first();
        $inboxs = NotificationInbox::where('receiver_id', $inbox->receiver_id)->where('sender_id', $inbox->sender_id)->get();
    	if (empty($inbox->id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Inbox.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}

        return view('Includes.adminCommonTemplate',compact('view','inbox','inboxs'));	
    }
    
    public function delete($id = null)
    {
    	$inbox = NotificationInbox::find($id);
        if (empty($inbox->id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Post.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	NotificationInbox::where('receiver_id', $inbox->receiver_id)->where('sender_id', $inbox->sender_id)->delete();

    	Session::flash('success','Notification Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
