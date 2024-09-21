<?php
// Start session to handle feedback or errors
session_start();

include 'dbConnection.php';
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Capture form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobile = $_POST['mobile'];
    $licenceNumber = $_POST['licenceNumber'];
    $address = $_POST['address'];
    $vehicleType = $_POST['vehicle'];
    $employmentType = $_POST['employment'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confPassword = $_POST['confPassword'];

    // Validate passwords
    if ($password !== $confPassword) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: ../driversSignup.html");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Handle file upload 
    // Image
        $targetDir = "upload/";
        $fileName = basename($_FILES["profilePicture"]["name"]);
        $targetfilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetfilePath)) {
            $picture = $targetfilePath;
        } else {
            $picture = "";
        }


    // Rest of your file handling and SQL insertion...

    $stmt = $conn->prepare("INSERT INTO driver (firstName, lastName, mobile, licenceNumber, address, vehicle, employment, profilePicture, email, password)
     VALUES ('$firstName', '$lastName', '$mobile', '$licenceNumber', '$address', '$vehicleType', '$employmentType', '$picture', '$email', '$hashedPassword')");

    if ($stmt->execute()) {
        echo'Driver registered successfully!';
       //header("Location: ../driversSignup.html");
    } else {
        echo 'Error: ' . $stmt->error;
        //header("Location: ../driversSignup.html");
    }

    $stmt->close();
    $conn->close();
}

?>
