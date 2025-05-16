<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us | QuizzyVerse</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f6f9;
    }

    .contact-wrapper {
      display: flex;
      justify-content: center;
      padding: 100px 20px 60px; /* Space from top to avoid navbar overlap */ 
      
    }

    .contact-container {
      display: flex;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      overflow: hidden;
      max-width: 1000px;
      width: 100%;
      
    }

    .contact-info {
      flex: 1;
      background: #f4f6f9;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .contact-info h3 {
      text-transform: uppercase;
      font-size: 14px;
      color: #666;
      margin-bottom: 10px;
    }

    .contact-info h1 {
      font-size: 32px;
      font-weight: 700;
      margin: 0 0 10px;
      color: #1a1a1a;
    }

    .contact-info p {
      font-size: 14px;
      color: #555;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .contact-info .icon-text {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .contact-info .icon-text i {
      font-size: 18px;
      color: #007bff;
      margin-right: 10px;
    }

    .contact-form {
      flex: 1;
      padding: 40px;
      background: white;
    }

    .contact-form input,
    .contact-form select,
    .contact-form textarea {
      width: 100%;
      padding: 12px 16px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 14px;
      outline: none;
    }

    .contact-form button {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 24px;
      background: purple;
      color: #fff;
      font-weight: bold;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .contact-form button:hover {
      background:rgb(130, 0, 200);
    }

    .contact-form button i {
      font-size: 16px;
    }

    @media (max-width: 768px) {
      .contact-container {
        flex-direction: column;
        margin: 20px;
      }
    }
  </style>
</head>
<body>

<!-- Include Navbar -->
<?php include '../php/loggednavebar.php'; ?>

<!-- Contact Form Wrapper -->
<div class="contact-wrapper">
  <div class="contact-container">

    <!-- Left: Info -->
    <div class="contact-info">
      <h3>We're here to help you</h3>
      <h1><strong style="color:purple">Discuss</strong> Your<br>Chemical Solution Needs</h1>
      <p>Are you looking for top-quality chemical solutions tailored to your needs? Reach out to us.</p>
      <div class="icon-text">
        <i class="fas fa-envelope" style="color:purple"></i>
        <span>soluvent***@gmail.com</span>
      </div>
      <div class="icon-text">
        <i class="fas fa-phone" style="color:purple"></i>
        <span>+123 - 456 - 7890</span>
      </div>
    </div>

    <!-- Right: Form -->
    <div class="contact-form">
      <form method="post" action="#">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="industry" required>
          <option value="">Select Role</option>
          <option value="teacher">Teacher</option>
          <option value="Student">Student</option>
        </select>
        <textarea name="message" placeholder="Type your message" rows="4" required></textarea>
        <button type="submit"><i class="fas fa-arrow-right"></i> Get a Solution</button>
      </form>
    </div>

  </div>
</div>

</body>
</html>
