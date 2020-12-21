<div class="input-group mx-1">
  <div class="input-group-prepend">
    <span class="input-group-text bg-light">{{ ucwords($filter) }}</span>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
      @if (Request::has($filter)) {{ ucwords(Request::query($filter)) }} @else All @endif
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <a class="dropdown-item" href="{{ url()->current() . '?' . http_build_query(Arr::except(Request::query(), [$filter])) }}">All</a>
      @foreach ($items as $item)
      <a class="dropdown-item" href="{{ url()->current() . '?' . http_build_query(array_merge(Request::query(), [$filter => $item])) }}">{{ ucwords($item) }}</a>
      @endforeach
    </div>
  </div>
</div>