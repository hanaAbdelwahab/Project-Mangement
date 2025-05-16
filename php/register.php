<?php
session_start();
include 'dp.php';

// Sanitize and validate input
$username = htmlspecialchars(trim($_POST['username']));
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$passwordRaw = trim($_POST['password']);
$role = $_POST['role'];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['msg'] = "Invalid email format.";
    header("Location: create_account.php");
    exit();
}

// Check if username or email already exists
$checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
$checkStmt->bind_param("ss", $email, $username);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    $checkStmt->close();
    $_SESSION['msg'] = "Username or email already exists.";
    header("Location: create_account.php");
    exit();
}
$checkStmt->close();

// Hash the password securely
$hashedPassword = password_hash($passwordRaw, PASSWORD_BCRYPT);

// Insert new user
$insertStmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
$insertStmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

if ($insertStmt->execute()) {
    $_SESSION['msg'] = "Account created successfully.";
} else {
    $_SESSION['msg'] = "Error creating account. Please try again.";
}

$insertStmt->close();
$conn->close();

header("Location: create_account.php");
exit();
?>
