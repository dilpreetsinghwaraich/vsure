<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
    	$sectionView = 'Profile.Profile';
        $view = 'Dashboard.Dashboard';
        return view('Includes.commonTemplate',compact('view','sectionView'));
    }
}
