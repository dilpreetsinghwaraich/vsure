<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Session, Redirect, DB, Helper;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
   public function loginAccess(Request $request)
   {
       $user = User::login($request);
       if($user['error']==true)
       {
            $message = '<div class="alert alert-warning">'.$user['message'].'</div>';
            echo json_encode(['status'=>'false','message'=>$message]);
            die;
           
       }else
       {
            Session::put('token', $user['token']);
            Session::save();
            Session::flash('success', $user['message']);
            $message = '<div class="alert alert-success">'.$user['message'].'</div>';
            echo json_encode(['status'=>'true','message'=>$message]);
            die;
       }
   }
   public function logout()
   {
       $user = User::logout();
       Session::flash('error', $user['message']);
       return redirect('auth/register');
   }
}
