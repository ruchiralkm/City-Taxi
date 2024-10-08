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
    <link rel="stylesheet" href="Sass/HomeDriver.css" />

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


    <br><br>
    
    <!-- slider animation -->
    <div class="slider-container">
        <div class="slide active">
            <img src="../../Assets/4298193.jpg" alt="City Taxi 1">
            <div class="slide-caption">Experience the city with comfort</div>
        </div>
        <div class="slide">
            <img src="../../Assets/4298194.jpg" alt="City Taxi 2">
            <div class="slide-caption">Reliable rides, anytime</div>
        </div>
        <div class="slide">
            <img src="../../Assets/4298195.jpg" alt="City Taxi 3">
            <div class="slide-caption">Your journey, our priority</div>
        </div>
    </div>

    <!-- slider animation script -->
    <script>
        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;

        function showSlide(n) {
            slides[currentSlide].classList.remove('active');
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        setInterval(nextSlide, 5000); // Change slide every 5 seconds
    </script>
    

    <!-- Cards -->
    <div class="card">
      <div class="card-con">
        <center><img src="https://img.icons8.com/?size=100&id=21702&format=png&color=000000" alt="" style="width:100px; height:100px;"></center>
        <span class="text">Rides</span>
      </div>

      <div class="card-con">
        <center><img src="https://img.icons8.com/?size=100&id=erEevcUCwAMR&format=png&color=000000" alt="" style="width:100px; height:100px;"></center>
        <span class="text">Foods</span>
      </div>

      <div class="card-con">
        <center><img src="https://img.icons8.com/?size=100&id=63761&format=png&color=000000" alt="" style="width:100px; height:100px;"></center>
        <span class="text">Offters</span>
      </div>

      <div class="card-con">
        <center><img src="https://img.icons8.com/?size=100&id=13010&format=png&color=000000" alt="" style="width:100px; height:100px;"></center>
        <span class="text">Market</span>
      </div>
    </div>



    


    <!-- Counter -->
    <div class="wrapper">
      <div class="container">
        <center><img src="https://img.icons8.com/?size=100&id=63397&format=png&color=40C057" alt="" style="width:60px; height:60px;"></center>
        <span class="num" data-val="24">000</span>
        <span class="text">Passengers</span>
      </div>

      <div class="container">
        <center><img src="https://img.icons8.com/?size=100&id=63392&format=png&color=40C057" alt="" style="width:60px; height:60px;"></center>
        <span class="num" data-val="16">000</span>
        <span class="text">Drivers</span>
      </div>

      <div class="container">
        <center><img src="https://img.icons8.com/?size=100&id=12684&format=png&color=40C057" alt="" style="width:60px; height:60px;"></center>
        <span class="num" data-val="25">000</span>
        <span class="text">Total Rides</span>
      </div>

      <div class="container">
        <center><img src="https://img.icons8.com/?size=100&id=85185&format=png&color=40C057" alt="" style="width:60px; height:60px;"></center>
        <span class="num" data-val="182">000</span>
        <span class="text">Total Stars</span>
      </div>
    </div>

    

    <!--===== MAIN JS =====-->
    <script src="Js/main.js"></script>
    <script src="Js/counter.js"></script>
  </body>
</html>
