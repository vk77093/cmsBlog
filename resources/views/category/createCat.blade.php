@extends('layouts.app')
@section('content')
 <div class="card card-default">
    <div class="card-header">Create Category</div>
      <div class="card-body">
@if($errors->any())
<div class="alert alert-danger">
    <ul class="list-group">
        @foreach ($errors->all() as $error )
        <li class="list-group-item">
            {{$error}}
        </li>

        @endforeach
    </ul>
    @endif
</div>

      <form action="{{route('category.store')}}" method="POST">
        @csrf
      <div class="form-group">
    <label for="name">NAME</label>
    <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-primary">Create</button>
    </div>
    </form>
      </div>

</div>
@endsection
