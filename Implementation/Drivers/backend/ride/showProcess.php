<?php
// Database connection
include '../dbConnection.php';

// Check if rideID is set in the URL
if (isset($_GET['rideID'])) {
    $rideID = htmlspecialchars($_GET['rideID']);

    // SQL query to fetch ride details based on the rideID
    $sql = "SELECT * FROM ride WHERE rideID = '$rideID'";
    $result = $conn->query($sql);

    // Check if the ride exists
    if ($result->num_rows > 0) {
        // Add a button to show the map with this rideID
        echo '<a href="mapShowLocationCus.php?rideID=' . $rideID . '">Show on Map</a>';
    } else {
        echo "Ride not found.";
    }
} else {
    echo "No ride ID provided.";
}

$conn->close();
?>
