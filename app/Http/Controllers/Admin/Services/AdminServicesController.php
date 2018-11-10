<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\User;
use App\Services;
use App\Documents;
use App\Features;
use App\Packages;
use App\Questions;
use App\ProcessResults;
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
        $view = 'Admin.Services.Add'; 
        return view('Includes.adminCommonTemplate',compact('view'));
    }
    public function save(Request $request)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $service = new Services();     
            $count = Services::where('service_title', $request->input('service_title'))->get()->count();
            if($count == 0)
            {
                $count = '';
            }
            $service_questions = $request->input('service_questions');
            if (!empty($request->file('service_questions')['image'])) {
                $service_questions['image'] = \Helper::fileuploadArray($request->file('service_questions')['image']);
            }

            $service_features = $request->input('service_features');
            if (!empty($request->file('service_features')['image'])) {
                $service_features['image'] = \Helper::fileuploadArray($request->file('service_features')['image']);
            } 

            $service_short_info = $request->input('service_short_info');
            if (!empty($request->file('service_short_info')['image'])) {
                $service_short_info['image'] = \Helper::fileuploadArray($request->file('service_short_info')['image']);
            }
            
            $service->service_title = $request->input('service_title');
            $service->service_slug = str_slug($request->input('service_title').' '.$count,'-');
            $service->service_content = $request->input('service_content');
            $service->service_questions = \Helper::maybe_serialize($service_questions);
            $service->service_features = \Helper::maybe_serialize($service_features);
            $service->service_short_info = \Helper::maybe_serialize($service_short_info);
            $service->service_documents = \Helper::maybe_serialize($request->input('service_documents'));
            $service->service_process_results = \Helper::maybe_serialize($request->input('service_process_results'));
            $service->service_packages = \Helper::maybe_serialize($request->input('service_packages')); 
            $service->status = $request->input('status');
            $service->show_nav_menu = $request->input('show_nav_menu');           
            $service->created_at = date('Y-m-d h:i:s');
            $service->updated_at = date('Y-m-d h:i:s');
            $service->save();
            Session::flash('success','Service Saved Successfully');
            return redirect('admin/services');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function addProccessItem($index = 0)
    {
        $service_process_result = [];
        echo view('Admin.Services.ProcessResult',compact('service_process_result','index'));
    }
    public function getServiceRemotePackage(Request $request)
    {
        $search_keyword = $request->input('q');
        $search_keyword = (isset($search_keyword['term'])?$search_keyword['term']:'');
        $rows = Packages::where('package_title', 'LIKE', '%'.$search_keyword.'%')->paginate(10);
        $results = [];
        if ($rows) {
            $index = 0;
            foreach ($rows as $row) {
                $results['results'][$index]['text'] = $row->package_title;
                $results['results'][$index]['id'] = $row->package_id;
                $index++;
            }
        }
        echo json_encode($results);
    }
    public function getServiceRemoteQuestion(Request $request)
    {
        $search_keyword = $request->input('q');
        $search_keyword = (isset($search_keyword['term'])?$search_keyword['term']:'');
        $rows = Questions::where('question_title', 'LIKE', '%'.$search_keyword.'%')->paginate(10);
        $results = [];
        if ($rows) {
            $index = 0;
            foreach ($rows as $row) {
                $results['results'][$index]['text'] = $row->question_title;
                $results['results'][$index]['id'] = $row->question_id;
                $index++;
            }
        }
        echo json_encode($results);
    }
    public function getServiceRemoteFeature(Request $request)
    {
        $search_keyword = $request->input('q');
        $search_keyword = (isset($search_keyword['term'])?$search_keyword['term']:'');
        $rows = Features::where('feature_title', 'LIKE', '%'.$search_keyword.'%')->paginate(10);
        $results = [];
        if ($rows) {
            $index = 0;
            foreach ($rows as $row) {
                $results['results'][$index]['text'] = $row->feature_title;
                $results['results'][$index]['id'] = $row->feature_id;
                $index++;
            }
        }
        echo json_encode($results);
    }
    public function getServiceRemoteDocument(Request $request)
    {
        $search_keyword = $request->input('q');
        $search_keyword = (isset($search_keyword['term'])?$search_keyword['term']:'');
        $rows = Documents::where('document_title', 'LIKE', '%'.$search_keyword.'%')->paginate(10);
        $results = [];
        if ($rows) {
            $index = 0;
            foreach ($rows as $row) {
                $results['results'][$index]['text'] = $row->document_title;
                $results['results'][$index]['id'] = $row->document_id;
                $index++;
            }
        }
        echo json_encode($results);
    }
    public function getServiceRemoteProcessResults(Request $request)
    {
        $search_keyword = $request->input('q');
        $search_keyword = (isset($search_keyword['term'])?$search_keyword['term']:'');
        $rows = ProcessResults::where('process_title', 'LIKE', '%'.$search_keyword.'%')->paginate(10);
        $results = [];
        if ($rows) {
            $index = 0;
            foreach ($rows as $row) {
                $results['results'][$index]['text'] = $row->process_title;
                $results['results'][$index]['id'] = $row->process_id;
                $index++;
            }
        }
        echo json_encode($results);
    }
    public function edit($service_id = null)
    {
    	$view = 'Admin.Services.Edit';
        $service = Services::find($service_id);
    	if (empty($service->service_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Service.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $service->service_questions = \Helper::maybe_unserialize($service->service_questions);
        $service->service_features = \Helper::maybe_unserialize($service->service_features);
        $service->service_short_info = \Helper::maybe_unserialize($service->service_short_info);
        $service->service_documents = \Helper::maybe_unserialize($service->service_documents);
        $service->service_process_results = \Helper::maybe_unserialize($service->service_process_results);
        $service->service_packages = \Helper::maybe_unserialize($service->service_packages);
        return view('Includes.adminCommonTemplate',compact('view','service','service_id'));	
    }
    public function update(Request $request, $service_id = null)
    {
    	$service = Services::find($service_id);
    	if (empty($service->service_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Service.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $count = Services::where('service_title', $request->input('service_title'))->get()->count();
            if($count == 0)
            {
                $count = '';
            }
            $service_questions = $request->input('service_questions');
            if (!empty($request->file('service_questions')['image'])) {
                $service_questions['image'] = \Helper::fileuploadArray($request->file('service_questions')['image']);
            } else {
                $service_questions['image'] = $service_questions['old_image'];
            } 

            $service_features = $request->input('service_features');
            if (!empty($request->file('service_features')['image'])) {
                $service_features['image'] = \Helper::fileuploadArray($request->file('service_features')['image']);
            } else {
                $service_features['image'] = $service_features['old_image'];
            } 

            $service_short_info = $request->input('service_short_info');
            if (!empty($request->file('service_short_info')['image'])) {
                $service_short_info['image'] = \Helper::fileuploadArray($request->file('service_short_info')['image']);
            } else {
                $service_short_info['image'] = $service_short_info['old_image'];
            }   

    	    $service->service_title = $request->input('service_title');
            $service->service_slug = (empty($request->input('service_slug'))?str_slug($request->input('service_title').' '.$count,'-'):$request->input('service_slug'));
            $service->service_content = $request->input('service_content');
            $service->service_questions = \Helper::maybe_serialize($service_questions);
            $service->service_features = \Helper::maybe_serialize($service_features);
            $service->service_short_info = \Helper::maybe_serialize($service_short_info);
            $service->service_documents = \Helper::maybe_serialize($request->input('service_documents'));
            $service->service_process_results = \Helper::maybe_serialize($request->input('service_process_results'));
            $service->service_packages = \Helper::maybe_serialize($request->input('service_packages')); 
            $service->status = $request->input('status');
            $service->show_nav_menu = $request->input('show_nav_menu');
    	    $service->updated_at = date('Y-m-d h:i:s');
 
    	    $service->save();
            Session::flash('success','Service Updated Successfully');
    	    return redirect('admin/services');
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
    public function clone($service_id = null)
    {
        $service_old = Services::find($service_id);
        if (empty($service_old->service_id)) {
            Session::flash('error','Something went wrong, You are not authorized to clone this Service.');
            return Redirect::back()->withInput(Input::all());           
        }
        $service = new Services();     
        $count = Services::where('service_title', $service_old->service_title)->get()->count();
        if($count == 0)
        {
            $count = '';
        }        
        $service->service_title = $service_old->service_title.' copy';
        $service->service_slug = str_slug($service_old->service_title.' copy','-');
        $service->service_content = $service_old->service_content;
        $service->service_questions = $service_old->service_questions;
        $service->service_features = $service_old->service_features;
        $service->service_short_info = $service_old->service_short_info;
        $service->service_documents = $service_old->service_documents;
        $service->service_process_results = $service_old->service_process_results;
        $service->service_packages = $service_old->service_packages; 
        $service->status = $service_old->status;
        $service->show_nav_menu = $service_old->show_nav_menu;           
        $service->created_at = date('Y-m-d h:i:s');
        $service->updated_at = date('Y-m-d h:i:s');
        $service->save();

        Session::flash('success','Service Cloned Successfully');
        return redirect('admin/services');
    }
}
