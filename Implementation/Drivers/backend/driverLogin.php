<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection
    include 'dbConnection.php';

    // Get the input data 
    $email =  $_POST["email"];
    $password = $_POST["pass"];

   
    if (!empty($email) && !empty($password)) {

        // SQL query to check if the user exists
        $sql = "SELECT * FROM driver WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        

        if ($result && mysqli_num_rows($result) > 0) 
        {
            // Fetch the user's data
            $row = mysqli_fetch_assoc($result);
            $hash = $row['password'];

            // Verify the password
            if (password_verify($password, $hash)) {
                // Start the session and set session variables
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['email'] = $row['email'];

                echo "<h3>Login successful! Welcome, " . $_SESSION['firstName'] . ".</h3>";
                // Redirect to the passenger dashboard or another page
                 header("Location: HomeDriver.php");
                exit();
            } 
            else 
            {
                echo "<h3>Incorrect password. Please try again.</h3>";
                // Redirect to the passenger dashboard or another page
                header("Location: ../SuccessError/error.html");
            }
        } 
        else 
        {
            echo "<h3>No account found with that email. Please sign up first.</h3>";
            // Redirect to the passenger dashboard or another page
            header("Location: ../SuccessError/error.html");
        }
        
        // Close the database connection
        mysqli_close($conn);
    } else 
    {
        echo "<h3>Please fill in both fields.</h3>";
    }
}

?>

