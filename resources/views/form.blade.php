@extends('layouts/page')
@section('content')
<form class="card bg-light mb-3" action="{{ route('appointments.store') }}" method="post">
  <div class="card-header border-0 d-flex">
    <h2 class="mb-0 font-weight-normal flex-grow-1">New Appointment</h2>
  </div>
  <div class="card-body">
    @if ($errors->any())
    <ul class="mb-0 pl-3">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>

    @endif


    @csrf
    <div class="form-group row">
      <label for="hospital" class="col-sm-2 col-form-label">Hospital</label>
      <div class="col-sm-10">
        <select class="form-control" id="hospital" name="hospital" required>
          @foreach ($hospitals as $hospital)
          <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="start" class="col-sm-2 col-form-label">Date / Time</label>
      <div class="col-sm-10">
        <input type="datetime-local" name="start" class="form-control" required>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Create Appointment</button>
    <a href="{{ route('appointments.index') }}" class="btn btn-default">Cancel</a>

  </div>
</form>
<button type="button" onclick="getLocation()" class="btn btn-secondary" id="demo">Fetch Location</button>
<span id="coordinates"></span>

@endsection

@push('scripts')
<script>
  var x = document.getElementById("coordinates");

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(browserGeolocationSuccess);
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }

  function browserGeolocationSuccess(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude;
  }
</script>
@endpush