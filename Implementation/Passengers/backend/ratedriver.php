<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SCSS file -->
     <link rel="stylesheet" href="../../Drivers/backend/ride/Sass/acceptRide.scss">
</head>

</html>

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
            // echo "Thank you for rating the driver!";
            ?>
            <!--=== Correct Content ===-->
                    <!--* hero section *-->
                    <div class="conn">
                    
                        <div class="container">
                        <br><br><br><br><br><br><br><br><br><br>
                            <div class="header">
                                <img
                                    src="https://img.icons8.com/?size=100&id=a4l6bA9mSmBh&format=png&color=40C057"
                                    alt="Checkmark"
                                    class="checkmark"
                                />
                                <h1>Thank you for rating the driver!</h1>
                            </div>
                            <p>
                                You are successfully rate your driver. Thank you for your ratings
                            </p>
                            <br />
                            <a href="HomePassenger.php"><button class="backbtn">Back</button></a>
                            <br><br>
                            <img src="https://www.gifcen.com/wp-content/uploads/2021/05/car-gif-7.gif" alt="" style="width: 300px; height:300px; border-radius:10px; object-fit:cover;">
                        </div>
                    </div>
            <?php
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
