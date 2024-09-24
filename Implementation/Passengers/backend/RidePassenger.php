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
                    <p><strong>Distance:</strong> <span id="distanceDisplay"></span></p>
                    <p><strong>Price:</strong> $<span id="fareDisplay"></span></p>

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
                      <input id="bike" type="radio" name="vehicle" value="Bike" />
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
                        <label for="bike">LKR 200</label>

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
                        <label for="threewheel" style="margin-top:18px;">Threewheel</label>
                        <label for="threewheel"><svg data-slot="icon" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="18px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"></path>
                        </svg> 3</label>
                        <label for="threewheel">LKR 200</label>
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
                        <label for="car"><svg data-slot="icon" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="18px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"></path>
                        </svg> 4</label>
                        <label for="bike">LKR 200</label>
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
                        <label for="van"><svg data-slot="icon" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="18px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"></path>
                        </svg> 10</label>
                        <label for="bike">LKR 200</label>
                      </div>
                    </div>

                    
                  </div>
                </div>



                <!-- Select Driver -->
                <h2 style="margin-top:-70px;">Select your driver</h2>
                <div class="card-container">

                  <!-- 1st Driver -->
                  <input type="radio" id="card1" name="card" class="card-input" />
                  <label for="card1" class="card">
                    <img
                      src="https://www.f1fantasytracker.com/Images/Drivers/2021/Headshots/Verstappen.png"
                      alt=""
                    />
                    <div class="card-content">
                      <h3>Daniel Brayan</h3>
                      <p>Tel: 0777123456</p>
                      <p>Age: 26</p>
                      <p>Catogory: Bike</p>

                      <!-- Star rating -->
                      <div class="star-rating">
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star">☆</span>
                      </div>

                    </div>
                  </label>

                  <!-- 2nd Driver -->
                  <input type="radio" id="card2" name="card" class="card-input" />
                  <label for="card2" class="card">
                    <img
                      src="https://o.quizlet.com/Iu7WzrIMeFItkAv06hDyaQ.jpg"
                      alt=""
                    />
                    <div class="card-content">
                      <h3>John Cena</h3>
                      <p>Tel: 0777123456</p>
                      <p>Age: 32</p>
                      <p>Catogory: Car</p>

                      <!-- Star rating -->
                      <div class="star-rating">
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star">☆</span>
                        <span class="star">☆</span>
                      </div>

                    </div>
                  </label>

                  <!-- 3rd Driver -->
                  <input type="radio" id="card3" name="card" class="card-input" />
                  <label for="card3" class="card">
                    <img
                      src="https://tiermaker.com/images/media/hero_images/2024/17244409/2025-f1-driver-line-up-prediction-17244409/172444091718791306.png"
                      alt=""
                    />
                    <div class="card-content">
                      <h3>Daniel Brayan</h3>
                      <p>Tel: 0777123456</p>
                      <p>Age: 20</p>
                      <p>Catogory: Van</p>

                      <!-- Star rating -->
                      <div class="star-rating">
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star">☆</span>
                        <span class="star">☆</span>
                        <span class="star">☆</span>
                      </div>

                    </div>
                  </label>
                </div>
                <hr>
                <h2>Total Price: LKR 1150</h2>
                <button class="bookbtn" type="submit" id="bookRideBtn">Book Ride</button>
            </form>

            <p class="footerP">© 2024 City-Taxi(pvt). All rights reserved.</p>
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
