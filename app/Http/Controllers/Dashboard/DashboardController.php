<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    public function dashboard()
    {
    	$profile =  Helper::getCurrentUser(); 
    	$html = view('Profile.Profile',compact('profile'));
        $view = 'Dashboard.Dashboard';
        return view('Includes.commonTemplate',compact('view','html'));
    }
}
