<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>City-Taxi Route Marking</title>

    <!-- Mapbox CSS and JS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" rel="stylesheet" />


    <!-- ===== NavBar SCSS File ===== -->
    <link rel="stylesheet" href="../Sass/NavBarDriver.min.css" />

     <!-- mapShowLocationCus SCSS -->
     <link rel="stylesheet" href="Sass/mapShowLocationCus.min.css">

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
                <a href="NotificationDriver.php" class="nav__link">Notifications</a>
              </li>

              <li class="nav__item" style="margin-left:70px">
                <a href="ProfileDriver.php" class="nav__link">
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

    <br><br><br>
    <!--===== MAIN JS =====-->
    <script src="../Js/main.js"></script>

    <!--===== END NAV BAR =====-->




    <!--===== Hero Section =====-->
    <div class="content">
      <!--=== left section ===-->
      <div class="left">
        <!-- Text Boxes for Pickup and Drop Locations -->
          <div class="box">
            <div class="form-group">
              <label for="pickupLocationText">Pickup Location</label>
              <input type="text" id="pickupLocationText" name="pickupLocationText" readonly />
            </div>
            <div class="form-group">
              <label for="dropLocationText">Drop Location</label>
              <input type="text" id="dropLocationText" name="dropLocationText" readonly />
            </div>
            <div class="form-group">
              <label for="distance">Distance(KM)</label>
              <input type="text" id="distance" name="distance" readonly />
            </div>
            <div class="form-group">
              <label for="fare">Price(LKR)</label>
              <input type="text" id="fare" name="fare" readonly />
            </div>
          </div>
          
    <?php
      // Database connection
      include '../dbConnection.php';
        // Fetch ride details for the selected ride ID
        if (isset($_GET['rideID'])) {
          $rideID = htmlspecialchars($_GET['rideID']);
      
          // SQL query to fetch ride details based on the rideID
          $sql = "SELECT * FROM ride WHERE rideID = '$rideID'";
          $result = $conn->query($sql);
      
          // Check if the ride exists
          if ($result->num_rows > 0) {
              // Fetch the ride details
              $row = $result->fetch_assoc();
              $pickupLocation = $row['pickupLocation'];
              $dropLocation = $row['dropLocation'];
              $distance = $row['distance'];
              $fare = $row['fare'];
              $passengerID = $row['passengerID'];
      
              // Add a button to show the map with this rideID
            // echo '<a href="mapShowLocationCus.php?rideID=' . $rideID . '">Show on Map</a>';
          } else {
              echo "Ride not found.";
          }
      } else {
          echo "No ride ID provided.";
      }
      $conn->close();
    ?>

        <!-- Button to Mark Route -->
        <div class="container">
          <button id="markRouteBtn">Mark Route</button>
          <!--Button to update the status -->
          <Form method="post" action = "acceptRide.php">
            <input type="hidden" id="rideID" name="rideID" value="<?php echo $rideID; ?>" />
            <input type="hidden" id="passengerID" name="passengerID" value="<?php echo $passengerID; ?>" />
            <button id="acceptRideBtn" name="acceptRideBtn" >Accept Ride</button>
          </form>

          <Form method="post" action = "rejectRide.php">
            <input type="hidden" id="rideID" name="rideID" value="<?php echo $rideID; ?>" />
            <input type="hidden" id="passengerID" name="passengerID" value="<?php echo $passengerID; ?>" />
            <button id="rejectRideBtn" name="rejectRideBtn" >Reject Ride</button>
          </form>
        </div>

        <center><p style="color:#ccc; margin-top:60px; font-weight:400;">© 2024 City-Taxi(pvt)ltd | All rights reserved.</p></center>
      </div>



      <!--=== Right section ===-->
      <div class="right">
        <!-- Map Container -->
        <div id="map"></div>
      </div>

    </div>

    



     

    <!-- JavaScript for Mapbox Integration -->
    <script>
      // Mapbox Access Token
      mapboxgl.accessToken = "pk.eyJ1IjoicnVjaGlyYWxrMjAwMiIsImEiOiJjbTE2bDZocmswbjBjMnZzOHFpYWhubDRyIn0.VR-eLFZQNviJBOVD_WfrmQ";

      // Coordinates and ride data from the backend (PHP)
      const pickupCoords = [<?php echo $pickupLocation; ?>]; // Pickup coordinates
      const dropCoords = [<?php echo $dropLocation; ?>]; // Drop coordinates
      const distance = <?php echo $distance; ?>; // Distance in km
      const fare = <?php echo $fare; ?>; // Fare in LKR

      // Initialize the map
      const map = new mapboxgl.Map({
        container: "map", // Map container ID
        style: "mapbox://styles/mapbox/streets-v11", // Map style
        center: pickupCoords, // Initial map center (pickup location)
        zoom: 12, // Zoom level
      });

      // Add markers for pickup and drop locations
      new mapboxgl.Marker({ color: 'green' }).setLngLat(pickupCoords).addTo(map);
      new mapboxgl.Marker({ color: 'red' }).setLngLat(dropCoords).addTo(map);

      // Initialize directions plugin (hidden initially)
      const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',
        profile: 'mapbox/driving',
      });

      // Event listener for "Mark Route" button
      document.getElementById("markRouteBtn").addEventListener("click", function () {
        // Add the directions control to the map
        map.addControl(directions, "top-left");

        // Set pickup and drop points for route calculation
        directions.setOrigin(pickupCoords);
        directions.setDestination(dropCoords);

        // Display coordinates and ride details in text fields
        document.getElementById("pickupLocationText").value = `Lat: ${pickupCoords[1]}, Lng: ${pickupCoords[0]}`;
        document.getElementById("dropLocationText").value = `Lat: ${dropCoords[1]}, Lng: ${dropCoords[0]}`;
        document.getElementById("distance").value = distance + " km";
        document.getElementById("fare").value = fare + " LKR";
      });
    </script>
  </body>
</html>
