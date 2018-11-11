<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Post;

class BlogController extends Controller
{
    public function blog()
    {
        $posts = Post::whereIn('post_type', ['blog'])->paginate(12);
        $view = 'Blog.Blog';
        return view('Includes.commonTemplate',compact('view','posts'));
    }
    
}
