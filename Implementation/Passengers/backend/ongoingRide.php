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
        .pbtn {
            background-color: #1a242f;
            padding: 10px;
            margin-top: 10px;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .pbtn:hover {
            background-color: #000;
        }

        textarea {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 2px solid #3498db;
            border-radius: 8px;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            resize: vertical;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        textarea:focus {
            outline: none;
            border-color: #2980b9;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.5);
            background-color: #fff;
        }

        textarea::placeholder {
            color: #95a5a6;
        }
        
        /* Rating Popup Styles */
        #ratingPopup {
            display: none; /* Hidden by default */
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            width: 300px;
        }

        .rating {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-bottom: 15px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
        }

        .rating input:checked ~ label {
            color: #f39c12;
        }

        .popup-content button {
            background-color: #1a242f;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup-content button:hover {
            background-color: #000;
        }
    </style>
</head>
<body>

    <div id="rides">
        <?php
        include('dbConnection.php');

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $passengerID = htmlspecialchars($_SESSION['passengerID']);
        } else {
            echo 'Please login to view notifications.';
            exit;
        }

        // SQL query for fetching ongoing rides for the logged-in passenger
        $query = "
        SELECT 
            r.rideID, 
            r.pickupLocation, 
            r.dropLocation, 
            r.fare, 
            r.distance, 
            d.firstName, 
            d.lastName, 
            d.driverID,
            d.vehicle, 
            d.regNo, 
            d.mobile
        FROM 
            ride r
        INNER JOIN 
            driver d ON r.driverID = d.driverID
        WHERE 
            r.passengerID = ? 
        AND 
            r.rideStatus = 'Accepted'";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $passengerID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='ride-container'>
                            <h2>Ride ID: " . $row['rideID'] . "</h2>
                            <div><strong>Pickup Location:</strong> " . $row['pickupLocation'] . "</div>
                            <div><strong>Drop Location:</strong> " . $row['dropLocation'] . "</div>
                            <div><strong>Fare:</strong> Rs. " . $row['fare'] . "</div>
                            <div><strong>Distance:</strong> " . $row['distance'] . " km</div>
                            <div><strong>Driver Name:</strong> " . $row['firstName'] . " " . $row['lastName'] . "</div>
                            <div><strong>Vehicle:</strong> " . $row['vehicle'] . "</div>
                            <div><strong>Reg No:</strong> " . $row['regNo'] . "</div>
                            <div><strong>Driver's Contact:</strong> " . $row['mobile'] . "</div>
                            <button class='pbtn'><a href='../../checkout.php?fare=" . $row['fare'] . "' class='payment-button'>Make Payment</a></button>
                            <button class='pbtn' onclick='completeRide(" . $row['rideID'] . ")'>Complete Ride</button>
                            <button class='pbtn' onclick='openRatingPopup(" . $row['driverID'] . ")'>Rate Driver</button>
                          </div>";
                }
            } else {
                echo "No ongoing rides at the moment.";
            }

            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
        ?>
    </div>

    <!-- Rating Popup -->
    <div id="ratingPopup">
        <div class="popup-content">
            <h2>Rate Your Driver</h2>
            <form id="ratingForm" method="POST">
                <input type="hidden" id="driverID" name="driverID" value="">
                
                <label for="rating">How was your experience?</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Excellent">★</label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Very Good">★</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Good">★</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Fair">★</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Poor">★</label>
                </div>

                <textarea name="comments" id="comments" placeholder="Leave your comments here..."></textarea>

                <button type="button" onclick="submitRating()">Submit Rating</button>
            </form>
        </div>
    </div>

    <script>
        // Function to open the rating popup
        function openRatingPopup(driverID) {
            document.getElementById('driverID').value = driverID;
            document.getElementById('ratingPopup').style.display = 'flex';
        }

        // Function to close the popup when clicking outside the popup content
        window.onclick = function(event) {
            const popup = document.getElementById('ratingPopup');
            if (event.target === popup) {
                popup.style.display = 'none';
            }
        };

        // Function to complete the ride using AJAX
        function completeRide(rideID) {
            if (confirm("Are you sure you want to mark this ride as complete?")) {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "completeRide.php?rideID=" + rideID, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        alert("Ride completed successfully!");
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert("Failed to complete the ride.");
                    }
                };
                xhr.send();
            }
        }

        // Function to submit the rating using AJAX
        function submitRating() {
            const formData = new FormData(document.getElementById('ratingForm'));
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "ratedriver.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Rating submitted successfully!");
                    document.getElementById('ratingPopup').style.display = 'none'; // Close popup
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert("Failed to submit the rating.");
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>
