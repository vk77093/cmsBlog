@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header">
        {{isset($tags->id)?'EDIT TAG':'Create TAG'}}
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert-danger">
            <ul class="list-group">
                @foreach ($errors->all() as $error)
                <li class="list-group-item">
                   {{$error}}
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    <form action="{{isset($tags)? route('tag.update',$tags->id): route('tag.store')}}" method="POST">
    @csrf
    @if (isset($tags))
    @method('PUT')

    @endif


    <div class="form-group">
        <label for="tag_name">Name</label>
    <input type="text" value="{{isset($tags)? $tags->tag_name : ''}}" class="form-control" name="tag_name">
    </div>
    <div class="form-group">
        <button type="submit" class="btb btn-primary">
        {{isset($tags)? 'Update Tags' :'ADD TAG'}}
        </button>
    </div>
    </form>
    </div>
</div>

@endsection
