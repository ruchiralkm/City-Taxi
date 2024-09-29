<?php
// Include database connection
include 'dbConnection.php';

$vehicleType = isset($_GET['filter']) ? $_GET['filter'] : '';

if (empty($vehicleType)) {
    echo "No vehicle type selected.";
    exit;
}



$sql = "SELECT driver.*, driverstatuslist.status 
        FROM driver 
        INNER JOIN driverstatuslist ON driver.driverID = driverstatuslist.driverID 
        WHERE driver.vehicle = ? 
        AND driverstatuslist.status = 'Available'";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error); // Debugging: Check if prepare failed
}

$stmt->bind_param("s", $vehicleType);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<div class="driver-list">'; // Container for driver cards
    while ($row = $result->fetch_assoc()) {
        echo '<div class="driver-item" style="border: 2px solid #ccc; padding: 20px; margin: 10px; border-radius: 10px; cursor: pointer; transition: all 0.3s ease;">';
        echo '<input type="radio" id="driver_' . htmlspecialchars($row["driverID"]) . '" name="selectedDriver" value="' . htmlspecialchars($row["driverID"]) . '">'; 
        echo '<img src="../../Drivers/backend/' . htmlspecialchars($row["profilePicture"]) . '" alt="Profile Picture" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;"><br>';
        echo '<strong>Name:</strong> ' . htmlspecialchars($row["firstName"]) . '<br>';
        echo '<strong>Mobile:</strong> ' . htmlspecialchars($row["mobile"]) . '<br>';
        echo '<strong>Vehicle:</strong> ' . htmlspecialchars($row["vehicle"]) . '<br>';
        echo '<strong>Vehicle Reg No:</strong> ' . htmlspecialchars($row["regNo"]) . '<br>';
        echo '</div><hr>';
    }
} else {
    echo "No Drivers found for this vehicle type.";
}

// Debugging: Check if result is empty
if (!$result) {
    echo "Query failed: " . $conn->error;
}



$stmt->close();
$conn->close();
?>
