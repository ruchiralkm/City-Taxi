<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" rel="stylesheet">
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .form-group {
            margin: 20px 0;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
    <title>City-Taxi Route Marking</title>
  </head>
  <body>

    <h1>Ride Section</h1>

    <!-- Map Container -->
    <div id="map"></div>

    <!-- Text Boxes for Pickup and Drop Locations -->
    <div class="form-group">
      <label for="pickupLocationText">Pickup Location:</label>
      <input type="text" id="pickupLocationText" name="pickupLocationText" readonly>
    </div>

    <div class="form-group">
      <label for="dropLocationText">Drop Location:</label>
      <input type="text" id="dropLocationText" name="dropLocationText" readonly>
    </div>

    <!-- Button to Mark Route -->
    <button id="markRouteBtn">Mark Route</button>

    <?php
      // Include the PHP backend to retrieve coordinates from the database
      include 'showProcess.php'; // This file should fetch $pickupLocation and $dropLocation from the database
    ?>

    <script>
      // Mapbox Access Token
      mapboxgl.accessToken = "pk.eyJ1IjoicnVjaGlyYWxrMjAwMiIsImEiOiJjbTE2bDZocmswbjBjMnZzOHFpYWhubDRyIn0.VR-eLFZQNviJBOVD_WfrmQ";
    
      // Coordinates retrieved from the database (from your PHP script)
      const pickupCoords = [<?php echo $pickupLocation; ?>]; // Example: [79.8504201049708, 6.93305360305348]
      const dropCoords = [<?php echo $dropLocation; ?>]; 

      // Initialize the map
      const map = new mapboxgl.Map({
          container: "map",
          style: "mapbox://styles/mapbox/streets-v11",
          center: pickupCoords, // Center on the pickup location
          zoom: 12
      });

      // Create markers for pickup and drop locations
      const pickupMarker = new mapboxgl.Marker()
          .setLngLat(pickupCoords)
          .addTo(map);
      const dropMarker = new mapboxgl.Marker()
          .setLngLat(dropCoords)
          .addTo(map);

      // Add Mapbox Directions control but keep it hidden initially
      const directions = new MapboxDirections({
          accessToken: mapboxgl.accessToken,
          unit: 'metric',
          profile: 'mapbox/driving'
      });

      // Add event listener for "Mark Route" button
      document.getElementById('markRouteBtn').addEventListener('click', function() {
          // Add the directions control to the map
          map.addControl(directions, "top-left");

          // Set the pickup and drop points
          directions.setOrigin(pickupCoords);  // Set the starting point
          directions.setDestination(dropCoords);  // Set the destination

          // Show coordinates in textboxes
          document.getElementById('pickupLocationText').value = 'Lat: ' + pickupCoords[1] + ', Lng: ' + pickupCoords[0];
          document.getElementById('dropLocationText').value = 'Lat: ' + dropCoords[1] + ', Lng: ' + dropCoords[0];
      });

    </script>

  </body>
</html>
