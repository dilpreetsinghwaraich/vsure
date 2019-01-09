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
use Illuminate\Support\Facades\Input;
use Newsletter;
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
        PhoneOtpVerification::where('phone', $phone)->where('otp_for', 'ServiceRequest')->where('otp_status', 'sent')->delete();
        $otp_code = rand(1, 1000000);
        PhoneOtpVerification::insertGetId([
            'phone' => $phone,
            'otp_code' => $otp_code,
            'time' => date('H:i:s'),
            'otp_for' => 'ServiceRequest',
            'otp_status' => 'sent',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
        $message = 'Your Otp for phone verification code is '.$otp_code;
        Helper::SendSMS($phone, $message);
        echo 'Otp code has been sent you. ';
        die;
    }
    public static $enqueryRules = array(
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'service_id' => 'required',
        //'city' => 'required',
    );
    public function enquerySubmit(Request $request)
    {
        $validation = Validator::make($request->all(), self::$enqueryRules);
        if($validation->passes()){

            $currentUser = \Helper::getCurrentUser();
            if (empty($currentUser->user_id)) {
                /*if (empty($request->input('otp_code'))) {
                    Session::flash('warning', 'Your Phone is not verify, please verify.');
                    return Redirect::back()->withInput(Input::all());
                }
                $otpCode = PhoneOtpVerification::where('phone', $request->input('phone'))->where('otp_status', 'sent')->where('otp_code', $request->input('otp_code'))->where('otp_for', 'ServiceRequest')->get()->first();
                if (empty($otpCode)) {
                    Session::flash('warning', 'Your OTP is invalid.');
                    return Redirect::back()->withInput(Input::all());   
                }*/
                
                /*$otpTime = date('H:i:s',strtotime("+3 minutes", strtotime($otpCode->time)));

                if ($otpTime < date('H:i:s')) {
                    Session::flash('warning', 'Your OTP is expired. Time is more then 3 minut .');
                    PhoneOtpVerification::where('otp_id', $otpCode->otp_id)->update(['otp_status'=>'expired']);
                    return Redirect::back()->withInput(Input::all());  
                }*/
            }
            $password = str_random(8);
            $userType = '';
            if (empty($currentUser->user_id)) {
                if ($user = User::where('phone', $request->input('phone'))->get()->first()) {
                    $user_id = $user->user_id;
                    User::authenticateWithEmail($user);
                    $userType = 'already';
                }else{
                    $user_id = self::createUser($request, $password);
                    $userType = 'new';
                    $user = User::where('user_id', $user_id)->get()->first();
                    User::authenticateWithEmail($user);
                }
            }else{
                $userType = 'already';
                $user_id = $currentUser->user_id;
            }
            $email = $request->input('phone');
            $ticket = self::createServiceRequest($user_id, $request);
            $service = Services::find($request->input('service_id'));
            $mailHtml = view('EmailTemplate.ServiceRequestMail', compact('ticket','userType','email','password'));
            $subject = '[#'.$ticket.'] Need Help with : '.$service->service_title;
            if (empty($currentUser->user_id)) {
                //PhoneOtpVerification::where('otp_id', $otpCode->otp_id)->update(['otp_status'=>'verify']);
            }
            Helper::SendEmail($request->input('email'), $subject, $mailHtml, '');

            Helper::SendEmail('vsurecfo@gmail.com', $subject, $mailHtml, '');
            return Redirect('/help/desk/ticket/'.$ticket);
        }else{
            Session::flash('warning',$validation->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public static function createUser($request, $password)
    {        
        return User::insertGetId([
            'name' => $request->input('name'),
            'email' => $request->input('phone').'@gmail.com',
            'user_login' => $request->input('phone'),
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
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
            'country' => (empty($request->input('country'))?0:$request->input('country')),
            'state' => (empty($request->input('state'))?0:$request->input('state')),
            'city' => (empty($request->input('city'))?0:$request->input('city')),
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
        $ticket = '3510'.$request_id;
        $request = ServiceRequest::find($request_id);
        $request->ticket = $ticket;
        $request->save();
        return $ticket;
    }
    public static $subscribeRules = array(
        'email' => 'required|email',
    );
    public function emailSubscribe(Request $request)
    {
        $validation = Validator::make($request->all(), self::$subscribeRules);
        if($validation->passes()){
            $getMember = Newsletter::getMember($request->input('email'));
            if (isset($getMember['id'])) {
                echo '<div class="alert alert-warning">You are already subscribed</div>';
                die;
            }else{
                Newsletter::subscribe($request->input('email'));
                echo '<div class="alert alert-success">Your subscription completed successfully</div>';
                die;
            }            
        }else{
            echo '<div class="alert alert-warning">'.$validation->getMessageBag()->first().'</div>';
            die;
        }
    }
}
