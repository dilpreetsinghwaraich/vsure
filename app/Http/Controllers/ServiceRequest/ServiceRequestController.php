<?php

namespace App\Http\Controllers\ServiceRequest;

use App\Http\Controllers\Controller;
use App\Packages;
use App\Orders;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper, PDF;
use Session, Redirect;
use Illuminate\Support\Facades\Input;
use App\User;
use App\ServiceRequest;
use App\Services;
use App\ServiceForm;

class ServiceRequestController extends Controller
{
    public function index($ticket)
    {
        if(empty($ticket))
        {
            return Redirect('/');
        }
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
            return Redirect('/');
        }
        
        $serviceForm = ServiceForm::where('service_id', $serviceRequest->service_id)->get()->first();
        $serviceForm->form_fields = Helper::maybe_unserialize($serviceForm->form_fields);

        $view = 'ServiceRequest.Index';        
        return view('Includes.commonTemplate', compact('view','serviceRequest','serviceForm'));
    }
    
}
