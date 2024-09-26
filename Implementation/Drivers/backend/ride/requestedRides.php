<?php
// Database connection
include '../dbConnection.php';

// Assuming you have a session started for the driver
session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $driverID = htmlspecialchars($_SESSION['driverID']);
} else {
    echo 'Please login to the system.';
    exit;
}
// SQL query to select all rides by driver ID
$sql = "SELECT * FROM ride WHERE driverID = '$driverID'";
$result = $conn->query($sql);

// List ride requests
if ($result->num_rows > 0) {
    echo '<form method="GET" action="showProcess.php">  '; // Form to submit rideID

    echo '<div class="ride-request-list">'; // Container for ride request cards

    // Loop through the results
    while ($row = $result->fetch_assoc()) {
        echo '<div class="ride-request-item" style="border: 1px solid #ccc; padding: 10px; margin: 10px; border-radius: 5px;">';
        echo '<input type="radio" name="rideID" value="' . htmlspecialchars($row["rideID"]) . '">'; // Radio button for ride selection
        echo '<strong>Ride ID:</strong> ' . htmlspecialchars($row["rideID"]) . '<br>';
        echo '<strong>Pickup Location:</strong> ' . htmlspecialchars($row["pickupLocation"]) . '<br>';
        echo '<strong>Drop Location:</strong> ' . htmlspecialchars($row["dropLocation"]) . '<br>';
        echo '<strong>Distance:</strong> ' . htmlspecialchars($row["distance"]) . ' km<br>';
        echo '<strong>Requested At:</strong> ' . htmlspecialchars($row["requestAt"]) . '<br>';
        
        echo '</div><hr>';
    }

    echo '<button type="submit">Select Ride</button>'; // Submit button
    //echo '<a href="mapShowLocationCus.php?rideID=' . $rideID . '">Show on Map</a>';
    echo '</div>'; // Close the ride request list container
    echo '</form>';
} else {
    echo "No rides found for this driver.";
}
?>
