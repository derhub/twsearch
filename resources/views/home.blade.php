@extends('layout.default')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="map-content">
            <div id="mapdata"></div>
        </div>
        <div class="search-bar">
            <form class="form-inline" action="={{ route('search.tweets') }}" method="post">
                <input class="form-control input-search" type="search" name="search" placeholder="City name" value="">
                <input type="submit" class="btn btn-primary search-button" value="search">
            </form>
        </div>
    </div>
</div>
@endsection
