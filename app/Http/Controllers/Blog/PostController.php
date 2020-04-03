<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    public function show($id){
        $post=Post::findOrfail($id);
        //$post=Post::all();
        return view('blog.showSinglePost',compact('post'));
    }
    public function category(Category $category){
        //$categories=Category::findOrFail($id)->post;
//         $category=Category::all();
//       $posts = Post::orderBy('id', 'desc')->simplePaginate(4);
//       $tags=Tag::all();
//         $postSingle = Post::orderBy('id', 'desc')->paginate(5);

// return view('blog.showCategory',compact('categories','posts','tags', 'postSingle'));

// instructor code
$search=request()->query('search');
if($search){
    $posts=Post::where('title', 'LIKE',"%{$search}%")->simplePaginate('4');

}
else{
            $posts = $category->post()->simplePaginate(3);
}
return view('blog.showCategory')
->with('category',$category)
->with('posts',$posts)
->with('categories',Category::all())
->with('postSingle', Post::orderBy('id', 'desc')->paginate(5))
->with('tags',Tag::all());
    }
    public function tag(Tag $tag){
        // $tag=Tag::all();
        // $posts=$tag->posts();
        // $categories=Category::all();
        // $postSingle= Post::orderBy('id', 'desc')->paginate(5);
        // $tags=Tag::all();
        // return view('blog.showTag',compact('tag','posts','categories','postSingle','tags'));
        $search = request()->query('search');
        if ($search) {
            $posts = Post::where('title', 'LIKE', "%{$search}%")->simplePaginate('4');
        } else {
            $posts = $tag->posts()->simplePaginate(3);
        }
        return view('blog.showTag')
->with('tag',$tag)
->with('posts',$posts)
->with('categories',Category::all())
            ->with('postSingle', Post::orderBy('id', 'desc')->paginate(5))
            ->with('tags', Tag::all());
    }
}
