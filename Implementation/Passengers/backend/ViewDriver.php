<?php

// Include database connection
include 'dbConnection.php';

// Get the driverID from the URL
$driverID = isset($_GET['driverID']) ? intval($_GET['driverID']) : 0;

if ($driverID > 0) {
    // SQL query to get driver details by driverID
    $sql = "SELECT * FROM driver WHERE driverID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $driverID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $driver = $result->fetch_assoc();
        // Display driver details
        echo "<h1>Driver Details</h1>";
        echo "<p><strong>Name:</strong> " . htmlspecialchars($driver["firstName"]) . "</p>";
        echo "<p><strong>Mobile:</strong> " . htmlspecialchars($driver["mobile"]) . "</p>";
        echo "<p><strong>Vehicle:</strong> " . htmlspecialchars($driver["vehicle"]) . "</p>";
        echo "<p><strong>Vehicle Reg No:</strong> " . htmlspecialchars($driver["regNo"]) . "</p>";
        // Other details...
    } else {
        echo "Driver not found.";
    }

    $stmt->close();
} else {
    echo "No driver selected.";
}

$conn->close();
?>



