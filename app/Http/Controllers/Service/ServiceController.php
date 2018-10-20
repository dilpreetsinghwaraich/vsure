<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function partnershipFirmRegistration()
    {
        $view = 'Service.PartnershipFirmRegistration';
        return view('includes.commonTemplate',compact('view'));
    }
}
