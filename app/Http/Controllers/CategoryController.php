<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::orderBy('id','desc')->get();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.createCat');
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
'name'=>'required|min:5|max:20|unique:categories',

        ]);
        $data=$request->all();
        $categories=new Category();
        $categories->name= $data['name'];
        $categories->save();
        session()->flash('sucess','Category Got added');
        return redirect('/category');
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
        $categories=Category::findOrFail($id);
        return view('category.editCat',compact('categories'));
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

        $errors=$request->validate([
'name'=>'required|min:5|max:20',

        ]);
        $data=$request->all();
        $categories=Category::findOrFail($id);
        $categories->name= $data['name'];
        $categories->save();
        session()->flash('sucess','Category Got Update');
        return redirect('/category');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
//$category=Category::find($id);
if($category->post->count()>0){
            session()->flash('error', 'you Can not delete category as it had some post');

            return redirect('/category');
}
        $category->delete();

        session()->flash('success', 'Category deleted successfully.');

       return redirect('/category');
    }
    public function destroy2($categoryId){
        $category=Category::find($categoryId);
        if ($category->post->count() > 0) {

            session()->flash('error', 'you Can not delete category as it had some post');
       return redirect()->back();
        }
            $category->delete();
        session()->flash('success', 'Category deleted successfully.');

        return redirect('/category');
    }
}
