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
        $view = 'Auth.Register';
        return view('Includes.commonTemplate',compact('view'));
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), self::rules());
        if($validation->passes()){
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')),
            ]);
            Session::flash('success','Account Created Successfully');
            return redirect('auth/register');
        }else{
            Session::flash('error',$validation->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
}
