<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <?php 
    // Check if the fare is set in the query parameters
    if (isset($_GET['fare'])) {
        $fare = htmlspecialchars($_GET['fare']); // Sanitize the input
    } else {
        $fare = '0'; // Default value if fare is not set
    }
    ?>
    <h1>Hello World, Fare: Rs. <?php echo $fare; ?></h1>
</body>
</html>
