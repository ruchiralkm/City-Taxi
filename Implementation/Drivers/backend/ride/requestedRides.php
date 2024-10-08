<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- ===== NavBar SCSS File ===== -->
    <link rel="stylesheet" href="../Sass/NavBarDriver.min.css" />

    <link rel="stylesheet" href="Sass/requestedRides.min.css">

    <!-- boxicons -->
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
      rel="stylesheet"
    />

    <!--font awesome(for icons)-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

</head>
<body>
    <!--====== Navigation Bar ======-->
    <header class="header">
      <a href="#" class="header__logo">City-Taxi</a>

      <i class="bx bx-menu header__toggle" id="header-toggle"></i>

      <nav class="nav" id="nav-menu">
        <div class="nav__content bd-grid">
          <a href="" class="nav__perfil">
            <div class="nav__img">
              <img src="assets/img/perfil.jpg" alt="" />
            </div>

            <div>
            <img src="../../../City-Taxi.png" alt="" style="width: 85px; height: 60px" />
            </div>
          </a>

          <div class="nav__menu">
            <ul class="nav__list">

              <li class="nav__item">
                <a href="../HomeDriver.php" class="nav__link">Home</a>
              </li>

              <li class="nav__item">
                <a href="#" class="nav__link">Ride</a>
              </li>

              <li class="nav__item">
                <a href="../statusDriver.php" class="nav__link">Status</a>
              </li>

              <li class="nav__item dropdown">
                <a href="#" class="nav__link dropdown__link"
                  >Activities <i class="bx bx-chevron-down dropdown__icon"></i
                ></a>

                <ul class="dropdown__menu" style="background-color:#1a242f">

                  <li class="dropdown__item">
                    <a href="#" class="nav__link">Ongoing</a>
                  </li>

                  <li class="dropdown__item">
                    <a href="#" class="nav__link">Completed</a>
                  </li>


                </ul>
              </li>

              <li class="nav__item">
                <a href="../NotificationDriver.php" class="nav__link">Notifications</a>
              </li>

              <li class="nav__item" style="margin-left:70px">
                <a href="../ProfileDriver.php" class="nav__link">
                  <?php
                    session_start();
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo "Welcome, " . htmlspecialchars($_SESSION['firstName']);
                    } else {
                        echo '<a href="login.php" style="color: white;">Login</a>';
                    }
                  ?> 
                </a>
              </li>

              <li class="nav__item" style="margin-left:-20px">
                <a href="../driversLogin.html" class="nav__link"> | <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
              </li>

            </ul>
          </div>
        </div>
      </nav>
    </header>

    <br><br><br><br>
    

    <!--===== MAIN JS =====-->
    <script src="../Js/main.js"></script>
</body>
</html>

<?php
// Database connection
include '../dbConnection.php';

// Assuming you have a session started for the driver
//session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $driverID = htmlspecialchars($_SESSION['driverID']);
} else {
    echo 'Please login to the system.';
    exit;
}
// SQL query to select all rides by driver ID
$sql = "SELECT * FROM ride WHERE driverID = '$driverID'";
$result = $conn->query($sql);

// List ride requests
if ($result->num_rows > 0) {
    echo '<form method="GET" action="showProcess.php">  '; // Form to submit rideID

    echo '<div class="ride-request-list">'; // Container for ride request cards

    // Loop through the results
    while ($row = $result->fetch_assoc()) {
      $rideID =  htmlspecialchars($row["rideID"]);
      $passengerID =  htmlspecialchars($row["passengerID"]);
        echo '<div class="ride-request-item" onclick="selectRide(this)">';
        echo '<input type="radio" name="rideID" value="' . htmlspecialchars($row["rideID"]) . '">';
        echo '<span style="font-weight: 900;">Ride ID:</span> ' . htmlspecialchars($row["rideID"]) . '<br>';
        echo '<span style="font-weight: 900;">Pickup Location:</span> ' . htmlspecialchars($row["pickupLocation"]) . '<br>';
        echo '<span style="font-weight: 900;">Drop Location:</span> ' . htmlspecialchars($row["dropLocation"]) . '<br>';
        echo '<span style="font-weight: 900;">Distance:</span> ' . htmlspecialchars($row["distance"]) . ' km<br>';
        echo '<span style="font-weight: 900;">Requested At:</span> ' . htmlspecialchars($row["requestAt"]) . '<br>';
        echo '<span style="font-weight: 900;">Passenger Mobile:</span> ' . htmlspecialchars($row["passengerMobile"]) . '<br>';

        if(($row["passengerType"]=="Unregistered"))
        {
          $unRegQuery = "SELECT*FROM unregpassengers WHERE unregPassengerID ='$passengerID' ";
          $result = $conn->query($unRegQuery);
          while ($row = $result->fetch_assoc()){
          echo '<span style="font-weight: 900;">Passenger Name:</span> ' . htmlspecialchars($row["firstName"]) . '<br>';
          }
        }
        else
        {
          $unRegQuery = "SELECT*FROM passenger WHERE passengerID ='$passengerID' ";
          $result = $conn->query($unRegQuery);
          while ($row = $result->fetch_assoc()){
          echo '<span style="font-weight: 900;">Passenger Name:</span> ' . htmlspecialchars($row["firstName"]) . '<br>';
          }
        }

        
        
        echo '</div>';
    }

    
    echo '<a href="mapShowLocationCus.php?rideID=' . $rideID . '" style="display: none;">Show on Map</a>';
    echo '</div>'; // Close the ride request list container
    echo '<button type="submit">Select Ride</button>'; // Submit button
    echo '</form>';
} else {
    echo "No rides found for this driver.";
}
?>

    <script>
        function selectRide(box) {
            // Remove 'selected' class from all items
            document.querySelectorAll('.ride-request-item').forEach(item => {
                item.classList.remove('selected');
            });
            
            // Add 'selected' class to the clicked box
            box.classList.add('selected');
            
            // Select the radio button inside the clicked box
            const radio = box.querySelector('input[type="radio"]');
            radio.checked = true;
        }
    </script>
