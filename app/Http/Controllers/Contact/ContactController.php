<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use App\ContactUs;
class ContactController extends Controller
{    
    public function contactUs()
    {
        $view = 'Contact.ContactUs';
        return view('Includes.commonTemplate',compact('view'));
    }
    public static $contactRules = array(
        'name' => 'required',
        'email' => 'required|email',
    );
    public function contactUsSubmit(Request $request)
    {
        $validation = Validator::make($request->all(), self::$contactRules);
        if($validation->passes()){
            ContactUs::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'url' => $request->input('url'),
                'subject' => $request->input('subject'),
                'comment' => $request->input('comment'),
            ]);
            $htmlMessage = '<table>';
            $htmlMessage .= '<thead><tr><th>Name</th><th>Email</th><th>Url</th><th>Subject</th><th>Comment</th></tr></thead>';
            $htmlMessage .= '<tbody>';
            $htmlMessage .= '<tr>';
            $htmlMessage .= '<td>'.$request->input('name').'</td>';
            $htmlMessage .= '<td>'.$request->input('email').'</td>';
            $htmlMessage .= '<td>'.$request->input('url').'</td>';
            $htmlMessage .= '<td>'.$request->input('subject').'</td>';
            $htmlMessage .= '<td>'.$request->input('comment').'</td>';
            $htmlMessage .= '</tr>';
            $htmlMessage .= '</tbody>';
            $htmlMessage .= '</table>';
            Helper::SendEmail('dilpreetsinghwaraich@gmail.com','Contact Us',$htmlMessage,$Attachment='');
            echo '<div class="alert alert-success">Message submit successfully. We will shortly contact you thanks.</div>';
            die;
        }else{
            echo '<div class="alert alert-warning">'.$validation->getMessageBag()->first().'</div>';
            die;
        }
    }
}
