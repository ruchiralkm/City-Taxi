<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Drivers/backend/ride/Sass/acceptRide.min.css">
</head>
<body>
    
</body>
</html>
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
            // echo "Ride booked successfully!";

            ?>

            <!--=== Correct Content ===-->
                <!--* hero section *-->
                <div class="conn">
                
                    <div class="container">
                    <br><br><br><br><br><br><br><br><br><br>
                        <div class="header">
                            <img
                                src="https://img.icons8.com/?size=100&id=a4l6bA9mSmBh&format=png&color=40C057"
                                alt="Checkmark"
                                class="checkmark"
                            />
                            <h1>Your successfully booked your ride</h1>
                        </div>
                        <p>
                            Your successfully booked your ride. Now you can connect with driver.
                        </p>
                        <br />
                        <a href="CalloperatorRide.php"><button class="backbtn">Back</button></a>
                        <br><br>
                        <img src="https://www.gifcen.com/wp-content/uploads/2021/05/car-gif-7.gif" alt="" style="width: 300px; height:300px; border-radius:10px; object-fit:cover;">
                    </div>
                </div>
            <?php

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
