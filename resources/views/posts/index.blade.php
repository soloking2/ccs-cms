@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
  <a href="{{route('posts.create')}}" class="btn btn-primary">Add Posts</a>
</div>

<div class="card card-default">
  <div class="card-header">Posts</div>
  <div class="card-body">
    @if($posts->count() > 0)
    <table class="table">
      <thead>
        <tr>
          <th>Image</th>
          <th>Title</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($posts as $post)
        <tr>
          <td>
            <img src="\storage\{{$post->image}}" alt="{{ $post->title}}" width="130" height="80">
          </td>
          <td>{{ $post->title}}</td>
          <td><a href="{{route('categories.edit', $post->category->id)}}">
            {{$post->category->name}}
          </a></td>
          @if($post->trashed())
            <td>
              <form action="{{route('restore-post', $post->id)}}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="put">
              <button type="submit" class="btn btn-info">Restore</button>
              </form>
            </td>
          @else
          <td><a href="{{ route('posts.edit', $post->id)}}" class="btn btn-info">Edit</a></td>
          @endif
          <td>
            <form action="{{route('posts.destroy', $post->id)}}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-danger">
                  <!-- Detect if its trashed display delete -->
                  {{$post->trashed() ? 'Delete' : 'Trash'}}
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    @else
    <h3 class="text-center">No posts yet</h3>
    @endif
  </div>
</div>


@endsection
