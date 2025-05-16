<?php
session_start();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="../css/attend.css" rel="stylesheet">
    <title>Computer Knowledge Quiz</title>
    <style>
        
.owl {
    position: relative;
    margin: 40px auto 0;
    width: 300px;
    translate: 4rem -8rem;
  }
  .pupil {
    position: absolute;
    top: 20px;
    left: 20px;
    width: 50px;
    height: 50px;
    border-radius: 25px;
    background: #000;
    transition: transform 0.15s ease;
  }
  .pupil::after {
    position: absolute;
    top: 0;
    right: 0;
    display: block;
    width: 24px;
    height: 24px;
    border-radius: 12px;
    background: #fff;
    content: '';
  }
  .eye {
    position: absolute;
    top: 10px;
    left: 10px;
    width: 90px;
    height: 90px;
    border-radius: 45px;
    background: #fff; 
  }
  .eye:nth-child(2){
    left:98px;
  }
  .eyes {
    position: absolute;
    top: 10px;
    left: -20px;
    width: 110px;
    height: 110px;
    border-radius: 55px;
    background: #FF2DF1;
  }
  .eyes::before {
    position: absolute;
    left: 88px;
    display: block;
    width: 110px;
    height: 110px;
    border-radius: 55px;
    background: #FF2DF1;
    content: '';
  }
  .beak {
    position: absolute;
    translate: 2rem 5rem;
    display: block;
    width: 0;
    height: 0;
    border-top: 60px solid #41044587; 
    border-right: 50px solid transparent;
    border-left: 50px solid transparent;
    content: ''; 
  }
  .head {
    position: absolute;
    width: 160px;
    height: 80px;
    border-radius: 80px / 40px;
    background: #A5158C;
    translate:-2rem 5rem;
  }
  .head::before {
    position: absolute;
    top: 0px;
    left: 15px;
    display: block;
    width: 0;
    height: 0; 
    border-right: 15px solid transparent;
    border-bottom: 15px solid #A5158C; 
    border-left: 15px solid transparent;
    content: ''; 
    -webkit-transform: rotate(-15deg);
  }
  .head::after {
    position: absolute;
    top: 0;
    right: 18px;
    z-index:-1;
    display: block;
    width: 0;
    height: 0; 
    border-right: 15px solid transparent;
    border-bottom: 15px solid #A5158C; 
    border-left: 15px solid transparent;
    content: ''; 
    -webkit-transform: rotate(15deg);
  }
  .body {
    position: absolute;
    top: 100px;
    width: 160px;
    height: 100px;
    border-radius: 80px / 50px;
    background: #da26ce;
    translate:-2rem 5rem;
  }
  .wing {
    position: absolute;
    top: 0;
    left: -20px;
    width: 50px;
    height: 100px;
    border-radius: 50px 0;
    background: #A5158C;
    -webkit-transform-origin: 30px 10px;
    -webkit-transform: rotate(-20deg);
    transition: all 0.5s ease;
  }
  
  .wing:nth-child(2){
    left: 130px;
    border-radius: 0 50px;
     -webkit-transform-origin: 20px 10px;
    -webkit-transform: rotate(20deg);
  }
  .feet {
    position: absolute;
    bottom: -5px;
    left: 50px;
    width: 6px;
    height: 18px;
    border-radius: 3px / 9px;
    background: #41044587;
    -webkit-transform: rotate(10deg);
  }
  .feet::before {
    position: absolute;
    bottom: 0;
    left: -6px;
    display: block;
    width: 6px;
    height: 18px;
    border-radius: 3px / 9px;
    background: #41044587;
    content: '';
  }
  .feet::after {
    position: absolute;
    bottom: 0;
    left: 6px;
    display: block;
    width: 6px;
    height: 18px;
    border-radius: 3px / 9px;
    background: #41044587;
    content: '';
  }
  .feet.right{
    left: 104px;
    -webkit-transform: rotate(-10deg);
  }
  .feather {
    position: absolute;
    top: 65px;
    left: 72px;
    width: 0;
    height: 0;
    border-top: 10px solid #A5158C; 
    border-right: 7px solid transparent;
    border-left: 7px solid transparent; 
  }
  .feather::before {
    position: absolute;
    top: -30px;
    left: -20px;
    display: block;
    width: 0;
    height: 0;
    border-top: 10px solid #A5158C; 
    border-right: 7px solid transparent;
    border-left: 7px solid transparent;
    content: ''; 
    -webkit-transform: rotate(5deg);
  }
  .feather::after {
    position: absolute;
    top: -30px;
    left: 7px;
    display: block;
    width: 0;
    height: 0;
    border-top: 10px solid #A5158C; 
    border-right: 7px solid transparent;
    border-left: 7px solid transparent;
    content: ''; 
    -webkit-transform: rotate(-5deg);
  }
  
  .owl:hover .wing {
    -webkit-transform: rotate(90deg);
  }
  .owl:hover .wing:nth-child(2) {
    -webkit-transform: rotate(-90deg);
  }
  .owl:hover .head {
    top: 5px;
  }

        </style>
</head>
<body>
    <div class="background-image"></div>
    <nav class="navbar">
        <span class="nav-title">Computer Knowledge Quiz</span>
        <span id="timer" class="nav-timer">00:00</span>
        <div class="nav-right">
            <p title="Quiz-Code">5544 6644</p>
            <button id="fullscreen-btn" title="Fullscreen"><i class="fa-solid fa-expand"></i></button>
        </div>
    </nav>
<div class="quiz-container">
    <form id="quiz-form">
        <!-- Question 1 -->
        <div class="question-container" id="q1">
            <span class="question-number">1/10</span>
            <div class="question-text">What does CPU stand for?</div>
            <div class="mcq-container" data-group="q1">
                <div class="mcq-option">
                    <input type="radio" id="q1-a" name="q1" value="a">
                    <label for="q1-a">Central Processing Unit</label>
                </div>
                <div class="mcq-option">
                    <input type="radio" id="q1-b" name="q1" value="b">
                    <label for="q1-b">Computer Personal Unit</label>
                </div>
                <div class="mcq-option">
                    <input type="radio" id="q1-c" name="q1" value="c">
                    <label for="q1-c">Central Print Unit</label>
                </div>
                <div class="mcq-option">
                    <input type="radio" id="q1-d" name="q1" value="d">
                    <label for="q1-d">Control Processing Unit</label>
                </div>
            </div>
        </div>

        <!-- Question 2 -->
        <div class="question-container" id="q2" style="display: none;">
            <span class="question-number">2/10</span>
            <div class="question-text">What is RAM?</div>
            <div class="mcq-container" data-group="q2">
                <div class="mcq-option">
                    <input type="radio" id="q2-a" name="q2" value="a">
                    <label for="q2-a">Read Access Memory</label>
                </div>
                <div class="mcq-option">
                    <input type="radio" id="q2-b" name="q2" value="b">
                    <label for="q2-b">Random Access Memory</label>
                </div>
                <div class="mcq-option">
                    <input type="radio" id="q2-c" name="q2" value="c">
                    <label for="q2-c">Remote Access Module</label>
                </div>
                <div class="mcq-option">
                    <input type="radio" id="q2-d" name="q2" value="d">
                    <label for="q2-d">Runtime Application Module</label>
                </div>
            </div>
        </div>

        <!-- Question 3 -->
        <div class="question-container" id="q3" style="display: none;">
            <span class="question-number">3/10</span>
            <div class="question-text">Which of these is a storage device?</div>
            <div class="mcq-container" data-group="q3">
                <div class="mcq-option">
                    <input type="radio" id="q3-a" name="q3" value="a">
                    <label for="q3-a">CPU</label>
                </div>
                <div class="mcq-option">
                    <input type="radio" id="q3-b" name="q3" value="b">
                    <label for="q3-b">Mouse</label>
                </div>
                <div class="mcq-option">
                    <input type="radio" id="q3-c" name="q3" value="c">
                    <label for="q3-c">Hard Disk</label>
                </div>
                <div class="mcq-option">
                    <input type="radio" id="q3-d" name="q3" value="d">
                    <label for="q3-d">Monitor</label>
                </div>
            </div>
        </div>
<!-- Question 4: MCQ -->
<div class="question-container" id="q4" style="display: none;">
    <span class="question-number">4/10</span>
    <div class="question-text">Which of these is an input device?</div>
    <div class="mcq-container" data-group="q4">
        <div class="mcq-option">
            <input type="radio" id="q4-a" name="q4" value="a">
            <label for="q4-a">Printer</label>
        </div>
        <div class="mcq-option">
            <input type="radio" id="q4-b" name="q4" value="b">
            <label for="q4-b">Mouse</label>
        </div>
        <div class="mcq-option">
            <input type="radio" id="q4-c" name="q4" value="c">
            <label for="q4-c">Monitor</label>
        </div>
        <div class="mcq-option">
            <input type="radio" id="q4-d" name="q4" value="d">
            <label for="q4-d">Speaker</label>
        </div>
    </div>
</div>

<!-- Question 5: Open-ended -->
<div class="question-container" id="q5" style="display: none;">
    <span class="question-number">5/10</span>
    <div class="question-text">What does HTML stand for?</div>
    <input type="text" name="q5" placeholder="Your answer here" class="mcq-option" style="padding: 1rem; width: 80%; margin-top: 1rem; border: none;">
</div>

<!-- Question 6: Dropdown -->
<div class="question-container" id="q6" style="display: none;">
    <span class="question-number">6/10</span>
    <div class="question-text">Select a programming language:</div>
    <select name="q6" class="mcq-option" style="padding: 1rem; width: fit-content; font-size: 1rem; margin-top: 1rem;">
        <option value="">--Choose--</option>
        <option value="python">Python</option>
        <option value="java">Java</option>
        <option value="html">HTML</option>
        <option value="css">CSS</option>
    </select>
</div>

<!-- Question 7: MCQ -->
<div class="question-container" id="q7" style="display: none;">
    <span class="question-number">7/10</span>
    <div class="question-text">Which one is an operating system?</div>
    <div class="mcq-container" data-group="q7">
        <div class="mcq-option">
            <input type="radio" id="q7-a" name="q7" value="a">
            <label for="q7-a">Oracle</label>
        </div>
        <div class="mcq-option">
            <input type="radio" id="q7-b" name="q7" value="b">
            <label for="q7-b">Linux</label>
        </div>
        <div class="mcq-option">
            <input type="radio" id="q7-c" name="q7" value="c">
            <label for="q7-c">Photoshop</label>
        </div>
        <div class="mcq-option">
            <input type="radio" id="q7-d" name="q7" value="d">
            <label for="q7-d">Visual Studio</label>
        </div>
    </div>
</div>

<!-- Question 8: Open-ended -->
<div class="question-container" id="q8" style="display: none;">
    <span class="question-number">8/10</span>
    <div class="question-text">What does URL stand for?</div>
    <input type="text" name="q8" placeholder="Your answer here" class="mcq-option" style="padding: 1rem; width: 80%; margin-top: 1rem; border: none;">
</div>

<!-- Question 9: Dropdown -->
<div class="question-container" id="q9" style="display: none;">
    <span class="question-number">9/10</span>
    <div class="question-text">Choose a web browser:</div>
    <select name="q9" class="mcq-option" style="padding: 1rem; width: fit-content; font-size: 1rem; margin-top: 1rem;">
        <option value="">--Choose--</option>
        <option value="chrome">Google Chrome</option>
        <option value="firefox">Mozilla Firefox</option>
        <option value="edge">Microsoft Edge</option>
        <option value="safari">Safari</option>
    </select>
</div>

<!-- Question 10: MCQ -->
<div class="question-container" id="q10" style="display: none;">
    <span class="question-number">10/10</span>
    <div class="question-text">Which of these is NOT a programming language?</div>
    <div class="mcq-container" data-group="q10">
        <div class="mcq-option">
            <input type="radio" id="q10-a" name="q10" value="a">
            <label for="q10-a">Python</label>
        </div>
        <div class="mcq-option">
            <input type="radio" id="q10-b" name="q10" value="b">
            <label for="q10-b">HTML</label>
        </div>
        <div class="mcq-option">
            <input type="radio" id="q10-c" name="q10" value="c">
            <label for="q10-c">Java</label>
        </div>
        <div class="mcq-option">
            <input type="radio" id="q10-d" name="q10" value="d">
            <label for="q10-d">C++</label>
        </div>
    </div>
</div>

      
    </form>
</div>

<footer class="footer">
    <div class="footer-left">
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
    </div>
    <div class="footer-right">
        <h2>Hi <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    </div>
</footer>
<!-- Exit Warning Modal -->
<div id="exitModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); justify-content: center; align-items: center; z-index: 9999;">
  <div style="background: white; padding: 30px; border-radius: 10px; text-align: center; font-family: 'Montserrat', sans-serif; color: #4A0072; max-width: 350px;">
    <img src="../images/warning-joypixels.gif" alt="Warning" style="width: 60px; height: 60px; margin-bottom: 15px;">
    <p style="font-weight: bold; font-size: 16px;">Are you sure you want to leave the quiz?</p>
    <div style="margin-top: 20px; display: flex; justify-content: center; gap: 15px;">
      <button onclick="cancelExit()" style="padding: 10px 20px; background-color: #6A0DAD; color: white; border: none; border-radius: 5px; cursor: pointer;">Cancel</button>
      <button onclick="confirmExit()" style="padding: 10px 20px; background-color: #ff4c4c; color: white; border: none; border-radius: 5px; cursor: pointer;">Yes</button>
    </div>
  </div>
</div>

<script src="../js/attend.js"></script>
<script>
    let seconds = 0;
let timerElement = document.getElementById("timer");

function updateTimer() {
    let mins = Math.floor(seconds / 60);
    let secs = seconds % 60;
    timerElement.textContent = 
        String(mins).padStart(2, '0') + ":" + String(secs).padStart(2, '0');
    seconds++;
}

let timerInterval = setInterval(updateTimer, 1000);
</script>
<script>
    // Push dummy state to history so we can detect back
    window.history.pushState({ page: 1 }, "", "");

    window.addEventListener("popstate", function (event) {
        // Show your custom exit modal
        document.getElementById("exitModal").style.display = "flex";

        // Push state again so back stays on page until user confirms
        window.history.pushState({ page: 1 }, "", "");
    });

    function cancelExit() {
        document.getElementById("exitModal").style.display = "none";
    }

function confirmExit() {
    window.onbeforeunload = null; // Disable the native alert
    window.location.href = '../php/attendQuiz.php'; // Navigate cleanly
}



</script>
</body>
</html>