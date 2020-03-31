@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
<a href="{{route('category.create')}}" class="btn btn-primary">Add Category</a>
</div>
<div class="card card-default">
    <div class="card-header">Category</div>
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
@if($categories->count()>0)
       <table class="table table-hover">
           <thead>
            <tr>
                <th>S.NO</th>
                <th>Cat_ID</th>
                <th>Category Name</th>
                <th>total Post</th>
                <th></th>
<th></th>
            </tr>
</thead>
<tbody>
    @foreach ($categories as $category)
        <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->post->count()}}</td>
        <td><a href="{{route('category.edit',$category->id)}}"><button class="btn btn-info btn-sm">Edit</button></a></td>
        <td> <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})">Delete</button></td>
        </tr>
    @endforeach
</tbody>

    </table>
    @else
    <h3 class="text-center">No Category Exits</h3>
    @endif
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <form action="" method="POST" id="deleteCategoryForm">
 @csrf
            @method('DELETE')
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <p class="text-center text-bold">
                  Are you sure you want to delete this category ?
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script>
    function handleDelete(id) {
      var form = document.getElementById('deleteCategoryForm')
      form.action = '/category/' + id
      $('#deleteModal').modal('show')
    }
  </script>
@endsection
