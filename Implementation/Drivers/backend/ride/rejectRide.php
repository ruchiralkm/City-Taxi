<?php
// Include the database connection
include '../dbConnection.php';

session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $driverID = htmlspecialchars($_SESSION['driverID']);
} else {
    echo 'Please login to the system.';
    exit;
}

if (isset($_POST['rejectRideBtn'])) {
    // Get the ride ID from the form submission
    if (isset($_POST['rideID'])) {
        $rideID = htmlspecialchars($_POST['rideID']);
        
        // Update the status of the ride in the database
        $sql = "UPDATE ride SET rideStatus = 'Rejected' WHERE rideID = '$rideID'";
        $sqlDriverStatus = "UPDATE driverstatuslist SET status = 'Available', updatedAt = CURRENT_TIMESTAMP where driverID = '$driverID'";
        if ($conn->query($sqlDriverStatus) === TRUE) {
            echo "Driver is available!";
        } else {
            echo "Error updating driver's status: " . $conn->error;
        }
        
        if ($conn->query($sql) === TRUE) {
            echo "Ride rejected successfully.";
            
            // Notify the passenger
            // Fetch the passenger details based on the ride ID
            if (isset($_POST['passengerID'])) {
                $passengerID = htmlspecialchars($_POST['passengerID']);
                
                // Insert a notification for the passenger
                $notification_message = "Your ride with ID " . $rideID . " has been rejected.";
                $recipientType = 'passenger'; // Set the recipient type
                $status = 0; // Assuming 0 means unread
                
                $sql_notify = "INSERT INTO notifications (recipientType, recipientID, Message, status, timeStamp) 
                               VALUES ('$recipientType', '$passengerID', '$notification_message', '$status', CURRENT_TIMESTAMP)";
                
                if ($conn->query($sql_notify) === TRUE) {
                    echo "Notification sent to the passenger.";
                } else {
                    echo "Error: " . $sql_notify . "<br>" . $conn->error;
                }
            } else {
                echo "Passenger not found.";
            }
        } else {
            echo "Error updating ride status: " . $conn->error;
        }
    } else {
        echo "No ride ID provided.";
    }
}

$conn->close();
?>
