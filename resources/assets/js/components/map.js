
let mapwindow;
window.initMap = function () {
    mapwindow = new google.maps.Map(document.getElementById('mapdata'), {
        zoom: 16,
        center: new google.maps.LatLng(15.079409, 120.619989),
        mapTypeId: 'roadmap'
    });
}
