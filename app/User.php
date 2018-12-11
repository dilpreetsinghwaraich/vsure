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
        'name', 'email', 'user_login', 'phone', 'company', 'county', 'state', 'city', 'role', 'password','image','address','postal_code','activation_key'
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
            'user_login' => 'required|string|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return ['error' => true,'message'=>$validator->errors(),'token'=>''];
        }
        $credentials = $request->only('user_login', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return ['error' => true,'message'=>'Inavlid Credentials, Incorrect email and password','token'=>''];
            }
        } catch (JWTException $e) {
            return ['error' => true,'message'=>'Failed to create access to login','token'=>''];
        }

        $user = JWTAuth::toUser($token);;
        DB::table('users_last_login')->insert([
            'user_id' => $user->user_id,
            'token' => $token,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
        JWTAuth::setToken($token);
        return ['error' => false,'message'=>'Login Successfully','token'=>$token];
    }
    protected function authenticateWithEmail($user) {         
        $token = JWTAuth::fromUser($user);

        DB::table('users_last_login')->insert([
            'user_id' => $user->user_id,
            'token' => $token,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
        Session::put('token', $token);
        Session::save();
        JWTAuth::setToken($token);
        return ['error' => false,'message'=>'Login Successfully','token'=>$token];
    }
    protected function logout()
    {
        JWTAuth::invalidate(session('token'));
        Session::forget('token');
        return ['error' => false,'message'=>'Logout Successfully','token'=>''];
    }
    protected function forgotPassword($request)
    {
        $user = User::where(function($query) use($request){
                    if (!empty($request->input('user_login'))) {
                        $query->orwhere('user_login', $request->input('user_login'))
                            ->orwhere('email', $request->input('user_login'))
                            ->orwhere('phone', $request->input('user_login'));
                    }
                })
                ->get()
                ->first();
        if (!empty($user)) {

            $activation_key = sha1(mt_rand(10000,99999).time().$user->email);
            $resetPasswordInsert = [];
            $resetPasswordInsert['user_id'] = $user->user_id;
            $resetPasswordInsert['email'] = $user->email;
            $resetPasswordInsert['token'] = $activation_key;
            $resetPasswordInsert['created_at'] = date('Y-m-d h:i:s');
            $resetPasswordInsert['updated_at'] = date('Y-m-d h:i:s');
            DB::table('users_password_reset')->insert($resetPasswordInsert);
            $link = url('auth/reset/forgot/password/'.$activation_key);
            $htmlmessage = 'Please click on this <a href="'.$link.'">Link</a> to reset your password';
            Helper::SendEmail($user->email,'Reset Your password at VsureCFO',$htmlmessage, '');
            Helper::SendSMS($user->phone,$htmlmessage);
            return ['error' => false,'message'=>'To reset your password link send on email'];
            
        }else{
            return ['error' => true,'message'=>'Inavlid Credentials, Incorrect email, user_login Or phone number'];
        }
    }
}
