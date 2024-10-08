<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi - Your Ongoing Rides</title>

    <link rel="stylesheet" href="Sass/ongoing.min.css">

    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        .pbtn{
            background-color: #1a242f;
        }
        .pbtn:hover{
            background-color: #000;
        }
        .pbtn a{
            color: white;
        }
    </style>
</head>
<body>
    <?php include 'NavBarPassenger.php'; ?>

    <h1>Your Ongoing Rides</h1>
    <div id="rides"></div>

    <div id="ratingPopup">
        <div class="popup-content">
            <h2>Rate Your Driver</h2>
            <form id="ratingForm" method="POST" action="rateDriver.php">
                <input type="hidden" name="driverID" id="driverID">
                <label for="rating">How was your experience?</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Excellent">★</label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Very Good">★</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Good">★</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Fair">★</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Poor">★</label>
                </div>
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
                                <button class="pbtn">
                                    <a href="../../checkout.php?fare=${ride.fare}" class="payment-button">Make Payment</a>
                                </button>
                                <form action="completeRide.php" method="POST" class="complete-ride-form">
                                    <input type="hidden" name="rideID" value="${ride.rideID}">
                                    <input type="hidden" name="driverID" value="${ride.driverID}">
                                    <button type="submit">Rate Driver</button>
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