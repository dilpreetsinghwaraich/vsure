<?php

namespace App\Http\Controllers\Admin\ServiceRequest;

use App\Http\Controllers\Controller;
use App\User;
use App\Terms;
use App\ContactUs;
use App\NotificationInbox;
use App\ServiceRequest;
use App\Services;
use App\ServiceForm;
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
    public function view($ticket = null)
    {
    	if(empty($ticket))
        {
           Session::flash('error','Something went wrong, You are not authorized to View this request.');
   	    	return Redirect::back()->withInput(Input::all());
        }
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
            Session::flash('error','Something went wrong, You are not authorized to View this request.');
   	    	return Redirect::back()->withInput(Input::all());
        }
        
        $serviceForm = ServiceForm::where('service_id', $serviceRequest->service_id)->get()->first();
        $serviceForm->form_fields = Helper::maybe_unserialize($serviceForm->form_fields);

        $serviceRequest->company_details = Helper::maybe_unserialize($serviceRequest->company_details);

        $view = 'Admin.ServiceRequest.View';        
        return view('Includes.adminCommonTemplate', compact('view','serviceRequest','serviceForm'));
    }
    public function delete($ticket = null)
    {
    	if(empty($ticket))
        {
            Session::flash('error','Something went wrong, You are not authorized to Delete this request.');
   	    	return Redirect::back()->withInput(Input::all());
        }
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
            Session::flash('error','Something went wrong, You are not authorized to Delete this request.');
   	    	return Redirect::back()->withInput(Input::all());
        }
        ServiceRequest::where('ticket', $ticket)->delete();
        Session::flash('Success','Request deleted successfully.');
   	    return Redirect::back();
    }
}
