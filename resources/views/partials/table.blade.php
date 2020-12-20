<div class="card bg-light">
  <div class="card-header border-0 d-flex">
    <h2 class="mb-0 font-weight-normal flex-grow-1">{{ ucwords(Str::plural($model)) }}</h2>
    @if (isset($controls) && $controls)
      <a class="btn btn-primary" href="{{ route(Str::plural($model).'.create') }}">Create {{ ucwords($model) }}</a>
    @endif
  </div>
  @if($items->count())
  {{ $slot }}
  @if (class_basename($items) == 'LengthAwarePaginator')
    <div class="card-footer clearfix">
      <div class="row">
        <div class="col">
          <div class="pt-2">Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} entries</div>
        </div>
        <div class="col-auto">
          {{ $items->links() }}
        </div>
      </div>
    </div>
  @endif
  @else
  <div class="card-body">No Results</div>
  @endif
</div>
