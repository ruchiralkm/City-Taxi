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
    <link rel="stylesheet" href="#" />

    <!--font awesome(for icons)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- title section -->
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi - Notifications</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            text-align: center;
            margin: 2rem 0;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .notification-container {
            max-width: 800px;
            margin: 2rem auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .notification-item {
            background-color: #f8f9fa;
            border-left: 5px solid #007bff;
            padding: 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .notification-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .notification-item p {
            margin: 0;
            color: #333;
            font-size: 1rem;
            line-height: 1.5;
        }

        .timestamp {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.75rem;
            font-style: italic;
        }

        .mark-read-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .mark-read-btn:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .notification-container {
                margin: 1rem;
                padding: 1rem;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
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
                // Output data of each notification
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
        // Animated entrance for notifications
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