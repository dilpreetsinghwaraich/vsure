<?php

namespace App\Http\Controllers\Admin\ServiceRequest;

use App\Http\Controllers\Controller;
use App\User;
use App\Terms;
use App\ContactUs;
use App\NotificationInbox;
use App\ServiceRequest;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

class AdminServiceRequestController extends Controller
{
    public function index()
    {
        $view = 'Admin.ServiceRequest.Index';
        $serviceRequests = ServiceRequest::join('services','services.service_id','=','service_request.service_id')
                                    ->select('service_request.*','services.service_title')
                                    ->orderBy('service_request.created_at','DESC')
                                    ->paginate(50);    
        return view('Includes.adminCommonTemplate',compact('view','serviceRequests'));
    }
}
