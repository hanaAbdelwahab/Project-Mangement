<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Quizzes</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="back-arrow"><a href="../php/home.php"><i class="fa-solid fa-circle-left"></i></a></div>
    <div class="container">
        <div class="login-box">
            
            <div class="rocket">
                <h2>Quizzes</h2>
                <p>Welcome to the website</p>
                <div class="rocket-shape">
                    <div class="rocket-nose"></div>
                    <div class="rocket-body">
                        <div class="rocket-window"></div>
                        <div class="rocket-fin-left"></div>
                        <div class="rocket-fin-right"></div>
                        <div class="rocket-flame"></div>
                    </div>
                </div>
            </div>
            
            <div class="login-form">
                <h3>USER LOGIN</h3>
                <form action="../php/login.php" method="POST" onsubmit="checkCredentials(event)">
                <?php
                    session_start();
                    if (isset($_SESSION['error'])) {
                    echo "<p style='color: red; text-align:center; margin-top:10px'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']); // Clear the message after displaying it
                }
                ?>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <div class="options">
                        <label>
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        <a href="../php/forgot_password.php">Forgot password?</a>
                    </div>
                    <button type="submit">Login</button>
                    <a href="../php/create_account.php">Create Account</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
