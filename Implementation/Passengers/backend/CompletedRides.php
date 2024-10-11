<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi - Your Completed Rides</title>

    <link rel="stylesheet" href="Sass/ongoing.min.css">

    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #1a242f;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #1a242f;
            color: white;
        }
    </style>
</head>
<body>
    <?php include 'NavBarPassenger.php'; ?>
    <?php
        include('dbConnection.php');

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $passengerID = htmlspecialchars($_SESSION['passengerID']);
        } else {
            echo 'Please login to view notifications.';
            exit;
        }

        // SQL query for fetching completed rides for the logged-in passenger
        $query = "
        SELECT 
            r.rideID, 
            r.pickupLocation, 
            r.dropLocation, 
            r.fare, 
            r.distance, 
            d.firstName, 
            d.lastName, 
            d.driverID,
            d.vehicle, 
            d.regNo, 
            d.mobile
        FROM 
            ride r
        INNER JOIN 
            driver d ON r.driverID = d.driverID
        WHERE 
            r.passengerID = ? 
        AND 
            r.rideStatus = 'Completed'";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $passengerID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Ride ID</th>
                                <th>Pickup Location</th>
                                <th>Drop Location</th>
                                <th>Fare (Rs.)</th>
                                <th>Distance (km)</th>
                                <th>Driver Name</th>
                                <th>Vehicle</th>
                                <th>Reg No</th>
                                <th>Driver's Contact</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['rideID'] . "</td>
                            <td>" . $row['pickupLocation'] . "</td>
                            <td>" . $row['dropLocation'] . "</td>
                            <td>" . $row['fare'] . "</td>
                            <td>" . $row['distance'] . "</td>
                            <td>" . $row['firstName'] . " " . $row['lastName'] . "</td>
                            <td>" . $row['vehicle'] . "</td>
                            <td>" . $row['regNo'] . "</td>
                            <td>" . $row['mobile'] . "</td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No completed rides at the moment.";
            }

            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    ?>
</body>
</html>
