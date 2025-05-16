<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="profile.css">
</head>
<body>
  <div class="page-container">
    <main class="main-content">
      <h1 class="page-title">Edit Profile</h1>

      <div class="profile-header-card card">
        <div class="profile-image-area">
          <img src="https://t4.ftcdn.net/jpg/02/45/56/35/360_F_245563558_XH9Pe5LJI2kr7VQuzQKAjAbz9PAyejG1.jpg" alt="User Photo" class="profile-img-main">
          <div class="profile-image-text">
            <span class="profile-img-title">User Photo</span>
            <p class="upload-hint">Manage your profile picture.</p>
          </div>
        </div>
        <button class="btn btn-secondary" id="editPasswordBtn">Edit Password</button>
      </div>


      <div class="card personal-info-card">
        <div class="card-header">
          <h2>Personal Info</h2>
          <div class="personal-info-actions">
            <button class="btn btn-link" id="editPersonalInfoBtn">Edit</button>
            <button class="btn btn-secondary" id="cancelPersonalInfoBtn" style="display: none;">Cancel</button>
            <button class="btn btn-primary" id="savePersonalInfoBtn" style="display: none;">Save</button>
          </div>
        </div>
        <div class="info-grid">
          <div class="info-item">
            <span class="info-label">Full Name</span>
            <span class="info-value-display" data-field="fullName">Ronald Richards</span>
            <input type="text" class="form-control info-value-edit" data-field="fullName" value="Ronald Richards" style="display: none;">
          </div>
          <div class="info-item">
            <span class="info-label">Email</span>
            <span class="info-value-display" data-field="email">RonaldRich@example.com</span>
            <input type="email" class="form-control info-value-edit" data-field="email" value="RonaldRich@example.com" style="display: none;">
          </div>
          <div class="info-item">
            <span class="info-label">Phone</span>
            <span class="info-value-display" data-field="phone">(219) 555-0114</span>
            <input type="tel" class="form-control info-value-edit" data-field="phone" value="(219) 555-0114" style="display: none;">
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h2>Location</h2>
        </div>
        <div class="location-input-group">
          <span class="location-icon-placeholder">📍</span> 
          <input type="text" id="location" value="California" class="form-control">
        </div>
        <div class="actions">
          <button class="btn btn-secondary" onclick="cancelLocation()">Cancel</button>
          <button class="btn btn-primary" onclick="saveLocation()">Save changes</button>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h2>Bio</h2>
          <button class="btn btn-link" id="editBioBtn">Edit</button> <!-- Added ID for potential JS -->
        </div>
        <textarea id="bioTextarea" class="form-control" rows="6" readonly>👋 Hi, I'm Ronald, a passionate UX designer with 10 years of experience in creating intuitive and user-centered digital experiences. With a strong background in user research, information architecture, and interaction design, I am dedicated to crafting seamless and delightful user journeys.

I have a keen eye for detail and a deep understanding of user needs, which allows me to create visually appealing and functional designs. I am proficient in using industry-standard design tools and have a proven track record of delivering successful projects.</textarea>
         <div class="actions" id="bioActions" style="display: none; margin-top: 15px;">
            <button class="btn btn-secondary" id="cancelBioBtn">Cancel</button>
            <button class="btn btn-primary" id="saveBioBtn">Save Bio</button>
        </div>
      </div>
    </main>

    <aside class="sidebar">
      <h2 class="sidebar-title">Complete your profile</h2>
      <div class="progress-container">
        <svg class="progress-ring" width="120" height="120">
          <circle class="progress-ring__bg" stroke-width="10" fill="transparent" r="50" cx="60" cy="60"/>
          <circle class="progress-ring__circle" id="profileProgressCircle" stroke-width="10" fill="transparent" r="50" cx="60" cy="60"/>
        </svg>
        <div class="progress-text" id="profileProgressValue">0%</div>
      </div>

      <ul class="profile-tasks">
        <li>Setup account <span class="task-percent">10%</span><span class="status-check completed">✔</span></li>
        <li>Upload your photo <span class="task-percent">5%</span><span class="status-check completed">✔</span></li>
        <li>Personal Info <span class="task-percent">10%</span><span class="status-check completed">✔</span></li>
        <li>Location <span class="task-percent">20%</span><span class="status-check completed">✔</span></li>
        <li>Biography <span class="task-percent">15%</span><span class="status-check completed">✔</span></li>
        <li>Notifications <span class="task-percent">10%</span><span class="status-check pending">✕</span></li>
      </ul>

      <div class="sidebar-separator"></div>

      <h2 class="sidebar-title">Quiz Performance</h2>
      <div class="progress-container">
        <svg class="progress-ring" width="120" height="120">
          <circle class="progress-ring__bg" stroke-width="10" fill="transparent" r="50" cx="60" cy="60"/>
          <circle class="progress-ring__circle quiz-progress-circle" id="quizProgressCircle" stroke-width="10" fill="transparent" r="50" cx="60" cy="60"/>
        </svg>
        <div class="progress-text quiz-progress-text" id="quizProgressValue">0%</div>
      </div>
      <div class="quiz-stats-details">
        <p>Quizzes Taken: <span id="quizzesTaken">0</span> / <span id="totalQuizzes">0</span></p>
        <p>Average Score: <span id="quizAverage">0</span>%</p>
      </div>

    </aside>
  </div>
  <script src="profile.js"></script>
</body>
</html>