@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
   <a href="{{route('post.create')}}" class="btn btn-success">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">Post</div>
    <div class="card-body">
     @if($posts->count()>0)
<table class="table table-hover">
    <thead>
        <tr>
            <th>Post Image</th>
            <th>Post Title</th>
            <th>Category</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post )
<tr>
<td>
  <img src="{{asset($post->image)}}" height="60px" width="70px" alt="databaseImage">
</td>
<td>{{$post->title}}</td>
@if(!$post->category_id)
<td>{{$post->category->name}}</td>
@endif
@if(!$post->trashed())

<td><a href="{{route('post.edit',$post->id)}}"
    class="btn btn-info btn-sm">Edit</a></td>
@endif
    <td>
    <form method="{{route('post.destroy',$post->id)}}" method="POST">
        @csrf
        @method('DELETE')
 <button type="submit"class="btn btn-danger btn-sm">
    {{$post->trashed() ?'DELETE' : 'TRASH'}}
    </button>
    </form>
</td>
        @endforeach
</tr>

    </tbody>
</table>
@else
<h3 class="text-center">
    No Post YET
    </h3>
@endif

    </div>
</div>
@endsection
