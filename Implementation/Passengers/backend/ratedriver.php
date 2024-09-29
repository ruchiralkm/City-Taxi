<?php
// Include the database connection file
include 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['driverID']) && isset($_POST['rating'])) {
    // Get the driverID and rating from the POST data
    $driverID = $_POST['driverID'];
    $rating = $_POST['rating'];

    // Begin transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Update total ratings, rating sum, and last rating
        $stmt = $conn->prepare("INSERT INTO driverRatings (driverID, total_ratings, rating_sum, last_rating) 
                                VALUES (?, 1, ?, ?) 
                                ON DUPLICATE KEY UPDATE 
                                    total_ratings = total_ratings + 1, 
                                    rating_sum = rating_sum + ?, 
                                    last_rating = ?");
        $stmt->bind_param("iiiii", $driverID, $rating, $rating, $rating, $rating);

        if ($stmt->execute()) {
            echo "Thank you for rating the driver!";
        } else {
            echo "Failed to submit rating.";
        }

        // Commit transaction
        $conn->commit();

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        // Rollback in case of error
        $conn->rollback();
        echo "Failed to submit rating: " . $e->getMessage();
    }

}

// Close the database connection
$conn->close();
?>
