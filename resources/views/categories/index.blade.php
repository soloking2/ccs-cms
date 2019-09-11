@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('categories.create')}}" class="btn btn-success">Add Category</a>
</div>
<div class="card card-default">
    <div class="card-header">Categories</div>

    <div class="card-body">
      @if($categories->count() > 0)
        <table class="table">
        <thead>
            <tr><th>Name</th>
                <th>Number of Posts</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)

            <tr><td>{{$category->name}}</td>
                <td>{{$category->posts->count()}}</td>
                <td><a href="{{route('categories.edit', $category->id)}}" class="btn btn-md btn-primary">Edit</a></td>
                <td><button class="btn btn-danger btn-md" onclick="handleDelete({{ $category->id }})" data-toggle="modal" data-target="#myModal">Delete</button></td>
            </tr>

            @endforeach
        </tbody>
        </table>

        <form id="deleteCategoryForm" action="" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">
          <!-- The Modal -->
          <div class="modal" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Delete Category</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <p class="text-center text-bold">Are you sure you want to delete this item?</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                  <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>

              </div>
            </div>
          </div>
        </form>

        @else
          <h3 class="text-center">No categories yet</h3>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function handleDelete(id){
    let form = document.getElementById('deleteCategoryForm');
    form.action = '/categories/'+id;
    $('.myModal').modal('show');
    console.log('deleting ..' + id);
}

</script>
@endsection
