<?php

namespace App\Http\Controllers\Admin\ServiceRequest;

use App\Http\Controllers\Controller;
use App\User;
use App\Terms;
use App\ContactUs;
use App\NotificationInbox;
use App\ServiceRequest;
use App\Services;
use App\Deliverable;
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
    public function submitDeliverable($ticket = null)
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
        $serviceForm = ServiceForm::where('service_id', $serviceRequest->service_id)->get()->first();
        $deliverables = Deliverable::where('ticket', $ticket)->get();
        $view = 'Admin.ServiceRequest.SubmitDeliverable';        
        return view('Includes.adminCommonTemplate', compact('view','serviceRequest','serviceForm','deliverables'));
    }
    public function rules()
    {
        return array(
            'title' => 'required',
            'document' => 'required',
        );
    }
    public function insertDeliverable(Request $request, $ticket = null)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $deliverable = new Deliverable();
            $deliverable->ticket = $ticket;
            $deliverable->title = $request->input('title');
            $deliverable->document = Helper::fileuploadExtra($request, 'document');
            $deliverable->created_at = new DateTime;
            $deliverable->updated_at = new DateTime;
            $deliverable->save();
            Session::flash('success','Document Uploaded Successfully');
            return Redirect::back()->withInput(Input::all());
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        } 
    }
    public function deleteDeliverable($deliverable_id = null)
    {
        $deliverable = Deliverable::find($deliverable_id);
        if(empty($deliverable->deliverable_id))
        {
            Session::flash('error','Something went wrong, You are not authorized to Delete this Document.');
            return Redirect::back()->withInput(Input::all());
        }
        $deliverable->delete();
        Session::flash('success','Document deleted successfully.');
        return Redirect::back();
    }
}
