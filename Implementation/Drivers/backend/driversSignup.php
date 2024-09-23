<?php

function sendEmail($to, $subject, $body) {
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

   
    $headers .= 'From: City Taxi <citytaxilk.pvtltd@gmail.com>' . "\r\n";
    $headers .= 'Reply-To: no-reply@citytaxi.com' . "\r\n";

    // Send the email
    if(mail($to, $subject, $body, $headers)) {
        echo 'Email has been sent successfully!';
    } else {
        echo 'Failed to send email.';
    }
}


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
       // echo 'wrong password';
        //header("Location: ../driversSignup.html");
        exit();
    }

    // Check if the provided email already exists
    $result = $conn->query("SELECT COUNT(*) AS count FROM driver WHERE email = '$email'");
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        $_SESSION['error'] = "Email already exists!";
        //echo'email already exist';
        //header("Location: ../driversSignup.html");
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
        $subject = "Welcome to City Taxi - Driver Registration Successful!";
        $body = "
            <html>
            <body>
            <p>Dear $firstName $lastName,</p>
            <p>Congratulations and welcome aboard as a driver with City Taxi! Your registration has been successfully processed.</p>
            <p><strong>Username:</strong> $email<br><strong>Password:</strong> $password</p>
            <p>Best regards,<br>The City Taxi Team</p>
            <p>Contact us: <a href='mailto:citytaxilk.pvtltd@gmail.com'>citytaxilk.pvtltd@gmail.com</a> | +94 123 456 789</p>
            </body>
            </html>
        ";
        sendEmail($email, $subject, $body);
        echo'Driver registered successfully!';
       // Redirect to the passenger dashboard or another page
       header("Location: ../SuccessError/success.html");
    } else {
        echo 'Error: ' . $stmt->error;
        // Redirect to the passenger dashboard or another page
        header("Location: ../SuccessError/error.html");
    }

    $stmt->close();
    $conn->close();
}

?>
