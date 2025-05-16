<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../php/loginform.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Statistics | QuizzyVerse</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f5f7fb;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border: none;
      border-radius: 15px;
      padding: 1.5rem;
      background-color: white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .stat-value {
      font-size: 2rem;
      font-weight: 700;
      color: #6b1f9e; /* purple */
    }
    .calendar-day.active {
      background-color: #e2d4f8;
      border-radius: 50%;
    }
    .circle-legend {
      list-style: none;
      padding-left: 0;
    }
    .circle-legend li::before {
      content: "●";
      margin-right: 0.5rem;
      color: currentColor;
    }
  </style>
</head>
<body>
<?php include '../php/loggednavebar.php'; ?>
<div class="container">
  <h2 class="mb-4" style="margin:1.5rem; color:#6b1f9e;">My Quiz Statistics</h2>
  
  <!-- Row 1: Summary -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card text-center">
        <p style="font-weight:700; font-size:1.6rem;">Total Quizzes Taken</p>
        <div class="stat-value"><i class="fa-regular fa-pen-to-square" style="color:blue"></i> 24</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <p style="font-weight:700; font-size:1.6rem;">Quizzes In Progress</p>
        <div class="stat-value"> <i class="fa-solid fa-spinner" style="color:orange"></i> 5</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <p style="font-weight:700; font-size:1.6rem;">Quizzes Created</p>
        <div class="stat-value"><i class="fa-regular fa-circle-check" style="color:green"></i>12</div>
      </div>
    </div>
  </div>

<div class="row mb-4">
  <!-- Left: Chart -->
  <div class="col-md-7">
    <div class="card" style="width: 100%;">
      <h5 style="color:#6b1f9e;">Category Breakdown</h5>
      <canvas id="categoryChart" height="200"></canvas>
      <ul class="circle-legend mt-3">
        <li style="color: #8e44ad;">Science (40%)</li>
        <li style="color: #a569bd;">History (25%)</li>
        <li style="color: #bb8fce;">Math (15%)</li>
        <li style="color: #d2b4de;">Tech (10%)</li>
        <li style="color: #ebdef0;">Others (10%)</li>
      </ul>
    </div>
  </div>

  <!-- Right: Calendar + Highlights + Summary -->
  <div class="col-md-5">
    <div class="card mb-4">
      <h5 class="text-center" style="color:#6b1f9e;">Activity Calendar</h5>
      <table class="table table-borderless text-center mt-3">
        <thead>
          <tr>
            <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
          </tr>
        </thead>
        <tbody>
          <tr><td></td><td class="calendar-day active">1</td><td>2</td><td class="calendar-day active">3</td><td>4</td><td>5</td><td class="calendar-day active">6</td></tr>
          <tr><td>7</td><td>8</td><td class="calendar-day active">9</td><td>10</td><td>11</td><td>12</td><td>13</td></tr>
          <tr><td>14</td><td class="calendar-day active">15</td><td>16</td><td>17</td><td>18</td><td class="calendar-day active">19</td><td>20</td></tr>
          <tr><td>21</td><td>22</td><td>23</td><td class="calendar-day active">24</td><td>25</td><td>26</td><td>27</td></tr>
        </tbody>
      </table>
    </div>

    <div class="card mb-3">
      <h5 style="color:#6b1f9e;">Top Quiz Highlights</h5>
      <ul>
        <li><strong>Quiz:</strong> JavaScript Basics – <em>Score: 95%</em></li>
        <li><strong>Quiz:</strong> History of Egypt – <em>Score: 90%</em></li>
        <li><strong>Quiz:</strong> Math Challenge – <em>Score: 88%</em></li>
        <li><strong>Quiz:</strong> Tech Trends – <em>Score: 85%</em></li>
      </ul>
    </div>

    <div class="card">
      <h5 class="text-center" style="color:#6b1f9e;">Activity Summary</h5>
      <ul class="list-group list-group-flush mt-3">
        <li class="list-group-item">Active Quiz Days: <strong>12</strong></li>
        <li class="list-group-item">Longest Streak: <strong>4 Days</strong></li>
        <li class="list-group-item">Total Time Spent: <strong>3h 27m</strong></li>
        <li class="list-group-item">Total Questions Answered: <strong>312</strong></li>
      </ul>
    </div>
  </div>
</div>


<!-- Chart.js for Category Breakdown -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('categoryChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Science', 'History', 'Math', 'Tech', 'Others'],
      datasets: [{
        data: [40, 25, 15, 10, 10],
        backgroundColor: ['#8e44ad', '#a569bd', '#bb8fce', '#d2b4de', '#ebdef0']
      }]
    },
    options: {
      responsive: true,
      cutout: '70%',
      plugins: {
        legend: { display: false }
      }
    }
  });
</script>
</body>
</html>
