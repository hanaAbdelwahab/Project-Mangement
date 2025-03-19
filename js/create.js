document.addEventListener("DOMContentLoaded", function () {
    // DOM Elements - Main UI
    let quizTitle = document.getElementById("quizTitle");
    let backButton = document.getElementById("back");
    let questionContainer = document.querySelector(".Questions-container");
    let addQuestionButton = document.querySelector(".addQ");
    
    // DOM Elements - Modals
    let modal = document.getElementById("welcomeModal");
    let closeModal = modal.querySelector(".close");
    let secondModal = document.getElementById("secondModal");
    let secondClose = secondModal.querySelector(".second-close");
    let DropModal = document.getElementById("DropModal");
    let DropClose = DropModal.querySelector(".Drop-close");
    
    // DOM Elements - Buttons
    let multipleChoiceBtn = document.getElementById("multipleChoiceBtn");
    let DropBtn = document.getElementById("DropBtn");
    let addAnswerBtn = document.getElementById("addAnswerBtn");
    let answerContainer = document.querySelector(".answer-options");
    
    // DOM Elements - Question Inputs
    let questionInputDiv = document.querySelector("#secondModal #questionInput"); // Multiple Choice Modal
    let dropQuestionInput = document.getElementById("dropQuestionInput"); // DropModal
    let answerOptionsdD = document.querySelector(".answer-optionsdD");
    let addCorrectBtn = document.getElementById("correct");
    let addIncorrectBtn = document.getElementById("incorrect");
    
    // DOM Elements - Error Messages
    let errorMessage = document.getElementById("errorMessage");
    
    // State variables
    let singleAnswerMode = true;
    
    // Initial Setup
    questionContainer.style.display = "none";
    modal.style.display = "flex"; // Show the first modal on load
    
    // Helper Functions
    function getActualTextContent(element) {
        const clone = element.cloneNode(true);
        clone.querySelectorAll('button').forEach(button => button.remove());
        return clone.textContent.trim();
    }
    
    function placeCursorAtEnd(element) {
        const range = document.createRange();
        const selection = window.getSelection();
        range.selectNodeContents(element);
        range.collapse(false);
        selection.removeAllRanges();
        selection.addRange(range);
    }
    
    function saveTitle() {
        let newTitle = quizTitle.innerText.trim();
        quizTitle.innerText = newTitle === "" ? "Untitled Quiz" : newTitle;
    }
    
    function toggleCorrectAnswer(button) {
        if (singleAnswerMode) {
            document.querySelectorAll(".correct-check").forEach(btn => btn.classList.remove("selected"));
        }
        button.classList.toggle("selected");
    }
    
    // Dropdown Question Functions
    function createAnswerField(isCorrect) {
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.placeholder = isCorrect ? 'Type your correct answer here...' : 'Type your incorrect answer here...';
        newInput.className = isCorrect ? 'correct-answer-input' : 'incorrect-answer-input';

        answerOptionsdD.appendChild(newInput);
        newInput.focus();

        newInput.addEventListener('blur', function () {
            if (newInput.value.trim() !== '') {
                const answerDiv = document.createElement('div');
                answerDiv.className = isCorrect ? 'correct-answer' : 'incorrect-answer';
                answerDiv.textContent = newInput.value.trim();
                answerDiv.style.border = isCorrect ? '3px solid green' : '3px solid red';
                answerDiv.style.padding = '0.2rem';
                answerDiv.style.margin = '0.5rem';
                answerDiv.style.borderRadius = '5px';
                answerDiv.style.display = 'inline-block';
                answerDiv.style.backgroundColor = 'white';

                answerOptionsdD.replaceChild(answerDiv, newInput);
            } else {
                newInput.remove();
            }
        });
    }
    
    function updateBlankButton() {
        const existingButton = dropQuestionInput.querySelector('.blank-btn');
        if (existingButton) existingButton.remove();
        
        const actualTextContent = getActualTextContent(dropQuestionInput);
        if (actualTextContent !== '' && actualTextContent !== 'Type your question here...') {
            const blankBtn = document.createElement('button');
            blankBtn.className = 'blank-btn';
            blankBtn.textContent = '+ Blank';
            
            blankBtn.addEventListener('mousedown', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Remove only this button
                this.remove();
                
                // Insert blank underscores at this position
                const blankText = document.createTextNode("____ ");
                dropQuestionInput.appendChild(blankText);
                
                // Place cursor after the blank
                const range = document.createRange();
                const selection = window.getSelection();
                range.setStartAfter(blankText);
                range.collapse(true);
                selection.removeAllRanges();
                selection.addRange(range);
                
                // Create a new answer field
                createAnswerField(true);
                
                // Since content has changed, update to potentially add a new blank button
                setTimeout(updateBlankButton, 0);
            });
            
            dropQuestionInput.appendChild(blankBtn);
        }
    }
    
    function saveQuestion(question, answers) {
        let questionItem = document.createElement("div");
        questionItem.classList.add("saved-question");
        questionItem.innerHTML = `<strong>${question}</strong><ul>${answers.map(ans => `<li>${ans}</li>`).join("")}</ul>`;
        
        questionContainer.appendChild(questionItem);
        questionContainer.style.display = "block";
        
        questionInputDiv.innerText = "Type your question here...";
        document.querySelectorAll(".answer-input").forEach(input => input.value = "");
        
        secondModal.style.display = "none";
        alert("Question saved successfully!");
    }
    
    function insertEquation() {
        let inputField = document.querySelector(":focus");
        if (inputField) {
            document.execCommand("insertText", false, "f(x) = ");
        }
    }
    
    // Event Listeners - Modal Controls
    addQuestionButton.addEventListener("click", function () {
        modal.style.display = "flex";
    });
    
    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });
    
    secondClose.addEventListener("click", function () {
        secondModal.style.display = "none";
    });
    
    DropClose.addEventListener("click", function () {
        DropModal.style.display = "none";
    });
    
    // Event Listeners - Window Click (Close Modals)
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
        if (event.target === secondModal) {
            secondModal.style.display = "none";
        }
        if (event.target === DropModal) {
            DropModal.style.display = "none";
        }
    });
    
    // Event Listeners - Modal Type Selection
    multipleChoiceBtn.addEventListener("click", function () {
        modal.style.display = "none";
        secondModal.style.display = "flex";
    });
    
    DropBtn.addEventListener("click", function () {
        modal.style.display = "none";
        DropModal.style.display = "flex";
    });
    
    // Event Listeners - Navigation
    backButton.addEventListener("click", function () {
        window.location.href = "../html/Dashboard.html";
    });
    
    // Event Listeners - Title Editing
    quizTitle.addEventListener("blur", saveTitle);
    quizTitle.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            quizTitle.blur();
        }
    });
    
    // Event Listeners - Multiple Choice Question
    addAnswerBtn.addEventListener("click", function () {
        let newAnswer = document.createElement("div");
        newAnswer.classList.add("answer", "blue");

        let checkButton = document.createElement("button");
        checkButton.classList.add("correct-check");
        checkButton.innerHTML = "✔";
        checkButton.addEventListener("click", function () {
            toggleCorrectAnswer(checkButton);
        });

        let inputField = document.createElement("input");
        inputField.type = "text";
        inputField.classList.add("answer-input");
        inputField.placeholder = "Type answer option here...";

        let deleteIcon = document.createElement("span");
        deleteIcon.classList.add("delete");
        deleteIcon.innerHTML = '<i class="fas fa-trash-alt"></i>';
        deleteIcon.addEventListener("click", function () {
            newAnswer.remove();
        });

        newAnswer.appendChild(checkButton);
        newAnswer.appendChild(inputField);
        newAnswer.appendChild(deleteIcon);
        answerContainer.appendChild(newAnswer);
    });
    
    document.querySelector(".single-answer").addEventListener("click", function () {
        singleAnswerMode = true;
        document.querySelectorAll(".correct-check").forEach(btn => btn.classList.remove("selected"));
    });
    
    document.querySelector(".multiple-answers").addEventListener("click", function () {
        singleAnswerMode = false;
    });
    
    document.body.addEventListener("click", function (event) {
        if (event.target.closest(".delete")) {
            event.target.closest(".answer").remove();
        }
    });
    
    // Event Listeners - Save Multiple Choice Question
    document.getElementById("saveQuiz").addEventListener("click", function () {
        let questionInput = questionInputDiv.innerText.trim();
        let answerInputs = document.querySelectorAll(".answer-input");
        
        let answers = [];
        answerInputs.forEach(input => {
            let answerText = input.value.trim();
            if (answerText !== "") {
                answers.push(answerText);
            }
        });
        
        if (questionInput === "Type your question here..." || !questionInput || answers.length === 0) {
            errorMessage.style.display = "block";
        } else {
            errorMessage.style.display = "none";
            saveQuestion(questionInput, answers);
        }
    });
    
    // Event Listeners - Dropdown Question
    addCorrectBtn.addEventListener('click', function () {
        createAnswerField(true);
    });

    addIncorrectBtn.addEventListener('click', function () {
        createAnswerField(false);
    });
    
    // Event Listeners - Drop Question Input
    if (dropQuestionInput) {
        dropQuestionInput.addEventListener('input', updateBlankButton);
        
        dropQuestionInput.addEventListener('focus', function() {
            if (this.textContent.trim() === 'Type your question here...') {
                this.textContent = '';
            }
            updateBlankButton();
        });
        
        dropQuestionInput.addEventListener('blur', function() {
            if (getActualTextContent(this) === '') {
                const blankBtn = this.querySelector('.blank-btn');
                if (blankBtn) {
                    blankBtn.remove();
                }
                this.textContent = 'Type your question here...';
            }
        });
        
        dropQuestionInput.addEventListener('click', function(e) {
            if (e.target === this) {
                placeCursorAtEnd(this);
            }
        });
    }
    
    // Event Listeners - Multiple Choice Question Input
    if (questionInputDiv) {
        questionInputDiv.addEventListener("focus", function () {
            if (this.innerText.trim() === "Type your question here...") {
                this.innerText = "";
            }
        });

        questionInputDiv.addEventListener("blur", function () {
            if (this.innerText.trim() === "") {
                this.innerText = "Type your question here...";
            }
        });
    }
    
    // Event Listeners - Formatting Toolbar
    document.querySelectorAll(".quiz-formatting button").forEach(button => {
        button.addEventListener("click", function () {
            let command = this.innerText.trim();
            let inputField = document.activeElement;
            
            if (!inputField || !inputField.isContentEditable) return;
            
            if (command === "A" || command === "B") {
                document.execCommand("bold", false, null);
            } else if (command === "I") {
                document.execCommand("italic", false, null);
            } else if (command === "U") {
                document.execCommand("underline", false, null);
            } else if (command === "𝑆̶") {
                document.execCommand("strikeThrough", false, null);
            } else if (command === "x¹") {
                document.execCommand("superscript", false, null);
            } else if (command === "x₁") {
                document.execCommand("subscript", false, null);
            } else if (command === "∑") {
                document.execCommand("insertText", false, "∑");
            } else if (command.includes("Insert Equation")) {
                insertEquation();
            }
        });
    });
});