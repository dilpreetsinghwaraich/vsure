<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Services;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminMenuController extends Controller
{
    public function index()
    {
        $view = 'Admin.Menu.Index';
        $menus = Post::whereIn('posts.post_type',['menu'])
                        ->leftJoin('posts as pt','pt.post_id','=','posts.post_parent')
                        ->select('posts.*','pt.post_title as parent_title')
                        ->paginate(50);
        $parentMenus = Post::whereIn('post_type',['menu'])->get(); 
        return view('Includes.adminCommonTemplate',compact('view','parentMenus','menus'));
    }
    public function rules()
    {
        return array(
            'post_title' => 'required',
        );
    }
    public function save(Request $request)
    {

        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $menu = new Post();    
            $menu->post_title = $request->input('post_title');
            $menu->user_id = Helper::getCurrentUserByKey('user_id');
            $menu->post_slug = $request->input('post_slug');
            $menu->post_parent_type = $request->input('post_parent_type');
            $menu->post_parent = $request->input('post_parent');
            $menu->post_type = 'menu';            
            $menu->status = 'publish';       
            $menu->created_at = date('Y-m-d h:i:s');
            $menu->updated_at = date('Y-m-d h:i:s');
            $menu->save();
            Session::flash('success','Menu Saved Successfully');
            return redirect('admin/menus');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($post_id = null)
    {
    	$view = 'Admin.Menu.Edit';
        $menu = Post::find($post_id);
        $parentMenus = Post::whereIn('post_type',['menu'])->get();  
    	if (empty($menu->post_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Menu.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        return view('Includes.adminCommonTemplate',compact('view','menu','parentMenus'));	
    }
    public function update(Request $request, $post_id = null)
    {
    	$menu = Post::find($post_id);
    	if (empty($menu->post_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Menu.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $menu->post_title = $request->input('post_title');
            $menu->user_id = Helper::getCurrentUserByKey('user_id');
            $menu->post_slug = $request->input('post_slug');
            $menu->post_parent_type = $request->input('post_parent_type');
            $menu->post_parent = $request->input('post_parent');
            $menu->post_type = 'menu';            
            $menu->status = 'publish';    
    	    $menu->updated_at = date('Y-m-d h:i:s');
    	    $menu->save();
            Session::flash('success','Menu Updated Successfully');
    	    return redirect('admin/menus');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
    }
    public function delete($post_id = null)
    {
    	$menu = Post::find($post_id);
        if (empty($menu->post_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Menu.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$menu->delete();
    	Session::flash('success','Menu Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
