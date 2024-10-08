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

    <!--Admin Driver scss file-->
    <link rel="stylesheet" href="Sass/AdminDrivers.min.css" />

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
            <a href="AdminHome.php" class="sidebar-link">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
              <i class="fas fa-car"></i>
              <span>Rides</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a href="AdminPassengers.php" class="sidebar-link">
              <i class="fas fa-user"></i>
              <span>Passengers</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a href="AdminDrivers.php" class="sidebar-link">
            <i class="fa-solid fa-user-nurse"></i>
              <span>Drivers</span>
            </a>
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
        </ul>

        <div class="sidebar-footer">
          <a href="../admin.html" class="sidebar-link">
            <i class="fas fa-right-from-bracket"></i>
            <span>Logout</span>
          </a>
        </div>
      </aside>

      <div class="main p-4">
        <!-- Ride Section -->

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
            <h1>Ride List</h1>

              <?php
                $sql="SELECT * FROM ride";
                $result=mysqli_query($conn,$sql);

                if(mysqli_num_rows($result)>0){
              ?>

            <table>
                <thead>
                    <tr>
                        <th>Ride ID</th>
                        <th>Driver ID</th>
                        <th>Passenger ID</th>
                        <th>Passenger Mobile</th>
                        <th>Pickup Location</th>
                        <th>Drop Location</th>
                        <th>Distance</th>
                        <th>Price(Rs)</th>
                        <th>Request Time</th>
                        <th>Ride Status</th>
                    </tr>

                    <?php
                      $i=0;
                      while($row=mysqli_fetch_array($result)){
                    ?>

                </thead>
                <tbody>
                    
                <tr>
                    <td data-label="#"><?php echo $row["rideID"];?></td>
                    <td data-label="#"><?php echo $row["driverID"];?></td>
                    <td data-label="#"><?php echo $row["passengerID"];?></td>
                    <td data-label="#"><?php echo $row["passengerMobile"];?></td>
                    <td data-label="#"><?php echo $row["pickupLocation"];?></td>
                    <td data-label="#"><?php echo $row["dropLocation"];?></td>
                    <td data-label="#"><?php echo $row["distance"];?></td>
                    <td data-label="#"><?php echo $row["fare"];?></td>
                    <td data-label="#"><?php echo $row["requestAt"];?></td>
                    <td data-label="#"><?php echo $row["rideStatus"];?></td>
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

        <div class="exportButton">
          <button onclick="window.location.href='export_Rides_pdf.php'" class="export_btn"><i class="fa-regular fa-file-pdf"></i> Export PDF</button>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="Js/app.js"></script>
  </body>
</html>
