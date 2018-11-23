<?php

namespace App\Http\Controllers\Admin\Media;

use App\Http\Controllers\Controller;
use App\User;
use App\Terms;
use App\Post;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminMediaController extends Controller
{
    public function index()
    {
        $view = 'Admin.Media.Index';
        $posts = Post::whereIn('post_type',['media'])->paginate(50);    
        return view('Includes.adminCommonTemplate',compact('view','posts'));
    }
    public function rules()
    {
        return array(
            '' => '',
        );
    }
    public function save(Request $request)
    {
        
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            if ($request->file('image')) {
                foreach ($request->file('image') as $file) {
                    $post = new Post();  
                    $post->post_title = $file->getClientOriginalName();
                    $post->user_id = Helper::getCurrentUserByKey('user_id');
                    $post->post_slug = '';
                    $post->post_excerpt = '';
                    $post->post_content = '';
                    $post->post_meta_data = '';
                    $post->image = Helper::fileuploadArray($file);
                    $post->post_type = 'media';            
                    $post->status = 'publish'; 
                    $post->term = 0;       
                    $post->created_at = date('Y-m-d h:i:s');
                    $post->updated_at = date('Y-m-d h:i:s');
                    $post->save();
                }
            }
            
            Session::flash('success','Media Saved Successfully');
            return redirect('admin/media');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function view($post_id = null)
    {
        $post = Post::find($post_id);
        if (empty($post->post_id)) {
            echo 'Something went wrong, You are not authorized to delete this Post.';
            die;
        } 
        echo '<div class="col-md-12">
              <img src="'.asset('/').$post->image.'" style="width: 100%;height: 290px;" alt="'.$post->post_title.'">
            </div>
            <div class="col-md-12">
              <input type="text" style="width: 100%;" class="form-control" readonly="" value="'.$post->post_title.'">
            </div>
            <div class="col-md-12">
              <input type="text" style="width: 100%;" class="form-control" readonly="" value="'.asset('/').$post->image.'">
            </div>
            <div class="col-md-12">
              <a class="btn btn-danger" href="'.url('admin/delete/media/'.$post->post_id).'">Delete</a>
            </div>';
            die;
    }
    public function delete($post_id = null)
    {
    	$post = Post::find($post_id);
        if (empty($post->post_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Post.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$post->delete();
    	Session::flash('success','Media Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
