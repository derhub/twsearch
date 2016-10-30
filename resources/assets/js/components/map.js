let markers = [],
    Geocoder,
    infowindow,
    mapwindow;

/**
 * Google map callback
 */
window.initMap = function () {

    Geocoder = new google.maps.Geocoder;
    infowindow = new google.maps.InfoWindow();

    // start map
    mapwindow = new google.maps.Map(document.getElementById('mapdata'), {
        zoom: 10,
        center: new google.maps.LatLng(15.079409, 120.619989), // default pampanga, ph
        mapTypeId: 'roadmap'
    });

    let searchCallback = function(e) {
        e.preventDefault();

        let $btn = $('form .search-button').button('loading');

        // get the text box value
        // then convert to coordinates
        let city = $('#search-place').val();

        //convert to coordinates
        Geocoder.geocode({
            address: city
        }, function(results, status) {

            $btn.button('reset');

            if (status == 'OK') {
                // change the map center
                mapwindow.setCenter(results[0].geometry.location);

                // remove all markers
                clearMarkers()

                // search and add tweet markers
                addTweets(city, results[0].geometry.location.lat(), results[0].geometry.location.lng());
            } else {
                console.log('Geocode was not successful for the following reason: ' + status);
                alert('Place not found!');
            }
        });

    }

    // on click search button
    $('#search-bar').submit(searchCallback);

    /**
     * Search and add tweet markers
     *
     * @param {string} city The city name
     * @param {string} lat  The city lattitude
     * @param {string} lon  The city longitude
     */
    function addTweets(city, lat, lon) {
        return window.$.get('/tweets?city=' + city + '&geo=' + lat + ',' + lon)
        .done(function(response) {
            for (var i = 0; i < response.length; i++) {
                let data = response[i];

                // only display tweets contains coordinate data
                if ( ! data.geo) {
                    continue;
                }

                // extract coordinate data
                let [lat, lon] = data.geo.coordinates;
                addMarker({
                    position: new google.maps.LatLng(lat, lon),
                    icon: data.profile_image_url_https,
                    map: mapwindow,
                    infowindowContent: 'Tweet: ' + data.text + '<br />When: ' + data.created_at
                });
            }

        })
        .fail(function() {
            alert('Place not found!');
        })
    }

    /**
     * Return all markers
     */
    function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }

        markers = [];
    }

    /**
     * Appply marker to the map
     *
     * @param {object} data The google marker options
     */
    function addMarker(data) {
        let marker = new google.maps.Marker(data);
        markers.push(marker);

        // show infowindow when marker is click
        marker.addListener('click', function () {
            infowindow.setContent(data.infowindowContent);
            infowindow.open(mapwindow, marker);
        });
    }

}
