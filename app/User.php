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

    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'county', 'state', 'city', 'role', 'password','image',
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

        $user = \App\User::first();
        DB::table('users_last_login')->insert([
            'user_id' => $user->user_id,
            'token' => $token,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
        
        return ['error' => false,'message'=>'Login Successfully','token'=>$token];
    }
    protected function logout()
    {
        JWTAuth::invalidate(session('token'));
        Session::forget('token');
        return ['error' => false,'message'=>'Logout Successfully','token'=>''];
    }
    public function rules()
    {
        $user_id = \Route::current()->getParameter('user_id');
        return [
          'name' => 'required',
          'email' => 'unique:users,email,'.$user_id.'|email|required',
        ];
    }
}
