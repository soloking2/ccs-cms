@if(session()->has('error'))
  <div class="alert alert-danger alert-dismissable fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
      <span aria-hidden="true">&times;</span>
    </button>
    {{session()->get('error')}}
  </div>
  @endif
