mapboxgl.accessToken = "pk.eyJ1IjoicnVjaGlyYWxrMjAwMiIsImEiOiJjbTE2bDZocmswbjBjMnZzOHFpYWhubDRyIn0.VR-eLFZQNviJBOVD_WfrmQ";


navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
  enableHighAccuracy: true,
});

function successLocation(position) {
  setupMap([position.coords.longitude, position.coords.latitude]);
}

function errorLocation() {
  setupMap([-2.24, 53.48]); // Default location if geolocation fails
}

function setupMap(center) {
  const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: center,
    zoom: 15,
  });

  const nav = new mapboxgl.NavigationControl();
  map.addControl(nav);

  var directions = new MapboxDirections({
    accessToken: mapboxgl.accessToken,
    unit: 'metric',
    profile: 'mapbox/driving',
  });

  map.addControl(directions, 'top-left');

  // Event listener to capture the starting and destination locations
  directions.on('route', function(e) {
    var startLocation = e.route[0].legs[0].summary.start;
    var destination = e.route[0].legs[0].summary.end;

    document.getElementById('pickup').value = startLocation;
    document.getElementById('dropoff').value = destination;
  });
}
