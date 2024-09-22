<?php
// Database connection
include 'connectiondb.php';

// SQL query to fetch pickup and drop location
$sql = "SELECT pickupLocation, dropLocation FROM ride WHERE id = 7"; // Adjust the WHERE clause as needed
$result = $conn->query($sql);

// Check if results are found
if ($result->num_rows > 0) {
    // Fetch the locations
    $row = $result->fetch_assoc();
    $pickupLocation = $row['pickupLocation'];
    $dropLocation = $row['dropLocation'];
} else {
    echo "0 results";
}
$conn->close();
?>
