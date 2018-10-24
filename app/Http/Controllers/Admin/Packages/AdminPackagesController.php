<?php

namespace App\Http\Controllers\Admin\Packages;

use App\Http\Controllers\Controller;
use App\User;
use App\Packages;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminPackagesController extends Controller
{
    public function index()
    {
        $view = 'Admin.Packages.Index';
        $packages = Packages::paginate(50);    
        return view('Includes.adminCommonTemplate',compact('view','packages'));
    }
    public function rules()
    {
        return array(
            'package_title' => 'required',
            'price' => 'required|max:999999999|integer',
            'package_content' => 'required',
            'package_terms' => 'required',
        );
    }
    public function add()
    {
        $view = 'Admin.Packages.Add'; 
        $terms = Terms::where('term_type','package')->select('*')->get();
        return view('Includes.adminCommonTemplate',compact('view','terms'));
    }
    public function save(Request $request)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $package = new Packages();       
            $package->package_title = $request->input('package_title');
            $package->price = $request->input('price');
            $package->package_content = \Helper::maybe_serialize($request->input('package_content'));
            $package->package_terms = \Helper::maybe_serialize($request->input('package_terms'));            
            $package->created_at = date('Y-m-d h:i:s');
            $package->updated_at = date('Y-m-d h:i:s');
            $package->save();
            Session::flash('success','Package Saved Successfully');
            return redirect('admin/packages');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($package_id = null)
    {
    	$view = 'Admin.Packages.Edit';
        $package = Packages::find($package_id);
    	if (empty($package->package_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Package.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $terms = Terms::where('term_type','package')->select('*')->get();
        $package->package_content = \Helper::maybe_unserialize($package->package_content);
        $package->document_terms = \Helper::maybe_unserialize($package->document_terms);
        return view('Includes.adminCommonTemplate',compact('view','package','terms'));	
    }
    public function update(Request $request, $package_id = null)
    {
    	$package = Packages::find($package_id);
    	if (empty($package->package_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Package.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
    	    $package->package_title = $request->input('package_title');
            $package->price = $request->input('price');
            $package->package_content = \Helper::maybe_serialize($request->input('package_content'));
            $package->package_terms = \Helper::maybe_serialize($request->input('package_terms'));
    	    $package->updated_at = date('Y-m-d h:i:s');
    	    $package->save();
            Session::flash('success','Package Updated Successfully');
    	    return redirect('admin/packages');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public function delete($package_id = null)
    {
    	$package = Packages::find($package_id);
        if (empty($package->package_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Package.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$package->delete();
    	Session::flash('success','Package Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
