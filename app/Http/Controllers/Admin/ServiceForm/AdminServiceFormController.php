<?php

namespace App\Http\Controllers\Admin\ServiceForm;

use App\Http\Controllers\Controller;
use App\User;
use App\ServiceRequest;
use App\Services;
use App\ServiceForm;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

class AdminServiceFormController extends Controller
{
    public function index()
    {
        $view = 'Admin.ServiceForm.Index';
        $serviceForms = ServiceForm::paginate(50);  

        return view('Includes.adminCommonTemplate',compact('view','serviceForms'));
    }
    public function editView($service_id = null)
    {
    	$view = 'Admin.ServiceForm.EditView';
    	$service = Services::find($service_id); 
    	if (empty($service->service_id)) {
   			Session::flash('error','Something went wrong, You are not authorized to add this Service Form.');
   	    	return Redirect::back()->withInput(Input::all());    
    	}  

    	if(empty(ServiceForm::where('service_id', $service_id)->get()->first()))
    	{
    		ServiceForm::insert([
    			'service_id'=> $service_id,
    			'service_title'=> $service->service_title,
    			'form_fields'=> Helper::maybe_serialize([]),
    			'created_at'=> new DateTime,
    			'updated_at' => new DateTime,
    		]);
    	}

    	$serviceForm = ServiceForm::where('service_id', $service_id)->get()->first();
        $serviceForm->form_fields = Helper::maybe_unserialize($serviceForm->form_fields);
        
    	return view('Includes.adminCommonTemplate',compact('view','serviceForm','service','service_id'));
    }
    public function updateForm(Request $request, $service_id = null)
    {
	 	$service = Services::find($service_id); 
	 	if (empty($service->service_id)) {
			Session::flash('error','Something went wrong, You are not authorized to add this Service Form.');
	    	return Redirect::back()->withInput(Input::all());    
	 	} 

	 	$serviceForm = ServiceForm::where('service_id', $service_id)->get()->first();

	 	$serviceFormUpdate = ServiceForm::find($serviceForm->form_id);
	 	$serviceFormUpdate->service_title = $service->service_title;
	 	$serviceFormUpdate->form_fields = Helper::maybe_serialize($request->input('form_fields'));
	 	$serviceFormUpdate->updated_at = new DateTime;
	 	$serviceFormUpdate->save();
	 	Session::flash('success','Service Form updated successfully.');
	    return Redirect('admin/service/forms'); 
    }
    public function getFormField(Request $request, $field)
    {
    	$tabCount = $request->input('tab_count');
    	$fieldCount = $request->input('field_count');
    	switch ($field) {
    		case 'tab':
    			$field = Helper::getTabField($tabCount, '');
    			break;
    		case 'text':
    			$field = Helper::getTextField($tabCount, $fieldCount, '');
    			break;
    		case 'email':
    			$field = Helper::getEmailField($tabCount, $fieldCount, '');
    			break;
    		case 'number':
    			$field = Helper::getNumberField($tabCount, $fieldCount, '');
    			break;
            case 'file':
                $field = Helper::getFileField($tabCount, $fieldCount, '');
                break;
    		case 'textarea':
    			$field = Helper::getTextareaField($tabCount, $fieldCount, '');
    			break;
    		case 'checkbox':
    			$field = Helper::getCheckboxField($tabCount, $fieldCount, '', '');
    			break;
    		case 'radio':
    			$field = Helper::getRadioField($tabCount, $fieldCount, '', '');
    			break;
    		case 'select':
    			$field = Helper::getSelectField($tabCount, $fieldCount, '', '');
    			break;
    	}
    	echo $field;
    	die;
    }
    public function clone(Request $request, $clone_service_id = null)
    {
	 	$service = Services::find($clone_service_id); 
	 	if (empty($service->service_id)) {
			Session::flash('error','Something went wrong, You are not authorized to add this Service Form.');
	    	return Redirect::back()->withInput(Input::all());    
	 	} 
        $service_id = $request->input('clone_service_id');
        $cloneService = Services::find($service_id); 
	 	$serviceForm = ServiceForm::where('service_id', $clone_service_id)->get()->first();

        if(empty(ServiceForm::where('service_id', $service_id)->get()->first()))
        {
            ServiceForm::insert([
                'service_id'=> $service_id,
                'service_title'=> $cloneService->service_title,
                'form_fields'=> $serviceForm->form_fields,
                'created_at'=> new DateTime,
                'updated_at' => new DateTime,
            ]);
        }
        Session::flash('success','Service Form Cloned successfully.');
        return Redirect('admin/service/forms');
    }
    public function delete($service_id = null)
    {
    	$service = Services::find($service_id); 
	 	if (empty($service->service_id)) {
			Session::flash('error','Something went wrong, You are not authorized to add this Service Form.');
	    	return Redirect::back()->withInput(Input::all());    
	 	} 

	 	$serviceForm = ServiceForm::where('service_id', $service_id)->get()->first();

	 	$serviceFormDelete = ServiceForm::find($serviceForm->form_id);
	 	$serviceFormDelete->delete();
	 	Session::flash('success','Service Form deleted successfully.');
	    return Redirect('admin/service/forms'); 
    }
}
