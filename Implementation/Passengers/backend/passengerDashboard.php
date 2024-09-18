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
    <link rel="stylesheet" href="Sass/passengerDashboard.min.css" />

    <!--font awesome(for icons)-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <title>Responsive menu dropdown</title>
  </head>
  <body>
    <header class="header">
      <a href="#" class="header__logo">Clay</a>

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
                <a href="#" class="nav__link active"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
              </li>

              <li class="nav__item">
                <a href="#" class="nav__link"><i class="fa fa-taxi" aria-hidden="true"></i> Ride</a>
              </li>

              <li class="nav__item dropdown">
                <a href="#" class="nav__link dropdown__link"
                  >Activities <i class="bx bx-chevron-down dropdown__icon"></i
                ></a>

                <ul class="dropdown__menu">

                  <li class="dropdown__item">
                    <a href="#" class="nav__link">Ongoing</a>
                  </li>

                  <li class="dropdown__item">
                    <a href="#" class="nav__link">Completed</a>
                  </li>


                </ul>
              </li>

              <li class="nav__item">
                <a href="#" class="nav__link"><i class="fa fa-bell" aria-hidden="true"></i> Notifications</a>
              </li>

              <li class="nav__item">
                <a href="#" class="nav__link"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>
              </li>

              <li class="nav__item">
                <a href="#" class="nav__link"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
              </li>

            </ul>
          </div>
        </div>
      </nav>
    </header>

    <br><br>
    <h1>Hello</h1>
    

    <!--===== MAIN JS =====-->
    <script src="Js/main.js"></script>
  </body>
</html>
