<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
      rel="stylesheet"
    />
    
    <link rel="stylesheet" href="Sass/ProfilePassenger.min.css">

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
    <?php include 'NavBarPassenger.php';
     //fetch driver data
     include 'dbConnection.php';
      
     if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
     {
     $passengerID = $_SESSION['passengerID']; 
     }
     $passengerData = [];

     if ($passengerID)
     {
     $selectQuery = "SELECT * FROM passenger WHERE passengerID = '$passengerID'";
     $stmt = $conn->prepare($selectQuery);
     $stmt->execute();
     $result = $stmt->get_result();
     $passengerData = $result->fetch_assoc();

     }
   ?>

  

    <div class="profile-section">
      <div class="profile-container">
        <div class="profile-header">
          <img
            src="https://img.freepik.com/premium-vector/city-street-panoramic-cityscape-with-bright-houses-walking-pedestrians-shop-stores-summer-city-vector-illustration-cartoon-style_528104-1596.jpg"
            alt="Profile header image"
          />
          <div class="profile-avatar">
            <img
              src="https://static.vecteezy.com/system/resources/previews/001/840/618/original/picture-profile-icon-male-icon-human-or-people-sign-and-symbol-free-vector.jpg"
              alt="Profile picture"
            />
          </div>
        </div>
        <h1 class="profile-name"><?= $passengerData['firstName'] ?? 'Driver' ?> <?= $passengerData['lastName'] ?? '' ?></h1>
        <form class="profile-form" method="POST" action="ProfilePassenger.php">
          <div class="form-row">
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" name="firstName" value="<?= $passengerData['firstName'] ?? '' ?>" />
            </div>
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" name="lastName" value="<?= $passengerData['lastName'] ?? '' ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= $passengerData['email'] ?? '' ?>" />
          </div>
          <div class="form-group">
            <label for="mobile">Mobile Number</label>
            <input type="tel" id="mobile" name="mobile" value="<?= $passengerData['mobile'] ?? '' ?>" />
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" value="password@123" readonly />
            </div>
            <div class="form-group">
              <label for="password">Confirm Password</label>
              <input type="password" id="password" name="conPass" value="password@123" readonly/>
            </div>
          </div>
          <button type="submit" class="update-button">Update details</button>
        </form>
      </div>
    </div>
    

    <!--===== MAIN JS =====-->
    <script src="Js/main.js"></script>
  </body>
</html>

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Ensure passengerID is set
  if (isset($passengerID)) {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    // Prepare the SQL query
    $stmt = $conn->prepare("UPDATE passenger 
                            SET firstName = ?, lastName = ?, mobile = ?, email = ? 
                            WHERE passengerID = ?");
    $stmt->bind_param("ssssi", $firstName, $lastName, $mobile, $email, $passengerID);

    // Execute the query
    if ($stmt->execute()) {
      echo "<script>alert('Profile updated successfully!');</script>";
    } else {
      echo "<script>alert('Error updating profile. Please try again.');</script>";
    }

    // Close the statement
    $stmt->close();
  } else {
    echo "<script>alert('Error: Passenger ID not found.');</script>";
  }
}

// Close the database connection
$conn->close();


?>