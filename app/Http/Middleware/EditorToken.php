<?php
namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use DB;
use Session;
use Redirect;
use App\User;
class EditorToken
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
        if (empty(session('token'))) {
            Session::forget('token');
            Session::flash('message', "Your Session has been expired, Please login again.");
            return redirect('/admin/login');
        }
        $request->headers->set('Authorization','Bearer '.session('token'));
        try {
            if(!$user = JWTAuth::parseToken()->authenticate())
            {
                Session::forget('token');
                Session::flash('message', "Your Session has been expired, Please login again.");
                return redirect('/admin/login');
            }else{
                if($user->role = 'admin' || $user->role = 'editor')
                {
                    return $next($request);                     
                }  
                else
                {
                    Session::forget('token');
                    Session::flash('message', "Your Session has been expired, Please login again.");
                    return redirect('/admin/login');
                }
            }
        } catch(\Tymon\JWTAuth\Exceptions\JWTException $e){
            Session::forget('token');
            Session::flash('message', "Your Session has been expired, Please login again.");
            return redirect('/admin/login');
        }
        return $next($request);
    }
}