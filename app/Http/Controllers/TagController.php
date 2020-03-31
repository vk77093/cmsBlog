<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::get();
        //dd($tags);

        return view('tags.tagIndex',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$tags=Tag::get();
        return view('tags.tagCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $errors=$request->validate([
         'tag_name'=>'required|min:5|max:30|unique:tags',
     ]);
// $data=$request->all();
// $tags=new Tag();
// $tags->tag_name=$data['tag_name'];
// $tags->save();

$tags=Tag::create([
    'tag_name'=>$request->tag_name,
]);

session()->flash('sucess','Tags Got Added');
return redirect('/tag');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$tags = Tag::all();
        $tags=Tag::findOrFail($id);
//$tags=Tag::all();
return view('tags.tagCreate', compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->all();
        $tags=Tag::findOrFail($id);
        $tags->update($request->all());
        session()->flash('sucess', 'The Tags Data Got update');
        return redirect('/tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {

        if($tag->posts->count()>0){
            session()->flash('error', 'you Can not delete category as it had some post');
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('sucess', 'Tags Got Added');
        return redirect('/tag');
    }
}
