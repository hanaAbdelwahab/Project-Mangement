<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz UI</title>
    <link rel="stylesheet" href="create.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        #quizEditor {
            display: none; /* Initially hidden */
        }

        /* Answer Box Styling */
        .answer-options {
            display: flex;
            gap: 10px;
        }

        .answer {
            position: relative;
            padding: 20px;
            width: 200px;
            height: 120px;
            color: white;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-align: center;
        }

        .blue { background-color: #2176FF; }
        .teal { background-color: #00A896; }
        .yellow { background-color: #F4A261; }
        .red { background-color: #E63946; }

        /* Icons */
        .icon {
            position: absolute;
            top: 10px;
            font-size: 16px;
            cursor: pointer;
            color: white;
        }

        .delete { right: 220px; }
        .correct-check { bottom: 20px; left: 200px; font-size: 18px; }

        /* Editable Question Input */
        .question-input {
    width: 100%;
    height: 80px; /* Increase height */
    padding: 15px;
    font-size: 22px; /* Make text larger */
    font-weight: bold;
    text-align: center;
    border: none;
    border-radius: 8px;
    outline: none;
    background: transparent;
    color: white;
}

.question-input::placeholder {
    color: rgba(255, 255, 255, 0.7); /* Light gray placeholder */
}


        .question-input:focus {
            border-color: #6A11CB;
            box-shadow: 0 0 8px rgba(106, 17, 203, 0.3);
        }
       
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Start from</h2>
            <ul>
                <li><i class="fas fa-file-import"></i> Import worksheets</li>
                <li><i class="fas fa-magic"></i> Generate with AI</li>
                <li class="active"><i class="fas fa-pencil-alt"></i> Create from scratch</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2>Create a new Quiz</h2>
            <div class="options">
                <div class="option purple" id="multipleChoiceBtn">
                    <i class="fas fa-list"></i> Multiple Choice
                </div>
                <div class="option purple"><i class="fas fa-edit"></i> Fill in the Blank</div>
                <div class="option purple"><i class="fas fa-comment-alt"></i> Open Ended</div>
            </div>
            <div class="quiz-toolbar">
    <button class="back-button">⬅</button>
    <div class="question-type">
        <button class="question-dropdown">
            <input type="checkbox" checked /> Multiple Choice ▼
        </button>
    </div>
    
</div>

<!-- Move this above -->
<div class="quiz-formatting">
    <button><b>A</b></button>
    <button><b>B</b></button>
    <button><i>I</i></button>
    <button><u>U</u></button>
    <button>𝑆̶</button>
    <button>x¹</button>
    <button>x₁</button>
    <button>∑</button>
    <button>𝑓(𝑥) Insert Equation</button>
</div>
    
            

            <!-- Quiz Editor (Initially Hidden) -->
            <div id="quizEditor">
                <div class="question-box">
                    <input type="text" id="questionInput" placeholder="Type your question here..." class="question-input">
                    <div class="answer-options">

                    <button id="addAnswerBtn" class="add-answer">+</button>
                   <div class="answer blue">
                  
                   <button class="correct-check">✔</button>
                   <span class="delete" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </span>
    <input type="text" class="answer-input" placeholder="Type answer option here...">
    
    
</div>


<div class="answer teal">
<button class="correct-check">✔</button>
<span class="delete" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </span>
    <input type="text" class="answer-input" placeholder="Type answer option here...">
  
    
</div>

                        <div class="answer yellow">
                        <button class="correct-check">✔</button>
                        <span class="delete" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </span>
                        <input type="text" class="answer-input" placeholder="Type answer option here...">
                            
                        </div>

                        <div class="answer red">
                        <button class="correct-check">✔</button>
                        <span class="delete" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </span>
                        <input type="text" class="answer-input" placeholder="Type answer option here...">
                         
                        </div>
                    </div>
                   
                    
                    <div class="button-container">
                        <button class="quiz-btn single-answer">Single Correct Answer</button>
                        <button class="quiz-btn multiple-answers">Multiple Correct Answers</button>
                        <button id="saveQuiz" class="save-btn">Save Quiz</button>
<p id="errorMessage" style="color: red; display: none;">Please fill in the question and the answers!</p>
    </div>
                    </div>
                </div>
            </div>
        </div>
      
    

   
</div>



    <script>
        document.addEventListener("DOMContentLoaded", function() { 
            let btn = document.getElementById("multipleChoiceBtn");
            let quizEditor = document.getElementById("quizEditor");

            if (!btn || !quizEditor) {
                console.error("Button or Quiz Editor not found!");
                return;
            }

            btn.addEventListener("click", function() {
                console.log("Button clicked!"); // Debugging log
                quizEditor.style.display = "block"; // Show the quiz editor
            });
        });
      
    document.addEventListener("DOMContentLoaded", function () {
        const addAnswerBtn = document.getElementById("addAnswerBtn");
        const answerContainer = document.querySelector(".answer-options");

        addAnswerBtn.addEventListener("click", function () {
            // Create a new answer div
            let newAnswer = document.createElement("div");
            newAnswer.classList.add("answer", "blue"); // Change "blue" to any default color class
            
            // Create the input field
            let inputField = document.createElement("input");
            inputField.type = "text";
            inputField.classList.add("answer-input");
            inputField.placeholder = "Type answer option here...";

            // Create the delete icon
            let deleteIcon = document.createElement("span");
            deleteIcon.classList.add("icon", "delete");
            deleteIcon.innerHTML = '<i class="fas fa-trash-alt"></i>';
            deleteIcon.addEventListener("click", function () {
                newAnswer.remove();
            });

            // Append elements
            newAnswer.appendChild(inputField);
            newAnswer.appendChild(deleteIcon);
            
            // Append new answer box to the container
            answerContainer.appendChild(newAnswer);
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
    // Select all check icons
    const checkIcons = document.querySelectorAll(".correct-check");

    checkIcons.forEach(icon => {
        icon.addEventListener("click", function () {
            // Remove 'selected' class from all icons (only one correct answer at a time)
            checkIcons.forEach(i => i.classList.remove("selected"));

            // Add 'selected' class to the clicked icon
            this.classList.add("selected");
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    // Add event listener to all delete buttons
    document.querySelectorAll(".delete").forEach(button => {
        button.addEventListener("click", function () {
            this.closest(".answer").remove(); // Remove the parent answer box
        });
    });

    // Function to add event listener for new dynamically added delete buttons
    document.body.addEventListener("click", function (event) {
        if (event.target.closest(".delete")) {
            event.target.closest(".answer").remove();
        }
    });
});
document.addEventListener("DOMContentLoaded", function() {
    console.log("Toolbar loaded:", document.querySelector(".quiz-toolbar"));
});



function saveQuizData(question, answers) {
    let quizData = {
        question: question,
        answers: answers
    };

    // Store quiz data in localStorage
    localStorage.setItem("savedQuiz", JSON.stringify(quizData));

    console.log("Quiz Saved:", quizData);
    alert("Quiz saved successfully!");

    // Redirect to the next page
    window.location.href = "quiz_display.php"; // Change this to your actual next page
}



console.log(document.getElementById("questionInput")?.value);
document.querySelectorAll(".answer-box").forEach(a => console.log(a.value));

document.addEventListener("DOMContentLoaded", function () {
    const saveQuizBtn = document.getElementById("saveQuiz");

    saveQuizBtn.addEventListener("click", function () {
        let questionInput = document.getElementById("questionInput").value.trim();
        let answerInputs = document.querySelectorAll(".answer-input");
        let answers = [];

        answerInputs.forEach(input => {
            let answerText = input.value.trim();
            if (answerText !== "") {
                answers.push(answerText);
            }
        });

        if (questionInput === "" || answers.length === 0) {
            alert("Please fill in the question and at least one answer!");
            return;
        }

        // Retrieve existing quiz data or create an empty array
        let quizData = JSON.parse(localStorage.getItem("savedQuizzes")) || [];

        // Add the new question and answers
        quizData.push({ question: questionInput, answers: answers });

        // Save back to localStorage
        localStorage.setItem("savedQuizzes", JSON.stringify(quizData));

        console.log("Quiz Saved:", quizData);

        // Redirect to quiz_display.php
        window.location.href = "quiz_display.php";
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const questionInput = document.getElementById("questionInput");

    document.querySelectorAll(".quiz-formatting button").forEach(button => {
        button.addEventListener("click", function () {
            let format = this.innerText.trim(); // Get the button text

            if (format === "A" || format === "B") {
                questionInput.style.fontWeight = 
                    questionInput.style.fontWeight === "bold" ? "normal" : "bold";
            } else if (format === "I") {
                questionInput.style.fontStyle = 
                    questionInput.style.fontStyle === "italic" ? "normal" : "italic";
            } else if (format === "U") {
                questionInput.style.textDecoration = 
                    questionInput.style.textDecoration === "underline" ? "none" : "underline";
            } else if (format === "𝑆̶") { // Strikethrough
                questionInput.style.textDecoration = 
                    questionInput.style.textDecoration === "line-through" ? "none" : "line-through";
            } else if (format === "x¹") { // Superscript
                insertTextAtCursor(questionInput, "<sup>superscript</sup>");
            } else if (format === "x₁") { // Subscript
                insertTextAtCursor(questionInput, "<sub>subscript</sub>");
            } else if (format === "∑") { // Summation symbol
                insertTextAtCursor(questionInput, "∑");
            } else if (format.includes("𝑓(𝑥)")) { // Insert Equation Placeholder
                insertTextAtCursor(questionInput, "[Equation]");
            }
        });
    });

    function insertTextAtCursor(input, text) {
        if (document.selection) {
            input.focus();
            let sel = document.selection.createRange();
            sel.text = text;
        } else if (input.selectionStart || input.selectionStart === 0) {
            let startPos = input.selectionStart;
            let endPos = input.selectionEnd;
            input.value = input.value.substring(0, startPos) + text + input.value.substring(endPos, input.value.length);
            input.selectionStart = input.selectionEnd = startPos + text.length;
        } else {
            input.value += text;
        }
    }
});



    </script>
</body>
</html>