@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
<a href="{{route('tag.create')}}" class="btn btn-info">ADD TAG</a>
</div>
 <div class="card card-default">
<div class="card-header">TAGS</div>
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
<div class="card-body">
@if($tags->count()>0)
<table class="table table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Tags Name</th>
<th>Tag Count</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
  @foreach ($tags as $tag)
  <tr>
  <td>{{$tag->id}}</td>
  <td>{{$tag->tag_name}}</td>
  <td>{{$tag->posts->count()}}</td>
  <td><a href="{{route('tag.edit',$tag->id)}}"><button class="btn btn-info btn-sm">Edit</button></td>
   <td><button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">Delete</button></td>
  </tr>

  @endforeach
</tbody>
</table>
@else
<h3 class="text-center">No TAGS Exits</h3>
@endif

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <form action="" method="POST" id="deleteCategoryForm">
 @csrf
            @method('DELETE')
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete TAGS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <p class="text-center text-bold">
                  Are you sure you want to delete this Tags ?
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
      form.action = '/tag/' + id
      $('#deleteModal').modal('show')
    }
  </script>
</div>
</div>
@endsection
