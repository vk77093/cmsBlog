<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;

class WelcomeController extends Controller
{
    public function index(){
        $categories = Category::all();
        $posts= Post::orderBy('id','desc')->get();
        $tags=Tag::all();
        $postSingle=Post::orderBy('id', 'desc')->paginate(5);
        return view('welcome',compact('categories','posts','tags', 'postSingle'));
    }



}
