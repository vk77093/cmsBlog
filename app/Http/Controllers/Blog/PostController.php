<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function show($id){
        $post=Post::findOrfail($id);
        //$post=Post::all();
        return view('blog.showSinglePost',compact('post'));
    }
}
