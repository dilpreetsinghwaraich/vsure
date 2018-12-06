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
    public function serviceRequest()
    {
        $serviceRequests = ServiceRequest::where('user_id', Helper::getCurrentUserByKey('user_id'))->get();
        echo view('ServiceRequest.serviceRequest',compact('serviceRequests'));
        die;
    }
    public function index($ticket = '')
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

        $serviceRequest->company_details = Helper::maybe_unserialize($serviceRequest->company_details);

        $view = 'ServiceRequest.Index';        
        return view('Includes.commonTemplate', compact('view','serviceRequest','serviceForm'));
    }
    public function update(Request $request, $ticket = '')
    {
        if(empty($ticket))
        {
            return Redirect('/');
        }
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
            return Redirect('/');
        }
        ServiceRequest::where('ticket', $ticket)
                        ->update([
                            'company_details' => Helper::maybe_serialize($request->input('company_details')),
                            'updated_at' => new DateTime,
                        ]);
        return Redirect()->back();
    }
}