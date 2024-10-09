// Set the access token
mapboxgl.accessToken =
  "pk.eyJ1IjoicnVjaGlyYWxrMjAwMiIsImEiOiJjbTE2bDZocmswbjBjMnZzOHFpYWhubDRyIn0.VR-eLFZQNviJBOVD_WfrmQ";

// Use Geolocation to set the user’s position
navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
  enableHighAccuracy: true,
});

// Success callback for geolocation
function successLocation(position) {
  setupMap([position.coords.longitude, position.coords.latitude]);
}

// Error callback for geolocation
function errorLocation() {
  // Default to Manchester if geolocation fails
  setupMap([-2.24, 53.48]);
}

// Set up the map and directions
function setupMap(center) {
  const map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/mapbox/streets-v11",
    center: center,
    zoom: 15,
  });

  // Add zoom and rotation controls
  const nav = new mapboxgl.NavigationControl();
  map.addControl(nav);

  // Add directions control
  const directions = new MapboxDirections({
    accessToken: mapboxgl.accessToken,
    unit: "metric",
    profile: "mapbox/driving",
  });
  map.addControl(directions, "top-left");

  // Event listener for route selection
  directions.on("route", function (event) {
    const route = event.route[0];
    const distance = route.distance / 1000; // Distance in kilometers

    // Get the pickup and drop coordinates
    const pickup = route.legs[0].steps[0].maneuver.location; // Start point
    const drop =
      route.legs[0].steps[route.legs[0].steps.length - 1].maneuver.location; // End point

      const pickupLng = pickup[0];
      const pickupLat = pickup[1];

    // Display Distance
    document.getElementById("distanceDisplay").innerText =
      distance.toFixed(2) + " km";
    calculateFare(distance);

    // Calculate and display the fare
    calculateFare(distance);

    // Store the pickup and drop locations in hidden input fields for later use
    document.getElementById("pickupLocation").value = pickup;
    document.getElementById("dropLocation").value = drop;
  });
}

// Fare calculation logic
function calculateFare(distance) {
  var totalFare;
  const baseFare = 2; // Base fare
  const fareFirst5Km = 75; // Cost per km for the first 5 km
  const fareAfter5Km = 50; // Cost per km after 5 km
  

  // Calculate the fare
  if (distance <= 5) {
    totalFare = (distance * fareFirst5Km)+baseFare;
  } else {
    totalFare = (5 * fareFirst5Km) + ((distance - 5) * fareAfter5Km)+baseFare;
  }

  document.getElementById("fareDisplay").innerText = totalFare.toFixed(2);

  // Update Hidden Inputs with Distance and Fare
  document.getElementById("distance").value = distance.toFixed(2);
  document.getElementById("fare").value = totalFare.toFixed(2);
  document.getElementById("pickupLng").value = pickupLng;
  document.getElementById("pickupLat").value = pickupLat;

}

// Book Ride on Button Click
/*
    document.getElementById('bookRideBtn').addEventListener('click', function() {
        const distance = document.getElementById('distance').value;
        const fare = document.getElementById('fare').value;
        const pickup = document.getElementById('pickupLocation').value;
        const drop = document.getElementById('dropLocation').value;

        if (distance && fare && pickup && drop) {
            // Perform AJAX Request to Book the Ride
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'book_ride.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    alert('Ride booked successfully!');
                } else {
                    alert('There was a problem booking the ride.');
                }
            };
            xhr.send(`pickup=${pickup}&drop=${drop}&distance=${distance}&fare=${fare}`);
        } else {
            alert('Please select a route first.');
        }
    });
    */
