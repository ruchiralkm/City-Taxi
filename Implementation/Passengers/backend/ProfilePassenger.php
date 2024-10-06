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
    <?php include 'NavBarPassenger.php'; ?>

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
        <h1 class="profile-name">Amila Bandara</h1>
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
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" value="amilabandara@gmail.com" />
          </div>
          <div class="form-group">
            <label for="mobile">Mobile Number</label>
            <input type="tel" id="mobile" value="0777123456" />
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" value="password" />
            </div>
            <div class="form-group">
              <label for="password">Confirm Password</label>
              <input type="password" id="password" value="password" />
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
