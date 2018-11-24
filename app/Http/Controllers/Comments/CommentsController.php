<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Packages;
use App\Orders;
use App\Comments;
use App\User;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class CommentsController extends Controller
{    
    public function rules()
    {
        return array(
            'comment_author_name' => 'required',
            'comment_author_email' => 'required',
            'comment_content' => 'required',
        );
    }
    public function save(Request $request)
    {
        $validator = Validator::make(Input::all(), self::rules());
        if(!$validator->passes()){
            Session::flash('warning',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
        
        Comments::create([
            'comment_author_name' => $request->input('comment_author_name'),
            'comment_author_email' => $request->input('comment_author_email'),
            'comment_content' => $request->input('comment_content'),
            'user_id' => Helper::getCurrentUserByKey('user_id'),
            'post_id' => $request->input('post_id'),
            'comment_parent' => (empty($request->input('comment_parent'))?0:$request->input('comment_parent')),
        ]);

        Session::flash('success','Comment submitted successfully');
        return Redirect::back()->withInput(Input::all());
    }
}
