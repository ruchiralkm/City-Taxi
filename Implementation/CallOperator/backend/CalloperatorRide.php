


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

    <!-- Linking MapBox -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" rel="stylesheet">

    <!--Calloperator Home scss file-->
    <link rel="stylesheet" href="Sass/CalloperatorRide.min.css" />

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
            <a href="#" class="sidebar-link">
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
            <a href="CalloperatorDriver.php" class="sidebar-link">
              <i class="fa-solid fa-user-nurse"></i>
              <span>Drivers</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link collapsed has-dropdown"
              data-bs-toggle="collapse"
              data-bs-target=".tools"
              aria-expanded="false"
              aria-controls="tools"
            >
              <i class="fas fa-wrench"></i>
              <span>Tools</span>
            </a>
            <ul class="tools sidebar-dropdown list-unstyled collapse" data-bs-parent=".sidebar">
              <li class="sidebar-item">
                <a
                  href="#"
                  class="sidebar-link collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target=".drop-two"
                  aria-expanded="false"
                  aria-controls="drop-two"
                >
                  Guides
                </a>
                <ul class="drop-two sidebar-dropdown list-unstyled collapse">
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Start a Blog</a>
                  </li>
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Start a Website</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
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
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link collapsed has-dropdown"
              data-bs-toggle="collapse"
              data-bs-target=".company"
              aria-expanded="false"
              aria-controls="company"
            >
              <i class="fas fa-building"></i>
              <span>Company</span>
            </a>
            <ul class="company sidebar-dropdown list-unstyled collapse" data-bs-parent=".sidebar">
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">About</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Contact</a>
              </li>
            </ul>
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
        <!-- Home Section -->
        <h1 class="ee">Ride Section</h1>
        <div class="content">

          <!-- Left Section -->
          <div class="left">
            <!-- Form -->
            <form method="POST" action="RideProcess.php"  id="rideForm">
              <!-- Hidden Inputs to Store Ride Details -->

              <p style="display: none;"><strong>Price:</strong> LKR<span id="fareDisplay"></span></p>
              <input type="hidden" id="distance" name="distance">
              <input type="hidden" id="fare" name="fare">
              <input type="hidden" id="pickupLocation" name="pickupLocation">
              <input type="hidden" id="dropLocation" name="dropLocation">
              <input type="hidden" id="driverID" name="driverID">
              <input type="hidden" id="totalAmount" name ="totalAmount" value="0">

              
              


              <!-- Passenger Info -->
              <div class="name-row">
                <div class="form-group half-width">
                  <label for="firstName">First Name</label>
                  <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group half-width">
                  <label for="lastName">Last Name</label>
                  <input type="text" id="lastName" name="lastName" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobileNumber">Mobile Number</label>
                <input type="text" id="mobileNumber" name="mobileNumber" required>
              </div>

              <!-- Toggle between OneWay and ReturnTrip -->
              <div class="toggle-container">
                <label for="oneWay" class="option oneWay">One way</label> 
                <input type="radio" id="oneWay" name="employment" value="One Way" checked />
                <label for="returnTrip" class="option returnTrip">Return trip</label>
                <input type="radio" id="returnTrip" name="employment" value="Return Trip" />

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
                      
                      <label for="bike">Bike</label>
                      

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
                      
                      <label for="threewheel" style="margin-top:18px;">Threewheel</label>
                   
                    </div>
                  </div>


                  <div class="input-container">
                    <input id="car" type="radio" name="vehicle" value="Car" onclick="showDrivers('Car')" />
                    <div class="radio-tile">
                      
                      <label for="car">Car</label>
                      
                    </div>
                  </div>


                  <div class="input-container">
                    <input id="van" type="radio" name="vehicle" value="Van" onclick="showDrivers('Van')"/>
                    <div class="radio-tile">
                     
                      <label for="van">Van</label>
                      
                    </div>
                  </div>

                  
                </div>
              </div>



              <!-- Select Driver -->
              <h2 style="margin-top:-70px;">Select your driver</h2>
              <div class="driverList" id="driverList"> driver list</div>
              <hr>
              <h2 class="totalPrice">Total Price: LKR 0</h2>
              <h2 class="distance">Total Distance : <span id="distanceDisplay"></span></h2>

              <button class="bookbtn" type="submit" name="submit" id="bookRideBtn">Book Ride</button>

             
             </form>
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

          <!-- Right Section -->
          <div class="right">
            <!-- Map Container -->
            <div id="map"></div>
            <script src="Js/map.js"></script>

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
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', 'fetchDrivers.php?filter=' + filter, true);
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
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
    <script src="Js/app.js"></script>
  </body>
</html>
