<?php
// Include database connection
include '../dbConnection.php';

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
            echo "Driver's location and status updated successfully!";
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
