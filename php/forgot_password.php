<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="back-arrow"><a href="../php/home.php"><i class="fa-solid fa-circle-left"></i></a></div>
    <div class="container">
        <div class="login-box">
        <div class="rocket">
    <h2>Business Startup</h2>
    <p>Welcome to the website</p>
    
    
</div>

            <div class="login-form">
                <h3>Forgot Password</h3>
                <form action="reset_password.php" method="POST">
                    <input type="email" name="email" placeholder="Email" required>
                    <button type="submit">Submit</button>
                </form>
                <a href="../html/login.html">Back to Login</a>
            </div>
        </div>
    </div>
</body>
</html>
