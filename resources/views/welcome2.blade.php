<h4>hello i will provide you the serch result</h4>

@forelse ($posts as $post)
  {{$post>title}}
@empty
   <h> No data found</h>
@endforelse
