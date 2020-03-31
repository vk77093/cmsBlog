@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
<a href="/register" class="btn btn-primary">Add user</a>
</div>
<div class="card card-default">
    <div class="card-header">Users</div>
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
  @if($users->count()>0)
  <table class="table table-hover">
      <thead>
          <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Email id</th>
              <th></th>
          </tr>
          <tbody>
              @foreach ($users as  $user)
              <tr>
              <td><img src="
                  {{Gravatar::src($user->emial)}}" width="40px" height="40px" style="border-radius: 50%"></td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
            <td>
                @if(!$user->isAdmin())
            <form action="{{route('user.make-admin',$user->id)}}" method="POST">
                @csrf
         <button type="submit" class="btn btn-info btn-sm">Make Admin</button>
            </form>
                @endif
            </td>
            </tr>

              @endforeach
          </tbody>
      </thead>
  </table>
  @else
  <h3 class="text-center">No users Exits</h3>
  @endif
    </div>
</div>
@endsection
