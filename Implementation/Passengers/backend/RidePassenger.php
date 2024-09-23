<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />

    <!-- =====RidePassenger SCSS File ===== -->
    <link rel="stylesheet" href="Sass/RidePassenger.min.css" />

    <!-- =====RidePassenger SCSS File ===== -->
    <link rel="stylesheet" href="VehicleCardSass/vehicleCards.min.css" />

    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Title section -->
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi</title>
</head>
<body>
    <!-- Navigation Bar -->
    <?php include 'NavBarPassenger.php'; ?>

    <!-- Linking MapBox -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" rel="stylesheet">

    <h1>Ride Section</h1>

    <div class="content">
        <!-- Left section -->
        <div class="left">
            <h2>Trip Details</h2>
            <!-- Ride Booking Form -->
            <form action="processRide.php" method="post" id="rideForm">
                <div id="fareDetails">
                    <p><strong>Distance:</strong> <span id="distanceDisplay"></span></p>
                    <p><strong>Fare:</strong> $<span id="fareDisplay"></span></p>

                    <!-- Hidden Inputs to Store Ride Details -->
                    <input type="hidden" id="distance" name="distance">
                    <input type="hidden" id="fare" name="fare">
                    <input type="hidden" id="pickupLocation" name="pickupLocation">
                    <input type="hidden" id="dropLocation" name="dropLocation">
                    <input type="hidden" id="passengerID" name="passengerID"
                        value="<?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                echo htmlspecialchars($_SESSION['passengerID']);
                            } else {
                                echo ''; 
                            }
                        ?>">
                </div>


                <!-- select vehicle -->
                <h2>Select your vehicle</h2>

                <div class="container">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="bike" type="radio" name="vehicle" value="Bike" />
                      <div class="radio-tile">
                        <img
                          style="width: 120px"
                          src="https://raw.githubusercontent.com/ruchiralkm/Small-Testing/main/ASEassets/bike.png"
                          alt=""
                        />
                        <label for="bike">Bike</label>
                      </div>
                    </div>   
                    
                    
                    <div class="input-container">
                      <input
                        id="threewheel"
                        type="radio"
                        name="vehicle"
                        value="Threewheel"
                      />
                      <div class="radio-tile">
                        <img
                          style="width: 90px"
                          src="https://raw.githubusercontent.com/ruchiralkm/Small-Testing/main/ASEassets/threew.png"
                          alt=""
                        />
                        <label for="threewheel">Threewheel</label>
                      </div>
                    </div>


                    <div class="input-container">
                      <input id="car" type="radio" name="vehicle" value="Car" />
                      <div class="radio-tile">
                        <img
                          style="width: 110px"
                          src="https://raw.githubusercontent.com/ruchiralkm/Small-Testing/main/ASEassets/car.png"
                          alt=""
                        />
                        <label for="car">Car</label>
                      </div>
                    </div>


                    <div class="input-container">
                      <input id="van" type="radio" name="vehicle" value="Van" />
                      <div class="radio-tile">
                        <img
                          style="width: 100px"
                          src="https://raw.githubusercontent.com/ruchiralkm/Small-Testing/main/ASEassets/van.png"
                          alt=""
                        />
                        <label for="van">Van</label>
                      </div>
                    </div>

                    
                  </div>
                </div>
                 




                <button type="submit" id="bookRideBtn">Book Ride</button>
            </form>
        </div>

        <!-- Right section -->
        <div class="right">
            <!-- Map Container -->
            <div id="map"></div>
            <script src="Js/map.js"></script>
        </div>
    </div>

    <!--===== MAIN JS =====-->
    <script src="Js/main.js"></script>
</body>
</html>
