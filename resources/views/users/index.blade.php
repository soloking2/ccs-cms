@extends('layouts.app')

@section('content')

<div class="card card-default">
  <div class="card-header">Users</div>
  <div class="card-body">
    @if($users->count() > 0)
    <table class="table">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Email</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>
            <img style="width:40px; height:30px; border-radius:50%;" src="{{Gravatar::src($user->email)}}" alt="">
          </td>
          <td>{{ $user->name}}</td>
          <td>
            {{$user->email}}
          </a></td>
            <td>
              @if(!$user->isAdmin())
              <form action="{{route('users.makeAdmin', $user->id)}}" method="post">
                {{csrf_field()}}
              <button type="submit" class="btn btn-sm btn-success" name="button">Make Admin</button>
            </form>
              @endif
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    @else
    <h3 class="text-center">No users yet</h3>
    @endif
  </div>
</div>


@endsection
