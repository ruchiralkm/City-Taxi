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



if($_SERVER["REQUEST_METHOD"] == "POST") {

    //database connection
    include 'dbConnection.php';

    //get the input data
    $pasName = $_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $conPassword = $_POST["conPass"];

    //email
   
    $subject = 'Welcome to City Taxi - Registration Successful!';
    $body = "
        <html>
        <body>
        <p>Dear $pasName,</p>
        <p>We are thrilled to welcome you to City Taxi! Your registration has been successfully completed, and you are now ready to start booking rides with us.</p>
        <p>Here are your login details:</p>
        <p>Email: $email<br>Password: $password</p>
        <p>You can log in to your account at any time through our website or mobile app to book a ride, manage your bookings, and view your ride history.</p>
        <p>Thank you for choosing City Taxi, and we look forward to serving you soon!</p>
        <p>Best regards,<br>The City Taxi Team</p>
        </body>
        </html>
    ";


   


    
        if(($password == $conPassword)){

             // Check if the provided email already exists
                $result = $conn->query("SELECT COUNT(*) AS count FROM passenger WHERE email = '$email'");
                $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                    $_SESSION['error'] = "Email already exists!";
                    echo'email already exist';
                    //header("Location: ../driversSignup.html");
                    exit();
                }


                $hash = password_hash($password, PASSWORD_DEFAULT);


                $sql = "INSERT INTO passenger(name,mobile,email,password) values('$pasName', '$mobile', '$email', '$hash')";
                
                
                if(mysqli_query($conn, $sql)){

                    sendEmail($email, $subject, $body);
                    echo "<h3>data stored in the database successfully.</h3>";
                    // Redirect to the passenger dashboard or another page
                    header("Location: ../SuccessError/success.html");
                    //send email to passenger
                    
                    exit();


                
                }
                else
                {
                    echo( "ERROR : Hush! SORRY $sql. ".mysqli_error($conn));
                    // Redirect to the passenger dashboard or another page
                    header("Location: ../SuccessError/error.html");
                    exit();
                
                }
                mysqli_close($conn);
            
            
        }
        else{
                echo "<h3>Password confirmation is fail</h3>";
                // Redirect to the passenger dashboard or another page
                header("Location: ../SuccessError/error.html");
                exit();
            }
    

     
}

?>