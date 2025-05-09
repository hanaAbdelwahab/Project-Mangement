  // Script to add "Blank" button when typing in the dropQuestionInput
  document.addEventListener('DOMContentLoaded', function() {
    // Get the save button for dropdown questions
    const saveDropQuizBtn = document.querySelector(".save-btn-D");

    // Add event listener for the dropdown save button
    if (saveDropQuizBtn) {
        saveDropQuizBtn.addEventListener("click", function() {
            // Get question content - make sure we're accessing the actual HTML content
            const dropQuestionElement = document.getElementById("dropQuestionInput");
            
            // Check if the element exists
            if (!dropQuestionElement) {
                console.error("Question input element not found");
                return;
            }
            
            // Get the innerHTML directly
            let dropQuestion = dropQuestionElement.innerHTML;
            console.log("Original question content:", dropQuestion); // Debug
            
            // Skip processing if question is empty or default text
            if (!dropQuestion || dropQuestion === "Type your question here...") {
                const dropErrorMessage = document.querySelector("#DropModal #errorMessage");
                if (dropErrorMessage) dropErrorMessage.style.display = "block";
                return;
            }
            
            // Remove any blank buttons from the question content before saving
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = dropQuestion;
            const blankButtons = tempDiv.querySelectorAll('.blank-btn');
            blankButtons.forEach(btn => {
                btn.remove();
            });
            dropQuestion = tempDiv.innerHTML;
            console.log("Processed question content:", dropQuestion); // Debug
            
            const correctAnswers = document.querySelectorAll(".correct-answer");
            const incorrectAnswers = document.querySelectorAll(".incorrect-answer");
            const dropErrorMessage = document.querySelector("#DropModal #errorMessage");
            
            // Check if at least one answer exists
            if (correctAnswers.length === 0 && incorrectAnswers.length === 0) {
                if (dropErrorMessage) dropErrorMessage.style.display = "block";
                return;
            }
            
            // Hide error message if everything is filled
            if (dropErrorMessage) dropErrorMessage.style.display = "none";
            
            // Create the question item to add to the container
            const questionItem = document.createElement("div");
            questionItem.classList.add("saved-question");
            
            // Build the HTML for the question
            let answersHTML = '<ul>';
            
            // Add correct answers with a check mark
            correctAnswers.forEach(answer => {
                answersHTML += `<li><span style="color:green">✓</span> ${answer.textContent}</li>`;
            });
            
            // Add incorrect answers with an X mark
            incorrectAnswers.forEach(answer => {
                answersHTML += `<li><span style="color:red">✗</span> ${answer.textContent}</li>`;
            });
            
            answersHTML += '</ul>';
            
            // Set the complete HTML without any blank buttons
            questionItem.innerHTML = `<strong>${dropQuestion}</strong>${answersHTML}`;
            
            // Add the question to the container
            const questionsContainer = document.querySelector(".Questions-container");
            if (questionsContainer) {
                questionsContainer.appendChild(questionItem);
                questionsContainer.style.display = "block";
            } else {
                console.error("Questions container not found");
            }
            
            // Reset the input fields
            if (dropQuestionElement) {
                dropQuestionElement.innerHTML = "Type your question here...";
            }
            
            const answerOptionsdD = document.querySelector(".answer-optionsdD");
            if (answerOptionsdD) {
                Array.from(answerOptionsdD.querySelectorAll(".correct-answer, .incorrect-answer")).forEach(el => el.remove());
            }
            
            // Close the modal
            const dropModal = document.getElementById("DropModal");
            if (dropModal) {
                dropModal.style.display = "none";
            }
            
            // Update the question count
            updateQuestionCount();
            
            // Show success message
            alert("Question saved successfully!");
        });
    }

    // Function to update the question count
    function updateQuestionCount() {
        const questionCount = document.querySelectorAll(".saved-question").length;
        const questionCountElement = document.querySelector(".Questions p");
        if (questionCountElement) {
            questionCountElement.innerHTML = `${questionCount} Question${questionCount !== 1 ? 's' : ''}<span> (${questionCount} Point${questionCount !== 1 ? 's' : ''})</span>`;
        }
    }

    // Function to save question data
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

        // Check for duplicates
        const isDuplicate = quizzes.some(q => q.question.toLowerCase() === question.toLowerCase());
        if (isDuplicate) {
            alert("This question already exists.");
            return;
        }

        // Save new question
        quizzes.push({ question: question, answers: answers });
        localStorage.setItem("savedQuizzes", JSON.stringify(quizzes));

        questionInput.value = "";
        answerInputs.forEach(input => input.value = "");
        correctChecks.forEach(check => check.checked = false);

        displaySavedQuestions();
    }

    // Function to display saved questions
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
                questionHTML += `<div class="answer-item">${icon} ${ans.text}</div>`;
            });

            questionHTML += `</div><hr></div>`;
            quizDisplay.innerHTML += questionHTML;
        });

        // Update the question count based on loaded questions
        const questionCount = quizData.length;
        const questionCountElement = document.querySelector(".Questions p");
        if (questionCountElement) {
            questionCountElement.innerHTML = `${questionCount} Question${questionCount !== 1 ? 's' : ''}<span> (${questionCount} Point${questionCount !== 1 ? 's' : ''})</span>`;
        }
    }

    // Initialize display of saved questions
    displaySavedQuestions();

    // Add event listener for the save button for multiple choice questions
    const saveMultipleChoiceBtn = document.querySelector(".save-btn");
    if (saveMultipleChoiceBtn) {
        saveMultipleChoiceBtn.addEventListener("click", function() {
            // Get the question from contenteditable div
            const questionElement = document.getElementById("questionInput");
            if (!questionElement) {
                console.error("Question input element not found");
                return;
            }
            
            const question = questionElement.textContent.trim();
            
            // Get all answer inputs
            const answerElements = document.querySelectorAll(".answer-input");
            const correctChecks = document.querySelectorAll(".correct-check");
            
            const answers = [];
            
            for (let i = 0; i < answerElements.length; i++) {
                const text = answerElements[i].value.trim();
                // Consider a button "checked" if it has an "active" class
                const correct = correctChecks[i].classList.contains("active");
                
                if (text) {
                    answers.push({ text: text, correct: correct });
                }
            }
            
            if (!question || question === "Type your question here..." || answers.length === 0) {
                const errorMessage = document.querySelector("#secondModal #errorMessage");
                if (errorMessage) errorMessage.style.display = "block";
                return;
            }
            
            let quizzes = JSON.parse(localStorage.getItem("savedQuizzes")) || [];
            
            // Check for duplicates
            const isDuplicate = quizzes.some(q => q.question.toLowerCase() === question.toLowerCase());
            if (isDuplicate) {
                alert("This question already exists.");
                return;
            }
            
            // Save new question
            quizzes.push({ question: question, answers: answers });
            localStorage.setItem("savedQuizzes", JSON.stringify(quizzes));
            
            // Reset the input fields
            if (questionElement) {
                questionElement.textContent = "Type your question here...";
            }
            
            answerElements.forEach(input => input.value = "");
            correctChecks.forEach(check => check.classList.remove("active"));
            
            // Close the modal
            const secondModal = document.getElementById("secondModal");
            if (secondModal) {
                secondModal.style.display = "none";
            }
            
            // Display saved questions
            displaySavedQuestions();
            
            // Show success message
            alert("Question saved successfully!");
        });
    }

    // Handle add question button
    const addQuestionBtn = document.querySelector(".addQ");
    if (addQuestionBtn) {
        addQuestionBtn.addEventListener("click", function() {
            const welcomeModal = document.getElementById("welcomeModal");
            if (welcomeModal) {
                welcomeModal.style.display = "block";
            }
        });
    }

    // Handle modal close buttons
    const closeButtons = document.querySelectorAll(".close");
    closeButtons.forEach(button => {
        button.addEventListener("click", function() {
            const modals = document.querySelectorAll(".modal");
            modals.forEach(modal => {
                modal.style.display = "none";
            });
        });
    });

    // Handle button to open multiple choice modal
    const multipleChoiceBtn = document.getElementById("multipleChoiceBtn");
    if (multipleChoiceBtn) {
        multipleChoiceBtn.addEventListener("click", function() {
            const welcomeModal = document.getElementById("welcomeModal");
            const secondModal = document.getElementById("secondModal");
            
            if (welcomeModal) welcomeModal.style.display = "none";
            if (secondModal) secondModal.style.display = "block";
        });
    }

    // Handle button to open dropdown modal
    const dropBtn = document.getElementById("DropBtn");
    if (dropBtn) {
        dropBtn.addEventListener("click", function() {
            const welcomeModal = document.getElementById("welcomeModal");
            const dropModal = document.getElementById("DropModal");
            
            if (welcomeModal) welcomeModal.style.display = "none";
            if (dropModal) dropModal.style.display = "block";
        });
    }

    // Handle correct/incorrect answer buttons for dropdown questions
    const correctBtn = document.getElementById("correct");
    const incorrectBtn = document.getElementById("incorrect");
    const correctAnswerContainer = document.getElementById("correctAnswerContainer");
    
    if (correctBtn && correctAnswerContainer) {
        correctBtn.addEventListener("click", function() {
            const answerDiv = document.createElement("div");
            answerDiv.className = "correct-answer";
            answerDiv.contentEditable = true;
            answerDiv.textContent = "Type correct answer...";
            correctAnswerContainer.appendChild(answerDiv);
        });
    }
    
    if (incorrectBtn && correctAnswerContainer) {
        incorrectBtn.addEventListener("click", function() {
            const answerDiv = document.createElement("div");
            answerDiv.className = "incorrect-answer";
            answerDiv.contentEditable = true;
            answerDiv.textContent = "Type incorrect answer...";
            correctAnswerContainer.appendChild(answerDiv);
        });
    }

    // Function to toggle active class on correct-check buttons
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("correct-check")) {
            const singleAnswerBtn = document.querySelector(".single-answer");
            const multipleAnswersBtn = document.querySelector(".multiple-answers");
            
            // If in single answer mode, remove active class from all buttons first
            if (singleAnswerBtn && singleAnswerBtn.classList.contains("active")) {
                document.querySelectorAll(".correct-check").forEach(btn => {
                    btn.classList.remove("active");
                });
            }
            
            e.target.classList.toggle("active");
        }
    });

    // Handle single vs multiple answer mode buttons
    const singleAnswerBtn = document.querySelector(".single-answer");
    const multipleAnswersBtn = document.querySelector(".multiple-answers");
    
    if (singleAnswerBtn) {
        singleAnswerBtn.addEventListener("click", function() {
            singleAnswerBtn.classList.add("active");
            if (multipleAnswersBtn) multipleAnswersBtn.classList.remove("active");
            
            // In single answer mode, make sure only one answer is selected
            const activeChecks = document.querySelectorAll(".correct-check.active");
            if (activeChecks.length > 1) {
                activeChecks.forEach((check, index) => {
                    if (index > 0) check.classList.remove("active");
                });
            }
        });
    }
    
    if (multipleAnswersBtn) {
        multipleAnswersBtn.addEventListener("click", function() {
            multipleAnswersBtn.classList.add("active");
            if (singleAnswerBtn) singleAnswerBtn.classList.remove("active");
        });
    }
});