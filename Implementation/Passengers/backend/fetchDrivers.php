<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .viewDriverBtn{
            padding: 5px;
            border: none;
            background: none;
            cursor: pointer;
        }
        .viewDriverBtn img{
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php
// Include database connection
include 'dbConnection.php';

$vehicleType = isset($_GET['filter']) ? $_GET['filter'] : '';
$lngPickup = isset($_GET['pickupLng']) ? floatval($_GET['pickupLng']) : 0;
$latPickup = isset($_GET['pickupLat']) ? floatval($_GET['pickupLat']) : 0;


if (empty($vehicleType)) {
    echo "No vehicle type selected.";
    exit;
}

// SQL query to get all available drivers with the selected vehicle type and their latitude/longitude
$sql = "SELECT driver.*, driverstatuslist.status, driverstatuslist.latitude, driverstatuslist.longitude 
        FROM driver 
        INNER JOIN driverstatuslist ON driver.driverID = driverstatuslist.driverID 
        WHERE driver.vehicle = ? 
        AND driverstatuslist.status = 'Available'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $vehicleType);
$stmt->execute();
$result = $stmt->get_result();

// Function to calculate distance using the Haversine formula
function haversineDistance($lat1, $lng1, $lat2, $lng2) {
    $earthRadius = 6371; // Radius of Earth in kilometers

    // Convert latitude and longitude from degrees to radians
    $lat1 = deg2rad($lat1);
    $lng1 = deg2rad($lng1);
    $lat2 = deg2rad($lat2);
    $lng2 = deg2rad($lng2);

    // Haversine formula
    $dlat = $lat2 - $lat1;
    $dlng = $lng2 - $lng1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = ($earthRadius * $c)-8940;
    $distance = abs($distance);

    return $distance;
}

$drivers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $driverLat = $row["latitude"];
        $driverLng = $row["longitude"];

        // Calculate the distance from the passenger's pickup location to the driver's location
        $distance = haversineDistance($latPickup, $lngPickup, $driverLat, $driverLng);

        // Store driver details along with the calculated distance
        $drivers[] = [
            'driverID' => $row["driverID"],
            'firstName' => $row["firstName"],
            'mobile' => $row["mobile"],
            'vehicle' => $row["vehicle"],
            'regNo' => $row["regNo"],
            'profilePicture' => $row["profilePicture"],
            'distance' => $distance // Add distance to the driver data
        ];
    }

    // Sort drivers by distance (nearest first)
    usort($drivers, function($a, $b) {
        return $a['distance'] - $b['distance'];
    });

    // Display only the nearest 3 drivers
    echo '<div class="driver-list">'; // Container for driver cards
    foreach (array_slice($drivers, 0, 3) as $driver) { // Limit to the first 3 drivers
        $driverId = htmlspecialchars($driver["driverID"]);
        echo '<div class="driver-item">';
        echo '<input type="radio" id="driver_' . $driverId . '" name="selectedDriver" value="' . $driverId . '">';
        echo '<label for="driver_' . $driverId . '">';
        echo '<img src="../../Drivers/backend/' . htmlspecialchars($driver["profilePicture"]) . '" alt="Profile Picture">';
        echo '<p><strong>Name:</strong> ' . htmlspecialchars($driver["firstName"]) . '</p>';
        echo '<p><strong>Mobile:</strong> ' . htmlspecialchars($driver["mobile"]) . '</p>';
        echo '<p><strong>Vehicle:</strong> ' . htmlspecialchars($driver["vehicle"]) . '</p>';
        echo '<p><strong>Vehicle Reg No:</strong> ' . htmlspecialchars($driver["regNo"]) . '</p>';
        echo '<p><strong>Distance:</strong> ' . round($driver["distance"], 2) . ' km</p>'; // Display distance
        echo '<p><strong></strong><span style="color: yellow; font-size: 20px;">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>';
        echo '</label>';
        echo '<a href="viewdriver.php?driverID=' . $driverId . '" class="viewDriverBtn"><img src="https://img.icons8.com/?size=100&id=63308&format=png&color=000000"></a>';
        echo '</div>';
    }
    echo '</div>';
}
else
{
    echo "No Drivers found for this vehicle type.";
}

$stmt->close();
$conn->close();
?>
