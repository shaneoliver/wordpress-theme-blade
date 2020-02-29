<form id="searchform" method="get" action="{{ home_url('/') }}">
    @if ($form_style === 'inline')
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="s" value="{{ the_search_query() }}" aria-label="Search" aria-describedby="searchButtonInline">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" id="searchButtonInline">Search</button>
            </div>
        </div>
    @else
        <div class="form-group">
            <label for="searchInput">Search</label>
            <input type="search" class="form-control" id="searchInput" placeholder="Search" name="s" value="{{ the_search_query() }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    @endif
</form>