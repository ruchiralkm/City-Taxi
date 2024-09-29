<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Rides</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .ride-container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
        }
        .ride-container h2 {
            color: #333;
            margin-top: 0;
        }
        .ride-details {
            margin-bottom: 10px;
        }
        .ride-details strong {
            color: #333;
        }
        button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        #ratingPopup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <h1>Your Ongoing Rides</h1>
    <div id="rides"></div>

    <!-- Rating Popup -->
    <div id="ratingPopup" style="display: none;">
        <div class="popup-content">
            <h2>Rate the Driver</h2>
            <form id="ratingForm" method="POST" action="rateDriver.php">
                <input type="hidden" name="driverID" id="driverID">
                <label for="rating">Rating:</label><br>
                <input type="radio" name="rating" value="1"> 1
                <input type="radio" name="rating" value="2"> 2
                <input type="radio" name="rating" value="3"> 3
                <input type="radio" name="rating" value="4"> 4
                <input type="radio" name="rating" value="5" checked> 5
                <br><br>
                <button type="submit">Submit Rating</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch the ongoing rides from the server
            fetch('ongoingRide.php')
                .then(response => response.json())
                .then(data => {
                    // Get the container element
                    const ridesContainer = document.getElementById('rides');

                    if (data.length > 0) {
                        // Loop through the rides and display them
                        data.forEach(ride => {
                            // Create a div for each ride
                            const rideDiv = document.createElement('div');
                            rideDiv.classList.add('ride-container');

                            // Add the ride details to the div
                            rideDiv.innerHTML = `
                                <h2>Ride ID: ${ride.rideID}</h2>
                                <div class="ride-details"><strong>Pickup Location:</strong> ${ride.pickupLocation}</div>
                                <div class="ride-details"><strong>Drop Location:</strong> ${ride.dropLocation}</div>
                                <div class="ride-details"><strong>Fare:</strong> Rs. ${ride.fare}</div>
                                <div class="ride-details"><strong>Distance:</strong> ${ride.distance} km</div>
                                <div class="ride-details"><strong>Driver Name:</strong> ${ride.firstName} ${ride.lastName}</div>
                                <div class="ride-details"><strong>Vehicle:</strong> ${ride.vehicle}</div>
                                <div class="ride-details"><strong>Reg No:</strong> ${ride.regNo}</div>
                                <div class="ride-details"><strong>Driver's Contact:</strong> ${ride.mobile}</div>
                                <form action="completeRide.php" method="POST" class="complete-ride-form">
                                    <input type="hidden" name="rideID" value="${ride.rideID}">
                                    <input type="hidden" name="driverID" value="${ride.driverID}">
                                    <button type="submit">Complete Ride</button>
                                </form>
                            `;

                            // Append the ride div to the container
                            ridesContainer.appendChild(rideDiv);
                        });

                        // Attach event listeners to complete the ride
                        document.querySelectorAll('.complete-ride-form').forEach(form => {
                            form.addEventListener('submit', function(e) {
                                e.preventDefault();

                                const formData = new FormData(this);
                                const rideID = formData.get('rideID');
                                const driverID = formData.get('driverID');
                                
                                // Submit the ride completion form using POST
                                fetch('completeRide.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.text())
                                .then(data => {
                                    alert('Ride completed successfully!');
                                    // Open rating popup
                                    openRatingPopup(driverID);
                                    this.closest('.ride-container').remove();
                                })
                                .catch(error => {
                                    alert('Error completing the ride. Please try again.');
                                });
                            });
                        });
                    } else {
                        // If no rides are ongoing, show a message
                        ridesContainer.innerHTML = '<p>No ongoing rides at the moment.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching ongoing rides:', error);
                });
        });

        // Function to open the rating popup
        function openRatingPopup(driverID) {
            const ratingPopup = document.getElementById('ratingPopup');
            ratingPopup.style.display = 'flex';
            document.getElementById('driverID').value = driverID;
        }
    </script>
</body>
</html>
