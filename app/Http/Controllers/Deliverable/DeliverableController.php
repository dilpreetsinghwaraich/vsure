<?php

namespace App\Http\Controllers\Deliverable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;
use App\ServiceRequest;
use App\Services;
use App\ServiceForm;
use App\Deliverable;

class DeliverableController extends Controller
{
    public function deliverable()
    {
    	$serviceRequests = ServiceRequest::where('user_id', Helper::getCurrentUserByKey('user_id'))->orderBy('created_at','DESC')->get();
        $html = view('Deliverable.Deliverable',compact('serviceRequests'));
        $view = 'Dashboard.Dashboard';
        return view('Includes.commonTemplate',compact('view','html'));
    }
    public function viewDeliverable($ticket = null)
    {
        if(empty($ticket))
        {
            return Redirect::back();
        }
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
            return Redirect::back();
        }

        $deliverables = Deliverable::where('ticket', $ticket)->orderBy('created_at','DESC')->get();

        $html = view('Deliverable.ViewDeliverable',compact('serviceRequest','deliverables'));
        $view = 'Dashboard.Dashboard';
        return view('Includes.commonTemplate',compact('view','html'));
    }
}
