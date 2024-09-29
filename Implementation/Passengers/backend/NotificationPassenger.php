<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
      rel="stylesheet"
    />
    
    <!-- ===== SCSS File ===== -->
    <link rel="stylesheet" href="#" />

    <!--font awesome(for icons)-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <!-- title section -->
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi</title>
  </head>
  <body>
    <!-- Navigation Bar -->
    <?php include 'NavBarPassenger.php'; ?>

    <h1>Notifications Section</h1>
    
    <?php


// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $passengerID = htmlspecialchars($_SESSION['passengerID']);
} else {
    echo 'Please login to view notifications.';
    exit;
}

// Include the database connection
include 'dbConnection.php';

// Fetch unread notifications for the passenger
$sql = "SELECT * FROM notifications WHERE recipientType = 'passenger' AND recipientID = '$passengerID' AND status = 0 ORDER BY timeStamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Notifications</title>
    <link rel="stylesheet" href="Sass/notificationPassenger.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="notification-container">
        <h2>Your Notifications</h2>
        <div class="notification-list">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each notification
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="notification-item">';
                    echo '<p>' . htmlspecialchars($row['Message']) . '</p>';
                    echo '<p class="timestamp">' . htmlspecialchars($row['timeStamp']) . '</p>';
                    echo '<button class="mark-read-btn" data-id="' . $row['notificationID'] . '">Mark as Read</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>No new notifications.</p>';
            }
            ?>
        </div>
    </div>

    <script>
        // JavaScript to mark notifications as read
        $(document).on('click', '.mark-read-btn', function() {
            var notificationID = $(this).data('id');
            $.ajax({
                url: 'markNotificationRead.php',
                type: 'POST',
                data: { id: notificationID },
                success: function(response) {
                    if (response === 'success') {
                        location.reload(); // Reload the page to reflect the changes
                    } else {
                        alert('Failed to mark notification as read.');
                    }
                }
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>


    <!--===== MAIN JS =====-->
    <script src="Js/main.js"></script>
  </body>
</html>
