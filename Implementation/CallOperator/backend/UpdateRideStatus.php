<?php
include('dbConnection.php');

if (isset($_POST['completeRide'])) {
    $rideID = $_POST['rideID'];

    // Update query to set the ride status as 'Completed'
    $updateQuery = "UPDATE ride SET rideStatus = 'Completed' WHERE rideID = ?";
    $stmt = $conn->prepare($updateQuery);

    if ($stmt) {
        $stmt->bind_param("i", $rideID);
        if ($stmt->execute()) {
            echo "Ride status updated successfully.";
        } else {
            echo "Error updating ride status.";
        }
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $conn->error;
    }

   
}

if (isset($_POST['cancelRide'])) {
    // Get the ride ID from the form
    $rideID = $_POST['rideID'];
    
    // Update the ride status to 'Canceled'
    $updateQuery = "UPDATE ride SET rideStatus = 'Canceled' WHERE rideID = ?";
    
    // Prepare and execute the update statement
    if ($stmt = $conn->prepare($updateQuery)) {
        $stmt->bind_param("i", $rideID);
        $stmt->execute();
        
        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            // Redirect back to the page with success message
            header("Location: CalloperatorRide.php?status=success");
        } else {
            echo "Error: Ride status could not be updated.";
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();

?>
