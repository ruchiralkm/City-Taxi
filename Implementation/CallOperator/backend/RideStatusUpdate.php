<!-- Database connection -->
<?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname="citytaxi";

          $conn = mysqli_connect($servername,$username,$password,$dbname);

          if(!$conn){
            die("Connection Erro".mysqli_connect_error());
          }else{
            // echo "C";
          }
        ?>
                      <?php
                
                $queryUnReg = "
                SELECT 

                    r.rideID, 
                    r.pickupLocation, 
                    r.dropLocation, 
                    r.fare, 
                    r.driverID,
                    r.distance, 
                    urp.firstName,  
                    urp.mobilenumber,
                    r.rideStatus
                FROM 
                    ride r
                INNER JOIN 
                    unregpassengers urp ON r.passengerID = urp.unregPassengerID
                WHERE 
                    r.passengerType='Unregistered' ";
                
                $stmtUnReg = $conn->prepare($queryUnReg);
                
                // Check if statement preparation was successful
                if ($stmtUnReg === false) {
                    die("Error preparing statement for unregistered passengers: " . $conn->error);
                }
                
                
                $stmtUnReg->execute();
                $resultUnReg = $stmtUnReg->get_result();
                ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- title section -->
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi</title>

    <!--font awesome(for icons)-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <!--BootStrap-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!--Calloperator Ride scss file-->
    
    <link rel="stylesheet" href="Sass/CalloperatorPassenger.min.css" />

  </head>
  <body>
    <div class="wrapper">
    <aside class="sidebar">
        <div class="d-flex">
          <button class="toggle-btn" type="button">
            <i class="fas fa-bars"></i>
          </button>

          <div class="sidebar-logo">
            <a href="#"><img src="../../City-Taxi.png" alt="" style="width: 85px; height: 60px" /></a>
          </div>
        </div>

        <ul class="sidebar-nav">
          <li class="sidebar-item">
            <a href="CalloperatorHome.php" class="sidebar-link">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="CalloperatorRide.php" class="sidebar-link">
              <i class="fas fa-car"></i>
              <span>Rides</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a href="CalloperatorPassenger.php" class="sidebar-link">
              <i class="fas fa-user"></i>
              <span>Passengers</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
            <i class="fa-solid fa-user-nurse"></i>
              <span>Drivers</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a href="RideStatusUpdate.php" class="sidebar-link">
              <i class="fas fa-bell"></i>
              <span>Notifications</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
              <i class="fas fa-cog"></i>
              <span>Settings</span>
            </a>
          </li>
        </ul>

        <div class="sidebar-footer">
          <a href="../callOperator.html" class="sidebar-link">
            <i class="fas fa-right-from-bracket"></i>
            <span>Logout</span>
          </a>
        </div>
      </aside>

      <div class="main p-4">
      <h2>Ongoing Rides for Unregistered Passengers</h2>
        

       
       
<!-- Ongoing Rides for Unregistered Passengers -->
<div class="tableContent">
                
                <?php if ($resultUnReg->num_rows > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr style="background-color: black; color: white;">
                                <th>Ride ID</th>
                                <th>Pickup Location</th>
                                <th>Drop Location</th>
                                <th>Fare (Rs.)</th>
                                <th>Distance (km)</th>
                                <th>Passenger Name</th>
                                <th>Mobile</th>
                                <th>Driver ID</th>
                                <th>Ride Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $resultUnReg->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['rideID']); ?></td>
                                <td><?php echo htmlspecialchars($row['pickupLocation']); ?></td>
                                <td><?php echo htmlspecialchars($row['dropLocation']); ?></td>
                                <td><?php echo htmlspecialchars($row['fare']); ?></td>
                                <td><?php echo htmlspecialchars($row['distance']); ?></td>
                                <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                                <td><?php echo htmlspecialchars($row['mobilenumber']); ?></td>
                                <td><?php echo htmlspecialchars($row['driverID']); ?></td>
                                <td><?php echo htmlspecialchars($row['rideStatus']); ?></td>
                                <td>
                                    <form action="updateRideStatus.php" method="POST">
                                        <input type="hidden" name="rideID" value="<?php echo $row['rideID']; ?>">
                                        <?php if ($row['rideStatus'] === 'Completed'): ?>
                                            <!-- Disable the button if the ride is already completed -->
                                            <button type="button" class="btn btn-secondary" disabled>Completed</button>
                                            <?php elseif ($row['rideStatus'] === 'Rejected'): ?>
                                            <button type="submit" class="btn btn-warning" name="cancelRide">Cancel</button>
                                        <?php elseif ($row['rideStatus'] === 'Accepted'):?>
                                            <button type="submit" name="completeRide" class="btn btn-success">Complete Ride</button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No ongoing rides for unregistered passengers.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="Js/app.js"></script>
  </body>
</html>
<?php
$conn->close();
?>