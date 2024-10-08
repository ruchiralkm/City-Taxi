<?php
// Database connection
include 'dbConnection.php';

// Handle form submission
if (isset($_POST['submit'])) {
    // Get passenger details
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobileNumber = $_POST['mobileNumber'];

    // Insert passenger data into unregpassengers table using a prepared statement
    $stmtPassenger = $conn->prepare("INSERT INTO unregpassengers (firstName, lastName, mobilenumber) VALUES (?, ?, ?)");
    $stmtPassenger->bind_param("sss", $firstName, $lastName, $mobileNumber);

    if ($stmtPassenger->execute()) {
        // Get the inserted passenger ID
        $passengerID = $stmtPassenger->insert_id;

        // Get ride details
        $pickupLocation = $_POST['pickupLocation'];
        $dropLocation = $_POST['dropLocation'];
        $distance = floatval($_POST['distance']);
        $fare = floatval($_POST['totalAmount']);
        $driverID = intval($_POST['driverID']);
        $rideStatus = "Pending";
        $passengerType = "Unregistered";

        // Insert ride data into the ride table using a prepared statement
        $stmtRide = $conn->prepare("INSERT INTO ride (pickupLocation, dropLocation, distance, fare, passengerID, driverID, rideStatus, passengertype, passengerMobile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmtRide->bind_param("ssddiisss", $pickupLocation, $dropLocation, $distance, $fare, $passengerID, $driverID, $rideStatus, $passengerType, $mobileNumber);

        if ($stmtRide->execute()) {
            echo "Ride booked successfully!";
        } else {
            echo "Error: " . $stmtRide->error;
        }
    } else {
        echo "Error: " . $stmtPassenger->error;
    }
} else {
    echo "Error: Form not submitted.";
}

// Close the connection
$conn->close();
?>
