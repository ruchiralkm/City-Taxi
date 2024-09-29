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
$driverID = intval($_POST['driverID']);
$passengerMobile = ($_POST['mobileNum']);

// Validate input data
if (!empty($pickup) && !empty($drop) && is_numeric($distance) && is_numeric($fare) && !empty($driverID)) {
    //validte passenger login
    if(!empty($passengerID)){
    $sql = "INSERT INTO ride (pickupLocation, dropLocation, distance, fare, passengerID, driverID, rideStatus, passengerMobile) 
    VALUES ('$pickup', '$drop', $distance, $fare, '$passengerID','$driverID','Pending','$passengerMobile')";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
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