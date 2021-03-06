<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;
use App\Classes\CurrencyCONV;
class HomeController extends Controller
{
    public function home()
    {
        $view = 'Home.Home';
        return view('Includes.commonTemplate',compact('view'));
    }
    public function singlePage($slug = null)
    {
        if (empty($slug)) {
            $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));       
        }
        $post = Post::where('post_slug', $slug)->whereIn('post_type',['page','blog'])->get()->first();
        if (empty($post)) {
            $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));       
        }
        $author = Helper::getUser($post->user_id);
        $title = $post->post_title;
        $view = $post->template;        
        return view('Includes.commonTemplate',compact('view','post','author','title'));
    }
    public function aboutUs()
    {
        $posts = Post::whereIn('post_type', ['blog'])->orderBy('created_at', 'DESC')->paginate(4);
        $view = 'Home.AboutUs';
        return view('Includes.commonTemplate',compact('view','posts'));
    }
    public function privacyPolicy()
    {
        $view = 'Home.PrivacyPolicy';
        return view('Includes.commonTemplate',compact('view'));
    }
    public function termsAndConditions()
    {
        $view = 'Home.TermsAndConditions';
        return view('Includes.commonTemplate',compact('view'));
    }
    public function refundAndCancellation()
    {
        $view = 'Home.RefundAndCancellation';
        return view('Includes.commonTemplate',compact('view'));
    }
}
