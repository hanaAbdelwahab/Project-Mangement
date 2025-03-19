<?php 
$quizzes = [
    ["title" => "Biology Ch1", "questions" => 20, "color" => "#007bff", "instructor" => "Dr. Ahmed", "photo" => "https://t3.ftcdn.net/jpg/03/45/75/94/360_F_345759488_gh3cxWU7DEnZJCmDiggHnsuM2zqpkTpG.jpg"],
    ["title" => "Chemistry Organic", "questions" => 15, "color" => "#28a745", "instructor" => "Prof. Fatima", "photo" => "https://media.istockphoto.com/id/1365527907/photo/portrait-of-smiling-mature-teacher-with-laptop-in-the-classroom.jpg?s=612x612&w=0&k=20&c=9Zgf2IEHkNV7LTEcmFLgOTqY8jaX0K5P-8IYmsyafA4="],
    ["title" => "Physics Motion", "questions" => 25, "color" => "#ff9800", "instructor" => "Dr. Hassan", "photo" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbLFc4jnvPpJFqK0zeIY8PxYDKuPSSDsrHog&s"],
    ["title" => "Math Algebra", "questions" => 30, "color" => "#9c27b0", "instructor" => "Prof. Aisha", "photo" => "https://media.istockphoto.com/id/1365527907/photo/portrait-of-smiling-mature-teacher-with-laptop-in-the-classroom.jpg?s=612x612&w=0&k=20&c=9Zgf2IEHkNV7LTEcmFLgOTqY8jaX0K5P-8IYmsyafA4="],
    ["title" => "History WW2", "questions" => 10, "color" => "#e91e63", "instructor" => "Dr. Omar", "photo" => "https://t3.ftcdn.net/jpg/03/45/75/94/360_F_345759488_gh3cxWU7DEnZJCmDiggHnsuM2zqpkTpG.jpg"],
    ["title" => "Physics Motion", "questions" => 25, "color" => "#ff9800", "instructor" => "Dr. Hassan", "photo" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbLFc4jnvPpJFqK0zeIY8PxYDKuPSSDsrHog&s"],
    ["title" => "Physics Motion", "questions" => 25, "color" => "#ff9800", "instructor" => "Dr. Hassan", "photo" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbLFc4jnvPpJFqK0zeIY8PxYDKuPSSDsrHog&s"],
    ["title" => "Geography Maps", "questions" => 12, "color" => "#3f51b5", "instructor" => "Prof. Zainab", "photo" => "https://www.shutterstock.com/image-photo/young-happy-business-woman-sitting-260nw-2223351415.jpg"]
];

$itemsPerPage = 6;
$totalPages = ceil(count($quizzes) / $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Quizzes</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
            
            height: 100vh;
            
        }

        .explore-section {
    width: 100%;
    max-width: 1500px;
    text-align: center;
    padding: 20px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}


        .quiz-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            justify-content: center;
        }

        .quiz-box {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: left;
            min-height: 140px;
            transition: 0.3s;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .quiz-box::before {
            content: "";
            width: 100%;
            height: 8px;
            position: absolute;
            top: 0;
            left: 0;
        }

        .quiz-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .quiz-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .question-box {
            background: rgba(50, 27, 27, 0.07);
            color: #444;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 10px;
        }

        .instructor-info {
            display: flex;
            align-items: center;
            margin-top: auto;
        }

        .instructor-photo {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .attendd-quiz {
            background: #007bff;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 8px 12px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
            align-self: flex-end;
        }

        .attendd-quiz:hover {
            background: #0056b3;
        }

        .nav-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .arrow {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 22px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            margin: 0 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .arrow:hover {
            background: linear-gradient(135deg, #0056b3, #00429d);
            transform: scale(1.1);
        }

        .page-indicator {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        @media (max-width: 768px) {
            .quiz-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .quiz-container {
                grid-template-columns: repeat(1, 1fr);
            }
        }
        /* Navbar */
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
    gap: 10px; /* Adjust spacing between buttons */
}

.create-quiz{
    border:none;
    background-color: purple;
    color: white;
    border-radius:5px;
    transition: background 0.3s ease-in-out;
    font-family: "Montserrat", sans-serif;
    margin-right: 8px;
    padding:10px 15px
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
     <!-- Navbar -->
     <nav class="navbar">
        <div class="logo">QuizzyVerse</div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Activity</a>
            <a href="#">Classes</a>
            <a href="../php/explore.php">Explore</a>
        </div>
        <div class="button-container">
    <button class="create-quiz"onclick="window.location.href='../html/create.html'">Create Quiz</button>
    <button class="attend-quiz" onclick="window.location.href='../html/attendQuiz.html'">Attend Quiz</button>
    </div>



    </nav>
    <div class="explore-section">
        <div id="quizContainer" class="quiz-container"></div>
        <div class="nav-container">
            <button class="arrow" onclick="changePage(-1)">&#9664;</button>
            <span id="pageIndicator" class="page-indicator">1/<?php echo $totalPages; ?></span>
            <button class="arrow" onclick="changePage(1)">&#9654;</button>
        </div>
    </div>

    <script>
        const quizzes = <?php echo json_encode($quizzes); ?>;
        const itemsPerPage = <?php echo $itemsPerPage; ?>;
        let currentPage = 1;
        const totalPages = <?php echo $totalPages; ?>;

        function renderPage(page) {
            const quizContainer = document.getElementById("quizContainer");
            quizContainer.innerHTML = "";

            let start = (page - 1) * itemsPerPage;
            let end = start + itemsPerPage;
            let pageQuizzes = quizzes.slice(start, end);

            pageQuizzes.forEach(quiz => {
                let quizBox = document.createElement("div");
                quizBox.classList.add("quiz-box");
                quizBox.style.borderTop = `8px solid ${quiz.color}`;

                quizBox.innerHTML = `
                    <div class="quiz-title">${quiz.title}</div>
                    <div class="question-box">${quiz.questions} Questions</div>
                    <div class="instructor-info">
                        <img src="${quiz.photo}" class="instructor-photo">
                        <span>${quiz.instructor}</span>
                    </div>
                    <button class="attendd-quiz">Attend Quiz</button>
                `;

                quizContainer.appendChild(quizBox);
            });

            document.getElementById("pageIndicator").innerText = `${page}/${totalPages}`;
        }

        function changePage(direction) {
            if (direction === -1 && currentPage > 1) {
                currentPage--;
            } else if (direction === 1 && currentPage < totalPages) {
                currentPage++;
            }
            renderPage(currentPage);
        }

        renderPage(1);
    </script>
</body>
</html>
