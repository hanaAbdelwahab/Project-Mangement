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

        /* Explore Section */
        .explore-section {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .filter-btn {
            background-color: white;
            border: 2px solid #662D91;
            color: #662D91;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .filter-btn.active, .filter-btn:hover {
            background-color: #662D91;
            color: white;
        }

        .quiz-container {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 40px; /* Increased spacing to match the image */
            perspective: 1000px;
            padding: 0 60px; /* Added horizontal padding to match the image layout */
        }

        .quiz-box-wrapper {
            width: 100%;
            height: 140px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.8s;
        }

        .quiz-box-wrapper:hover {
            transform: rotateY(180deg);
        }

        .quiz-box-front, .quiz-box-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .quiz-box-front {
            background: white;
            transform: rotateY(0deg);
        }

        .quiz-box-back {
            color: white;
            transform: rotateY(180deg);
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .quiz-box-front::before {
            content: "";
            width: 100%;
            height: 8px;
            position: absolute;
            top: 0;
            left: 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .quiz-title {
            font-size: 16px;
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
            width: 25px;
            height: 25px;
            border-radius: 50%;
            margin-right: 8px;
            object-fit: cover;
        }

        .instructor-info span {
            font-size: 14px;
        }

        .attendd-quiz {
            background: #662D91;
            color: white;
            font-size: 12px;
            font-weight: bold;
            padding: 6px 10px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .attendd-quiz:hover {
            background: #4D1A75;
        }

        .quiz-back-details {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .quiz-back-details h3 {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .quiz-back-details p {
            margin: 5px 0;
            font-size: 12px;
        }

        @media (max-width: 1024px) {
            .quiz-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 680px) {
            .quiz-container {
                grid-template-columns: 1fr;
            }

            .filter-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }

            .filter-btn {
                margin-bottom: 10px;
            }
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
            <button class="create-quiz" onclick="window.location.href='../html/create.html'">Create Quiz</button>
            <button class="attend-quiz" onclick="window.location.href='../html/attendQuiz.html'">Attend Quiz</button>
        </div>
    </nav>

    <div class="explore-section">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="chemistry">Chemistry</button>
            <button class="filter-btn" data-filter="history">History</button>
            <button class="filter-btn" data-filter="maths">Maths</button>
            <button class="filter-btn" data-filter="biology">Biology</button>
            <button class="filter-btn" data-filter="literature">Literature</button>
        </div>
        <div id="quizContainer" class="quiz-container"></div>
    </div>

    <script>
       const quizzes = [
            {"title": "Biology Ch1", "questions": 20, "color": "#007bff", "instructor": "Dr. Ahmed", "photo": "https://t3.ftcdn.net/jpg/03/45/75/94/360_F_345759488_gh3cxWU7DEnZJCmDiggHnsuM2zqpkTpG.jpg", "category": "biology", "difficulty": "Beginner", "duration": "30 mins", "description": "An introductory quiz covering fundamental biological concepts and principles."},
            {"title": "Chemistry Organic", "questions": 15, "color": "#28a745", "instructor": "Prof. Fatima", "photo": "https://media.istockphoto.com/id/1365527907/photo/portrait-of-smiling-mature-teacher-with-laptop-in-the-classroom.jpg?s=612x612&w=0&k=20&c=9Zgf2IEHkNV7LTEcmFLgOTqY8jaX0K5P-8IYmsyafA4=", "category": "chemistry", "difficulty": "Intermediate", "duration": "45 mins", "description": "Dive deep into organic chemistry reactions and molecular structures."},
            {"title": "Physics Motion", "questions": 25, "color": "#ff9800", "instructor": "Dr. Hassan", "photo": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbLFc4jnvPpJFqK0zeIY8PxYDKuPSSDsrHog&s", "category": "physics", "difficulty": "Advanced", "duration": "60 mins", "description": "Comprehensive quiz on classical mechanics and motion principles."},
            {"title": "Math Algebra", "questions": 30, "color": "#9c27b0", "instructor": "Prof. Aisha", "photo": "https://media.istockphoto.com/id/1365527907/photo/portrait-of-smiling-mature-teacher-with-laptop-in-the-classroom.jpg?s=612x612&w=0&k=20&c=9Zgf2IEHkNV7LTEcmFLgOTqY8jaX0K5P-8IYmsyafA4=", "category": "maths", "difficulty": "Intermediate", "duration": "40 mins", "description": "Test your algebraic skills with challenging problems and concepts."},
            {"title": "History WW2", "questions": 10, "color": "#e91e63", "instructor": "Dr. Omar", "photo": "https://t3.ftcdn.net/jpg/03/45/75/94/360_F_345759488_gh3cxWU7DEnZJCmDiggHnsuM2zqpkTpG.jpg", "category": "history", "difficulty": "Beginner", "duration": "25 mins", "description": "Explore key events and turning points of World War II."},
            {"title": "Physics Mechanics", "questions": 25, "color": "#ff9800", "instructor": "Dr. Hassan", "photo": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbLFc4jnvPpJFqK0zeIY8PxYDKuPSSDsrHog&s", "category": "physics", "difficulty": "Advanced", "duration": "55 mins", "description": "In-depth exploration of mechanical principles and applications."},
            {"title": "Computer Science Basics", "questions": 20, "color": "#4CAF50", "instructor": "Prof. Samir", "photo": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRX_Nz8A8ZqWKt_CqCqk0QGqO0PL4-7doFhbw&s", "category": "computer-science", "difficulty": "Beginner", "duration": "35 mins", "description": "Fundamental concepts in computer science and programming."},
            {"title": "Literature Shakespeare", "questions": 15, "color": "#2196F3", "instructor": "Dr. Laila", "photo": "https://t3.ftcdn.net/jpg/03/45/75/94/360_F_345759488_gh3cxWU7DEnZJCmDiggHnsuM2zqpkTpG.jpg", "category": "literature", "difficulty": "Intermediate", "duration": "40 mins", "description": "Explore the works and literary techniques of William Shakespeare."},
            {"title": "Geography World Capitals", "questions": 25, "color": "#FF5722", "instructor": "Prof. Emily", "photo": "https://media.istockphoto.com/id/1365527907/photo/portrait-of-smiling-mature-teacher-with-laptop-in-the-classroom.jpg?s=612x612&w=0&k=20&c=9Zgf2IEHkNV7LTEcmFLgOTqY8jaX0K5P-8IYmsyafA4=", "category": "geography", "difficulty": "Intermediate", "duration": "40 mins", "description": "Test your knowledge of world capitals and geographical facts."}
            
        ];

        const quizContainer = document.getElementById("quizContainer");
        const filterButtons = document.querySelectorAll(".filter-btn");

        function renderQuizzes(filter = 'all') {
            quizContainer.innerHTML = "";

            const filteredQuizzes = filter === 'all' 
                ? quizzes 
                : quizzes.filter(quiz => quiz.category === filter);

            filteredQuizzes.forEach(quiz => {
                let quizBoxWrapper = document.createElement("div");
                quizBoxWrapper.classList.add("quiz-box-wrapper");

                quizBoxWrapper.innerHTML = `
                    <div class="quiz-box-front" style="border-top: 8px solid ${quiz.color}">
                        <div class="quiz-title">${quiz.title}</div>
                        <div class="question-box">${quiz.questions} Questions</div>
                        <div class="instructor-info">
                            <img src="${quiz.photo}" class="instructor-photo">
                            <span>${quiz.instructor}</span>
                        </div>
                        <button class="attendd-quiz" onclick="attendQuiz('${quiz.title}')">Attend Quiz</button>
                    </div>
                    <div class="quiz-box-back" style="background-color: ${quiz.color}">
                        <div class="quiz-back-details">
                            <h3>${quiz.title}</h3>
                            <p><strong>Difficulty:</strong> ${quiz.difficulty}</p>
                            <p><strong>Duration:</strong> ${quiz.duration}</p>
                            <p>${quiz.description}</p>
                            <button class="attendd-quiz" onclick="attendQuiz('${quiz.title}')">Start Quiz</button>
                        </div>
                    </div>
                `;

                quizContainer.appendChild(quizBoxWrapper);
            });
        }

        function attendQuiz(quizTitle) {
            // Redirect to quiz.html for Biology Ch1 quiz
            if (quizTitle === "Biology Ch1") {
                window.location.href = '../html/quiz.html';
            } else {
                // You can add logic for other quizzes or show a message
                alert(`Quiz "${quizTitle}" is not available yet.`);
            }
        }

        // Filter button event listeners
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Filter and render quizzes
                renderQuizzes(button.dataset.filter);
            });
        });

        // Initial render
        renderQuizzes();
    </script>
</body>
</html>