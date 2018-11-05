<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Helper;

class ProfileController extends Controller
{
    public function profile()
    {
    	$profile =  Helper::getCurrentUser();
        echo view('Profile.Profile',compact('profile'));
        die;
    }
}
