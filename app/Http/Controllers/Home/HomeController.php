<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $view = 'Home.Home';
        return view('Includes.commonTemplate',compact('view'));
    }
    public function aboutUs()
    {
        $view = 'Home.AboutUs';
        return view('Includes.commonTemplate',compact('view'));
    }
    public function privacyPolicy()
    {
        $view = 'Home.PrivacyPolicy';
        return view('Includes.commonTemplate',compact('view'));
    }
    public function termsAndConditions()
    {
        $view = 'Home.TermsAndConditions';
        return view('Includes.commonTemplate',compact('view'));
    }
    public function refundAndCancellation()
    {
        $view = 'Home.RefundAndCancellation';
        return view('Includes.commonTemplate',compact('view'));
    }
}
