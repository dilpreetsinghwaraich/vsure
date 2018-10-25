<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\User;
use App\Services;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminServicesController extends Controller
{
    public function index()
    {
        $view = 'Admin.Services.Index';
        $services = Services::paginate(50);    
        return view('Includes.adminCommonTemplate',compact('view','services'));
    }
    public function rules()
    {
        return array(
            'service_title' => 'required',
            'service_content' => 'required',
            'service_packages' => 'required',
            'status' => 'required',
        );
    }
    public function add()
    {
        Session::flash('error', 'Something Went Wrong, Page is not active yet!!!');
        return Redirect::back()->withInput(Input::all());
        $view = 'Admin.Services.Add'; 
        $terms = Terms::where('term_type','package')->select('*')->get();
        return view('Includes.adminCommonTemplate',compact('view','terms'));
    }
    public function save(Request $request)
    {
        Session::flash('error', 'Something Went Wrong, Page is not active yet!!!');
        return Redirect::back()->withInput(Input::all());
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $service = new Services();       
            $service->service_title = $request->input('service_title');
            $service->service_content = $request->input('service_content');
            $service->service_questions = $request->input('service_questions');
            $service->service_short_info = $request->input('service_short_info');
            $service->service_features = $request->input('service_features');
            $service->service_documents = $request->input('service_documents');
            $service->service_process_results = \Helper::maybe_serialize($request->input('service_process_results'));
            $service->service_packages = \Helper::maybe_serialize($request->input('service_packages')); 
            $service->status = $request->input('status');
            $service->show_nav_menu = $request->input('show_nav_menu');           
            $service->created_at = date('Y-m-d h:i:s');
            $service->updated_at = date('Y-m-d h:i:s');
            $service->save();
            Session::flash('success','Service Saved Successfully');
            return redirect('admin/packages');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($service_id = null)
    {
        Session::flash('error', 'Something Went Wrong, Page is not active yet!!!');
        return Redirect::back()->withInput(Input::all());
    	$view = 'Admin.Services.Edit';
        $service = Services::find($service_id);
    	if (empty($service->service_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Service.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $terms = Terms::where('term_type','package')->select('*')->get();
        $service->package_content = \Helper::maybe_unserialize($service->package_content);
        $service->package_terms = \Helper::maybe_unserialize($service->package_terms);
        return view('Includes.adminCommonTemplate',compact('view','service','terms'));	
    }
    public function update(Request $request, $service_id = null)
    {
        Session::flash('error', 'Something Went Wrong, Page is not active yet!!!');
        return Redirect::back()->withInput(Input::all());
    	$service = Services::find($service_id);
    	if (empty($service->service_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Service.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
    	    $service->service_title = $request->input('service_title');
            $service->service_content = $request->input('service_content');
            $service->service_questions = $request->input('service_questions');
            $service->service_short_info = $request->input('service_short_info');
            $service->service_features = $request->input('service_features');
            $service->service_documents = $request->input('service_documents');
            $service->service_process_results = \Helper::maybe_serialize($request->input('service_process_results'));
            $service->service_packages = \Helper::maybe_serialize($request->input('service_packages'));
            $service->status = $request->input('status');
            $service->show_nav_menu = $request->input('show_nav_menu');
    	    $service->updated_at = date('Y-m-d h:i:s');
    	    $service->save();
            Session::flash('success','Service Updated Successfully');
    	    return redirect('admin/packages');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public function delete($service_id = null)
    {
    	$service = Services::find($service_id);
        if (empty($service->service_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Service.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$service->delete();
    	Session::flash('success','Service Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
