<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class BlogController extends Controller
{
    public function blog(Request $request)
    {
        $posts = Post::whereIn('post_type', ['blog'])
        				->where(function ($query) use ($request){
        					if (!empty($request->input('term'))) {
        						$query->where('term', $request->input('term'));
        					}
        				})
        				->paginate(24);
        $terms = Terms::where('term_type', 'blog')->get();
        $view = 'Blog.Blog';
        return view('Includes.commonTemplate',compact('view','posts','terms'));
    }
    
}
