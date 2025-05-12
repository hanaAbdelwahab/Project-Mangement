<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Create Account</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="back-arrow"><a href="../php/home.php"><i class="fa-solid fa-circle-left"></i></a></div>
    <div class="container">
        <div class="login-box">
            <div class="rocket">
                <h2>Create Account</h2>
                <p>Join our community</p>
            </div>
            <div class="login-form">
                <h3>Register</h3>
                <form action="register.php" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Sign Up</button>
                </form>
                <a href="../html/login.html">Back to Login</a>
            </div>
        </div>
    </div>
</body>
</html>
