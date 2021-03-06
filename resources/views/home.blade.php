@extends('layout.default')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="map-content">
            <div id="city-title" class="hide">
                <h1>TWEETS ABOUT <span id="city-name">Pampanga<span></h1>
            </div>
            <div id="mapdata"></div>
        </div>
        <div class="search-bar">
            <form class="form-inline" id="search-bar" action="={{ route('search.tweets') }}" method="post">
                <input class="form-control input-search" id="search-place" type="search" name="search" placeholder="City name" value="">
                <input type="submit" class="btn btn-primary search-button" value="SEARCH" data-loading-text="Searching...">
            </form>
        </div>
    </div>
</div>
@endsection
