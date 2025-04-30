<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Quiz Questions</title>
    <link rel="stylesheet" href="display.css">
</head>
<body>

  
  <div id="quizDisplay" class="quiz-container"></div>

  <script>
   function saveQuestion() {
    const questionInput = document.getElementById("questionInput");
    const answerInputs = document.querySelectorAll(".answer-text");
    const correctChecks = document.querySelectorAll(".answer-correct");

    const question = questionInput.value.trim();
    const answers = [];

    for (let i = 0; i < answerInputs.length; i++) {
        const text = answerInputs[i].value.trim();
        const correct = correctChecks[i].checked;

        if (text) {
            answers.push({ text: text, correct: correct });
        }
    }

    if (!question || answers.length === 0) {
        alert("Please enter a valid question and at least one answer.");
        return;
    }

    let quizzes = JSON.parse(localStorage.getItem("savedQuizzes")) || [];

    // 🚫 Check for duplicates
    const isDuplicate = quizzes.some(q => q.question.toLowerCase() === question.toLowerCase());
    if (isDuplicate) {
        alert("This question already exists.");
        return;
    }

    // ✅ Save new question
    quizzes.push({ question: question, answers: answers });
    localStorage.setItem("savedQuizzes", JSON.stringify(quizzes));

    questionInput.value = "";
    answerInputs.forEach(input => input.value = "");
    correctChecks.forEach(check => check.checked = false);

    displaySavedQuestions();
}


    function displaySavedQuestions() {
        const quizData = JSON.parse(localStorage.getItem("savedQuizzes")) || [];
        const quizDisplay = document.getElementById("quizDisplay");
        quizDisplay.innerHTML = "";

        quizData.forEach((quiz, index) => {
            let questionHTML = `
                <div class="question-box">
                    <div class="question-meta">
                        <input type="checkbox">
                        <button class="question-type">${index + 1}. Multiple Choice</button>
                        <select><option>30 seconds</option></select>
                        <select><option>1 point</option></select>
                    </div>
                    <div class="question-text"><strong>${quiz.question}</strong></div>
                    <div class="answer-label">Answer choices</div>
                    <div class="answer-grid">
            `;

            quiz.answers.forEach(ans => {
                const icon = ans.correct ? "✅" : "❌";
                questionHTML += `<div class="answer-item">${icon} ${ans.text}</div>`;  // ✅ .text works now
            });

            questionHTML += `</div><hr></div>`;
            quizDisplay.innerHTML += questionHTML;
        });
    }

    document.addEventListener("DOMContentLoaded", displaySavedQuestions);
</script>



</body>
</html>
