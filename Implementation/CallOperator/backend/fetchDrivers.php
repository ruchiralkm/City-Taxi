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

//if (!$stmt) {
  //  die("Prepare failed: " . $conn->error); // Debugging: Check if prepare failed
//}

$stmt->bind_param("s", $vehicleType);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<div class="driver-list">'; // Container for driver cards
    while ($row = $result->fetch_assoc()) {
        $driverId = htmlspecialchars($row["driverID"]);
        echo '<div class="driver-item">';
        echo '<input type="radio" id="driver_' . $driverId . '" name="selectedDriver" value="' . $driverId . '">';
        echo '<label for="driver_' . $driverId . '">';
        echo '<img src="../../Drivers/backend/' . htmlspecialchars($row["profilePicture"]) . '" alt="Profile Picture">';
        echo '<p><strong>Name:</strong> ' . htmlspecialchars($row["firstName"]) . '</p>';
        echo '<p><strong>Mobile:</strong> ' . htmlspecialchars($row["mobile"]) . '</p>';
        echo '<p><strong>Vehicle:</strong> ' . htmlspecialchars($row["vehicle"]) . '</p>';
        echo '<p><strong>Vehicle Reg No:</strong> ' . htmlspecialchars($row["regNo"]) . '</p>';
        echo '<p><strong></strong><span style="color: yellow; font-size: 20px;">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>';
        echo '</label>';
        echo '</div>';
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
