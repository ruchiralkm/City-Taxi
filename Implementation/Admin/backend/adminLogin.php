<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["pass"];

    
    $adminEmail = "admin@citytaxy.lk";
    $adminPasswordHash = password_hash("admin123", PASSWORD_DEFAULT);

    
    if ($email === $adminEmail && password_verify($password, $adminPasswordHash)) {
        
        $_SESSION["admin_logged_in"] = true;
        echo "Login successful!";
        
       header("Location: AdminHome.php");
       exit();
    } else {
        echo "Invalid email or password.";
        
        header("Location: ../SuccessError/error.html");
    }
}
?>
