@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header">
        {{-- here we are actully using if else --}}
        {{isset($posts->id)? 'Edit POST':'Create Post'}}
    </div>
    <div class="card-body">
        @if($errors->any())
<div class="alert alert-danger">
    <ul class="lsit-group">
        @foreach ($errors->all() as $error )
        <li class="list-group-item">
            {{$error}}
        </li>

        @endforeach
    </ul>
    @endif
</div>
<form action="{{isset($posts)? route('post.update',$posts->id) :route('post.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($posts))
    @method('PUT')

    @endif
    <div class="form-group">
     <label for="title">Title</label>
    <input type="text" name="title" value="{{isset($posts)? $posts->title : ''}}" class="form-control">
    </div>
    <div class="form-group">
        <label for="description">description</label>
    <input type="text" name="description" value="{{isset($posts)? $posts->description : ''}}" class="form-control">
    </div>
    <div class="form-group">
      <label for="content">Post Content</label>
    {{-- <textarea class="form-control" name="content" row="3" col="3">{{isset($posts)? $posts->content : ''}}</textarea> --}}
    <input id="content" type="hidden" name="content" value="{{isset($posts)? $posts->content : ''}}">
  <trix-editor input="content"></trix-editor>
</div>
    <div class="form-group">
        <label for="published_at">Published At</label>
    <input type="text" name="published_at" value="{{isset($posts)? $posts->published_at : ''}}" id="published_at" class="form-control">
    </div>
    @if(isset($posts))
    <div class="form-group">
    <img src="{{asset($posts->image)}}" width="70px" height="50px" alt="databaseImage">
    </div>
    @endif
    <div class="form-group">
    <input type="file" class="form-control-file" name="image">
    </div>
<div class="form-group">
        <label for="category">Category</label>
      <select class="form-control tags-select" id="category" name="category_id">
    @foreach ($categories as $category )
    <option value="{{$category->id}}"
        @if(isset($posts))
        @if($category->id ==$posts->category->id)
selected
      @endif
        @endif

       > {{$category->name}}

    @endforeach
    </select>
    </div>
    @if($tags->count()>0)
    <div class="form-group">
      <label for="tags">Tags</label>
        <select name="tags[]" id="tags" class="form-control tags-select" multiple>
            @foreach ($tags as $tag)
        <option value="{{$tag->id}}"
          @if(isset($posts))
          @if($posts->hasTag($tag->id))
          selected
          @endif
          @endif
            >{{$tag->tag_name}}</option>
            @endforeach
        </select>
    </div>
    @endif
    <div class="form-group">
        <button type="submit" class="btn btn-success">
        {{isset($posts)?'UPDATE POST': 'ADD POST'}}
        </button>
    </div>
    </form>
    </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#published_at", {
        enableTime:true,
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix-core.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.tags-select').select2();
});
</script>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
