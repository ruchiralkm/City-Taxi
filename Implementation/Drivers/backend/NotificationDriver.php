<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $passengerID = htmlspecialchars($_SESSION['passengerID']);
} else {
    echo 'Please login to view notifications.';
    exit;
}

// Include the database connection
include './dbConnection.php';

// Fetch unread notifications for the passenger
$sql = "SELECT * FROM notifications WHERE recipientType = 'passenger' AND recipientID = '$passengerID' AND status = 0 ORDER BY timeStamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    
    <!-- ===== SCSS File ===== -->
    <link rel="stylesheet" href="Sass/NotificationDriver.min.css" />

    <!--font awesome(for icons)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- title section -->
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi - Notifications</title>


</head>
<body>
    <!-- Navigation Bar -->
    <?php include 'NavBarDriver.php'; ?>

    <h1>Notification Section</h1>

    <div class="notification-container">
        <h2>Your Notifications</h2>
        <div class="notification-list">
            <?php
            if ($result->num_rows > 0) {
                // Output of each notification
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="notification-item">';
                    echo '<p>' . htmlspecialchars($row['Message']) . '</p>';
                    echo '<p class="timestamp">' . htmlspecialchars($row['timeStamp']) . '</p>';
                    echo '<button class="mark-read-btn" data-id="' . $row['id'] . '">Mark as Read</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>No new notifications.</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        
        $('.notification-item').each(function(index) {
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            }).delay(100 * index).animate({
                'opacity': '1',
                'transform': 'translateY(0)'
            }, 500);
        });

        // Click effect and AJAX call for "Mark as Read" button
        $('.mark-read-btn').on('click', function() {
            var $button = $(this);
            var notificationID = $button.data('id');

            // Add a pressed effect
            $button.css({
                'transform': 'scale(0.95)',
                'box-shadow': 'inset 0 3px 5px rgba(0, 0, 0, 0.1)'
            });

            $.ajax({
                url: 'markNotificationRead.php',
                type: 'POST',
                data: { id: notificationID },
                success: function(response) {
                    if (response === 'success') {
                        // Change button appearance on success
                        $button.text('Marked as Read');
                        $button.css({
                            'background-color': '#6c757d',
                            'cursor': 'default'
                        }).prop('disabled', true);

                        // Fade out the notification item
                        $button.closest('.notification-item').fadeOut(500, function() {
                            $(this).remove();
                            // Check if there are any notifications left
                            if ($('.notification-item').length === 0) {
                                $('.notification-list').html('<p>No new notifications.</p>');
                            }
                        });
                    } else {
                        alert('Failed to mark notification as read.');
                        // Reset button style if failed
                        $button.css({
                            'transform': 'scale(1)',
                            'box-shadow': 'none'
                        });
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                    // Reset button style if error
                    $button.css({
                        'transform': 'scale(1)',
                        'box-shadow': 'none'
                    });
                }
            });
        });
    });
    </script>

    <!--===== MAIN JS =====-->
    <script src="Js/main.js"></script>
</body>
</html>
<?php
$conn->close();
?>