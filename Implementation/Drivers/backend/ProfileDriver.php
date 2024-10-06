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
    <?php include 'NavBarDriver.php'; ?>

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
            <h1 class="profile-name">Amila Bandara</h1>
          </div>
        </div>
        <h1 class="profile-name">Amila Bandara</h1>
        <h4 style="margin-left:20px; margin-bottom:5px; margin-top:-10px;">Personal Information</h4>
        <form class="profile-form">
          <div class="form-row">
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" value="Amila" />
            </div>
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" value="Bandara" />
            </div>
            <div class="form-group">
              <label for="Address">Address</label>
              <input type="text" id="Address" value="Kandy" />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="mobile">Mobile Number</label>
              <input type="number" id="mobile" value="0777123456" />
            </div>
            <div class="form-group">
              <label for="Licence">Licence Number</label>
              <input type="text" id="Licence" value="123456" />
            </div>
            <div class="form-group">
              <label for="Vehicle">Vehicle Type</label>
              <input type="text" id="Vehicle" value="Car" />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" value="amila@gmail.com" />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" value="password" />
            </div>
            <div class="form-group">
              <label for="password">Confirm Password</label>
              <input type="password" id="password" value="password" />
            </div>
          </div>
          


          <h4 style="margin-bottom:15px; margin-top:15px;">Vehicle Information</h4>
          <div class="form-row">
            <div class="form-group">
              <label for="email">Vehicle NO</label>
              <input type="no" id="no" value="ABC-1234" />
            </div>
            <div class="form-group">
              <label for="Brand">Brand</label>
              <input type="text" id="Brand" value="Nissan" />
            </div>
            <div class="form-group">
              <label for="Model">Model</label>
              <input type="text" id="Model" value="GTR-R35" />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="Year">Year</label>
              <input type="text" id="Year" value="2017" />
            </div>
            <div class="form-group">
              <label for="Colour">Colour</label>
              <input type="text" id="Colour" value="Red" />
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
