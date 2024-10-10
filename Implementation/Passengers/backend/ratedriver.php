<?php
// ratedriver.php

// Include database connection
include 'dbConnection.php';

// Check if form is submitted with POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $driverID = isset($_POST['driverID']) ? intval($_POST['driverID']) : null;
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : null;
    $comment = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : null;

    // Validate if driverID, rating, and comment are set
    if ($driverID && $rating && $rating >= 1 && $rating <= 5 && $comment) {

        // First, insert the comment into the driverfeedback table
        $sqlComment = "INSERT INTO driverfeedback (driverID, comment) VALUES (?, ?)";
        $stmtComment = $conn->prepare($sqlComment);
        $stmtComment->bind_param("is", $driverID, $comment);

        if ($stmtComment->execute()) {
            // Comment successfully added, proceed with rating

            // Check if this driver already has ratings
            $sql = "SELECT * FROM driverratings WHERE driverID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $driverID);
            $stmt->execute();
            $result = $stmt->get_result();

            $currentDate = date('Y-m-d H:i:s'); // Get the current date and time

            if ($result->num_rows > 0) {
                // Driver has previous ratings, update them
                $row = $result->fetch_assoc();
                $total_ratings = $row['total_ratings'] + 1;
                $rating_sum = $row['rating_sum'] + $rating;
                $rating_avg = $rating_sum / $total_ratings;

                // Update driver rating
                $updateSql = "UPDATE driverratings 
                              SET total_ratings = ?, rating_sum = ?, rating_avg = ?, last_rating = ?, last_rating_date = ? 
                              WHERE driverID = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("iidisi", $total_ratings, $rating_sum, $rating_avg, $rating, $currentDate, $driverID);

                // Execute update query
                if ($updateStmt->execute()) {
                    echo 'message=rating_comment_success';
                    exit();
                } else {
                    echo 'message=rating_error';
                    exit();
                }

            } else {
                // No ratings found for this driver, insert a new record
                $total_ratings = 1;
                $rating_sum = $rating;
                $rating_avg = $rating;

                // Insert new driver rating record
                $insertSql = "INSERT INTO driverratings (driverID, total_ratings, rating_sum, rating_avg, last_rating, last_rating_date) 
                              VALUES (?, ?, ?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param("iiidis", $driverID, $total_ratings, $rating_sum, $rating_avg, $rating, $currentDate);

                // Execute insert query
                if ($insertStmt->execute()) {
                    echo 'message=rating_comment_success';
                    exit();
                } else {
                    echo 'message=rating_error';
                    exit();
                }
            }

        } else {
            // Comment insertion failed
            echo 'message=comment_error';
            exit();
        }
    } else {
        // Invalid input or missing data
        echo 'message=invalid_input';
        exit();
    }
} else {
    // Redirect if the page is accessed without submitting the form
    header("Location: ongoingRides.php");
    exit();
}
?>
