<?php

namespace App\Http\Controllers\Admin\Documents;

use App\Http\Controllers\Controller;
use App\User;
use App\Documents;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminDocumentsController extends Controller
{
    public function index()
    {
        $view = 'Admin.Documents.Index';
        $documents = Documents::paginate(50);    
        $terms = Terms::where('term_type','document')->select('*')->get();
        return view('Includes.adminCommonTemplate',compact('view','documents','terms'));
    }
    public function rules()
    {
        return array(
            'document_title' => 'required',
            'document_promoter' => 'required',
            'document_company' => 'required',
            'document_terms' => 'required',
        );
    }
    public function save(Request $request)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $document = new Documents();       
            $document->document_title = $request->input('document_title');
            $document->document_promoter = $request->input('document_promoter');
            $document->document_company = $request->input('document_company');
            $document->document_terms = \Helper::maybe_serialize($request->input('document_terms'));            
            $document->created_at = date('Y-m-d h:i:s');
            $document->updated_at = date('Y-m-d h:i:s');
            $document->save();
            Session::flash('success','Document Saved Successfully');
            return redirect('admin/documents');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($document_id = null)
    {
    	$view = 'Admin.Documents.Edit';
        $document = Documents::find($document_id);
    	if (empty($document->document_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Document.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $terms = Terms::where('term_type','document')->select('*')->get();
        $document->document_terms = \Helper::maybe_unserialize($document->document_terms);
        return view('Includes.adminCommonTemplate',compact('view','document','terms'));	
    }
    public function update(Request $request, $document_id = null)
    {
    	$document = Documents::find($document_id);
    	if (empty($document->document_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Document.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
    	    $document->document_title = $request->input('document_title');
    	    $document->document_promoter = $request->input('document_promoter');
            $document->document_company = $request->input('document_company');
            $document->document_terms = \Helper::maybe_serialize($request->input('document_terms'));
    	    $document->updated_at = date('Y-m-d h:i:s');
    	    $document->save();
            Session::flash('success','Document Updated Successfully');
    	    return redirect('admin/documents');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public function delete($document_id = null)
    {
    	$document = Documents::find($document_id);
        if (empty($document->document_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Document.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$document->delete();
    	Session::flash('success','Document Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
