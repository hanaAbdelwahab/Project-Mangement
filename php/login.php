<?php
session_start();
include '../php/dp.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];
            header("Location: Dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: ../php/loginform.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: ../php/loginform.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
