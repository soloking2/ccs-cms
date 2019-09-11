@extends('layouts.app')

@section('content')

<div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">
                  <form action="{{route('users.update-profile')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                    </div>

                    <div class="form-group">
                      <label for="about">About Me</label>
                      <textarea name="about" rows="8" cols="5" class="form-control">{{$user->about}}</textarea>
                    </div>
                    <button type="submit" name="button" class="btn btn-success">Update Profile</button>
                  </form>
                </div>
</div>
@endsection
