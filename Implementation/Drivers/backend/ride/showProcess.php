<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City-Taxi</title>

    <link rel="stylesheet" href="Sass/showProcess.min.css">
</head>
<body>
    
</body>
</html>
<?php
// Database connection
include '../dbConnection.php';

// Check if rideID is set in the URL
if (isset($_GET['rideID'])) {
    $rideID = htmlspecialchars($_GET['rideID']);

    // SQL query to fetch ride details based on the rideID
    $sql = "SELECT * FROM ride WHERE rideID = '$rideID'";
    $result = $conn->query($sql);

    // Check if the ride exists
    if ($result->num_rows > 0) {
        // Add a button to show the map with this rideID
        echo '<a href="mapShowLocationCus.php?rideID=' . $rideID . '" style="display:none;">Show on Map</a>';
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
          <h1>Passenger is successfully assigned</h1>
        </div>
        <p>
          Your passenger's ride is currently being processed. Now you can check the passenger's locations
        </p>
        <br />
        <a href="requestedRides.php"><button class="backbtn">Back</button></a>
        <?php echo '<a href="mapShowLocationCus.php?rideID=' . $rideID . '"><button class="loginbtn">Show Map</button></a>';?>
        <br><br>
        <img src="https://www.gifcen.com/wp-content/uploads/2021/05/car-gif-7.gif" alt="" style="width: 300px; height:300px; border-radius:10px; object-fit:cover;">
      </div>
    </div>



    <?php
    } else {
    ?>

    <!--=== InCorrect Content ===-->
    <!--* hero section *-->
    <div class="conn">
      <div class="container">
        <div class="header">
          <img
            src="https://img.icons8.com/?size=100&id=XMIQOqKWWnuu&format=png&color=FA5252"
            alt="Checkmark"
            class="checkmark"
          />
          <h1>Somthing went a wrong</h1>
        </div>
        <p>
          Passenger's ride is not assigned. Please go back to the menu
        </p>
        <br />
        <a href="requestedRides.php"><button class="backbtn">Back</button></a>
      </div>
    </div>

    <?php
    }
} else {

    ?>
    <!--=== InCorrect Content ===-->
    <!--* hero section *-->
    <div class="conn">
      <div class="container">
        <div class="header">
          <img
            src="https://img.icons8.com/?size=100&id=XMIQOqKWWnuu&format=png&color=FA5252"
            alt="Checkmark"
            class="checkmark"
          />
          <h1>Somthing went a wrong</h1>
        </div>
        <p>
          Passenger's ride is not assigned. Please go back to the menu
        </p>
        <br />
        <a href="requestedRides.php"><button class="backbtn">Back</button></a>
      </div>
    </div>

    <?php
}

$conn->close();
?>
