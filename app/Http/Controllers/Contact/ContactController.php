<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use App\ContactUs;
use App\User;
use App\Services;
use App\ServiceRequest;
use App\PhoneOtpVerification;
class ContactController extends Controller
{    
    public function contactUs()
    {
        $view = 'Template.ContactUs';
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
    public function phoneOtpSendVarification(Request $request)
    {
        $phone = $request->input('phone');
        if (empty($phone)) {
            echo 'empty';
            die;
        }
        PhoneOtpVerification::where('phone', $phone)->where('otp_for', 'ServiceRequest')->delete();
        $otp_code = str_random(6);
        PhoneOtpVerification::insertGetId(
            'phone' => $phone,
            'otp_code' => $otp_code,
            'time' => date('H:i:s'),
            'otp_for' => 'ServiceRequest',
            'otp_status' => 'sent',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );
        $message = 'Your Otp for phone verification code is '.$otp_code;
        Helper::SendSMS($phone, $message);
        echo 'sent';
        die;
    }
    public static $enqueryRules = array(
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'service_id' => 'required',
        'city' => 'required',
    );
    public function enquerySubmit(Request $request)
    {
        $validation = Validator::make($request->all(), self::$enqueryRules);
        if($validation->passes()){
            
            $password = str_random(8);
            $user_id = self::createUser($request, $password);
            $ticket = self::createServiceRequest($user_id, $request);
            $service = Services::find($request->input('service_id'));
            $mailHtml = view('EmailTemplate.ServiceRequestMail', compact('ticket'));
            $subject = '[#'.$ticket.'] Need Help with : '.$service->service_title;
            Helper::SendEmail($request->input('email'), $subject, $mailHtml, '');

            Helper::SendEmail('vsurecfo@gmail.com', $subject, $mailHtml, '');
            $html = 'Thank you for choosing '.url('/').'. Our team will be getting in touch with you within 24-48 hours. Please bear with us!
            In other news, we are now the official partners of the Confederation of Indian Industry and have now helped more than 200,000 users (and counting!)
            We really value your business.';
            Session::flash('success',$html);
            return Redirect('thank-you');
        }else{
            Session::flash('warning',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public static function createUser($request, $password)
    {
        if ($user = User::where('email', $request->input('email'))->select('user_id')->get()->first()) {
            return $user->user_id;
        }
        if ($user = User::where('phone', $request->input('phone'))->select('user_id')->get()->first()) {
            return $user->user_id;
        }
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'user_login' => $request->input('email'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'activation_key' => '',
            'email_verified_at' => date('Y-m-d h:i:s'),
            'password' => Hash::make($password),
        ]);
    }
    public static function createServiceRequest($user_id, $request)
    {
        $request_id = ServiceRequest::insertGetId([
            'user_id' => $user_id,
            'service_id' => $request->input('service_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
        $ticket = '3510'.$request_id;
        $request = ServiceRequest::find($request_id);
        $request->ticket = $ticket;
        $request->save();
        return $ticket;
    }
}
