<?php
include('dbConnection.php'); // Include database connection
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $passengerID = htmlspecialchars($_SESSION['passengerID']);
} else {
    echo 'Please login to view notifications.';
    exit;
}

// SQL query for fetching ongoing rides for the logged-in passenger
$query = "
SELECT 
    r.rideID, 
    r.pickupLocation, 
    r.dropLocation, 
    r.fare, 
    r.distance, 
    d.firstName, 
    d.lastName, 
    d.vehicle, 
    d.regNo, 
    d.mobile
FROM 
    ride r
INNER JOIN 
    driver d ON r.driverID = d.driverID
WHERE 
    r.passengerID = ? 
AND 
    r.rideStatus = 'Accepted'";

// Prepare and execute the statement
if ($stmt = $conn->prepare($query)) {
    // Bind the parameter (passengerID)
    $stmt->bind_param("i", $passengerID);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Initialize an array to store ongoing rides
    $ongoingRides = [];
    
    // Fetch the results and populate the array
    while ($row = $result->fetch_assoc()) {
        $ongoingRides[] = $row;
    }
    
    // Return the ongoing rides data as JSON
    echo json_encode($ongoingRides);
    
    // Close the statement
    $stmt->close();
} else {
    // If there's an error with preparing the query, display the error message
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
