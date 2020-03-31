@extends('layouts.app')
@section('content')
<div class="card card-default">
<div class="card-header">Update The Category</div> 
<div class="card-body">
  @if($categories)  
<form action="{{route('category.update',$categories->id)}}" method="POST">
@csrf
@method('PATCH')
 <div class="form-group">
    <label for="name">NAME</label>
 <input type="text" name="name" value="{{$categories->name}}" class="form-control">      
    </div>  
    <div class="form-group">
    <button type="submit" class="btn btn-warning">Update</button>
    </div>
</form>
    @endif   
</div>   
</div>    
@endsection