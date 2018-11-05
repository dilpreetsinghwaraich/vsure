<?php
namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use DB;
use Session;
use Redirect;
use App\User;
class UserToken
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
            return redirect('/');
        }
        if(empty(JWTAuth::toUser(session('token'))))
        {
            Session::forget('token');
            Session::flash('message', "Your Session has been expired, Please login again.");
            return redirect('/');
        } 
        return $next($request); 
    }
}