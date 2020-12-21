<div class="card bg-light">
  <div class="card-header border-0 d-flex">
    <h2 class="mb-0 font-weight-normal flex-grow-1">{{ ucwords(Str::plural($model)) }}</h2>
    
    @if (isset($controls) && $controls)
    <div class="form-inline">
      @include('components.create', ['mode' => $model])
      @hasanyrole('admin|staff|agent')
        @includeWhen($search, 'components.search')
        @isset($filters)
          @foreach ($filters as $filter => $list)
            @include('components.filters', ['filter' => $filter, 'items' => $list])
          @endforeach
        @endisset
      @endhasanyrole
    </div>
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
