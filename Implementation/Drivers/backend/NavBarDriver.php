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
    <link rel="stylesheet" href="Sass/NavBarDriver.min.css" />

    <!--font awesome(for icons)-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <!-- title section -->
    <link rel="icon" href="City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi</title>
  </head>
  <body>
    <header class="header">
      <a href="#" class="header__logo">City-Taxi</a>

      <i class="bx bx-menu header__toggle" id="header-toggle"></i>

      <nav class="nav" id="nav-menu">
        <div class="nav__content bd-grid">
          <a href="" class="nav__perfil">
            <div class="nav__img">
              <img src="assets/img/perfil.jpg" alt="" />
            </div>

            <div>
            <img src="../../City-Taxi.png" alt="" style="width: 85px; height: 60px" />
            </div>
          </a>

          <div class="nav__menu">
            <ul class="nav__list">

              <li class="nav__item">
                <a href="HomeDriver.php" class="nav__link"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
              </li>

              <li class="nav__item">
                <a href="ride/mapShowLocationCus.php" class="nav__link"><i class="fa fa-taxi" aria-hidden="true"></i> Ride</a>
              </li>

              <li class="nav__item">
                <a href="statusList/statusDriver.php" class="nav__link"><i class="fa fa-taxi" aria-hidden="true"></i> Status</a>
              </li>

              <li class="nav__item dropdown">
                <a href="#" class="nav__link dropdown__link"
                  >Activities <i class="bx bx-chevron-down dropdown__icon"></i
                ></a>

                <ul class="dropdown__menu" style="background-color:#1a242f">

                  <li class="dropdown__item">
                    <a href="#" class="nav__link">Ongoing</a>
                  </li>

                  <li class="dropdown__item">
                    <a href="#" class="nav__link">Completed</a>
                  </li>


                </ul>
              </li>

              <li class="nav__item">
                <a href="NotificationDriver.php" class="nav__link"><i class="fa fa-bell" aria-hidden="true"></i> Notifications</a>
              </li>

              <li class="nav__item" style="margin-left:70px">
                <a href="ProfileDriver.php" class="nav__link"><i class="fa fa-user-circle" aria-hidden="true"></i>
                  <?php
                    session_start();
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo "Welcome, " . htmlspecialchars($_SESSION['firstName']);
                    } else {
                        echo '<a href="login.php" style="color: white;">Login</a>';
                    }
                  ?> 
                </a>
              </li>

              <li class="nav__item" style="margin-left:-20px">
                <a href="../driversLogin.html" class="nav__link"> | <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
              </li>

            </ul>
          </div>
        </div>
      </nav>
    </header>

    <br><br>
    

    <!--===== MAIN JS =====-->
    <script src="Js/main.js"></script>
  </body>
</html>
