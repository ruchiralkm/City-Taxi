<?php
include('dbConnection.php'); // Include database connection
session_start();

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
        urp.mobile
    FROM 
        ride r
    INNER JOIN 
        unregpassengers p ON r.passengerID = urp.unregPassengerID
    WHERE 
        r.driverID = ? 
    AND 
        r.rideStatus = 'Accepted'
    AND 
        r.passengerType='Unregistered' ";

        $stmtUnReg = $conn->prepare($queryUnReg);
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
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
            <td><?php echo htmlspecialchars($row['mobile']); ?></td>
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
