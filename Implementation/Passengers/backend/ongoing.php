<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi - Your Ongoing Rides</title>

    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        #rides {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .ride-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            padding: 25px;
            width: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .ride-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.1);
        }
        .ride-container h2 {
            color: #3498db;
            margin-top: 0;
            font-size: 1.5em;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .ride-details {
            margin-bottom: 12px;
            font-size: 0.95em;
            line-height: 1.4;
        }
        .ride-details strong {
            color: #2c3e50;
            font-weight: 600;
        }
         button {
            background-color: #2ecc71;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }
        button:hover {
            background-color: #27ae60;
        }
        button:disabled {
            background-color: #95a5a6;
            cursor: not-allowed;
        }
        #ratingPopup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .popup-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .popup-content h2 {
            color: #3498db;
            margin-bottom: 20px;
        }
        #ratingForm label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        #ratingForm input[type="radio"] {
            display: none;
        }
        #ratingForm .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
            text-align: center;
        }
        #ratingForm .rating > label {
            display: inline-block;
            position: relative;
            width: 1.1em;
            font-size: 2em;
            color: #ddd;
            cursor: pointer;
        }
        #ratingForm .rating > label:hover,
        #ratingForm .rating > label:hover ~ label,
        #ratingForm .rating > input:checked ~ label {
            color: #ffd700;
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