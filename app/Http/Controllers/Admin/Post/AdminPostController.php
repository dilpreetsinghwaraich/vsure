<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\User;
use App\Terms;
use App\Post;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminPostController extends Controller
{
    public function index()
    {
        $view = 'Admin.Post.Index';
        $posts = Post::whereIn('post_type',['blog'])->paginate(50);    
        return view('Includes.adminCommonTemplate',compact('view','posts'));
    }
    public function rules()
    {
        return array(
            'post_title' => 'required',
            'status' => 'required',
        );
    }
    public function add()
    {
        $view = 'Admin.Post.Add'; 
        $terms = Terms::where('term_type','blog')->select('*')->get();
        return view('Includes.adminCommonTemplate',compact('view','terms'));
    }
    public function save(Request $request)
    {

        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $post = new Post();    
            $count = Post::whereIn('post_type',['page','blog'])->where('post_title', $request->input('post_title'))->get()->count();
            if($count == 0)
            {
                $count = '';
            }      
            $post->post_title = $request->input('post_title');
            $post->user_id = Helper::getCurrentUserByKey('user_id');
            $post->post_slug = str_slug($request->input('post_title').' '.$count,'-');
            $post->post_excerpt = $request->input('post_excerpt');
            $post->post_content = $request->input('post_content');
            $post->post_meta_data = Helper::maybe_serialize($request->input('post_meta_data'));
            if ($request->file('image') != '') {
                $post->image = \Helper::fileuploadExtra($request, 'image');
            }
            $post->post_type = 'blog';  
            $post->template = 'Template.SinglePost';          
            $post->status = $request->input('status'); 
            $post->term = $request->input('term');       
            $post->created_at = date('Y-m-d h:i:s');
            $post->updated_at = date('Y-m-d h:i:s');
            $post->save();
            Session::flash('success','Post Saved Successfully');
            return redirect('admin/posts');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($post_id = null)
    {
    	$view = 'Admin.Post.Edit';
        $post = Post::find($post_id);
        $terms = Terms::where('term_type','blog')->select('*')->get();
    	if (empty($post->post_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Post.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $post->post_meta_data = Helper::maybe_unserialize($post->post_meta_data);
        return view('Includes.adminCommonTemplate',compact('view','post','terms'));	
    }
    public function update(Request $request, $post_id = null)
    {
    	$post = Post::find($post_id);
    	if (empty($post->post_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Post.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $count = Post::whereIn('post_type',['page','blog'])->where('post_title', $request->input('post_title'))->get()->count();
            if($count == 0)
            {
                $count = '';
            }
    	    $post->post_title = $request->input('post_title');
            $post->post_slug = (empty($request->input('post_slug'))?str_slug($request->input('post_title').' '.$count,'-'):$request->input('post_slug'));
            $post->user_id = Helper::getCurrentUserByKey('user_id');
            $post->post_excerpt = $request->input('post_excerpt');
            $post->post_content = $request->input('post_content');
            $post->post_meta_data = Helper::maybe_serialize($request->input('post_meta_data'));
            if ($request->file('image') != '') {
                $post->image = \Helper::fileuploadExtra($request, 'image');
            }
            $post->post_type = 'blog';   
            $post->template = 'Template.SinglePost';
            $post->term = $request->input('term');         
            $post->status = $request->input('status');
    	    $post->updated_at = date('Y-m-d h:i:s');
    	    $post->save();
            Session::flash('success','Post Updated Successfully');
    	    return redirect('admin/posts');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public function delete($post_id = null)
    {
    	$post = Post::find($post_id);
        if (empty($post->post_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Post.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$post->delete();
    	Session::flash('success','Post Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
