<?php
// Start the session
session_start();
include '../php/dp.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];  // Use the raw password submitted by the user

    // Prepare and execute the query to find the user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    // Check if user exists
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user data
        
        // Check if the entered password matches the stored hash
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['username'] = $username;
            echo "<script>alert('Login successful!'); window.location.href = 'login.html';</script>";
        } else {
            echo "<script>alert('Invalid username or password.'); window.location.href = 'login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password.'); window.location.href = 'login.html';</script>";
    }
}
?>
