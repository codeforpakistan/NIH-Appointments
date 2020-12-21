<form class="input-group mx-1" action="{{ url()->current() }}">
    <input type="text" name="q" class="form-control" placeholder="Search" value="{{ \Request::input('q') }}">
    <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
    </div>
</form>