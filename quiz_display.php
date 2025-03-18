<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Quiz Questions</title>
    <link rel="stylesheet" href="display.css">
</head>
<body>
<button class="back-button" onclick="window.history.back();">⬅ Back</button>

    <div class="quiz-container">
        <h2>Saved Quiz Questions</h2>
        <div id="quizDisplay"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let quizData = JSON.parse(localStorage.getItem("savedQuizzes")) || [];

            let quizDisplay = document.getElementById("quizDisplay");

            if (quizData.length === 0) {
                quizDisplay.innerHTML = "<p>No quizzes saved yet.</p>";
                return;
            }

            quizData.forEach((quiz, index) => {
                let questionHTML = `<div class='question'><b>Q${index + 1}: ${quiz.question}</b></div><ul>`;

                quiz.answers.forEach(answer => {
                    let answerClass = answer.correct ? "answer-item correct" : "answer-item";
                    questionHTML += `<li class="${answerClass}">${answer.text}</li>`;
                });

                questionHTML += "</ul><hr>";
                quizDisplay.innerHTML += questionHTML;
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
    let quizData = JSON.parse(localStorage.getItem("savedQuizzes")) || [];

    if (quizData.length > 0) {
        let quizContainer = document.querySelector(".quiz-container");
        quizContainer.innerHTML = ""; // Clear existing content

        quizData.forEach((quizItem, index) => {
            let questionElement = document.createElement("div");
            questionElement.classList.add("question");
            questionElement.textContent = `${index + 1}. ${quizItem.question}`;

            let answersContainer = document.createElement("ul");
            answersContainer.classList.add("answers");

            quizItem.answers.forEach(answer => {
                let answerItem = document.createElement("li");
                answerItem.classList.add("answer-item");
                answerItem.innerHTML = `<i class="fas fa-circle"></i> ${answer}`;
                answersContainer.appendChild(answerItem);
            });

            // Append question and answers to quiz container
            quizContainer.appendChild(questionElement);
            quizContainer.appendChild(answersContainer);
        });
    }
});

    </script>
</body>
</html>
