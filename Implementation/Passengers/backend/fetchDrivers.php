<?php
// Include database connection
include 'dbConnection.php';

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$vehicleType = isset($_GET['filter']) ? $_GET['filter'] : '';

if (empty($vehicleType)) {
    echo "No vehicle type selected.";
    exit;
}

// Debugging - Check the vehicle type value
// Remove this after debugging
echo "Vehicle Type: " . htmlspecialchars($vehicleType) . "<br>";

$sql = "SELECT * FROM driver WHERE vehicle = ?";
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
        echo '<div class="driver-item" onclick="selectDriver(this)" style="cursor: pointer;">';
        echo '<input type="radio" id="driver_' . htmlspecialchars($row["driverID"]) . '" name="selectedDriver" value="' . htmlspecialchars($row["driverID"]) . '" style="display:none;">'; 
        echo '<img src="https://cdn.aarp.net/content/dam/aarp/auto/2021/03/1140-man-driving-a-car.imgcache.revf9c4f44f3b585ea7b920f79e4f144bd6.jpg" style="width:100px; height:100px" alt="Driver Image">'; // Replace with dynamic image paths
        echo '<p><strong>' . htmlspecialchars($row["firstName"]) . '</strong></p>';
        echo '<p><i class="fas fa-phone"></i> ' . htmlspecialchars($row["mobile"]) . '</p>';
        echo '<p><i class="fas fa-car"></i> ' . htmlspecialchars($row["vehicle"]) . '</p>';
        echo '<p>LKR 200</p>';  // Replace with dynamic price if needed
        echo '</div>';
    }
    echo '</div>';
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
