<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Navbar</title>
    <style>
        /* Navbar Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 100px;
            font-weight: bold;
            color: purple;
            text-decoration: none;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li {
            display: inline;
        }

        .nav-links a {
            text-decoration: none;
            color: black;
            font-size: 16px;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: purple;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 15px;
            border: 2px solid rgba(128, 0, 128, 0.25); /* Purple with 50% opacity */
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn:hover {
            background: purple;
            color: white;
        }

        .btn-primary {
            background: purple;
            color: white;
        }

        .btn-primary:hover {
            background: darkviolet;
        }
    </style>
</head>
<body>

<nav>
    <a href="#" class="logo">QuizzyVerse</a>
    <ul class="nav-links">
        <li><a href="#">Plans</a></li>
        <li><a href="#">For Business</a></li>
        <li><a href="#">Library</a></li>
    </ul>
    <div class="nav-buttons">
        <a href="#" class="btn">Enter code</a>
        <a href="#" class="btn">Log in</a>
        <a href="#" class="btn btn-primary">Sign up</a>
    </div>
</nav>

</body>
</html>
