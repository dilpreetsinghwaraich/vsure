<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller
{

    public function rules(){
        return array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric|phone_number|unique:users',
            'password' => 'required|string|min:8|max:14|required_with:confirmed|same:confirmed',
        );
    }
    public function registerForm()
    {
        if (!empty(session('token'))) {
            return redirect('my-account');
        }
        $view = 'Auth.Register';
        return view('Includes.commonTemplate',compact('view'));
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), self::rules());
        if($validation->passes()){
            $activation_key = sha1(mt_rand(10000,99999).time().$request->input('email'));
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'user_login' => $request->input('email'),
                'phone' => $request->input('phone'),
                'activation_key' => $activation_key,
                'email_verified_at' => '0',
                'password' => Hash::make($request->input('password')),
            ]);

            $htmlmessage = 'Please Click on this link to varify your email.';
            $htmlmessage .= '<br>Click <a href="'.url('varify/email/link/'.$activation_key).'">Here</a>';
            Helper::SendEmail($request->input('email'),'Varify Email At vsure',$htmlmessage,'');

            Session::flash('success','Account Created Successfully');
            return redirect('auth/register');
        }else{
            Session::flash('error',$validation->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
}
