<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Session, Redirect, DB, Helper;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function login()
    {
        return view('Admin.Auth.Login');
    }
    public function loginAccess(Request $request)
    {
        $user = User::login($request);
        if($user['error']==true)
        {
            Session::flash('error', $user['message']);
            return Redirect::back()->withInput(Input::all());
        }else
        {
            Session::put('token', $user['token']);
            Session::save();
            Session::flash('success', $user['message']);
            return redirect('/admin/dashboard');
        }
    }
    public function logout()
    {
        $user = User::logout();
        Session::flash('error', $user['message']);
        return redirect('/admin/login');
    }
}
