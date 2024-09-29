<?php
// Database connection
include 'dbConnection.php';
// Passenger ID (you can get it from session or passed parameter)
$passengerID = $_SESSION['passengerID']; // Example

// Fetch ongoing accepted ride
$sql = "SELECT * FROM rides 
        WHERE passengerID= ? AND rideStatus = 'Accepted' LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $passengerID);
$stmt->execute();
$result = $stmt->get_result();
$ride = $result->fetch_assoc();

echo json_encode($ride);
?>
