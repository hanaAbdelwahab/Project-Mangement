<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Account</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <div class="back-arrow">
    <a href="home.php"><i class="fa-solid fa-circle-left"></i></a>
  </div>

  <div class="container">
    <div class="login-box">
      <div class="rocket">
        <h2>Create Account</h2>
        <p>Join our community</p>
      </div>
      <div class="login-form">
        <h3>Register</h3>

        <?php if (isset($_SESSION['msg'])): ?>
          <div class="form-message" style="color:red;"><?php echo htmlspecialchars($_SESSION['msg']); unset($_SESSION['msg']); ?></div>
        <?php endif; ?>

        <form action="register.php" method="POST">
          <input type="text" name="username" placeholder="Username" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <select name="role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="student">Student</option>
            <option value="tutor">Tutor</option>
          </select>
          <button type="submit">Sign Up</button>
        </form>
        <a href="loginform.php">Back to Login</a>
      </div>
    </div>
  </div>
</body>
</html>
