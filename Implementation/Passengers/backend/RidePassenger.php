<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />

    <!-- =====RidePassenger SCSS File ===== -->
    <link rel="stylesheet" href="Sass/RidePassenger.min.css" />

    <!-- =====Vehicle Card SCSS File ===== -->
    <link rel="stylesheet" href="VehicleCardSass/vehicleCards.min.css" />

    <!-- =====Driver Card SCSS File ===== -->
    <link rel="stylesheet" href="DriverCardSass/DriverCardSass.min.css" />

    

    <!-- Title section -->
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi</title>
    <style>
        .driverList {
            margin-top: -20px;
            display: none;
        }
        .driver-item {
            padding: 0px;
            border-bottom: 1px solid #ddd;
        }
        
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <?php include 'NavBarPassenger.php'; ?>

    <!-- Linking MapBox -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" rel="stylesheet">

    <br><br>
    <div class="content">
        <!-- Left section -->
        <div class="left">
            <h2>Trip Details</h2>
            <!-- Ride Booking Form -->
            <form action="processRide.php" method="post" id="rideForm">
                <div id="fareDetails" class="fareDetails">
                    <h2 class="distance" style="margin-top:-25px;">Total Distance : <span id="distanceDisplay"></span></h2>
                    <p style="display: none;"><strong>Price:</strong> LKR<span id="fareDisplay"></span></p>

                    <!-- Hidden Inputs to Store Ride Details -->
                    <input type="hidden" id="distance" name="distance">
                    <input type="hidden" id="fare" name="fare">
                    <input type="hidden" id="pickupLocation" name="pickupLocation">
                    <input type="hidden" id="dropLocation" name="dropLocation">
                    <input type="hidden" id="pickupLat" name="pickupLat">
                    <input type="hidden" id="pickupLng" name="pickupLng">


                    <input type="hidden" id="passengerID" name="passengerID"
                        value="<?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                echo htmlspecialchars($_SESSION['passengerID']);
                            } else {
                                echo ''; 
                            }
                        ?>"/>

                    <input type="hidden" id="driverID" name="driverID">
                    <input type="hidden" id="totalAmount" name ="totalAmount" value="0">

                    <input type="hidden" id="mobileNum" name="mobileNum"
                        value="<?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                echo htmlspecialchars($_SESSION['mobile']);
                            } else {
                                echo ''; 
                            }
                        ?>"/>
                </div>

                <br>

                <!-- Toggle between OneWay and ReturnTrip -->
                <div class="toggle-container">
                  <input
                    type="radio"
                    id="oneWay"
                    name="employment"
                    value="One Way"
                    checked
                  />
                  <input
                    type="radio"
                    id="returnTrip"
                    name="employment"
                    value="Return Trip"
                  />

                  <label for="oneWay" class="option oneWay">One way</label>
                  <label for="returnTrip" class="option returnTrip">Return trip</label>

                  <div class="toggle-slider">
                    <div class="slider"></div>
                  </div>
                </div>

                <!-- select vehicle -->
                <h2>Select your vehicle</h2>

                <div class="container">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="bike" type="radio" name="vehicle" value="Bike" onclick="showDrivers('Bike')">
                      <div class="radio-tile">
                        <img
                          style="width: 120px"
                          src="https://raw.githubusercontent.com/ruchiralkm/Small-Testing/main/ASEassets/bike.png"
                          alt=""
                        />
                        <label for="bike">Bike</label>
                        <label for="bike"><svg data-slot="icon" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="18px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"></path>
                        </svg> 1</label>

                      </div>
                    </div>   
                    
                    
                    <div class="input-container">
                      <input
                        id="threewheel"
                        type="radio"
                        name="vehicle"
                        value="Threewheel"
                        onclick="showDrivers('Threewheel')"
                      >
                      <div class="radio-tile">
                        <img
                          style="width: 90px"
                          src="https://raw.githubusercontent.com/ruchiralkm/Small-Testing/main/ASEassets/threew.png"
                          alt=""
                        />
                        <label for="threewheel" style="margin-top:18px;">Threewheel</label>
                        <label for="threewheel"><svg data-slot="icon" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="18px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"></path>
                        </svg> 3</label>
                      </div>
                    </div>


                    <div class="input-container">
                      <input id="car" type="radio" name="vehicle" value="Car" onclick="showDrivers('Car')" />
                      <div class="radio-tile">
                        <img
                          style="width: 110px"
                          src="https://raw.githubusercontent.com/ruchiralkm/Small-Testing/main/ASEassets/car.png"
                          alt=""
                        />
                        <label for="car">Car</label>
                        <label for="car"><svg data-slot="icon" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="18px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"></path>
                        </svg> 4</label>
                      </div>
                    </div>


                    <div class="input-container">
                      <input id="van" type="radio" name="vehicle" value="Van" onclick="showDrivers('Van')"/>
                      <div class="radio-tile">
                        <img
                          style="width: 100px"
                          src="https://raw.githubusercontent.com/ruchiralkm/Small-Testing/main/ASEassets/van.png"
                          alt=""
                        />
                        <label for="van">Van</label>
                        <label for="van"><svg data-slot="icon" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="18px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"></path>
                        </svg> 10</label>
                      </div>
                    </div>

                    
                  </div>
                </div>



                <!-- Select Driver -->
                <h2 style="margin-top:-100px;">Select your driver</h2>
                <div class="driverList" id="driverList"> driver list</div>
                <hr>
                <h2 class="totalPrice">Total Price: LKR 0</h2>
                <button class="bookbtn" type="submit" id="bookRideBtn">Book Ride</button>
            </form>

            <p class="footerP">© 2024 City-Taxi(pvt). All rights reserved.</p>

              <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const radioButtons = document.querySelectorAll('.driver-item input[type="radio"]');
                    radioButtons.forEach(radio => {
                        radio.addEventListener('change', function() {
                            
                        });
                    });
                });
              </script>
        </div>

        <!-- Right section -->
        <div class="right">
            <!-- Map Container -->
            <div id="map"></div>
            <script src="Js/map.js"></script>
        </div>
    </div>

    <!--===== MAIN JS =====-->
    <script src="Js/main.js">

      
    </script>
    <script>


    // Define vehicle prices
    const vehiclePrices = {
        'Bike': 200,
        'Threewheel': 300,
        'Car': 400,
        'Van': 500
    };

    // Function to calculate and display the total price
    function calculateTotalPrice() {
        // Get the selected vehicle type
        const selectedVehicle = document.querySelector('input[name="vehicle"]:checked');
        const vehiclePrice = selectedVehicle ? vehiclePrices[selectedVehicle.value] : 0;

        // Get the fare value (ensure fare input is correctly populated)
        const fare = parseFloat(document.getElementById('fare').value) || 0;

        let totalAmount;
        const tripType = document.querySelector('input[name="employment"]:checked')?.value;

        if (tripType === 'Return Trip') {
            totalAmount = (vehiclePrice + fare) * 2;
            document.getElementById('totalAmount').value = totalAmount;
            document.querySelector('h2.totalPrice').innerHTML = `Total Price: LKR ${totalAmount}`;
        } else {
            totalAmount = vehiclePrice + fare;
            document.getElementById('totalAmount').value = totalAmount;
            document.querySelector('h2.totalPrice').innerHTML = `Total Price: LKR ${totalAmount}`;
        }


        // Display the total amount on the page

      }
        document.querySelectorAll('input[name="vehicle"]').forEach(vehicleRadio => {
            vehicleRadio.addEventListener('change', calculateTotalPrice);
        });

        document.querySelectorAll('input[name="employment"]').forEach(tripRadio => {
            tripRadio.addEventListener('change', calculateTotalPrice);
        });
      

        function showDrivers(filter) 
        {
            const driverList = document.getElementById('driverList');

            // Get the pickupLat and pickupLng values
            const pickupLat = document.getElementById('pickupLat').value;
            const pickupLng = document.getElementById('pickupLng').value;

            // Create the query string with the filter, pickupLat, and pickupLng values
            const queryString = `filter=${filter}&pickupLat=${encodeURIComponent(pickupLat)}&pickupLng=${encodeURIComponent(pickupLng)}`;

            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetchDrivers.php?' + queryString, true);
            xhr.onload = function () {
                if (this.status === 200) {
                  driverList.innerHTML = this.responseText;
                  driverList.style.display = 'block';

                  //event listner for selecting a driver
                  const driverRadios = document.querySelectorAll('input[name="selectedDriver"]');
                  driverRadios.forEach(radio => {
                    radio.addEventListener('change', function () {
                    document.getElementById('driverID').value = this.value;
                });
            });
            calculateTotalPrice();
                }
            }
            xhr.send();
        }

      </script>
   
</body>
</html>
