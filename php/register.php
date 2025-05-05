<?php
session_start();
include 'dp.php';

// Sanitize and validate input
$username = htmlspecialchars(trim($_POST['username']));
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../html/create_account.php?msg=Invalid email format.");
    exit();
}

// Check if username or email already exists
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
$stmt->bind_param("ss", $email, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: ../html/create_account.php?msg=Username or email already exists.");
    exit();
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $password, $role);

if ($stmt->execute()) {
    header("Location: ../php/create_account.php?msg=Account created successfully.");
} else {
    header("Location: ../php/create_account.php?msg=Error: " . urlencode($stmt->error));
}

// Close resources
$stmt->close();
$conn->close();
exit();
?>
