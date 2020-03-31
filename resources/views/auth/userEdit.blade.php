@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header">Edit Profile</div>
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
<form action="{{route('user.update-profile',$user->id)}}" method="POST">
@csrf
@method('PUT')
<div class="form-group">
<label for="name">Name</label>
<input type="text" class="form-control" name="name" value="{{$user->name}}" id="name">
</div>
<div class="form-group">
    <label for="about_us">About ME</label>
<textarea class="form-control" rows="3" col="3" name="about_us">{{$user->about_us}}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success form-control">Update Profile</button>
</div>

</form>

</div>
</div>
@endsection
