<?php
include 'dbConnection.php';

if (isset($_POST['id'])) {
    $notificationID = htmlspecialchars($_POST['id']);

    // Update notification status to "read"
    $sql = "UPDATE notifications SET status = 1 WHERE notificationID = '$notificationID'";
    
    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }
}

$conn->close();
?>
