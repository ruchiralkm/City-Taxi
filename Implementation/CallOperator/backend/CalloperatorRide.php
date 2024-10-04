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


    <script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />

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
            <a href="#" class="sidebar-link">
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
            <ul
              class="tools sidebar-dropdown list-unstyled collapse"
              data-bs-parent=".sidebar"
            >
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
            <ul
              class="company sidebar-dropdown list-unstyled collapse"
              data-bs-parent=".sidebar"
            >
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
        <form method="POST" action="">
             
        <!-- Hidden Inputs to Store Ride Details -->
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
             <label for="oneWay" class="option oneWay">One way</label> <input
                    type="radio"
                    id="oneWay"
                    name="employment"
                    value="One Way"
                    checked
                  />
                  <label for="returnTrip" class="option returnTrip">Return trip</label><input
                    type="radio"
                    id="returnTrip"
                    name="employment"
                    value="Return Trip"
                  />

                  
                  

                  <div class="toggle-slider">
                    <div class="slider"></div>
                  </div>
                </div>

        <!-- Vehicle Selection -->
        <div class="form-group">
          <label for="vehicle">Vehicle</label>
          <select id="vehicle" name="vehicle" onchange="fetchDrivers()">
            <option value="">Select Vehicle</option>
            <option value="Bike">Bike</option>
            <option value="Car">Car</option>
            <option value="Van">Van</option>
            <option value="Threewheel">Threewheel</option>
          </select>
        </div>

        <!-- Driver Selection -->
        <div class="form-group">
          <label for="driver">Drivers</label>
          <select id="driver" name="driverID">
            <option value="">Select Driver</option>
          </select>
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Book Ride">
        <h2 class="distance">Total Distance : <span id="distanceDisplay"></span></h2>
        <h2 class="totalPrice">Total Price: LKR 0</h2>
        <p style="display: none;"><strong>Price:</strong> LKR<span id="fareDisplay"></span></p>

      </form>
      
      </div>



      <!-- Right Section -->
      <div class="right">
        <!-- Map Container -->
        <div id="map"></div>
    
          <script>
            // Set the access token
            mapboxgl.accessToken =
              "pk.eyJ1IjoicnVjaGlyYWxrMjAwMiIsImEiOiJjbTE2bDZocmswbjBjMnZzOHFpYWhubDRyIn0.VR-eLFZQNviJBOVD_WfrmQ";

            // Use Geolocation to set the user’s position
            navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
              enableHighAccuracy: true,
            });

            // Success callback for geolocation
            function successLocation(position) {
              setupMap([position.coords.longitude, position.coords.latitude]);
            }

            // Error callback for geolocation
            function errorLocation() {
              // Default to Manchester if geolocation fails
              setupMap([-2.24, 53.48]);
            }

            // Set up the map and directions
            function setupMap(center) {
              const map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v11",
                center: center,
                zoom: 15,
              });

              // Add zoom and rotation controls
              const nav = new mapboxgl.NavigationControl();
              map.addControl(nav);

              // Add directions control
              const directions = new MapboxDirections({
                accessToken: mapboxgl.accessToken,
                unit: "metric",
                profile: "mapbox/driving",
              });
              map.addControl(directions, "top-left");

              // Event listener for route selection
              directions.on("route", function (event) {
                const route = event.route[0];
                const distance = route.distance / 1000; // Distance in kilometers

                // Get the pickup and drop coordinates
                const pickup = route.legs[0].steps[0].maneuver.location; // Start point
                const drop =
                  route.legs[0].steps[route.legs[0].steps.length - 1].maneuver.location; // End point

                // Display Distance
                document.getElementById("distanceDisplay").innerText =
                  distance.toFixed(2) + " km";
                calculateFare(distance);

                // Calculate and display the fare
                calculateFare(distance);

                // Store the pickup and drop locations in hidden input fields for later use
                document.getElementById("pickupLocation").value = pickup;
                document.getElementById("dropLocation").value = drop;
              });
            }

            // Fare calculation logic
            function calculateFare(distance) {
              var totalFare;
              const baseFare = 2; // Base fare
              const fareFirst5Km = 75; // Cost per km for the first 5 km
              const fareAfter5Km = 50; // Cost per km after 5 km

              // Calculate the fare
              if (distance <= 5) {
                totalFare = distance * fareFirst5Km + baseFare;
              } else {
                totalFare = 5 * fareFirst5Km + (distance - 5) * fareAfter5Km + baseFare;
              }

              document.getElementById("fareDisplay").innerText = totalFare.toFixed(2);

              // Update Hidden Inputs with Distance and Fare
              document.getElementById("distance").value = distance.toFixed(2);
              document.getElementById("fare").value = totalFare.toFixed(2);
            }

            // Book Ride on Button Click
            /*
                document.getElementById('bookRideBtn').addEventListener('click', function() {
                    const distance = document.getElementById('distance').value;
                    const fare = document.getElementById('fare').value;
                    const pickup = document.getElementById('pickupLocation').value;
                    const drop = document.getElementById('dropLocation').value;

                    if (distance && fare && pickup && drop) {
                        // Perform AJAX Request to Book the Ride
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', 'book_ride.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            if (this.status === 200) {
                                alert('Ride booked successfully!');
                            } else {
                                alert('There was a problem booking the ride.');
                            }
                        };
                        xhr.send(`pickup=${pickup}&drop=${drop}&distance=${distance}&fare=${fare}`);
                    } else {
                        alert('Please select a route first.');
                    }
                });
                */

                
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
      

          </script>

<script>
      function fetchDrivers() {
        var vehicle = $('#vehicle').val();
        if (vehicle) {
          $.ajax({
            type: 'POST',
            url: 'fetchDrivers.php', // PHP script to fetch drivers
            data: {vehicle: vehicle},
            success: function(response) {
              $('#driver').html(response); // Update driver dropdown with the response
            }
          });
        } else {
          $('#driver').html('<option value="">Select Driver</option>'); // Reset driver list if no vehicle selected
        }
      }
    </script>

      </div>
    </div>













      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="Js/app.js"></script>
  </body>
</html>
