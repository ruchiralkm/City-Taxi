<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SCSS file -->
    <link rel="stylesheet" href="ride/Sass/acceptRide.min.css">
</head>

</html>
<?php
// Include database connection
include 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $driverID = $_POST['driverID'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $status = $_POST['status'];

    // Check if the driverID already exists in the table
    $checkSql = "SELECT * FROM driverStatusList WHERE driverId = '$driverID'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        
        $updateSql = "UPDATE driverStatusList 
                      SET latitude = '$latitude', longitude = '$longitude', status = '$status', updatedAt = NOW() 
                      WHERE driverId = '$driverID'";
        
        if ($conn->query($updateSql) === TRUE) {
            // echo "Driver's location and status updated successfully!";
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
                                <h1>Your successfully set the status</h1>
                            </div>
                            <p>
                                You are successfully change your driver status.
                            </p>
                            <br />
                            <a href="statusDriver.php"><button class="backbtn">Back</button></a>
                            <br><br>
                            <img src="https://www.gifcen.com/wp-content/uploads/2021/05/car-gif-7.gif" alt="" style="width: 300px; height:300px; border-radius:10px; object-fit:cover;">
                        </div>
                    </div>
            <?php
        } else {
            echo "Error updating driver's location: " . $conn->error;
        }
    } else {
        
        $insertSql = "INSERT INTO driverStatusList (driverId, latitude, longitude, status, updatedAt) 
                      VALUES ('$driverID', '$latitude', '$longitude', '$status', NOW())";

        if ($conn->query($insertSql) === TRUE) {
            echo "Driver's location and status inserted successfully!";
        } else {
            echo "Error inserting driver's location: " . $conn->error;
        }
    }
}
?>
