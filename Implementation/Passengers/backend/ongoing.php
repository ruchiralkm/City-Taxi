<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../City-Taxi.png" type="image/x-icon" />
    <title>City-Taxi - Your Ongoing Rides</title>

    <link rel="stylesheet" href="Sass/ongoing.min.css">

    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        .pbtn {
            background-color: #1a242f;
            padding: 10px;
            margin-top: 10px;
        }
        .pbtn:hover {
            background-color: #000;
        }
        .pbtn a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include 'NavBarPassenger.php'; ?>

    <h1>Your Ongoing Rides</h1>

    <div id="rides">
        <?php include 'ongoingRide.php'; ?>
    </div>
</body>
</html>
