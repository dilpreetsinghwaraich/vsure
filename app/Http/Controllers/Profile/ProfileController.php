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
    public function rules(){
        $profile =  Helper::getCurrentUser();
        return array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric|phone_number',
            'password' => 'min:8|max:14',
        );

    }
    public function updateProfile(Request $request)
    {
        $validation = Validator::make($request->all(), self::rules());
        if($validation->passes()){            
            $profile =  Helper::getCurrentUser();
            if (User::where('user_id','!=',$profile->user_id)->where('email',$request->input('email'))->get()->first()) {
                $message = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The email has already been taken for another account.</div>';
                echo json_encode(['status'=>'false','message'=>$message]);
                die;
            }
            if (User::where('user_id','!=',$profile->user_id)->where('phone',$request->input('phone'))->get()->first()) {
                $message = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The phone number has already been taken for another account.</div>';
                echo json_encode(['status'=>'false','message'=>$message]);
                die;
            }

            $user = User::find($profile->user_id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if ($profile->email != $request->input('email')) {
                $user->email_verified_at = 0;
            }
            $user->phone = $request->input('phone');
            $user->company = $request->input('company');
            $user->country = $request->input('country');
            $user->state = $request->input('state');
            $user->city = $request->input('city');
            $user->Address = $request->input('address');
            $user->postal_code = $request->input('postal_code');
            if (!empty($request->input('password'))) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->updated_at = date('Y-m-d h:i:s');
            $user->save();
            $message = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Profile updated successfully</div>';
            echo json_encode(['status'=>'true','message'=>$message]);
            die;
        }else{
            $message = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$validation->getMessageBag()->first().'</div>';
            echo json_encode(['status'=>'false','message'=>$message]);
            die;
        }
    }
    public function varifyEmail()
    {
        $profile =  Helper::getCurrentUser();
        $user = User::find($profile->user_id);
        $activation_key = sha1(mt_rand(10000,99999).time().$user->email);
        $user->activation_key = $activation_key;
        $user->save();

        $htmlmessage = 'Please Click on this link to varify your email.';
        $htmlmessage .= '<br>Click <a href="'.url('varify/email/link/'.$activation_key).'">Here</a>';
        Helper::SendEmail($user->email,'Verify Email At vsure',$htmlmessage,'');
        $message = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>To verify email, Email has been sent you.</div>';
        echo json_encode(['status'=>'true','message'=>$message]);
        die;
    }
    public function varifyEmailLinkWithKey($key = null)
    {
        if (empty($key)) {
            Session::flash('error','Something Went Wrong, Please try after sometime');
            return redirect('my-account');
        }
        if (!$user = User::where('activation_key', $key)->get()->first()) {
            Session::flash('error','Looks like your activation key is expired');
            return redirect('my-account');
        }
        User::where('activation_key', $key)
            ->update([
                'activation_key' => '',
                'email_verified_at' => date('Y-m-d h:i:s'),
            ]);
        Session::flash('success','Email varified successfully');
        return redirect('my-account');
    }
}
