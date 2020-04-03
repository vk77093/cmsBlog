<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;

class WelcomeController extends Controller
{
    public function index(Request $request){
       // $search = request()->query('search');
       $search= $request->input('search');
        if ($search) {
            //dd($search);
            //$posts=Post::all();
            $posts = Post::where('title', 'LIKE',"%{$search}%")->simplePaginate('4');
            //var_dump($posts);
            //$posts=Post::query()->where('title', 'LIKE', '%' . $search . '%')->get();
            //dd($posts);
            //print_r($posts->toSql());
            //print_r($posts->getBindings());

        } else {
            $posts = Post::orderBy('id', 'desc')->simplePaginate('4');
        }
        $categories = Category::all();
        //$posts = Post::orderBy('id', 'desc')->simplePaginate(4);
        $posts= $posts;
        $tags = Tag::all();
        $postSingle = Post::orderBy('id', 'desc')->paginate(5);
        return view('welcome',compact('categories','posts','tags', 'postSingle'));
        // return view('welcome')
        // ->with('categories',Category::all())
        // ->with('tags',Tag::all())
        // ->with('postSingle',Post::orderBy('id', 'desc')->paginate(5))
        // ->with('posts',$posts);
    }

public function indexSearch(){

        $search=request()->query('search');
        if($search){
            //dd($search);
            $posts = Post::where('title', 'LIKE', "%{$search}%")->get();
        }
        else{

        }
        return view('welcome2',compact('posts'));

}


}
