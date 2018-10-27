<?php

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use App\User;
use App\Features;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminFeaturesController extends Controller
{
    public function index()
    {
        $view = 'Admin.Features.Index';
        $features = Features::paginate(50);    
        $terms = Terms::where('term_type','feature')->select('*')->get();
        return view('Includes.adminCommonTemplate',compact('view','features','terms'));
    }
    public function rules()
    {
        return array(
            'feature_title' => 'required',
            'feature_content' => 'required',
            'feature_image' => 'required',
        );
    }
    public function updateRules()
    {
        return array(
            'feature_title' => 'required',
            'feature_content' => 'required',
        );
    }
    public function save(Request $request)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $feature = new Features();       
            $feature->feature_title = $request->input('feature_title');
            $feature->feature_content = $request->input('feature_content');
            if ($request->file('feature_image') != '') {
                $feature->feature_image = \Helper::fileuploadExtra($request, 'feature_image');
            }
            $feature->feature_terms = \Helper::maybe_serialize($request->input('feature_terms'));
            $feature->created_at = date('Y-m-d h:i:s');
            $feature->updated_at = date('Y-m-d h:i:s');
            $feature->save();
            Session::flash('success','Feature Saved Successfully');
            return redirect('admin/features');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($feature_id = null)
    {
    	$view = 'Admin.Features.Edit';
        $feature = Features::find($feature_id);

    	if (empty($feature->feature_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Feature.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $feature->feature_terms = \Helper::maybe_unserialize($feature->feature_terms);
        $terms = Terms::where('term_type','feature')->select('*')->get();
        
        return view('Includes.adminCommonTemplate',compact('view','feature','terms'));	
    }
    public function update(Request $request, $feature_id = null)
    {
    	$feature = Features::find($feature_id);
    	if (empty($feature->feature_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Feature.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::updateRules());
        if($validator->passes()){
    	    $feature->feature_title = $request->input('feature_title');
    	    $feature->feature_content = $request->input('feature_content');
            if ($request->file('feature_image') != '') {
                $feature->feature_image = \Helper::fileuploadExtra($request, 'feature_image');
            }
            $feature->feature_terms = \Helper::maybe_serialize($request->input('feature_terms'));
    	    $feature->updated_at = date('Y-m-d h:i:s');
    	    $feature->save();
            Session::flash('success','Feature Updated Successfully');
    	    return redirect('admin/features');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public function delete($feature_id = null)
    {
    	$feature = Features::find($feature_id);
        if (empty($feature->feature_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Feature.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$feature->delete();
    	Session::flash('success','Feature Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
