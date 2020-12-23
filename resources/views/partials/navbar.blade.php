<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('appointments.index') }}">{{ config('app.name') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    @auth
    <!-- <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('appointments.index') }}">Appointments</a>
      </li>
    </ul> -->
    @endauth
    <ul class="navbar-nav ml-auto">
      @if (Route::has('login'))
      @auth
      <li class="nav-item"><a class="nav-link" href="{{ route('appointments.index') }}">Appointments</a></li>
      @hasanyrole('admin|staff|agent')<li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>@endhasanyrole
      @role('admin')
      <li class="nav-item"><a class="nav-link" href="{{ route('hospitals.index') }}">Hospitals</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('departments.index') }}">Departments</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('doctors.index') }}">Doctors</a></li>
      @endrole
      <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
      </a></li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      @else
      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
      @if (Route::has('register'))
      <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
      @endif
      @endauth
      @endif
    </ul>

  </div>
</nav>