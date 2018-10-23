<?php

namespace App\Http\Controllers\Admin\Questions;

use App\Http\Controllers\Controller;
use App\User;
use App\Questions;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminQuestionsController extends Controller
{
    public function index()
    {
        $view = 'Admin.Questions.Index';
        $questions = Questions::paginate(50);
        $terms = Terms::where('term_type','question')->select('*')->get();       
        return view('Includes.adminCommonTemplate',compact('view','questions','terms'));
    }
    public function rules()
    {
        return array(
            'question_title' => 'required',
            'question_content' => 'required',
        );
    }
    public function save(Request $request, $question_id = null)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $question = new Questions();       
            $question->question_title = $request->input('question_title');
            $question->question_content = $request->input('question_content');
            $question->question_terms = \Helper::maybe_serialize($request->input('question_terms'));
            $question->created_at = date('Y-m-d h:i:s');
            $question->updated_at = date('Y-m-d h:i:s');
            $question->save();
            Session::flash('success','Question Saved Successfully');
            return redirect('admin/questions');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($question_id = null)
    {
    	$view = 'Admin.Questions.Edit';
        $question = Questions::find($question_id);

    	if (empty($question->question_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Question.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $question->question_terms = \Helper::maybe_unserialize($question->question_terms);
        $terms = Terms::where('term_type','question')->select('*')->get();
        
        return view('Includes.adminCommonTemplate',compact('view','question','terms'));	
    }
    public function update(Request $request, $question_id = null)
    {
    	$question = Questions::find($question_id);
    	if (empty($question->question_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Question.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
    	    $question->question_title = $request->input('question_title');
    	    $question->question_content = $request->input('question_content');
            $question->question_terms = \Helper::maybe_serialize($request->input('question_terms'));
    	    $question->updated_at = date('Y-m-d h:i:s');
    	    $question->save();
            Session::flash('success','Question Updated Successfully');
    	    return redirect('admin/questions');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public function delete($question_id = null)
    {
    	$question = Questions::find($question_id);
        if (empty($question->question_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Question.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$question->delete();
    	Session::flash('success','Question Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
