<?php


if($_SERVER["REQUEST_METHOD"] == "POST") {

    //database connection
    include 'dbConnection.php';

    //get the input data
    $pasName = $_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $conPassword = $_POST["conPass"];

   

    
        if(($password == $conPassword)){

             // Check if the provided email already exists
                $result = $conn->query("SELECT COUNT(*) AS count FROM passenger WHERE email = '$email'");
                $row = $result->fetch_assoc();

                if ($row['count'] > 0) {
                    $_SESSION['error'] = "Email already exists!";
                    echo'email already exist';
                    //header("Location: ../driversSignup.html");
                    exit();
                


            $hash = password_hash($password, PASSWORD_DEFAULT);


            $sql = "INSERT INTO passenger(name,mobile,email,password) values('$pasName', '$mobile', '$email', '$hash')";
            
            if(mysqli_query($conn, $sql)){
                echo "<h3>data stored in the database successfully.</h3>";
                // Redirect to the passenger dashboard or another page
                header("Location: ../SuccessError/success.html");
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
    }
        else{
                echo "<h3>Password confirmation is fail</h3>";
                // Redirect to the passenger dashboard or another page
                header("Location: ../SuccessError/error.html");
                exit();
            }
    

    
}

?>