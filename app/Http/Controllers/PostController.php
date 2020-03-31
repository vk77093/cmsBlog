<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\CreatePostRequest;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriescount')->only([
            'create','store',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('post.PostIndex',compact('posts'));
    }

    public function trash(){
        $trashed=Post::onlyTrashed()->get();
        return view('post.PostIndex')->with('posts',$trashed);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('post.createPost',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //dd($request->all());
       $image= $request->image->store('/postsImage');
$posts=Post::create([
    'title'=>$request->title,
    'description'=>$request->description,
    'content'=>$request->content,
    'published_at'=>$request->published_at,
    'category_id'=>$request->category,
    'user_id'=>auth()->user()->id,
    'image'=>$image,
]);
if($request->tags){
    $posts->tags()->attach($request->tags);
}
session()->flash('sucess','The new Post Got Added');
//echo "the data got added";
return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts=Post::findOrFail($id);
        $categories = Category::all();
        $tags=Tag::all();
        return view('post.createPost',compact('posts','categories','tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts=Post::findOrFail($id);
        if($request->tags){
            $posts->tags()->sync($request->tag);
        }
        $posts->update($request->all());
        session()->flash('sucess','The Post Data Got update');
        return redirect('/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $post=Post::findOrFail($id);
        // $post->delete();
        // session()->flash('sucess', 'The Post Data Got Trashed');
        // return redirect('/post');
        //Subscription::withTrashed()->where('email', 'test@example.com')->delete();
$post=Post::withTrashed()->where('id',$id)->firstOrFail();
        if($post->trashed()){
            Storage::delete($post->image);
            $post->forceDelete();

        }
        else{
           //$post->delete();
        Post::withTrashed()->where('id',$id)->delete();

        }
        session()->flash('sucess', 'The Post Data Got Trashed');
        return redirect('/post');

    }
}
