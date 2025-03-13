<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Attend Quiz</title>
    <style>
        /* Background Styling */
        body {
            background-color: #4A0072;
            background-image: url('Screenshot 2025-03-13 024825.png'); /* Replace with your image */
            background-size: cover;
            background-position: center;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: "Montserrat", sans-serif;
            overflow: hidden; /* REMOVE SCROLL BARS */


        }

        /* Navbar */
        .navbar {
            position: absolute;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            font-family: "Montserrat", sans-serif;

        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            margin-left: 50px;
        }

        .navbar .nav-buttons {
            display: flex;
            gap: 15px;
            
        }

        .nav-buttons button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-family: "Montserrat", sans-serif;
            margin-right: 20px;


        }

        .nav-buttons button:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Form Container */
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 400px;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            font-family: "Montserrat", sans-serif;

        }

        .form-box {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
            font-family: "Montserrat", sans-serif;

        }

        input {
            padding: 12px;
            width: 75%;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            background: transparent;
            color: white;
            outline: none;
            font-family: "Montserrat", sans-serif;

        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        button {
            padding: 12px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            background-color: #6A0DAD;
            color: white;
            cursor: pointer;
            transition: 0.3s;
            font-family: "Montserrat", sans-serif;

        }

        button:hover {
            background-color: #8A2BE2;
        }

    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">QuizzyVerse</div>
    <div class="nav-buttons">
    <button onclick="window.location.href='Dashboard.php'">My Dashboard</button>
<button onclick="window.location.href='homepage.php'">Home</button>


    </div>
</div>

<!-- Form -->
<div class="container">
    <h1>QuizzyVerse</h1>
    <div class="form-box">
        <input type="text" placeholder="Enter a join code">
        <button>Join</button>
    </div>
</div>

</body>
</html>
