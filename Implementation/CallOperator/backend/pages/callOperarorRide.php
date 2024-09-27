<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>City-Taxi</title>

    <!-- ===== SCSS File ===== -->
    <link rel="stylesheet" href="Sass/callOperarorRide.min.css" />

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />

        <!-- Linking MapBox -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" rel="stylesheet">

  </head>
  <body>
  <h4>Book Ride</h4>
    <div class="content">
   
      <!-- Left Section -->
      <div class="left">
        <!-- Form -->
        <form method="POST" action="#">
          <div class="name-row">
              <div class="form-group half-width">
                  <label for="firstName">First Name</label>
                  <input type="text" id="firstName" name="firstName" required>
              </div>
              <div class="form-group half-width">
                  <label for="lastName">Last Name</label>
                  <input type="text" id="lastName" name="lastName" required>
              </div>
          </div>

          <div class="form-group">
              <label for="latitude">Mobile Number</label>
              <input type="text" id="latitude" name="latitude" required>
          </div>

          <div class="form-group">
              <label for="status">Vehicles</label>
              <select id="status" name="#">
                  <option value="available">Bike</option>
                  <option value="not_available">Threeweel</option>
                  <option value="not_available">Car</option>
                  <option value="not_available">Van</option>
              </select>
          </div>

          <div class="form-group">
              <label for="status">Drivers</label>
              <select id="status" name="status">
                  <option value="available">Daniel Brayan</option>
                  <option value="not_available">Tahani Hareeth</option>
              </select>
          </div>

          <input type="submit" value="Book Ride">
      </form>

        <h3 class="distance">Distance : 55 KM</h3>
        <h3 class="totalPrice">Total Price : LKR 3500</h3>

      </div>



      <!-- Right Section -->
      <div class="right">
        <!-- Map Container -->
        <div id="map"></div>
    
          <script>
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
                totalFare = distance * fareFirst5Km + baseFare;
              } else {
                totalFare = 5 * fareFirst5Km + (distance - 5) * fareAfter5Km + baseFare;
              }

              document.getElementById("fareDisplay").innerText = totalFare.toFixed(2);

              // Update Hidden Inputs with Distance and Fare
              document.getElementById("distance").value = distance.toFixed(2);
              document.getElementById("fare").value = totalFare.toFixed(2);
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

          </script>

      </div>
    </div>

  </body>
</html>
