<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | QuizzyVerse</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Montserrat', sans-serif;
      background: #ffffff;
      color: #333;
      overflow-x: hidden;
      max-width:100vw;
    }
body::before {
    content: "";
    position: fixed;
    top: 0; 
    left: 0;
    width: 100vw;
    height: 100vh;
    background: url('../images/dots.png') repeat;
    background-size: auto;
    z-index: -1;

    /* Mask gradient: full at top, fades out toward bottom */
    -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0));
    mask-image: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0));
    -webkit-mask-repeat: no-repeat;
    mask-repeat: no-repeat;
}


    .hero {
      text-align: center;
      padding: 80px 20px 40px;
      background: url('../images/dot-pattern.png') repeat;
    }

    .hero h5 {
      color: #D3D3D3;
      letter-spacing: 1px;
      font-size: 20px;
      margin-bottom: 10px;
    }

    .hero h1 {
      font-size: 62px;
      font-weight: 400;
      color: #008080;
      margin: 0;
      position: relative;
      font-family:"Archer Gage Demo";
    }

    .hero h1::after {
      content: "";
      display: block;
      width: 580px;
      height: 5px;
      background-color: #00b0b9;
      margin: 10px auto 0;
      border-radius: 20px;
      font-family:"Cheddar Gothic Rough";
    }

    .hero p {
      max-width: 900px;
      font-weight:500;
      margin: 30px auto 0;
      font-size: 16px;
      color: #444;
      line-height: 1.6;
    }

.gallery {
  display: flex;
  justify-content: center;   /* Ensures centering of whole section */
  align-items: flex-start;
  padding: 50px 40px;
  max-width: 900px;
  margin: 0 auto;
  flex-wrap: nowrap;
}



    .gallery img {
      width: 280px;
      height: 180px;
      border-radius: 16px;
      object-fit: cover;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);

    }
.left-column,
.right-column {
  flex: 1;
  display: flex;
  flex-direction: column;
}


.left-column img,
.right-column img {
  width: 280px;
  height: 180px;
  border-radius: 16px;
  object-fit: cover;
  box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

    .footer {
      text-align: center;
      padding: 30px 20px;
      font-size: 14px;
      color: #888;
    }
.blob-wrapper {
  width: 100%;
  max-width: 420px; /* or 600px */
  height: auto;
}


.blob-wrapper svg {
  width: 100%;
  height: 150%;
  display: block;
}

.impact-section {
  text-align: center;
  padding: 40px 20px 60px;
  font-size: 34px;
  font-weight: 600;
  color: #333;
  line-height: 1.6;
  max-width: 870px;
margin: 0 auto;
  max-width: 900px;
}

.impact-section .highlight-blue {
  color: #2563eb; /* Blue */
}

.impact-section .highlight-red {
  color: #d6225e; /* Red / Pink */
}

.impact-section .highlight-teal {
  color: #0aaab4; /* Teal */
}

.impact-section i {
  margin-right: 6px;
  color: inherit;
}
.join-us {
  background-color: #e9d4e5;
  border-radius: 20px;
  margin: 40px auto;
  padding: 40px;
margin: 40px auto;
  max-width: 1150px;
}

.join-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  align-items: center;
}

.join-images {
  display: flex;
}

.join-images img {
  width: 600px;
  height: 400px;
  object-fit: cover;
  border-radius: 10px;
}

.join-text {
  max-width: 500px;
  margin-left: 30px;
}

.join-text h2 {
  font-size: 38px;
  color: #5a0d7a;
  font-weight: bold;
  margin-bottom: 20px;
  font-family:"Archer Gage Demo";
}

.join-text .underline-purple {
  border-bottom: 4px solid #5a0d7a;
  padding-bottom: 4px;
}

.join-text p {
  font-size: 16px;
  color: #333;
  margin-bottom: 25px;
  font-weight:500;
}

.career-button {
  padding: 12px 24px;
  background-color: white;
  color: #5a0d7a;
  font-weight: bold;
  border-radius: 8px;
  text-decoration: none;
  box-shadow: 2px 4px #ddd;
  display: inline-flex;
  align-items: center;
  transition: all 0.2s ease-in-out;
}

.career-button:hover {
  background-color: #f5f5f5;
  transform: translateY(-2px);
}
.story-section {
  padding: 60px 20px;
  max-width: 1100px;
  margin: 0 auto;
}

.story-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 40px;
  flex-wrap: wrap;
}

.story-text {
  flex: 1;
}

.story-text h2 {
  font-size: 46px;
  font-weight: 700;
  color: purple;
  margin-bottom: 20px;
  position: relative;
  font-family:"Archer Gage Demo";
}

.story-highlight {
  display: inline-block;
  border-bottom: 5px solid purple;
  padding-bottom: 6px;
}

.story-text p {
  font-size: 16px;
  line-height: 1.6;
  color: #333;
  margin-bottom: 15px;
  font-weight: 500;
}

.story-image {
  flex: 1;
  max-width: 420px;
}

.story-blob {
  width: 100%;
  height: auto;
}
@keyframes float {
  0%   { transform: translateY(0); }
  50%  { transform: translateY(-10px); }
  100% { transform: translateY(0); }
}

.float-card {
  animation: float 3s ease-in-out infinite;
}
.fade-in-section {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
  will-change: opacity, transform;
}

.fade-in-section.visible {
  opacity: 1;
  transform: none;
}


  </style>
</head>
<body>

  <!-- Navbar -->
<?php include '../php/loggednavebar.php'; ?>

  <div class="background-image"></div>
  <div class="hero">
    <h5>OUR MISSION</h5>
    <h1>Motivate every student</h1>
    <p>
      QuizzyVerse is more than gamified quizzes. We are assessment, instruction,
      and practice that motivate every student to mastery.
    </p>
    <p>
      Today, we’re used by teachers in 86% of U.S. schools who have created and shared 30+ million activities.
    </p>
  </div>

  <!-- Image Gallery Section -->
<!-- Image Gallery Section -->
<div class="gallery fade-in-section" style="justify-content: center;" >
  <div class="left-column" style="margin-left:5rem;">
    <img src="../images/Team 1.png" alt="Team 1">
    <img src="../images/team3.png" alt="Team 3" style="margin-top: 20px;">
  </div>
  <div class="right-column" >
  <div class="blob-wrapper">
  <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <clipPath id="blobClip">
      <path fill="#FFFFFF" d="M35.6,-59.1C45.1,-56.2,51.1,-44.6,61.1,-33.3C71.2,-22,85.2,-11,87.7,1.4C90.2,13.8,81,27.7,71.2,39.3C61.4,51,50.9,60.5,38.9,68.1C26.9,75.7,13.5,81.4,1.5,78.8C-10.5,76.2,-20.9,65.3,-35.1,59C-49.3,52.6,-67.1,50.8,-77.5,41.8C-87.8,32.7,-90.6,16.3,-86.7,2.3C-82.7,-11.8,-71.9,-23.5,-61.2,-31.9C-50.4,-40.2,-39.7,-45.1,-29.5,-47.6C-19.3,-50.1,-9.6,-50.1,1.7,-53.1C13,-56,26.1,-61.9,35.6,-59.1Z" transform="translate(100 100)" />
    </clipPath>
    <image clip-path="url(#blobClip)" xlink:href="../images/team2.jpg" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" />
  </svg>
</div>
</div>
</div>
<!-- Impact Stats Section -->
<div class="impact-section fade-in-section">
  <p>
    <span class="icon"><i class="fas fa-user"></i></span>
    <span class="highlight-blue">50M+</span> people, in 
    <span class="highlight-red"><i class="fas fa-globe"></i> 150+</span> countries
    answering 
    <span class="highlight-teal"><i class="fas fa-question-circle"></i> 50M+</span> questions/day.
  </p>
</div>

<!-- Join Us Section -->
<div class="join-us fade-in-section">
  <div class="join-container">
    <div class="join-images">
      <img src="../images/join.png" alt="Join 1">
    </div>
    <div class="join-text">
      <h2>Join <span class="underline-purple">us.</span></h2>
      <p>
        QuizzyVerse is venture funded and growing fast. Join our diverse team of educators, designers, and engineers who believe in staying curious. Always.
      </p>
      <a href="#" class="career-button">Explore Careers <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</div>
<!-- Our Story Section -->
<div class="story-section fade-in-section">
  <div class="story-container">
    <div class="story-text">
      <h2><span class="story-highlight">Our story</span></h2>
      <p><strong>Ankit and Deepak founded Quizizz in 2015</strong>, while teaching remedial math at a school in Bangalore, India.</p>
      <p><strong>Today, Quizizz supports millions of students in over 150 countries</strong> from offices in Santa Monica, California and Bangalore, India.</p>
    </div>
    <div class="story-image">
      <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <clipPath id="blobClip2">
          <path fill="#FF0066" d="M47.2,-52.8C58.4,-46.8,63,-29.3,67.7,-10.8C72.4,7.8,77.2,27.6,70.7,42.8C64.3,58.1,46.6,68.8,28.3,73.8C9.9,78.8,-9.1,78,-24.5,70.9C-39.9,63.7,-51.8,50.2,-60.7,34.9C-69.6,19.7,-75.7,2.6,-73.2,-13.2C-70.8,-29,-59.7,-43.5,-46.1,-49.2C-32.5,-54.8,-16.2,-51.5,0.9,-52.5C17.9,-53.6,35.9,-58.9,47.2,-52.8Z" transform="translate(100 100)" />
        </clipPath>
        <image clip-path="url(#blobClip2)" xlink:href="../images/founderjpg.jpg" width="90%" height="95%"   preserveAspectRatio="xMidYMid slice" />
      </svg>
    </div>
  </div>
</div>

<div class="learn-more-section fade-in-section" style="padding: 60px 20px; max-width: 1150px; margin: 0 auto;">
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 40px;">
    
    <!-- Left: Heading -->
    <div style="flex: 1; min-width: 250px;">
      <h2 style="font-size: 36px; font-weight: 700; margin: 0;">Learn more<br>about QuizzyVerse</h2>
    </div>

    <!-- Right: Cards -->
    <div style="flex: 2; display: flex; gap: 30px; flex-wrap: wrap; justify-content: flex-end;">
      
      <!-- Card 1 -->
<div class="float-card" style="flex: 1 1 250px; max-width: 250px; background: #f5e6f7; border-radius: 16px; padding: 20px; text-align: center;">
  <i class="fa-brands fa-square-twitter" style="color:purple; font-size:15rem;"></i>
  <h3 style="margin-top: 15px; font-size: 18px;">Join The Conversation</h3>
  <button style="margin-top: 10px; padding: 10px 18px; background-color: white; border: 2px solid purple; color: purple; font-weight: 600; border-radius: 8px; cursor: pointer;">
    Join The Conversation &gt;
  </button>
</div>


      <!-- Card 2 -->
     <div class="float-card" style="flex: 1 1 250px; max-width: 250px; background: #f5e6f7; border-radius: 16px; padding: 20px; text-align: center;">
  <i class="fa-brands fa-square-facebook" style="color:purple; font-size:15rem;"></i>
  <h3 style="margin-top: 15px; font-size: 18px;">Read Our Blog</h3>
  <button style="margin-top: 10px; padding: 10px 18px; background-color: white; border: 2px solid purple; color: purple; font-weight: 600; border-radius: 8px; cursor: pointer;">
    Join The Team &gt;
  </button>
</div>


    </div>
  </div>
</div>

<div class="motivation-section fade-in-section" style="background-color:rgba(126, 116, 116, 0.66); color: white; padding: 60px 40px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
  <div style="max-width: 550px;">
    <p style="opacity: 0.8; font-size: 16px; color:black; font-weight:500;">The best way to ask questions, explore ideas, and let students show what they know.</p>
    <h2 style="font-size: 42px; font-weight: 800; margin: 15px 0;">Start motivating students. <span style="color: purple;">In minutes.</span></h2>
    <div style="margin-top: 30px; display: flex; gap: 20px;">
      <a href="#" style="background-color: white; color: #7a3e9d; padding: 14px 22px; border-radius: 10px; font-weight: 600; text-decoration: none;">Learn more</a>
    </div>
  </div>
  <div style="flex: 1; max-width: 400px;">
      <image src="../images/Logoo.png"  width="100%" height="100%" />
    </svg>
  </div>
</div>


</div>

</div>


  <!-- Footer -->
  <div class="footer">
    &copy; 2025 QuizzyVerse. All rights reserved.
  </div>
  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll(".fade-in-section");

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          observer.unobserve(entry.target); // Optional: remove observer after it reveals
        }
      });
    }, { threshold: 0.15 });

    sections.forEach(section => {
      observer.observe(section);
    });
  });
</script>

</body>
</html>
