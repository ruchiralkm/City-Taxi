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
        // Fetch the ride details
        $row = $result->fetch_assoc();
        $pickupLocation = $row['pickupLocation'];
        $dropLocation = $row['dropLocation'];
        $distance = $row['distance'];
        $fare = $row['fare'];

        // Display ride details
     //   echo "<h1>Ride Details</h1>";
      //  echo "<p><strong>Pickup Location:</strong> $pickupLocation</p>";
      //  echo "<p><strong>Drop Location:</strong> $dropLocation</p>";
      //  echo "<p><strong>Distance:</strong> $distance km</p>";
      //  echo "<p><strong>Fare:</strong> $fare</p>";

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
