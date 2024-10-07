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
    <link rel="stylesheet" href="Sass/CalloperatorDriver.min.css" />

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
            <a href="CalloperatorPassenger.php" class="sidebar-link">
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
        <!-- Driver Section -->
        <h1 class="ee">Driver Section</h1>

        <!-- Database connection -->
        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname="citytaxi";

          $conn = mysqli_connect($servername,$username,$password,$dbname);

          if(!$conn){
            die("Connection Erro".mysqli_connect_error());
          }else{
            // echo "C";
          }
        ?>


        <!-- Driver List -->
        <div class="tableContent">
            <h1>Drivers List</h1>

              <?php
                $sql="SELECT * FROM driver";
                $result=mysqli_query($conn,$sql);

                if(mysqli_num_rows($result)>0){
              ?>

            <table>
                <thead>
                <tr>
                        <th>ID</th>
                        <th>Frist Name</th>
                        <th>Last Name</th>
                        <th>Mobile Number</th>
                        <th>Licence Number</th>
                        <th>Address</th>
                        <th>Vehicle</th>
                        <th>Employement</th>
                        <th>Vehicle No</th>
                        <th>Vehicle Brand</th>
                        <th>Vehicle Model</th>
                        <th>Vehicle Year</th>
                        <th>Vehicle Color</th>
                        <th>Profile Picture</th>
                        <th>Email</th>
                    </tr>

                    <?php
                      $i=0;
                      while($row=mysqli_fetch_array($result)){
                    ?>

                </thead>
                <tbody>
                    
                <tr>
                    <td data-label="#"><?php echo $row["driverID"];?></td>
                    <td data-label="#"><?php echo $row["firstName"];?></td>
                    <td data-label="#"><?php echo $row["lastName"];?></td>
                    <td data-label="#"><?php echo $row["mobile"];?></td>
                    <td data-label="#"><?php echo $row["licenceNumber"];?></td>
                    <td data-label="#"><?php echo $row["address"];?></td>
                    <td data-label="#"><?php echo $row["vehicle"];?></td>
                    <td data-label="#"><?php echo $row["employment"];?></td>
                    <td data-label="#"><?php echo $row["regNo"];?></td>
                    <td data-label="#"><?php echo $row["vehicleBrand"];?></td>
                    <td data-label="#"><?php echo $row["vehicleModel"];?></td>
                    <td data-label="#"><?php echo $row["vYear"];?></td>
                    <td data-label="#"><?php echo $row["vColor"];?></td>
                    <td data-label="#">Profile Pic</td>
                    <td data-label="#"><?php echo $row["email"];?></td>
                </tr>

                <?php
                  $i++;
                  }
                ?>
                    
                </tbody>
            </table>

            <?php
              }
              else{
                echo "No Records Found";
              }
            ?>

        </div>

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="Js/app.js"></script>
  </body>
</html>
