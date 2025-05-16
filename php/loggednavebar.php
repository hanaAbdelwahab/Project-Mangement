<?php
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../php/home.php"); // Redirect to home page
    exit();
}
?>
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
            /* Navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;
    padding: 15px 30px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar .logo {
    font-size: 24px;
    font-weight: bold;
    color: #662D91;
}

.nav-links a {
    margin: 0 15px;
    text-decoration: none;
    color: black;
    transition: color 0.3s ease-in-out;
}

.nav-links a:hover {
    color: #662D91;
}

.create-quiz {
    background-color: #662D91;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

.create-quiz:hover {
    background-color: #4D1A75;
}
 
        /* Profile Icon and Dropdown Styles */
        .profile-dropdown {
            position: relative;
            display: inline-block;
            margin-left: 15px;
        }
        
        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid #fff;
            color: purple;
            font-size: 18px;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            min-width: 220px;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 8px;
            z-index: 100;
            margin-top: 10px;
            overflow: hidden;
        }
        
        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
            font-size: 14px;
        }
        
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        
        .dropdown-content a i {
            margin-right: 8px;
            width: 16px;
        }
        
        .show {
            display: block;
        }
        
        /* Arrow for dropdown */
        .dropdown-content::before {
            content: "";
            position: absolute;
            top: -10px;
            right: 15px;
            border-width: 0 10px 10px 10px;
            border-style: solid;
            border-color: transparent transparent #fff transparent;
        }
        
        /* User profile in dropdown */
        .user-profile {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .user-initials {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: purple;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            margin-right: 12px;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 600;
            margin: 0;
            color: #333;
            font-size: 14px;
        }
        
        .user-email {
            margin: 0;
            color: #666;
            font-size: 12px;
            margin-top: 3px;
        }
            .nav-links a.active {
    color: purple;
    font-weight: bold;
    position: relative;
}

.nav-links a.active::after {
    content: '';
    position: absolute;
    bottom: -6px;
    left: 0;
    right: 0;
    height: 3px;
    background-color: purple;
    border-radius: 10px;
}
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 15px 30px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            font-family: "Montserrat", sans-serif;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #662D91;
        }

        .nav-links a {
            margin: 0 15px;
            text-decoration: none;
            color: black;
            transition: color 0.3s ease-in-out;
        }

        .nav-links a:hover {
            color: #662D91;
        }

        .button-container {
            display: flex;
            gap: 10px;
        }

        .create-quiz {
            border: none;
            background-color: purple;
            color: white;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
            font-family: "Montserrat", sans-serif;
            margin-right: 8px;
            padding: 10px 15px;
        } 

        .attend-quiz {
            background-color: white;
            color: purple;
            border: 2px solid;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
            font-family: "Montserrat", sans-serif;
            margin-right: 8px;
        }

        .create-quiz:hover {
            background-color: #7E57C2;
            color: white;
        }

        .attend-quiz:hover {
            background-color: #4D1A75;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="logo">QuizzyVerse</div>
<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<div class="nav-links">
    <a href="Dashboard.php" class="<?= $currentPage == 'Dashboard.php' ? 'active' : '' ?>">Dashboard</a>
    <a href="explore.php" class="<?= $currentPage == 'explore.php' ? 'active' : '' ?>">Explore</a>
    <a href="About.php" class="<?= $currentPage == 'About.php' ? 'active' : '' ?>">About</a>
    <a href="contact.php" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>">Contact</a>
</div>

    <div class="button-container">
        <?php if ($_SESSION['role'] !== 'student'): ?>
          <button class="create-quiz" onclick="window.location.href='../php/create.php'">Create Quiz</button>
        <?php endif; ?>
        <button class="attend-quiz" onclick="window.location.href='../php/attendQuiz.php'">Attend Quiz</button>
        
        <!-- Profile Icon with Dropdown -->
        <div class="profile-dropdown">
            <div class="profile-icon" onclick="toggleDropdown()">
                <i class="fas fa-user"></i>
            </div>
            <div id="profileDropdown" class="dropdown-content">
                <div class="user-profile">
                    <div class="user-initials">
                        <?php echo substr($_SESSION['username'], 0, 1); ?>
                    </div>
                    <div class="user-info">
                        <p class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                        <p class="user-email"><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'user@quizzyverse.com'; ?></p>
                    </div>
                </div>
                <a href="../php/profile.php"><i class="fas fa-user-circle"></i> View Profile</a>
                <a href="../php/statistics.php"><i class="fa-solid fa-chart-line"></i> Statistics</a>
                <a href="?logout=true"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</nav>
<script>
        // Profile dropdown functionality
    function toggleDropdown() {
        document.getElementById("profileDropdown").classList.toggle("show");
    }

    // Close dropdown when clicking outside
    window.onclick = function(event) {
        if (!event.target.matches('.profile-icon') && !event.target.matches('.fa-user')) {
            const dropdowns = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < dropdowns.length; i++) {
                const openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
    </script>
</body>
</html>
