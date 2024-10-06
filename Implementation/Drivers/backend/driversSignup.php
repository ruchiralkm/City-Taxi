<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Function to send email using PHPMailer
function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'citytaxilk.pvtltd@gmail.com';      
        $mail->Password   = 'ekrz uuto juca tgdm';                   
        $mail->SMTPSecure = 'tls';                                  
        $mail->Port       = 587;                                    

        //Recipients
        $mail->setFrom('citytaxilk.pvtltd@gmail.com', 'City Taxi');
        $mail->addAddress($to);                                      // Add a recipient

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);                         // Fallback in case client does not support HTML

        $mail->send();
        echo 'Email has been sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
    $regNo = $_POST['regNo'];
    $brand = $_POST['VehicleBrand'];
    $model = $_POST['VehicleModel'];
    $year = $_POST['VehicleYear'];
    $color = $_POST['VehicleColour'];



    //password validation 
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
    if (!preg_match($pattern, $password)) {
        $_SESSION['error'] = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.";
        header("Location: ../driversSignup.html");
        exit();
    }

    // Validate that password and confirmation password match
    if ($password !== $confPassword) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: ../driversSignup.html");
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


// query to insert driver data
    $stmt = $conn->prepare("INSERT INTO driver (firstName, lastName, mobile, licenceNumber, address, vehicle, employment, profilePicture, email, password, regNo,vehicleBrand, vehicleModel,vYear,vColor)
     VALUES ('$firstName', '$lastName', '$mobile', '$licenceNumber', '$address', '$vehicleType', '$employmentType', '$picture', '$email', '$hashedPassword','$regNo','$brand','$model','$year','$color')");

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
