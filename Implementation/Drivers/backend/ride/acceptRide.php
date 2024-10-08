<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Sass/acceptRide.min.css">
</head>
</html>
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

if (isset($_POST['acceptRideBtn'])) {
    // Get the ride ID from the form submission
    if (isset($_POST['rideID'])) {
        $rideID = htmlspecialchars($_POST['rideID']);
        
        // Update the status of the ride in the database
        $sql = "UPDATE ride SET rideStatus = 'Accepted' WHERE rideID = '$rideID'";
        $sqlDriverStatus = "UPDATE driverstatuslist SET status = 'Busy', updatedAt = CURRENT_TIMESTAMP where driverID = '$driverID'";
        if ($conn->query($sqlDriverStatus) === TRUE) {
            // echo "Driver is in busy mood!";
        } else {
            echo "Error inserting driver's status: " . $conn->error;
        }
        
        if ($conn->query($sql) === TRUE) {
            // echo "Ride accepted successfully.";
            // Fetch the driver details based on driverID
            $queryDriver = "SELECT regNo, firstName, lastName FROM driver WHERE driverID = $driverID";
            $resultDriver = $conn->query($queryDriver);

            if ($resultDriver->num_rows > 0) {
                $rowDriver = $resultDriver->fetch_assoc();
                $regNo = $rowDriver['regNo'];
                $driverFirstName = $rowDriver['firstName'];
                $driverLastName = $rowDriver['lastName'];
            } else {
                echo "No driver found with the given driverID.<br>";
                exit;
            }
            
            // Notify the passenger
            // Fetch the passenger details based on the ride ID
            if (isset($_POST['passengerID'])) {
                $passengerID = htmlspecialchars($_POST['passengerID']);
                
                // Insert a notification for the passenger
                $notification_message = "Your ride with ID " . $rideID . " has been accepted by".$driverFirstName ." with the vehicle No ".$regNo.".";
                $recipientType = 'passenger'; // Set the recipient type
                $status = 0; 
                
                $sql_notify = "INSERT INTO notifications (recipientType, recipientID, Message, status, timeStamp) 
                               VALUES ('$recipientType', '$passengerID', '$notification_message', '$status', CURRENT_TIMESTAMP)";
                  
                if ($conn->query($sql_notify) === TRUE) {
                        
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
                                <h1>Your successfully accepted ride</h1>
                            </div>
                            <p>
                                Your passenger's ride is currently being processed. Now you can connect with passenger
                            </p>
                            <br />
                            <a href="requestedRides.php"><button class="backbtn">Back</button></a>
                            <?php echo '<a href="mapShowLocationCus.php?rideID=' . $rideID . '"><button class="loginbtn">Show Map</button></a>';?>
                            <br><br>
                            <img src="https://www.gifcen.com/wp-content/uploads/2021/05/car-gif-7.gif" alt="" style="width: 300px; height:300px; border-radius:10px; object-fit:cover;">
                        </div>
                    </div>
                   

                    <?php
//********************// include 'SMS.php';
                } else {
                    echo "Error: " . $sql_notify . "<br>" . $conn->error;
                }
            } else {
                // echo "Passenger not found.";
                ?>
                <!--=== InCorrect Content ===-->
                <!--* hero section *-->
                <div class="conn">
                <div class="container">
                    <div class="header">
                    <img
                        src="https://img.icons8.com/?size=100&id=XMIQOqKWWnuu&format=png&color=FA5252"
                        alt="Checkmark"
                        class="checkmark"
                    />
                    <h1>Somthing went a wrong</h1>
                    </div>
                    <p>
                    Passenger's ride is not assigned. Please go back to the menu
                    </p>
                    <br />
                    <a href="requestedRides.php"><button class="backbtn">Back</button></a>
                </div>
                </div>

                <?php
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
