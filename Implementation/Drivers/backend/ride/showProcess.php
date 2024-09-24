<?php
// Database connection
include '../dbConnection.php';

// SQL query to fetch pickup and drop location
$sql = "SELECT * FROM ride WHERE rideID = 8"; // Adjust the WHERE clause as needed
$result = $conn->query($sql);

// Check if results are found
if ($result->num_rows > 0) {
    // Fetch the locations
    $row = $result->fetch_assoc();
    $pickupLocation = $row['pickupLocation'];
    $dropLocation = $row['dropLocation'];
    $distance = $row['distance'];
    $fare = $row['fare'];
} else {
    echo "0 results";
}
$conn->close();
?>
