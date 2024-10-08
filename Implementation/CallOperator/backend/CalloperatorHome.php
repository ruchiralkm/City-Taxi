<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- title section -->
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi</title>

    <!--font awesome(for icons)-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <!--BootStrap-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!--Calloperator Ride scss file-->
    <link rel="stylesheet" href="Sass/CalloperatorHome.min.css" />

  </head>
  <body>
    <div class="wrapper">
      <aside class="sidebar">
        <div class="d-flex">
          <button class="toggle-btn" type="button">
            <i class="fas fa-bars"></i>
          </button>

          <div class="sidebar-logo">
            <a href="#"><img src="../../City-Taxi.png" alt="" style="width: 85px; height: 60px" /></a>
          </div>
        </div>

        <ul class="sidebar-nav">
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="CalloperatorRide.php" class="sidebar-link">
              <i class="fas fa-car"></i>
              <span>Rides</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a href="CalloperatorPassenger.php" class="sidebar-link">
              <i class="fas fa-user"></i>
              <span>Passengers</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a href="CalloperatorDriver.php" class="sidebar-link">
            <i class="fa-solid fa-user-nurse"></i>
              <span>Drivers</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link collapsed has-dropdown"
              data-bs-toggle="collapse"
              data-bs-target=".tools"
              aria-expanded="false"
              aria-controls="tools"
            >
              <i class="fas fa-wrench"></i>
              <span>Tools</span>
            </a>
            <ul
              class="tools sidebar-dropdown list-unstyled collapse"
              data-bs-parent=".sidebar"
            >
              <li class="sidebar-item">
                <a
                  href="#"
                  class="sidebar-link collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target=".drop-two"
                  aria-expanded="false"
                  aria-controls="drop-two"
                >
                  Guides
                </a>
                <ul class="drop-two sidebar-dropdown list-unstyled collapse">
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Start a Blog</a>
                  </li>
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Start a Website</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
              <i class="fas fa-bell"></i>
              <span>Notifications</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
              <i class="fas fa-cog"></i>
              <span>Settings</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link collapsed has-dropdown"
              data-bs-toggle="collapse"
              data-bs-target=".company"
              aria-expanded="false"
              aria-controls="company"
            >
              <i class="fas fa-building"></i>
              <span>Company</span>
            </a>
            <ul
              class="company sidebar-dropdown list-unstyled collapse"
              data-bs-parent=".sidebar"
            >
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">About</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Contact</a>
              </li>
            </ul>
          </li>
        </ul>

        <div class="sidebar-footer">
          <a href="../callOperator.html" class="sidebar-link">
            <i class="fas fa-right-from-bracket"></i>
            <span>Logout</span>
          </a>
        </div>
      </aside>

      <div class="main p-4">
        <!-- Home Section -->

        <div class="mainBox">
          <div class="left-Box">
            <img src="../../Assets/dashboard.png" alt="">
          </div>

          <div class="right-Box">
            <img src="../../Assets/dashboardui.png" alt="">
          </div>
        </div>



        <!-- Counter -->
        <div class="counters">
          <div class="container">
            <center><img src="https://img.icons8.com/?size=100&id=63397&format=png&color=40C057" alt="" style="width:60px; height:60px;"></center>
            <span class="num" data-val="24">000</span>
            <span class="text" style="font-weight: 500;">Passengers</span>
          </div>

          <div class="container">
            <center><img src="https://img.icons8.com/?size=100&id=63392&format=png&color=40C057" alt="" style="width:60px; height:60px;"></center>
            <span class="num" data-val="16">000</span>
            <span class="text" style="font-weight: 500;">Drivers</span>
          </div>

          <div class="container">
            <center><img src="https://img.icons8.com/?size=100&id=12684&format=png&color=40C057" alt="" style="width:60px; height:60px;"></center>
            <span class="num" data-val="25">000</span>
            <span class="text" style="font-weight: 500;">Total Rides</span>
          </div>

          <div class="container">
            <center><img src="https://img.icons8.com/?size=100&id=85185&format=png&color=40C057" alt="" style="width:60px; height:60px;"></center>
            <span class="num" data-val="182">000</span>
            <span class="text" style="font-weight: 500;">Total Stars</span>
          </div>
          
        </div>
        
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="Js/app.js"></script>
    <script src="Js/counter.js"></script>
  </body>
</html>
