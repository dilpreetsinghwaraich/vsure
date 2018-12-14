<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\User;
use App\Terms;
use App\Post;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminSliderController extends Controller
{
    public function index()
    {
        $view = 'Admin.Slider.Index';
        $sliders = Post::whereIn('post_type',['slider'])->paginate(50);    
        return view('Includes.adminCommonTemplate',compact('view','sliders'));
    }
    public function rules()
    {
        return array(
            'post_title' => 'required',
            'image' => 'required',
        );
    }
    public function add()
    {
        $view = 'Admin.Slider.Add'; 
        return view('Includes.adminCommonTemplate',compact('view'));
    }
    public function save(Request $request)
    {

        $validator = Validator::make(Input::all(), self::rules());
        if($validator->passes()){
            $slider = new Post();    
            $count = Post::whereIn('post_type',['page','slider'])->where('post_title', $request->input('post_title'))->get()->count();
            if($count == 0)
            {
                $count = '';
            }      
            $slider->post_title = $request->input('post_title');
            $slider->user_id = Helper::getCurrentUserByKey('user_id');
            $slider->post_slug = str_slug($request->input('post_title').' '.$count,'-');
            $slider->post_excerpt = $request->input('post_excerpt');
            $slider->post_content = $request->input('post_content');
            $slider->post_meta_data = Helper::maybe_serialize($request->input('post_meta_data'));
            if ($request->file('image') != '') {
                $slider->image = \Helper::fileuploadExtra($request, 'image');
            }
            $slider->post_type = 'slider';  
            $slider->template = 'Template.SingleSlider';          
            $slider->status = 'publish'; 
            $slider->term = 0;       
            $slider->created_at = date('Y-m-d h:i:s');
            $slider->updated_at = date('Y-m-d h:i:s');
            $slider->save();
            Session::flash('success','Slider Saved Successfully');
            return redirect('admin/sliders');
        }else{
            Session::flash('error',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }        
    }
    public function edit($post_id = null)
    {
    	$view = 'Admin.Slider.Edit';
        $slider = Post::find($post_id);
    	if (empty($slider->post_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Slider.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        return view('Includes.adminCommonTemplate',compact('view','slider'));	
    }
    public function update(Request $request, $post_id = null)
    {
    	$slider = Post::find($post_id);
    	if (empty($slider->post_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Slider.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $count = Post::whereIn('post_type',['page','blog'])->where('post_title', $request->input('post_title'))->get()->count();
        if($count == 0)
        {
            $count = '';
        }
	    $slider->post_title = $request->input('post_title');
        $slider->user_id = Helper::getCurrentUserByKey('user_id');
        $slider->post_excerpt = $request->input('post_excerpt');
        $slider->post_content = $request->input('post_content');
        $slider->post_meta_data = Helper::maybe_serialize($request->input('post_meta_data'));
        if ($request->file('image') != '') {
            $slider->image = \Helper::fileuploadExtra($request, 'image');
        }
        $slider->post_type = 'slider';  
        $slider->template = 'Template.SingleSlider'; 
        $slider->term = 0;             
        $slider->status = 'publish'; 
	    $slider->updated_at = date('Y-m-d h:i:s');
	    $slider->save();
        Session::flash('success','Slider Updated Successfully');
	    return redirect('admin/sliders');
    }
    public function delete($post_id = null)
    {
    	$slider = Post::find($post_id);
        if (empty($slider->post_id)) {
            Session::flash('error','Something went wrong, You are not authorized to delete this Slider.');
            return Redirect::back()->withInput(Input::all());           
        }   	
    	$slider->delete();
    	Session::flash('success','Slider Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
}
