<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../html/login.html"); // Redirect to login if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizzyVerse Dashboard</title>
    <link rel="stylesheet" href="../css/Dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js for Stats -->
    <style>
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
            color: #5765d6;
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
            background-color: #5765d6;
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
    </style>
</head>
<body>

<div class="hero-section">
<div class="white-overlay"></div> <!-- White Background Behind Text -->
<nav class="navbar">
    <div class="logo">QuizzyVerse</div>
    <div class="nav-links">
        <a href="#">Home</a>
        <a href="#">Activity</a>
        <a href="#">Classes</a>
        <a href="../php/explore.php">Explore</a>
    </div>
    <div class="button-container">
        <?php if ($_SESSION['role'] !== 'student'): ?>
          <button class="create-quiz" onclick="window.location.href='../html/create.html'">Create Quiz</button>
        <?php endif; ?>
        <button class="attend-quiz" onclick="window.location.href='../html/attendQuiz.html'">Attend Quiz</button>
        
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
                <a href="../php/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</nav>

    <!-- Dashboard Container -->
    <div class="dashboard">
        <!-- Profile Section -->
        <div class="welcome-box">
        <h2>Hi <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>Welcome back to your QuizzyVerse dashboard.</p>
            <div class="profile-image">
                <div class="owl">
                    <div class="body">
                        <div class="wing left"></div>
                        <div class="wing right"></div>
                        <div class="feet left"></div>
                        <div class="feet right"></div>
                        <div class="feather"></div>
                    </div>
                    <div class="head">
                        <div class="beak"></div>
                        <div class="eyes">
                            <div class="eye left">
                                <div class="pupil"></div>
                            </div>
                            <div class="eye right">
                                <div class="pupil"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="freelance-people-work-composition-with-character-young-girl-working-armchair-with-laptop.png" alt="Profile Image">
            </div>
        </div>

        <!-- Dashboard Sections -->
        <div class="dashboard-sections">
            <div class="overview-container">
                <div class="box" id="overview">
                    <h3>Overview</h3>
                    <div class="stats-container">
                        <div class="stat-box" id="box1">
                            
                            <h4>Quizzes Completed</h4>
                            <p id="quizzes-completed">5 <i class="fa-solid fa-check"></i></p> <!-- Example data -->
                        </div>
                        <div class="stat-box" id="box2">
                            <h4>Average Score</h4>
                            <p id="average-score">80% <i class="fa-solid fa-gauge-simple"></i></p> <!-- Example data -->
                        </div>
                        <div class="stat-box" id="box3">
                            <h4>Highest Score</h4>
                            <p id="highest-score">85% <i class="fa-solid fa-chart-line"></i></p> <!-- Example data -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- History Section -->
            <div class="box" id="history">
                <h3>History</h3>
                <button class="view-history">View History</button>
                <ul id="history-list" class="hidden">
                    <li class="history-item">
                        <div class="history-row">
                            <div class="profile-circle">
                                <img src="../images/p3.jpg" alt="Profile Picture">
                            </div>
                            <div class="history-info">
                                <p class="username" style="padding-left:2rem">Noha Malek</p>
                                <p class="quiz-name" style="padding-left:2rem">Math Quiz</p>
                                <p class="score" style="padding-left:2rem;padding-right:4rem;">Score: 85%</p>
                                <button class="view-quiz">View Quiz</button> <!-- Added button -->
                            </div>
                           
                        </div>
                    </li>
                    <li class="history-item">
                        <div class="history-row">
                            <div class="profile-circle">
                                <img src="../images/p1.jpg" alt="Profile Picture">
                            </div>
                            <div class="history-info">
                                <p class="username" style="padding-left:2rem">John Smith</p>
                                <p class="quiz-name" style="padding-left:2rem">Science Quiz</p>
                                <p class="score" style="padding-left:2rem;padding-right:2.5rem;">Score: 90%</p>
                                <button class="view-quiz">View Quiz</button> <!-- Added button -->
                            </div>
                            
                        </div>
                    </li>
                    <li class="history-item">
                        <div class="history-row">
                            <div class="profile-circle">
                                <img src="../images/p2.jpeg" alt="Profile Picture">
                            </div>
                            <div class="history-info" >
                                <p class="username"style="padding-left:2rem">Fares Wael</p>
                                <p class="quiz-name" style="padding-left:2rem">History Quiz</p>
                                <p class="score" style="padding-left:2rem ;padding-right:3rem;">Score: 78%</p>
                                <button class="view-quiz">View Quiz</button> <!-- Added button -->
                            </div>
                           
                        </div>
                    </li>
                </ul>
            </div>
            


    </div>

    <script src="../js/Dashboard.js"></script>
<script>
    const pupils = document.querySelectorAll('.pupil');

    document.addEventListener('mousemove', (e) => {
        pupils.forEach(pupil => {
            const rect = pupil.parentElement.getBoundingClientRect(); // Eye container
            const pupilCenterX = rect.left + rect.width / 2;
            const pupilCenterY = rect.top + rect.height / 2;

            const angleX = e.clientX - pupilCenterX;
            const angleY = e.clientY - pupilCenterY;

            const maxMove = 20; // max pixels pupil can move
            const distance = Math.min(maxMove, Math.hypot(angleX, angleY));
            const angle = Math.atan2(angleY, angleX);

            const moveX = Math.cos(angle) * distance;
            const moveY = Math.sin(angle) * distance;

            pupil.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });
    });

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