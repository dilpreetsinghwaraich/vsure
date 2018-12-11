<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $user = User::forgotPassword($request);
        if($user['error']==true)
        {
            $message = '<div class="alert alert-warning">'.$user['message'].'</div>';
            echo json_encode(['status'=>'false','message'=>$message]);
            die;
           
        }else
        {
            $message = '<div class="alert alert-success">'.$user['message'].'</div>';
            echo json_encode(['status'=>'true','message'=>$message]);
            die;
        }
    }
    public function resetForgotPassword($activation_key = null)
    {
        if(!$user_reset = DB::table('users_password_reset')->where('token', $activation_key)->get()->first())
        {
            Session::flash('error','Your token is expired, Ply try again');
            return redirect('auth/register');
        }

        $view = 'Auth.ResetForgotPassword';
        return view('Includes.commonTemplate',compact('view','activation_key'));

    }
    public function rules(){
        return array(
            'password' => 'required|string|min:8|max:14|required_with:confirmed|same:confirmed',
        );
    }
    public function updateForgotPassword(Request $request, $activation_key = null)
    {
        if(!$user_reset = DB::table('users_password_reset')->where('token', $activation_key)->get()->first())
        {
            Session::flash('error','Your token is expired, Ply try again');
            return redirect('auth/register');
        }
        $validation = Validator::make($request->all(), self::rules());
        if($validation->passes()){
            $user = User::find($user_reset->user_id);
            $user->password = Hash::make($request->input('password'));
            $user->updated_at = date('Y-m-d h:i:s');
            $user->save();
            DB::table('users_password_reset')->where('token', $activation_key)->delete();

            Session::flash('success','Password Updated Successfully, Please login to access your account');
            return redirect('auth/register');
        }else{
            Session::flash('error',$validation->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
}
