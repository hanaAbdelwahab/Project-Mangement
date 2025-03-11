<?php
// Start the session
session_start();
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);  // Hashing the password with MD5

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $username, 'password' => $password]);

    // Check if user exists
    if ($stmt->rowCount() == 1) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Login successful!'); window.location.href = 'login.html';</script>";
    } else {
        echo "<script>alert('Invalid username or password.'); window.location.href = 'login.html';</script>";
    }
}
?>
