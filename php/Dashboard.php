<?php
session_start();

// Check if user requested logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../php/home.php"); // Redirect to home page
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../php/loginform.php"); // Redirect to login if not logged in
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
</head>
<body>

<div class="hero-section">
<div class="white-overlay"></div> <!-- White Background Behind Text -->
<?php include '../php/loggednavebar.php'; ?>

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


</script>
</body>
</html>