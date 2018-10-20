<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Session, Redirect, DB, Helper;
use Illuminate\Support\Facades\Input;

class AdminDashboardController extends Controller
{
    public function home()
    {
        $view = 'Admin.Home.Home';
        return view('Includes.adminCommonTemplate',compact('view'));
    }
}
