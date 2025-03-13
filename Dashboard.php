<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizzyVerse Dashboard</title>
    <link rel="stylesheet" href="Dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js for Stats -->
</head>
<body>

<div class="hero-section">
<div class="white-overlay"></div> <!-- White Background Behind Text -->

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">QuizzyVerse</div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Activity</a>
            <a href="#">Classes</a>
            <a href="#">Flashcards</a>
        </div>
        <div class="button-container">
    <button class="create-quiz">Create Quiz</button>
    <button class="attend-quiz" onclick="window.location.href='attendQuiz.php'">Attend Quiz</button>
    </div>



    </nav>

    <!-- Dashboard Container -->
    <div class="dashboard">
        <!-- Profile Section -->
        <div class="welcome-box">
            <h2>Hi Karen!</h2>
            <p>Welcome back to your QuizzyVerse dashboard.</p>
            <div class="profile-image">
                <img src="freelance-people-work-composition-with-character-young-girl-working-armchair-with-laptop.png" alt="Profile Image">
            </div>
        </div>

        <!-- Dashboard Sections -->
        <div class="dashboard-sections">
            <!-- History Section -->
            <div class="box" id="history">
                <h3>History</h3>
                <button class="view-history">View History</button>
                <ul id="history-list" class="hidden"></ul>
            </div>

            <!-- Overview Section -->
            <div class="box" id="overview">
                <h3>Overview</h3>
                <button class="view-overview">View Stats</button>
                <canvas id="performanceChart" class="hidden"></canvas>
            </div>

            <!-- Third Section (Placeholder) -->
            <div class="box" id="third-section">
                <h3>Placeholder</h3>
                <p>Define this section.</p>
            </div>
        </div>


    </div>

    <script src="Dashboard.js"></script>

</body>
</html>
