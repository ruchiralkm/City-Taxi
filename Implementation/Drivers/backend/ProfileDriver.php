

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
    <link rel="stylesheet" href="Sass/ProfileDriver.min.css" />

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
    <?php include 'NavBarDriver.php'; 

      //fetch driver data
      include 'dbConnection.php';
      
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
      {
      $driverID = $_SESSION['driverID']; 
      }
      $driverData = [];

      if ($driverID)
      {
      $selectQuery = "SELECT * FROM driver WHERE driverID = '$driverID'";
      $stmt = $conn->prepare($selectQuery);
      $stmt->execute();
      $result = $stmt->get_result();
      $driverData = $result->fetch_assoc();

      }
    ?>


    <div class="profile-section">
      <div class="profile-container">
        <div class="profile-header">
          <img
            src="https://static.vecteezy.com/system/resources/thumbnails/001/340/769/small_2x/street-side-scene-with-red-telephone-box-scene-free-vector.jpg"
            alt="Profile header image"
          />
          <div class="profile-avatar">
            <img
              src="https://static.vecteezy.com/system/resources/previews/001/840/618/original/picture-profile-icon-male-icon-human-or-people-sign-and-symbol-free-vector.jpg"
              alt="Profile picture"
            />
            <h1 class="profile-name"><?= $driverData['firstName'] ?? 'Driver' ?> <?= $driverData['lastName'] ?? '' ?> </h1>
          </div>
        </div>
        <h1 class="profile-name"><?= $driverData['firstName'] ?? 'Driver' ?> <?= $driverData['lastName'] ?? '' ?></h1>
        <h4 style="margin-left:20px; margin-bottom:5px; margin-top:-10px;">Personal Information</h4>
        <form class="profile-form" method = "POST" action="ProfileDriver.php">
          <div class="form-row">
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" name="firstName" value="<?= $driverData['firstName'] ?? '' ?>"/>
            </div>
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" name="lastName" value="<?= $driverData['lastName'] ?? '' ?>" />
            </div>
            <div class="form-group">
              <label for="Address">Address</label>
              <input type="text" id="Address" name="Address" value="<?= $driverData['address'] ?? '' ?>" />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="mobile">Mobile Number</label>
              <input type="number" id="mobile" name="mobile" value="<?= $driverData['mobile'] ?? '' ?>"/>
            </div>
            <div class="form-group">
              <label for="Licence">Licence Number</label>
              <input type="text" id="Licence" name="Licence" value="<?= $driverData['licenceNumber'] ?? '' ?>"/>
            </div>
            <div class="form-group">
              <label for="Vehicle">Vehicle Type</label>
              <input type="text" id="Vehicle" name="Vehicle" value="<?= $driverData['vehicle'] ?? '' ?>"/>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" value="<?= $driverData['email'] ?? '' ?>"/>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" value="password" value="<?= $driverData['password'] ?? '' ?>" />
            </div>
            <div class="form-group">
              <label for="password">Confirm Password</label>
              <input type="password" id="password" name="conPass" value="password" value="<?= $driverData['password'] ?? '' ?>" />
            </div>
          </div>
          


          <h4 style="margin-bottom:15px; margin-top:15px;">Vehicle Information</h4>
          <div class="form-row">
            <div class="form-group">
              <label for="email">Vehicle NO</label>
              <input type="no" id="no" name="no" value="<?= $driverData['regNo'] ?? '' ?>"/>
            </div>
            <div class="form-group">
              <label for="Brand">Brand</label>
              <input type="text" id="Brand" name="Brand" value="<?= $driverData['vehicleBrand'] ?? '' ?>"/>
            </div>
            <div class="form-group">
              <label for="Model">Model</label>
              <input type="text" id="Model" name="Model" value="<?= $driverData['vehicleModel'] ?? '' ?>"/>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="Year">Year</label>
              <input type="text" id="Year" name="Year" value="<?= $driverData['vYear'] ?? '' ?>"/>
            </div>
            <div class="form-group">
              <label for="Colour">Colour</label>
              <input type="text" id="Colour" name="Colour" value="<?= $driverData['vColor'] ?? '' ?>" />
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
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $address = $_POST['Address'];
  $mobile = $_POST['mobile'];
  $licence = $_POST['Licence'];
  $vehicleType = $_POST['Vehicle'];
  $email = $_POST['email'];
  $password = $_POST['password']; 
  $conPassword = $_POST['conPass'];
  $vehicleNo = $_POST['no'];
  $brand = $_POST['Brand'];
  $model = $_POST['Model'];
  $year = $_POST['Year'];
  $colour = $_POST['Colour'];

  if($password==$conPassword){
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("UPDATE driver 
                          SET firstName = '$firstName', 
                              lastName = '$lastName', 
                              address = '$address', 
                              mobile = '$mobile', 
                              licenceNumber = '$licence', 
                              vehicle = '$vehicleType', 
                              email = '$email', 
                              password = '$hashedPassword', 
                              regNo = '$vehicleNo', 
                              vehicleBrand = '$brand', 
                              vehicleModel = '$model', 
                              vYear = '$year', 
                              vColor = '$colour' 
                          WHERE driverID = '$driverID'");


 // Check if the prepare() statement is successful
 if ($stmt === false) {
  // Output the SQL error
  die("Error preparing statement: " . $conn->error);
}

// Execute the query
if ($stmt->execute()) {
  // Success message
  echo "<script>alert('Profile updated successfully!');</script>";
} else {
  // Error handling
  echo "<script>alert('Error updating profile. Please try again.');</script>";
}

// Close the statement
$stmt->close();
}

else
{
  
  echo "<script>alert('Error updating profile. Please Enter correct Password.');</script>";
}
}


?>