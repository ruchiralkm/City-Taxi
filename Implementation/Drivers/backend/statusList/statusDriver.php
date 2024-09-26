<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Driver Location</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />
    <style>
        body { font-family: Arial, sans-serif; }
        #map { width: 100%; height: 400px; margin-bottom: 20px; }
        form { max-width: 600px; margin: 0 auto; }
        label { display: block; margin-bottom: 8px; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 8px; margin-bottom: 16px; }
        input[type="submit"] { padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
    </style>
</head>
<body>

<h2>Update Driver Location</h2>

<!-- Map Container -->
<div id="map"></div>

<!-- Form -->
<form method="POST" action="driverStatusUpdate.php">
    <label for="driver_id">Driver ID:</label>
    <input type="number" id="driverID" name="driverID" required 
        value="<?php session_start(); if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { echo htmlspecialchars($_SESSION['driverID']); } ?>">
  
    <label for="latitude">Latitude:</label>
    <input type="text" id="latitude" name="latitude" readonly required>

    <label for="longitude">Longitude:</label>
    <input type="text" id="longitude" name="longitude" readonly required>

    <label for="status">Status:</label>
    <select id="status" name="status">
        <option value="available">Available</option>
        <option value="not_available">Busy</option>
    </select>

    <input type="submit" value="Update Location">
</form>

<script>
// Initialize Mapbox
mapboxgl.accessToken = "pk.eyJ1IjoicnVjaGlyYWxrMjAwMiIsImEiOiJjbTE2bDZocmswbjBjMnZzOHFpYWhubDRyIn0.VR-eLFZQNviJBOVD_WfrmQ";  // Replace with your Mapbox access token
const map = new mapboxgl.Map({
    container: 'map', // ID of the map container
    style: 'mapbox://styles/mapbox/streets-v11', // Map style
    center: [79.861244, 6.927079], // Starting position [longitude, latitude] (Colombo, Sri Lanka)
    zoom: 12 // Starting zoom level
});

// Automatically collect user's current location
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        // Update form fields with the current location
        document.getElementById('latitude').value = latitude;
        document.getElementById('longitude').value = longitude;

        // Center the map on the current location
        map.setCenter([longitude, latitude]);

        // Add a marker at the current location
        new mapboxgl.Marker().setLngLat([longitude, latitude]).addTo(map);
    }, function() {
        alert('Unable to retrieve your location.');
    });
} else {
    alert('Geolocation is not supported by your browser.');
}

// Add click event to map to select location manually
map.on('click', function (e) {
    const latitude = e.lngLat.lat;
    const longitude = e.lngLat.lng;

    // Update form fields with clicked location
    document.getElementById('latitude').value = latitude;
    document.getElementById('longitude').value = longitude;

    // Add a marker to the map at the clicked location
    new mapboxgl.Marker().setLngLat([longitude, latitude]).addTo(map);
});

</script>

</body>
</html>
