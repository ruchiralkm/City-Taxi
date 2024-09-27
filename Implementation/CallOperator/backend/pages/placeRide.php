<?php
// Database connection
include 'dbConnection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get passenger details
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobileNumber = $_POST['mobileNumber'];

    // Insert passenger data into unregpassengers table
    $sql = "INSERT INTO unregpassengers (firstName, lastName, mobilenumber) 
            VALUES ('$firstName', '$lastName', '$mobileNumber')";
    
    if ($conn->query($sql) === TRUE) {
        // Get the inserted passenger ID
        $passengerID = $conn->insert_id;

        // Get ride details (assuming form has pickupLocation, dropLocation, distance, fare, driverID)
        $pickupLocation = $_POST['pickupLocation'];
        $dropLocation = $_POST['dropLocation'];
        $distance = $_POST['distance'];
        $fare = $_POST['fare'];
        $driverID = $_POST['driverID'];
        $rideStatus = "Pending"; 
        $passengerType = "Unregistered";

        // Insert ride data into the ride table
        $sql = "INSERT INTO ride (pickupLocation, dropLocation, distance, fare, passengerID, driverID, rideStatus, passengerType)
                VALUES ('$pickupLocation', '$dropLocation', '$distance', '$fare', '$passengerID', '$driverID', '$rideStatus', '$passengerType')";

        if ($conn->query($sql) === TRUE) {
            echo "Ride booked successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
