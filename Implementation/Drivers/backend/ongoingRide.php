<?php
include 'NavBarDriver.php';
include('dbConnection.php'); // Include database connection


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $driverID = htmlspecialchars($_SESSION['driverID']);
} else {
    echo 'Please login to view notifications.';
    exit;
}

// SQL query for fetching ongoing rides for the logged-in passenger
$queryReg = "
SELECT 
    r.rideID, 
    r.pickupLocation, 
    r.dropLocation, 
    r.fare, 
    r.distance, 
    p.firstName, 
    p.lastName, 
    p.mobile
FROM 
    ride r
INNER JOIN 
    passenger p ON r.passengerID = p.passengerID
WHERE 
    r.driverID = ? 
AND 
    r.rideStatus = 'Accepted'
AND 
    r.passengerType='Registered' ";

$stmtReg = $conn->prepare($queryReg);

// Check if statement preparation was successful
if ($stmtReg === false) {
    die("Error preparing statement for registered passengers: " . $conn->error);
}

$stmtReg->bind_param('i', $driverID);
$stmtReg->execute();
$resultReg = $stmtReg->get_result();


$queryUnReg = "
SELECT 
    r.rideID, 
    r.pickupLocation, 
    r.dropLocation, 
    r.fare, 
    r.distance, 
    urp.firstName, 
    urp.lastName, 
    urp.mobilenumber
FROM 
    ride r
INNER JOIN 
    unregpassengers urp ON r.passengerID = urp.unregPassengerID
WHERE 
    r.driverID = ? 
AND 
    r.rideStatus = 'Accepted'
AND 
    r.passengerType='Unregistered' ";

$stmtUnReg = $conn->prepare($queryUnReg);

// Check if statement preparation was successful
if ($stmtUnReg === false) {
    die("Error preparing statement for unregistered passengers: " . $conn->error);
}

$stmtUnReg->bind_param('i', $driverID);
$stmtUnReg->execute();
$resultUnReg = $stmtUnReg->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Rides</title>
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap");
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f0f4f8;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 2px solid #0b8c4c;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        /*--------- Animation ---------*/
        table {
            position: relative;
            opacity: 0;
            transform: translateY(40%);
            animation: slideIn 600ms forwards;
            animation-delay: 0.3s;
        }
        @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateX(0%);
        }
        }

        h2{
            position: relative;
            opacity: 0;
            transform: translateY(-40%);
            animation: slideIn 600ms forwards;
            animation-delay: 0.3s;
        }
        @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateX(0%);
        }
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #1a242f;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #ddffe6;
            transition: background-color 0.3s ease;
        }
        p {
            text-align: center;
            font-style: italic;
            color: #7f8c8d;
        }
    </style>
</head>
<body>

<h2>Ongoing Rides for Registered Passengers</h2>
<?php if ($resultReg->num_rows > 0): ?>
    <table>
        <tr>
            <th>Ride ID</th>
            <th>Pickup Location</th>
            <th>Drop Location</th>
            <th>Fare</th>
            <th>Distance</th>
            <th>Passenger Name</th>
            <th>Mobile</th>
        </tr>
        <?php while($row = $resultReg->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['rideID']); ?></td>
            <td><?php echo htmlspecialchars($row['pickupLocation']); ?></td>
            <td><?php echo htmlspecialchars($row['dropLocation']); ?></td>
            <td><?php echo htmlspecialchars($row['fare']); ?></td>
            <td><?php echo htmlspecialchars($row['distance']); ?></td>
            <td><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?></td>
            <td><?php echo htmlspecialchars($row['mobile']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No ongoing rides for registered passengers.</p>
<?php endif; ?>

<h2>Ongoing Rides for Unregistered Passengers</h2>
<?php if ($resultUnReg->num_rows > 0): ?>
    <table>
        <tr>
            <th>Ride ID</th>
            <th>Pickup Location</th>
            <th>Drop Location</th>
            <th>Fare</th>
            <th>Distance</th>
            <th>Passenger Name</th>
            <th>Mobile</th>
        </tr>
        <?php while($row = $resultUnReg->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['rideID']); ?></td>
            <td><?php echo htmlspecialchars($row['pickupLocation']); ?></td>
            <td><?php echo htmlspecialchars($row['dropLocation']); ?></td>
            <td><?php echo htmlspecialchars($row['fare']); ?></td>
            <td><?php echo htmlspecialchars($row['distance']); ?></td>
            <td><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?></td>
            <td><?php echo htmlspecialchars($row['mobilenumber']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No ongoing rides for unregistered passengers.</p>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
