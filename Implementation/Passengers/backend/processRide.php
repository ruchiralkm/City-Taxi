<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
// Connect to the database
include 'dbConnection.php';

// Get data from the POST request and validate/sanitize it
$pickup = ($_POST['pickupLocation']);
$drop = ($_POST['dropLocation']);
$distance = ($_POST['distance']);
$fare = ($_POST['fare']);
$passengerID = ($_POST['passengerID']);

// Validate input data
if (!empty($pickup) && !empty($drop) && is_numeric($distance) && is_numeric($fare)) {
    // Prepare an SQL statement to insert ride data
    $stmt = $conn->prepare("INSERT INTO ride (pickupLocation, dropLocation, distance, fare,passengerID) VALUES (?, ?, ?, ?,?)");

    // Bind parameters to the statement (s for string, d for double)
    $stmt->bind_param("ssdds", $pickup, $drop, $distance, $fare,$passengerID);

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
