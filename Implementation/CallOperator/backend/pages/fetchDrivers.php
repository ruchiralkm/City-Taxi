<?php
include 'dbConnection.php';

if (isset($_POST['vehicle'])) {
    $vehicle = $_POST['vehicle'];

    // Fetch drivers based on the selected vehicle type
    $query = "SELECT driverID, firstName, lastName FROM drivers WHERE vehicle = '$vehicle'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['driverID'] . "'>" . $row['firstName'] . " " . $row['lastName'] . "</option>";
        }
    } else {
        echo "<option value=''>No Drivers Available</option>";
    }
}
?>
