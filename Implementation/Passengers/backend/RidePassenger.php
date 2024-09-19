<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
      rel="stylesheet"
    />
    
    <!-- ===== SCSS File ===== -->
    <link rel="stylesheet" href="#" />

    <!--font awesome(for icons)-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

<!--Linking map mapbox-->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" rel="stylesheet">
    <style>
        #map {
            height: 500px;
            width: 100%;
        }

        #fareDetails {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>

    <!-- title section -->
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi</title>
  </head>
  <body>
    <!-- Navigation Bar -->
    <?php include 'NavBarPassenger.php'; ?>

    <h1>Ride Section</h1>

    <!-- Map Container -->
<div id="map"></div>
 <!-- Ride Booking Form -->
 <form action="processRide.php" method="post" id="rideForm">
        <div id="fareDetails">
            <p><strong>Distance:</strong> <span id="distanceDisplay"></span></p>
            <p><strong>Fare:</strong> $<span id="fareDisplay"></span></p>

            <!-- Hidden Inputs to Store Ride Details -->
            <input type="hidden" id="distance" name="distance">
            <input type="hidden" id="fare" name="fare">
            <input type="hidden" id="pickupLocation" name="pickupLocation">
            <input type="hidden" id="dropLocation" name="dropLocation">

            <button type="submit" id="bookRideBtn">Book Ride</button>
        </div>
    </form>
<script>
    // Set the access token
    mapboxgl.accessToken = "pk.eyJ1IjoicnVjaGlyYWxrMjAwMiIsImEiOiJjbTE2bDZocmswbjBjMnZzOHFpYWhubDRyIn0.VR-eLFZQNviJBOVD_WfrmQ";
    
    // Use Geolocation to set the user’s position
    navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
        enableHighAccuracy: true
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
            zoom: 15
        });
    
        // Add zoom and rotation controls
        const nav = new mapboxgl.NavigationControl();
        map.addControl(nav);
    
        // Add directions control
        const directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken,
            unit: 'metric',
            profile: 'mapbox/driving'
        });
        map.addControl(directions, "top-left");
    
        // Event listener for route selection
        directions.on('route', function(event) {
            const route = event.route[0];
            const distance = route.distance / 1000; // Distance in kilometers
    
            // Get the pickup and drop coordinates
            const pickup = route.legs[0].steps[0].maneuver.location; // Start point
            const drop = route.legs[0].steps[route.legs[0].steps.length - 1].maneuver.location; // End point
    
             // Display Distance 
             document.getElementById('distanceDisplay').innerText = distance.toFixed(2) + " km";
                calculateFare(distance);

            // Calculate and display the fare
            calculateFare(distance);
    
            // Store the pickup and drop locations in hidden input fields for later use
            document.getElementById('pickupLocation').value = pickup;
            document.getElementById('dropLocation').value = drop;
        });
    }
    
    // Fare calculation logic
    function calculateFare(distance) {
        const baseFare = 2; // Base fare
        const costPerKm = 1; // Cost per kilometer
        const totalFare = baseFare + (costPerKm * distance);
       
        document.getElementById('fareDisplay').innerText = totalFare.toFixed(2);

        // Update Hidden Inputs with Distance and Fare
        document.getElementById('distance').value = distance.toFixed(2);
            document.getElementById('fare').value = totalFare.toFixed(2);
 
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
    

    

    <!--===== MAIN JS =====-->
    <script src="Js/main.js"></script>
  </body>
</html>


