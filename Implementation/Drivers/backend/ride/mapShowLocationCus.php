<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>City-Taxi Route Marking</title>

    <!-- Mapbox CSS and JS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" rel="stylesheet" />

    <!-- Inline CSS -->
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
      button:hover {
        background-color: #0056b3;
      }
    </style>
  </head>
  <body>
    <h1>Ride Section</h1>

    

    <!-- Map Container -->
    <div id="map"></div>

    <!-- Text Boxes for Pickup and Drop Locations -->
    <div class="form-group">
      <label for="pickupLocationText">Pickup Location:</label>
      <input type="text" id="pickupLocationText" name="pickupLocationText" readonly />
    </div>

    <div class="form-group">
      <label for="dropLocationText">Drop Location:</label>
      <input type="text" id="dropLocationText" name="dropLocationText" readonly />
    </div>

    <div class="form-group">
      <label for="distance">Distance:</label>
      <input type="text" id="distance" name="distance" readonly />
    </div>

    <div class="form-group">
      <label for="fare">Fare:</label>
      <input type="text" id="fare" name="fare" readonly />
    </div>

    <!-- Button to Mark Route -->
    <button id="markRouteBtn">Mark Route</button>

   



    <?php
    // Database connection
include '../dbConnection.php';
      // Fetch ride details for the selected ride ID
      if (isset($_GET['rideID'])) {
        $rideID = htmlspecialchars($_GET['rideID']);
    
        // SQL query to fetch ride details based on the rideID
        $sql = "SELECT * FROM ride WHERE rideID = '$rideID'";
        $result = $conn->query($sql);
    
        // Check if the ride exists
        if ($result->num_rows > 0) {
            // Fetch the ride details
            $row = $result->fetch_assoc();
            $pickupLocation = $row['pickupLocation'];
            $dropLocation = $row['dropLocation'];
            $distance = $row['distance'];
            $fare = $row['fare'];
            $passengerID = $row['passengerID'];
    
            // Add a button to show the map with this rideID
           // echo '<a href="mapShowLocationCus.php?rideID=' . $rideID . '">Show on Map</a>';
        } else {
            echo "Ride not found.";
        }
    } else {
        echo "No ride ID provided.";
    }
    $conn->close();
    ?>

     <!--Button to update the status -->
     <Form method="post" action = "acceptRide.php">
    <input type="hidden" id="rideID" name="rideID" value="<?php echo $rideID; ?>" />
    <input type="hidden" id="passengerID" name="passengerID" value="<?php echo $passengerID; ?>" />
    <button id="acceptRideBtn" name="acceptRideBtn" >Accept Ride</button>
    </form>

    <Form method="post" action = "rejectRide.php">
    <input type="hidden" id="rideID" name="rideID" value="<?php echo $rideID; ?>" />
    <input type="hidden" id="passengerID" name="passengerID" value="<?php echo $passengerID; ?>" />
    <button id="rejectRideBtn" name="rejectRideBtn" >Reject Ride</button>
    </form>

    <!-- JavaScript for Mapbox Integration -->
    <script>
      // Mapbox Access Token
      mapboxgl.accessToken = "pk.eyJ1IjoicnVjaGlyYWxrMjAwMiIsImEiOiJjbTE2bDZocmswbjBjMnZzOHFpYWhubDRyIn0.VR-eLFZQNviJBOVD_WfrmQ";

      // Coordinates and ride data from the backend (PHP)
      const pickupCoords = [<?php echo $pickupLocation; ?>]; // Pickup coordinates
      const dropCoords = [<?php echo $dropLocation; ?>]; // Drop coordinates
      const distance = <?php echo $distance; ?>; // Distance in km
      const fare = <?php echo $fare; ?>; // Fare in LKR

      // Initialize the map
      const map = new mapboxgl.Map({
        container: "map", // Map container ID
        style: "mapbox://styles/mapbox/streets-v11", // Map style
        center: pickupCoords, // Initial map center (pickup location)
        zoom: 12, // Zoom level
      });

      // Add markers for pickup and drop locations
      new mapboxgl.Marker({ color: 'green' }).setLngLat(pickupCoords).addTo(map);
      new mapboxgl.Marker({ color: 'red' }).setLngLat(dropCoords).addTo(map);

      // Initialize directions plugin (hidden initially)
      const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',
        profile: 'mapbox/driving',
      });

      // Event listener for "Mark Route" button
      document.getElementById("markRouteBtn").addEventListener("click", function () {
        // Add the directions control to the map
        map.addControl(directions, "top-left");

        // Set pickup and drop points for route calculation
        directions.setOrigin(pickupCoords);
        directions.setDestination(dropCoords);

        // Display coordinates and ride details in text fields
        document.getElementById("pickupLocationText").value = `Lat: ${pickupCoords[1]}, Lng: ${pickupCoords[0]}`;
        document.getElementById("dropLocationText").value = `Lat: ${dropCoords[1]}, Lng: ${dropCoords[0]}`;
        document.getElementById("distance").value = distance + " km";
        document.getElementById("fare").value = fare + " LKR";
      });
    </script>
  </body>
</html>
