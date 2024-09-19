<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taxitest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the POST request
$pickup = $_POST['pickupLocation'];
$drop = $_POST['dropLocation'];


// Prepare SQL query to insert ride data
$sql = "INSERT INTO ride(pickupLocation, dropLocation) VALUES ('$pickup', '$drop')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
