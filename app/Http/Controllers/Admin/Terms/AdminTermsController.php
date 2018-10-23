<?php

namespace App\Http\Controllers\Admin\Terms;

use App\Http\Controllers\Controller;
use App\User;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminTermsController extends Controller
{
    public function index()
    {
        $view = 'Admin.Terms.Index';
        $terms = Terms::paginate(50);
        return view('Includes.adminCommonTemplate',compact('view','terms'));
    }
    public function rules()
    {
        return array(
            'term_title' => 'required',
            'term_type' => 'required',
        );
    }
    public function save(Request $request)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $term = new Terms();       
            $term->term_title = $request->input('term_title');
            $term->term_slug = str_slug($request->input('term_title'), '-');
            $term->term_content = $request->input('term_content');
            $term->term_type = $request->input('term_type');
            $term->created_at = date('Y-m-d h:i:s');
            $term->updated_at = date('Y-m-d h:i:s');
            $term->save();
            Session::flash('success','Term Saved Successfully');
            return redirect('admin/terms');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($term_id = null)
    {
    	$view = 'Admin.Terms.Edit';
        $term = Terms::find($term_id);

    	if (empty($term->term_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Term.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}

        return view('Includes.adminCommonTemplate',compact('view','term'));	
    }
    public function update(Request $request, $term_id = null)
    {
    	$term = Terms::find($term_id);
    	if (empty($term->term_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Term.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
    	    $term->term_title = $request->input('term_title');
            $term->term_content = $request->input('term_content');
            $term->term_type = $request->input('term_type');
    	    $term->updated_at = date('Y-m-d h:i:s');
    	    $term->save();
            Session::flash('success','Term Updated Successfully');
    	    return redirect('admin/terms');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public function delete($term_id = null)
    {
    	$term = Terms::find($term_id);
        if (empty($term->term_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Term.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$term->delete();
    	Session::flash('success','Question Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
