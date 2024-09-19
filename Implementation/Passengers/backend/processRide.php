<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
// Connect to the database
include 'dbConnection.php';

// Get data from the POST request and validate/sanitize it
$pickup = trim($_POST['pickupLocation']);
$drop = trim($_POST['dropLocation']);
$distance = trim($_POST['distance']);
$fare = trim($_POST['fare']);

// Validate input data
if (!empty($pickup) && !empty($drop) && is_numeric($distance) && is_numeric($fare)) {
    // Prepare an SQL statement to insert ride data
    $stmt = $conn->prepare("INSERT INTO ride (pickupLocation, dropLocation, distance, fare) VALUES (?, ?, ?, ?)");

    // Bind parameters to the statement (s for string, d for double)
    $stmt->bind_param("ssdd", $pickup, $drop, $distance, $fare);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid input data. Please try again.";
}

// Close the connection
$conn->close();

}
?>
