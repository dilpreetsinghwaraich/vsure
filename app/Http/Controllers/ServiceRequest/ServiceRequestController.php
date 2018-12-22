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
        $serviceRequests = ServiceRequest::where('user_id', Helper::getCurrentUserByKey('user_id'))->orderBy('created_at','DESC')->get();
        $html = view('ServiceRequest.serviceRequest',compact('serviceRequests'));
        $view = 'Dashboard.Dashboard';
        return view('Includes.commonTemplate',compact('view','html'));
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
        if (!$serviceForm) {
            return Redirect('/');
        }
        $serviceForm->form_fields = Helper::maybe_unserialize($serviceForm->form_fields);

        $serviceRequest->company_details = Helper::maybe_unserialize($serviceRequest->company_details);

        $view = 'ServiceRequest.Index';        
        return view('Includes.commonTemplate', compact('view','serviceRequest','serviceForm'));
    }
    public function view($ticket = '')
    {
        if(empty($ticket))
        {
            return Redirect('/');
        }
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
            return Redirect('/');
        }
        
        $serviceForm = ServiceForm::where('service_id', $serviceRequest->service_id)->get()->first();
        if (!$serviceForm) {
            return Redirect('/');
        }
        $serviceForm->form_fields = Helper::maybe_unserialize($serviceForm->form_fields);

        $serviceRequest->company_details = Helper::maybe_unserialize($serviceRequest->company_details);

        $view = 'ServiceRequest.View';        
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
        $inputArray = $request->all();
        $company_details = $inputArray['company_details'];
        $arrayKeys = array_keys($inputArray['company_details']);
        $file_keys = [];
        if (!empty($arrayKeys)) {
            foreach ($arrayKeys as $arrayKey) {
                $arrayKeyChoose = explode('_',$arrayKey);
                if (reset($arrayKeyChoose) == 'file') {
                    $company_details[$arrayKey] = Helper::fileuploadArray($request->file('company_details')[$arrayKey]);
                }                
            }
        }
        ServiceRequest::where('ticket', $ticket)
                        ->update([
                            'company_details' => Helper::maybe_serialize($company_details),
                            'updated_at' => new DateTime,
                        ]);
        return Redirect('select/service/packages/'.$ticket);
    }
}
