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
    <link rel="stylesheet" href="Sass/CalloperatorPassenger.min.css" />

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
            <a href="CalloperatorHome.php" class="sidebar-link">
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
            <a href="#" class="sidebar-link">
              <i class="fas fa-user"></i>
              <span>Passengers</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
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
        <h1 class="ee">Passenger Section</h1>


        <!-- Registered Passenger -->
        <div class="tableContent">
            <h1>Registered Passenger</h1>
            <table>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Frist Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Pickup Location</th>
                    <th>Drop Location</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td data-label="#">S20</td>
                    <td data-label="#">Tahani</td>
                    <td data-label="#">Hareeth</td>
                    <td data-label="#">119</td>
                    <td data-label="#">tani@gmail.com</td>
                    <td data-label="#">Badulla</td>
                    <td data-label="#">Kandy</td>
                </tr>

                <tr>
                    <td data-label="#">S20</td>
                    <td data-label="#">Tahani</td>
                    <td data-label="#">Hareeth</td>
                    <td data-label="#">119</td>
                    <td data-label="#">tani@gmail.com</td>
                    <td data-label="#">Badulla</td>
                    <td data-label="#">Kandy</td>
                </tr>
                    
                </tbody>
            </table>
        </div>



        <!-- Unregistered Passenger -->
        <div class="tableContent">
            <h1>Unregistered Passenger</h1>
            <table>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Frist Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <th>Pickup Location</th>
                    <th>Drop Location</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td data-label="#">S20</td>
                    <td data-label="#">Tahani</td>
                    <td data-label="#">Hareeth</td>
                    <td data-label="#">119</td>
                    <td data-label="#">Badulla</td>
                    <td data-label="#">Kandy</td>
                </tr>
                    
                </tbody>
            </table>
        </div>





      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="Js/app.js"></script>
  </body>
</html>
