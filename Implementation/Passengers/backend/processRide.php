<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SCSS file -->
     <link rel="stylesheet" href="../../Drivers/backend/ride/Sass/acceptRide.min.css">
</head>

</html>
<?php



if($_SERVER["REQUEST_METHOD"] == "POST") {
// Connect to the database
include 'dbConnection.php';

// Get data from the POST request and validate/sanitize it
$pickup = ($_POST['pickupLocation']);
$drop = ($_POST['dropLocation']);
$distance = ($_POST['distance']);
$fare = ($_POST['totalAmount']);
$passengerID = ($_POST['passengerID']);
$driverID = intval($_POST['driverID']);
$passengerMobile = ($_POST['mobileNum']);


// Validate input data
if (!empty($pickup) && !empty($drop) && is_numeric($distance) && is_numeric($fare) && !empty($driverID)) {
    //validte passenger login
    if(!empty($passengerID)){
    $sql = "INSERT INTO ride (pickupLocation, dropLocation, distance, fare, passengerID, driverID, rideStatus, passengerMobile) 
    VALUES ('$pickup', '$drop', $distance, $fare, '$passengerID','$driverID','Pending','$passengerMobile')";

    if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
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
                <a href="requestedRides.php"><button class="backbtn">Back</button></a>
                <br><br>
                <img src="https://www.gifcen.com/wp-content/uploads/2021/05/car-gif-7.gif" alt="" style="width: 300px; height:300px; border-radius:10px; object-fit:cover;">
            </div>
        </div>
    <?php
    } else {
    echo "Error: " . $conn->error;
    }
    }
    else
    {
        echo "You should Login to the system";
    }

 
} else {
    echo "Invalid input data. Please try again.";
}










// Close the connection
$conn->close();

}
?>