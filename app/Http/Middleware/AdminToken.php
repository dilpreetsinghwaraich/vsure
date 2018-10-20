<?php
namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use DB;
use Session;
use Redirect;
use App\User;
class AdminToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(empty(Session('token')))
        {
            Session::forget('token');
            Session::flash('message', "Your Session has been expired, Please login again.");
            return redirect('/admin/login');
        }
        $user = User::first(); 
        if(empty($user))
        {
            Session::forget('token');
            Session::flash('message', "Your Session has been expired, Please login again.");
            return redirect('/admin/login');
        } 
        if($user->role != 'admin')
        {
            Session::forget('token');
            Session::flash('message', "Your Session has been expired, Please login again.");
            return redirect('/admin/login');
        }        
        return $next($request); 
    }
}