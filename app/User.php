<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use JWTFactory;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Session, Redirect, DB, Helper;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected function login($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return ['error' => true,'message'=>$validator->errors(),'token'=>''];
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return ['error' => true,'message'=>'Inavlid Credentials, Incorrect email and password','token'=>''];
            }
        } catch (JWTException $e) {
            return ['error' => true,'message'=>'Failed to create access to login','token'=>''];
        }
        return ['error' => false,'message'=>'Login Successfully','token'=>$token];
    }
    protected function logout()
    {
        JWTAuth::invalidate(session('token'));
        Session::forget('token');
        return ['error' => false,'message'=>'Logout Successfully','token'=>''];
    }
}
