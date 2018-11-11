<?php

namespace App\Http\Controllers\Admin\ProcessResults;

use App\Http\Controllers\Controller;
use App\User;
use App\ProcessResults;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminProcessResultsController extends Controller
{
    public function index()
    {
        $view = 'Admin.ProcessResults.Index';
        $processResults = ProcessResults::paginate(50);    
        $terms = Terms::where('term_type','process')->select('*')->get();
        return view('Includes.adminCommonTemplate',compact('view','processResults','terms'));
    }
    public function rules()
    {
        return array(
            'process_title' => 'required',
            'process_subtitle' => 'required',
            'process_content' => 'required',
            'process_image' => 'required',
        );
    }
    public function updateRules()
    {
        return array(
            'process_title' => 'required',
            'process_subtitle' => 'required',
            'process_content' => 'required',
        );
    }
    public function save(Request $request)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $processResult = new ProcessResults();       
            $processResult->process_title = $request->input('process_title');
            $processResult->process_subtitle = $request->input('process_subtitle');
            $processResult->process_content = $request->input('process_content');
            if ($request->file('process_image') != '') {
                $processResult->process_image = \Helper::fileuploadExtra($request, 'process_image');
            }
            $processResult->process_terms = \Helper::maybe_serialize($request->input('process_terms'));
            $processResult->created_at = date('Y-m-d h:i:s');
            $processResult->updated_at = date('Y-m-d h:i:s');
            $processResult->save();
            Session::flash('success','Process Result Saved Successfully');
            return redirect('admin/process/results');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($process_id = null)
    {
    	$view = 'Admin.ProcessResults.Edit';
        $processResult = ProcessResults::find($process_id);

    	if (empty($processResult->process_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Process Result.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $processResult->process_terms = \Helper::maybe_unserialize($processResult->process_terms);
        $terms = Terms::where('term_type','process')->select('*')->get();
        
        return view('Includes.adminCommonTemplate',compact('view','processResult','terms'));	
    }
    public function update(Request $request, $process_id = null)
    {
    	$processResult = ProcessResults::find($process_id);
    	if (empty($processResult->process_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Process Result.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::updateRules());
        if($validator->passes()){
    	    $processResult->process_title = $request->input('process_title');
            $processResult->process_subtitle = $request->input('process_subtitle');
    	    $processResult->process_content = $request->input('process_content');
            if ($request->file('process_image') != '') {
                $processResult->process_image = \Helper::fileuploadExtra($request, 'process_image');
            }
            $processResult->process_terms = \Helper::maybe_serialize($request->input('process_terms'));
    	    $processResult->updated_at = date('Y-m-d h:i:s');
    	    $processResult->save();
            Session::flash('success','Process Result Updated Successfully');
    	    return redirect('admin/process/results');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public function delete($process_id = null)
    {
    	$processResult = ProcessResults::find($process_id);
        if (empty($processResult->process_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Process Result.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$processResult->delete();
    	Session::flash('success','Process Result Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
