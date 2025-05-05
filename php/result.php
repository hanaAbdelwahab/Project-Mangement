<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome for back arrow icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<link rel="stylesheet" href="../css/result.css">
    <style>
    </style>
</head>
<body>
    <div id="jsi-fireworks-container" class="container"></div>
    <div id="canvas-container" style="display: none;">
        <canvas id="canvas"></canvas>
        <div class="fog"></div>
		</div>
    </div>
      
    <div class="navbar">
        <a href="attend.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
        <div class="title">Computer Basics Quiz</div>
        <div class="spacer"></div>
    </div>
    
    <div class="result-container">
        <img id="avatar" class="avatar" src="../images/JUl.gif" alt="Avatar reaction">

        <img id="sad-gif" class="sad-gif" src="../images/output-onlinegiftools.gif" alt="Sad reaction">
        <h2 id="result-text">Your result is ...</h2>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/result.js"></script>
</body>
</html>