@if(session('success'))
<div class="alert alert-success alert-dismissable fade show">
<button class="close" type="button" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span>
</button>
<li><strong>{{session('success')}}</strong></li>
</div>
@endif


@if(isset($errors) && count($errors) > 0)
  <div class="alert alert-danger alert-dismissable fade show">
  <button class="close" type="button" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span>
  </button>
  @foreach($errors->all() as $error)
    <li><strong>{{ $error }}</strong></li>
  @endforeach
</div>

@endif
