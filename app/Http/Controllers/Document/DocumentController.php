<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\UserDocuments;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class DocumentController extends Controller
{
    public function document()
    {
    	$documents = UserDocuments::paginate(50);
        $html = view('Document.Document',compact('documents'));
        $view = 'Dashboard.Dashboard';
        return view('Includes.commonTemplate',compact('view','html'));
    }
    public function uploadDocument(Request $request)
    {
    	if (empty($request->input('type'))) {
    		Session::flash('error', 'Type field is required');
            return Redirect::back()->withInput(Input::all());
    	}
    	if (empty($request->file('file'))) {
    		Session::flash('error', 'File field is required');
            return Redirect::back()->withInput(Input::all());
    	}
    	$document = new UserDocuments();
    	$document->user_id = Helper::getCurrentUserByKey('user_id');
    	$document->type = $request->input('type');
    	$document->file = Helper::fileuploadExtra($request, 'file');
    	$document->created_at = new DateTime;
    	$document->updated_at = new DateTime;
    	$document->save();
    	Session::flash('success', 'Document uploaded successfully');
        return Redirect::back();
    }
}
