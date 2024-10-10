<?php
// Database connection
include 'dbConnection.php';

// Check if rideID is posted
if (isset($_GET['rideID'])) {
    $rideID = intval($_GET['rideID']);

    // Update the ride status to 'completed'
    $sql = "UPDATE ride SET rideStatus = 'Completed' WHERE rideID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rideID);

    if ($stmt->execute()) {
        echo "Ride completed successfully.";
    } else {
        echo "Error completing the ride.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
