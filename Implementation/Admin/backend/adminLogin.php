<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["pass"];

    // admin credentials (stored securely in the database in real-world apps)
    $adminEmail = "admin@citytaxy.lk";
    $adminPasswordHash = password_hash("admin123", PASSWORD_DEFAULT);

    // Check if the input matches the credentials
    if ($email === $adminEmail && password_verify($password, $adminPasswordHash)) {
        // Set session variable for admin
        $_SESSION["admin_logged_in"] = true;
        echo "Login successful!";
        // Redirect to admin dashboard or home page
       // header("Location: adminDashboard.php");
       // exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>
