<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\User;
use App\UserDocuments;
use Illuminate\Http\Request;
use Session, Redirect, DB, Helper;
use Illuminate\Support\Facades\Input;

class AdminUsersController extends Controller
{
    public function index()
    {
        $view = 'Admin.Users.Index';
        $users = User::paginate(50);
        return view('Includes.adminCommonTemplate',compact('view','users'));
    }
    public function editUser($user_id = null)
    {
    	$view = 'Admin.Users.EditUser';
        $user = User::find($user_id);

    	if (empty($user->user_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update user.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}

        return view('Includes.adminCommonTemplate',compact('view','user'));	
    }
    public function updateUser(Request $request, $user_id = null)
    {
    	$user = User::find($user_id);
    	if (empty($user->user_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update user.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
	    $user->name = $request->input('name');
	    $user->email = $request->input('email');
	    $user->phone = $request->input('phone');
	    $user->company = $request->input('company');
	    $user->country = $request->input('countrycountry');
	    $user->state = $request->input('state');
	    $user->city = $request->input('city');
	    $user->role = $request->input('role');
	    $user->updated_at = date('Y-m-d h:i:s');
	    $user->save();

	    Session::flash('success','Profile Updated Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
    public function deleteUser($user_id = null)
    {
    	$user = User::find($user_id);
    	if (empty($user->user_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update user.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
    	if ($user->role == 'admin') {
			Session::flash('error','Something went wrong, You are not authorized to update user.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
    	$user->delete();
    	Session::flash('success','Profile Deleted Successfully');
	    return Redirect::back()->withInput(Input::all());
    }
    public function document($user_id = null)
    {
        $user = User::find($user_id);
        if (empty($user->user_id)) {
            Session::flash('error','Something went wrong, You are not authorized to update user.');
            return Redirect::back()->withInput(Input::all());           
        }
        $documents = UserDocuments::where('user_id', $user_id)->get();
        echo view('Admin.Users.Document',compact('documents'));
        die;
    }
}
