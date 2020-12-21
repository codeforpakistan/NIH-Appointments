@extends('layouts/page')
@section('content')

@isset($hospital)
<form class="card bg-light mb-3" action="{{ route('hospitals.update', $hospital->id) }}" method="post">
@method('PUT')
@else
<form class="card bg-light mb-3" action="{{ route('hospitals.store') }}" method="post">
@endisset
@csrf

  <div class="card-header border-0 d-flex">
    <h2 class="mb-0 font-weight-normal flex-grow-1">
      @isset($hospital) Editing hospital @else Creating hospital @endisset
    </h2>
  </div>
  <div class="card-body">
    <div class="form-group row">
      <label for="hospital" class="col-sm-2 col-form-label">Hospital</label>
      <div class="col-sm-10">
        @isset($hospital)
        <input type="text" name="name" class="form-control" required value="{{ $hospital->name }}">
        @else
        <input type="text" name="name" class="form-control" required>
        @endif
      </div>
    </div>
  </div>
  <div class="card-footer border-0">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('hospitals.index') }}" class="btn btn-default">Cancel</a>
  </div>
</form>

@endsection
