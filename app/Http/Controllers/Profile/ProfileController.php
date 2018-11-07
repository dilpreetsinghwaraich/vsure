<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    public function profile()
    {
    	$profile =  Helper::getCurrentUser();
        echo view('Profile.Profile',compact('profile'));
        die;
    }
    public function updateProfileImage(Request $request)
    {
    	if ($request->file('image') == null) {
    		echo 'wrong';
    		die;
    	}
    	$image = Helper::fileupload($request);
    	$profile =  Helper::getCurrentUser();
    	$user = User::find($profile->user_id);
    	$user->image = $image;
    	$user->updated_at = date('Y-m-d h:i:s');
    	$user->save();
    	echo $image;
    	die;
    }
    public function editProfile()
    {
    	$profile =  Helper::getCurrentUser();
        $states = DB::table('state_city')->select('state')->groupBy('state')->orderBy('state','asc')->get()->toArray();
        echo view('Profile.EditProfile',compact('profile','states'));
        die;
    }
    public function getStateCity($state)
    {
        $cities = DB::table('state_city')->select('city')->where('state','LIKE','%'.$state.'%')->orderBy('city','asc')->get()->toArray();
        $option = '<option value="">---Select City---</option>';
        if (!empty($cities)) {
            foreach ($cities as $citie) {
               $option .= '<option value="'.$citie->city.'">'.$citie->city.'</option>';
            }
        }
        echo $option;
        die();
    }
    public function updateProfile(Request $request)
    {
        $image = Helper::fileupload($request);
        $profile =  Helper::getCurrentUser();
        $user = User::find($profile->user_id);
        $user->image = $image;
        $user->updated_at = date('Y-m-d h:i:s');
        $user->save();
        echo $image;
        die;
    }
}
