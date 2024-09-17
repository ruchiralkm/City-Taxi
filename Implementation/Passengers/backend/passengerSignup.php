<?php


if($_SERVER["REQUEST_METHOD"] == "POST") {

    //database connection
    include 'dbConnection.php';

    //get the input data
    $pasName = $_POST["name"];
    $mobile = $_POST["mobile"];
    $emai = $_POST["email"];
    $password = $_POST["pass"];
    $conPassword = $_POST["conPass"];

   

    
        if(($password == $conPassword)){

            $hash = password_hash($password, PASSWORD_DEFAULT);


            $sql = "INSERT INTO passenger(name,mobile,email,password) values('$pasName', '$mobile', '$emai', '$hash')";
            
            if(mysqli_query($conn, $sql)){
                echo "<h3>data stored in the database successfully.</h3>";
            
            }
            else
            {
                echo( "ERROR : Hush! SORRY $sql. ".mysqli_error($conn));
            
            }
            mysqli_close($conn);
            
        }
        else{
                echo "<h3>Password confirmation is fail</h3>";
            }
    

    
}

?>