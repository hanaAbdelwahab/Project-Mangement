
    document.addEventListener("DOMContentLoaded", function () {
        // DOM Elements - Main UI
        const quizTitle = document.getElementById("quizTitle");
        const backButton = document.getElementById("back");
        const questionContainer = document.querySelector(".Questions-container");
        const addQuestionButton = document.querySelector(".addQ");
        const publishBtn = document.getElementById("publishbtn");
        const publishModal = document.getElementById("publishModal");
        const publishClose = document.querySelector(".publish-close");
        const codeBox = document.getElementById("codeBox");
        const goToDashboardBtn = document.getElementById("goToDashboardBtn");
        
        // Modals
        const modals = {
            welcome: document.getElementById("welcomeModal"),
            second: document.getElementById("secondModal"),
            drop: document.getElementById("DropModal")
        };
        const closes = {
            welcome: modals.welcome.querySelector(".close"),
            second: modals.second.querySelector(".second-close"),
            drop: modals.drop.querySelector(".Drop-close")
        };
        // Buttons
        const buttons = {
            multipleChoice: document.getElementById("multipleChoiceBtn"),
            drop: document.getElementById("DropBtn"),
            addAnswer: document.getElementById("addAnswerBtn"),
            addCorrect: document.getElementById("correct"),
            addIncorrect: document.getElementById("incorrect"),
            saveQuiz: document.getElementById("saveQuiz"),
            saveDropQuiz: document.querySelector(".save-btn-D"),
            insertBlank: document.getElementById("insertBlankBtn")
        };
        // Containers
        const answerContainer = document.querySelector(".answer-options");
        const answerOptionsdD = document.querySelector(".answer-optionsdD");
        const questionInputField = document.querySelector("#secondModal #questionInput") || document.querySelector(".question-input");
        const dropQuestionInput = document.getElementById("dropQuestionInput");
        // Error messages
        let errorMessage = document.getElementById("errorMessage");
        if (!errorMessage) {
            errorMessage = document.createElement("p");
            errorMessage.id = "errorMessage";
            errorMessage.style.color = "red";
            errorMessage.style.display = "none";
            if (document.querySelector(".button-container")) {
                document.querySelector(".button-container").appendChild(errorMessage);
            }
        }
        // Global variables
        window.singleAnswerMode = true;
        // Initial Setup
// Initial Setup
questionContainer.style.display = "none";

// Only show welcome modal if no other modal is visible
const isAnyModalOpen = Object.values(modals).some(modal => modal && modal.style.display === "flex");
const errorModals = [
    document.getElementById("errorModal"),
    document.getElementById("dropErrorModal"),
    document.getElementById("openEndedModal")
];
const isErrorModalOpen = errorModals.some(modal => modal && modal.style.display === "flex");

if (!isAnyModalOpen && !isErrorModalOpen) {
    modals.welcome.style.display = "flex";
}

    if (publishBtn) {
        publishBtn.addEventListener("click", () => {
            const code = Math.floor(10000000 + Math.random() * 90000000).toString();
            const codeTextSpan = document.querySelector("#codeBox .code-text");

            if (publishModal && codeBox && codeTextSpan) {
                codeTextSpan.textContent = code;
                codeBox.dataset.code = code;
                publishModal.style.display = "flex";
            }
        });
    }


    if (publishClose) {
        publishClose.addEventListener("click", () => {
            publishModal.style.display = "none";
        });
    }

    if (codeBox) {
        codeBox.addEventListener("click", () => {
            const codeTextSpan = codeBox.querySelector(".code-text");
            const code = codeTextSpan.textContent;

            navigator.clipboard.writeText(code).then(() => {
                codeBox.style.backgroundColor = "#d4edda";
                codeBox.style.color = "green";
                codeTextSpan.textContent = "Copied!";
                setTimeout(() => {
                    const originalCode = codeBox.dataset.code || "--------";
                    codeTextSpan.textContent = originalCode;
                    codeBox.style.backgroundColor = "#f4f4f4";
                    codeBox.style.color = "black";
                }, 1500);
            });
        });
    }


    if (goToDashboardBtn) {
        goToDashboardBtn.addEventListener("click", () => {
            window.location.href = "../php/Dashboard.php";
        });
    }
    function renderPreview() {
        const previewContent = document.getElementById("previewContent");
        const questions = document.querySelectorAll(".saved-question");
        
        if (questions.length === 0) {
            previewContent.innerHTML = "<p style='text-align:center;color:gray;'>No questions added yet.</p>";
            return;
        }

        let currentIndex = 0;
        const colorClasses = ["blue", "teal", "yellow", "red"];
        const colorMap = {
            blue: "#2176FF",
            teal: "#00A896",
            yellow: "#F4A261",
            red: "#E63946"
        };

        // Function to render a single question
    function renderQuestion(index) {
        previewContent.innerHTML = ""; // Clear current content

        const question = questions[index];
        const questionBox = document.createElement("div");
        questionBox.style.border = "1px solid #ccc";
        questionBox.style.borderRadius = "10px";
        questionBox.style.padding = "5rem";
        questionBox.style.backgroundColor = "#4A0072";
        questionBox.style.boxShadow = "0 2px 5px rgba(0, 0, 0, 0.05)";
        questionBox.style.minHeight = "300px";
        questionBox.style.display = "flex";
        questionBox.style.flexDirection = "column";
        questionBox.style.alignItems = "center";
        questionBox.style.textAlign = "center";

        // Question Title (centered and on a single line)
        const titleEl = question.querySelector("strong");
        const questionTitle = document.createElement("div");
    if (titleEl) {
        const rawText = titleEl.textContent.split(": ").slice(1).join(": ");
        questionTitle.textContent = rawText.trim();
    } else {
        questionTitle.textContent = `Question ${index + 1}`;
    }

    questionTitle.style.backgroundColor = "#3333338b";
    questionTitle.style.padding = "1rem";
    questionTitle.style.fontSize = "1.5rem";
    questionTitle.style.fontWeight = "700";
    questionTitle.style.color = "white";
    questionTitle.style.width = "100%";
    questionTitle.style.textAlign = "center";
    questionTitle.style.borderRadius = "8px";
    questionTitle.style.marginBottom = "1rem";
        questionBox.appendChild(questionTitle);

        // Answers (in a horizontal row)
    // === Check Question Type ===
const typeEl = Array.from(question.querySelectorAll("div")).find(div =>
    ["Drop Down", "Multiple Choice", "Open Ended"].includes(div.textContent?.trim())
);
const questionType = typeEl ? typeEl.textContent.trim() : "Multiple Choice";



    // === Render Answers ===
    if (questionType === "Drop Down") {
        const dropdown = document.createElement("select");
        dropdown.style.padding = "0.6rem 1rem";
        dropdown.style.fontSize = "1rem";
        dropdown.style.borderRadius = "8px";
        dropdown.style.border = "1px solid #ccc";
        dropdown.style.minWidth = "200px";
        dropdown.style.marginTop = "1rem";

        const answerList = question.querySelectorAll("ul > li");
        answerList.forEach((li, i) => {
            const answerText = li.textContent.replace(/^✓ |^✗ /, "").trim();
            const option = document.createElement("option");
            option.value = answerText;
            option.textContent = answerText;
            dropdown.appendChild(option);
        });

        questionBox.appendChild(dropdown);
    }
     else if (questionType === "Open Ended") {
    const answerInput = document.createElement("textarea");
    answerInput.placeholder = "write your answer...";
    answerInput.style.width = "80%";
    answerInput.style.minHeight = "100px";
    answerInput.style.fontSize = "1rem";
    answerInput.style.padding = "1rem";
    answerInput.style.borderRadius = "8px";
    answerInput.style.border = "1px solid #ccc";
    answerInput.style.marginTop = "1rem";
    answerInput.style.resize = "vertical";
    questionBox.appendChild(answerInput);
}  else {
        // Default rendering as row of answer divs
        const answerListWrapper = document.createElement("div");
        answerListWrapper.style.display = "flex";
        answerListWrapper.style.flexWrap = "wrap";
        answerListWrapper.style.justifyContent = "center";
        answerListWrapper.style.gap = "1rem";

        const answerList = question.querySelectorAll("ul > li");
        answerList.forEach((li, i) => {
            const answerText = li.textContent.replace(/^✓\s+|^✗\s+/, "").trim();
            const answerDiv = document.createElement("div");
            answerDiv.className = "answer";

            const colorClasses = ["blue", "teal", "yellow", "red"];
            const colorMap = {
                blue: "#2176FF",
                teal: "#00A896",
                yellow: "#F4A261",
                red: "#E63946"
            };
            const colorClass = colorClasses[i % colorClasses.length];
            const bgColor = colorMap[colorClass];

            answerDiv.textContent = answerText;
            answerDiv.style.padding = "0.6rem 1rem";
            answerDiv.style.borderRadius = "8px";
            answerDiv.style.fontSize = "0.95rem";
            answerDiv.style.backgroundColor = bgColor;
            answerDiv.style.color = "white";
            answerDiv.style.fontWeight = "500";
            answerDiv.style.width = "fit-content";
            answerDiv.style.minWidth = "200px";
            answerDiv.style.textAlign = "center";

            answerListWrapper.appendChild(answerDiv);
        });

        questionBox.appendChild(answerListWrapper);
    }

        previewContent.appendChild(questionBox);
        renderNavigationButtons(index, questions.length);
    }



        // Add Next/Back buttons
        function renderNavigationButtons(current, total) {
            const navWrapper = document.createElement("div");
            navWrapper.style.display = "flex";
            navWrapper.style.justifyContent = "space-between";
            navWrapper.style.marginTop = "1.5rem";

            const backBtn = document.createElement("button");
            backBtn.innerHTML = "← Back";
            backBtn.disabled = current === 0;
            backBtn.style.padding = "0.5rem 1.2rem";
            backBtn.style.borderRadius = "10px";
            backBtn.style.border = "none";
            backBtn.style.backgroundColor = "#ddd";
            backBtn.style.cursor = current === 0 ? "not-allowed" : "pointer";

            const nextBtn = document.createElement("button");
            nextBtn.innerHTML = "Next →";
            nextBtn.disabled = current === total - 1;
            nextBtn.style.padding = "0.5rem 1.2rem";
            nextBtn.style.borderRadius = "10px";
            nextBtn.style.border = "none";
            nextBtn.style.backgroundColor = "#6b1f9e";
            nextBtn.style.color = "white";
            nextBtn.style.cursor = current === total - 1 ? "not-allowed" : "pointer";

            // Actions
            backBtn.addEventListener("click", () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    renderQuestion(currentIndex);
                }
            });

            nextBtn.addEventListener("click", () => {
                if (currentIndex < total - 1) {
                    currentIndex++;
                    renderQuestion(currentIndex);
                }
            });

            navWrapper.appendChild(backBtn);
            navWrapper.appendChild(nextBtn);
            previewContent.appendChild(navWrapper);
        }

        // Start with first question
        renderQuestion(currentIndex);
    }
        const previewBtn = document.getElementById("previewBtn");
    const previewModal = document.getElementById("previewModal");
    const previewClose = document.querySelector(".preview-close");

        if (previewBtn && previewModal && previewClose) {
        previewBtn.addEventListener("click", () => {
            renderPreview();
            previewModal.style.display = "flex";
        });

        previewClose.addEventListener("click", () => {
            previewModal.style.display = "none";
        });

        // Optional: Click outside to close
        window.addEventListener("click", (e) => {
            if (e.target === previewModal) {
                previewModal.style.display = "none";
            }
        });
        }
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
        const newTitle = quizTitle.innerText.trim();
        quizTitle.innerText = newTitle || "Untitled Quiz";
        localStorage.setItem("quizTitle", quizTitle.innerText); // ✅ Save to localStorage
    }

        function toggleCorrectAnswer(button) {
            if (window.singleAnswerMode) {
                // Deselect all others before selecting this one
                document.querySelectorAll(".correct-check").forEach(btn => {
                    btn.classList.remove("selected");
                    btn.style.backgroundColor = "";
                    btn.style.color = "";
                });
                // Select this button
                button.classList.add("selected");
                button.style.backgroundColor = "green";
                button.style.color = "white";
            } else {
                // Toggle this button only (allow multiple selections)
                const isSelected = button.classList.toggle("selected");
                if (isSelected) {
                    button.style.backgroundColor = "green";
                    button.style.color = "white";
                } else {
                    button.style.backgroundColor = "";
                    button.style.color = "";
                }
            }
        }
        function insertTextAtCursor(container) {
            const sel = window.getSelection();
            if (!sel.rangeCount) return;
        
            const range = sel.getRangeAt(0);
            range.deleteContents();
        
            const blankBtn = document.createElement("button");
            blankBtn.className = "blank-btn";
            blankBtn.textContent = "Blank";
        
            range.insertNode(blankBtn);
        
            // Move the caret after the inserted node
            range.setStartAfter(blankBtn);
            range.setEndAfter(blankBtn);
            sel.removeAllRanges();
            sel.addRange(range);
        
            container.focus();
        }
        function createAnswerField(isCorrect) {
        const input = document.createElement('input');
        input.type = 'text';
        input.placeholder = isCorrect ? 'Correct answer...' : 'Incorrect answer...';
        input.style.backgroundColor = 'white';
        input.style.border = 'none';
        input.style.padding = '0.5rem';
        input.style.marginTop = '0.5rem';
        input.style.borderRadius = '5px';
        input.style.width = '50%';
        input.style.fontSize = '1rem';
        input.style.outline = 'none';
        input.style.height = "1rem";
        
        const container = document.querySelector('.answer-optionsdD');

        // 🆕 Ensure answer list container exists
        let answerList = container.querySelector('.answer-list');
        if (!answerList) {
            answerList = document.createElement('div');
            answerList.className = 'answer-list';
            answerList.style.marginTop = '1rem';
            answerList.style.display = 'flex';
            answerList.style.flexWrap = 'wrap';
            answerList.style.gap = '0.5rem';
            container.appendChild(answerList);
        }

        // Insert input just after the last button
        const buttons = container.querySelectorAll('button');
        const lastButton = buttons[buttons.length - 1];
        container.insertBefore(input, lastButton.nextSibling);

        input.focus();

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const val = input.value.trim();
                if (val !== '') {
                    const answerDiv = document.createElement('div');
                    answerDiv.className = isCorrect ? 'correct-answer' : 'incorrect-answer';
                    answerDiv.textContent = val;
                    answerDiv.style.color = isCorrect ? 'green' : 'red';
                    answerDiv.style.border = `2px solid ${isCorrect ? 'green' : 'red'}`;
                    answerDiv.style.padding = '0.3rem 0.6rem';
                    answerDiv.style.margin = '0.5rem 0';
                    answerDiv.style.borderRadius = '5px';
                    answerDiv.style.backgroundColor = 'white';
                    answerDiv.style.height = "1rem";
                    answerDiv.style.display = 'inline-block';

                    answerList.appendChild(answerDiv); // ✅ Append here
                    input.remove();
                }
            }
        });

        input.addEventListener('blur', function () {
            if (input.value.trim() === '') {
                input.remove();
            }
        });
        }
        function saveQuestion(question, answers) {
        const count = document.querySelectorAll(".saved-question").length + 1;

        const questionItem = document.createElement("div");
        questionItem.classList.add("saved-question");
        questionItem.style.backgroundColor = "#f2f2f2";
        questionItem.style.border = "1px solid #ccc";
        questionItem.style.padding = "1rem";
        questionItem.style.marginBottom = "1rem";
        questionItem.style.borderRadius = "10px";
        questionItem.style.width = "50rem";
        questionItem.style.margin = "1rem 2rem";

        // === Metadata Container (Type, Mark, Time) ===
        const metaRow = document.createElement("div");
        metaRow.style.display = "flex";
        metaRow.style.justifyContent = "space-between";
        metaRow.style.marginBottom = "0.5rem";

        // Question Type
        // Shared styles for all metadata boxes
    const metaBoxStyle = {
        backgroundColor: "white",
        border: "2px solid gray",
        borderRadius: "2rem",
        padding: "0.3rem 1rem",
        color: "purple",
        fontWeight: "bold",
        fontSize: "0.9rem"
    };

    // Question Type
    const typeDiv = document.createElement("div");
    typeDiv.textContent = "Multiple Choice";
    Object.assign(typeDiv.style, metaBoxStyle);

    // Mark Div
    // Mark Dropdown
    const markWrapper = document.createElement("div");
    Object.assign(markWrapper.style, metaBoxStyle);
    const markLabel = document.createElement("span");
    markLabel.textContent = "Mark: ";
    const markSelect = document.createElement("select");
    ["1 point", "2 points", "3 points"].forEach(optText => {
        const option = document.createElement("option");
        option.textContent = optText;
        markSelect.appendChild(option);
    });
    markSelect.style.border = "none";
    markSelect.style.background = "transparent";
    markSelect.style.color = "purple";
    markSelect.style.fontWeight = "bold";
    markSelect.style.marginLeft = "0.5rem";
    markWrapper.appendChild(markLabel);
    markWrapper.appendChild(markSelect);

    // Time Div
    const timeWrapper = document.createElement("div");
    Object.assign(timeWrapper.style, metaBoxStyle);
    const timeLabel = document.createElement("span");
    timeLabel.textContent = "Time: ";
    const timeSelect = document.createElement("select");
    ["30 sec", "1 min", "1.5 min", "2 mins"].forEach(optText => {
        const option = document.createElement("option");
        option.textContent = optText;
        timeSelect.appendChild(option);
    });
    timeSelect.style.border = "none";
    timeSelect.style.background = "transparent";
    timeSelect.style.color = "purple";
    timeSelect.style.fontWeight = "bold";
    timeSelect.style.marginLeft = "0.5rem";
    timeWrapper.appendChild(timeLabel);
    timeWrapper.appendChild(timeSelect);
    // === Delete Icon ===
    const deleteIcon = document.createElement("span");
    deleteIcon.className = "delete-question";
    deleteIcon.title = "Delete this question";
    deleteIcon.innerHTML = '<i class="fas fa-trash-alt"></i>'; // Font Awesome

    // Style it
    deleteIcon.style.cursor = "pointer";
    deleteIcon.style.color = "#d11a2a";
    deleteIcon.style.float = "right";
    deleteIcon.style.fontSize = "1.2rem";

    // Append it to the top-right of the questionItem

    // Delete handler
    deleteIcon.addEventListener("click", () => {
        questionItem.remove();
        updateQuestionCount();
        updateQuestionTitles(); // <- Re-number questions
    });


        metaRow.appendChild(typeDiv);
        metaRow.appendChild(markWrapper);
        metaRow.appendChild(timeWrapper);
        metaRow.style.marginBottom="1rem";
        metaRow.appendChild(deleteIcon);
        questionItem.appendChild(metaRow);

        // === Question Title ===
        const title = document.createElement("strong");
    title.textContent = `Q${count}: ${question}`;
        title.style.color = "black";
        title.style.fontSize = "1.1rem";
        questionItem.appendChild(title);

        // === Answers ===
        const correctIndices = [];
        document.querySelectorAll(".correct-check").forEach((btn, index) => {
            if (btn.classList.contains("selected")) {
                correctIndices.push(index);
            }
        });

        const answerList = document.createElement("ul");
        answerList.style.listStyleType = "none";
        answerList.style.padding = "0";
        answerList.style.display = "flex";
        answerList.style.flexWrap = "wrap";
        answerList.style.gap = "1rem";
        answerList.style.marginTop = "0.5rem";

        answers.forEach((answer, index) => {
            const isCorrect = correctIndices.includes(index);
            const li = document.createElement("li");
            li.textContent = answer;
            li.style.padding = "0.5rem 1rem";
            li.style.borderRadius = "5px";
            li.style.backgroundColor = "white";
            li.style.fontWeight = "200";
            li.style.border = "1px solid";
            li.style.color = isCorrect ? "green" : "red";
            li.style.borderColor = isCorrect ? "green" : "red";

            const icon = document.createElement("span");
            icon.textContent = isCorrect ? "✓ " : "✗ ";
            icon.style.marginRight = "5px";

            li.prepend(icon);
            answerList.appendChild(li);
        });

        questionItem.appendChild(answerList);
        questionContainer.appendChild(questionItem);
        saveQuestionsToLocalStorage();
        questionContainer.style.display = "block";

        // Clear input fields
        if (questionInputField.tagName === "INPUT") {
            questionInputField.value = "";
        } else {
            questionInputField.innerText = "Type your question here...";
        }

        // Reset answers
        answerContainer.innerHTML = '';
        addInitialAnswerFields();

        // Close the modal
        modals.second.style.display = "none";
        document.getElementById("successModal").style.display = "flex";
            // ✅ Hide welcome modal if open
    if (modals.welcome && modals.welcome.style.display === "flex") {
        modals.welcome.style.display = "none";
    }

        updateQuestionCount();
        }
        function addInitialAnswerFields() {
            for (let i = 0; i < 4; i++) {
                const color = ["blue", "teal", "yellow", "red"][i];
                const newAnswer = document.createElement("div");
                newAnswer.classList.add("answer", color);

                const checkButton = document.createElement("button");
                checkButton.classList.add("correct-check");
                checkButton.innerHTML = "✔";
                checkButton.addEventListener("click", function () {
                    toggleCorrectAnswer(checkButton);
                });

                const deleteIcon = document.createElement("span");
                deleteIcon.classList.add("delete");
                deleteIcon.title = "Delete";
                deleteIcon.innerHTML = '<i class="fas fa-trash-alt"></i>';

                const inputField = document.createElement("input");
                inputField.type = "text";
                inputField.classList.add("answer-input");
                inputField.placeholder = "Type answer option here...";

                newAnswer.appendChild(checkButton);
                newAnswer.appendChild(deleteIcon);
                newAnswer.appendChild(inputField);
                answerContainer.appendChild(newAnswer);
            }

            // Add the "+" button for adding more answers
            const addButton = document.createElement("button");
            addButton.id = "addAnswerBtn";
            addButton.classList.add("add-answer");
            addButton.innerText = "+";
            addButton.addEventListener("click", addAnswerField);
            answerContainer.appendChild(addButton);
        }
        function addAnswerField() {
            const currentAnswers = document.querySelectorAll(".answer-input").length;
            if (currentAnswers >= 5) {
                alert("You can only add up to 5 answers.");
                return;
            }

            const colors = ["blue", "teal", "yellow", "red", "green"];
            const newAnswer = document.createElement("div");
            newAnswer.classList.add("answer", colors[currentAnswers % colors.length]);

            const checkButton = document.createElement("button");
            checkButton.classList.add("correct-check");
            checkButton.innerHTML = "✔";
            checkButton.addEventListener("click", function () {
                toggleCorrectAnswer(checkButton);
            });

            const deleteIcon = document.createElement("span");
            deleteIcon.classList.add("delete");
            deleteIcon.title = "Delete";
            deleteIcon.innerHTML = '<i class="fas fa-trash-alt"></i>';

            const inputField = document.createElement("input");
            inputField.type = "text";
            inputField.classList.add("answer-input");
            inputField.placeholder = "Type answer option here...";

            newAnswer.appendChild(checkButton);
            newAnswer.appendChild(deleteIcon);
            newAnswer.appendChild(inputField);
            
            // Insert before the "+" button
            const addButton = document.getElementById("addAnswerBtn");
            answerContainer.insertBefore(newAnswer, addButton);
        }
        function updateQuestionCount() {
            const count = document.querySelectorAll(".saved-question").length;
            const questionCountEl = document.querySelector(".Questions p");
            if (questionCountEl) {
                questionCountEl.innerHTML = `${count} Question${count !== 1 ? 's' : ''}<span> (${count} Point${count !== 1 ? 's' : ''})</span>`;
            }
            console.log(`Total questions: ${count}`);
        }
function saveQuestionsToLocalStorage() {
    const questions = Array.from(document.querySelectorAll(".saved-question")).map(question => {
        const title = question.querySelector("strong")?.textContent || "";

        // Detect question type from dataset or fallback
        const type = question.dataset.type || (() => {
            const typeDiv = question.querySelector("div");
            if (typeDiv && typeDiv.textContent.trim() === "Open Ended") return "Open Ended";
            return "Multiple Choice";
        })();

        // Handle answer extraction based on question type
        let answers = [];
        if (type === "Open Ended") {
            const sampleAnswerEl = question.querySelector("ul li");
            const sampleText = sampleAnswerEl?.textContent?.trim() || "No answer";
            answers = [{ text: sampleText, isCorrect: true }];
        } else {
            answers = Array.from(question.querySelectorAll("ul > li")).map(li => {
                const answerText = li.textContent.replace(/^✓\s*|^✗\s*/, "").trim();
                const isCorrect = li.style.color === "green";
                return { text: answerText, isCorrect };
            });
        }

        const markSelect = question.querySelector("select:nth-of-type(1)");
        const timeSelect = question.querySelector("select:nth-of-type(2)");

        const mark = markSelect?.value || "1 point";
        const time = timeSelect?.value || "30 sec";

        return { title, answers, type, mark, time };
    });

    localStorage.setItem("savedQuestions", JSON.stringify(questions));
}

        function loadQuestionsFromLocalStorage() {
        const data = JSON.parse(localStorage.getItem("savedQuestions") || "[]");

        data.forEach((q, index) => {
            const questionItem = document.createElement("div");
questionItem.classList.add("saved-question");
questionItem.dataset.type = q.type || "Multiple Choice"; // ✅ Add this line
            questionItem.style.backgroundColor = "#f2f2f2";
            questionItem.style.border = "1px solid #ccc";
            questionItem.style.padding = "1rem";
            questionItem.style.marginBottom = "1rem";
            questionItem.style.borderRadius = "10px";
            questionItem.style.width = "50rem";
            questionItem.style.margin = "1rem 2rem";

            // Meta Row
            const metaRow = document.createElement("div");
            metaRow.style.display = "flex";
            metaRow.style.justifyContent = "space-between";
            metaRow.style.marginBottom = "1rem";

            const metaBoxStyle = {
                backgroundColor: "white",
                border: "2px solid gray",
                borderRadius: "2rem",
                padding: "0.3rem 1rem",
                color: "purple",
                fontWeight: "bold",
                fontSize: "0.9rem"
            };

            const typeDiv = document.createElement("div");
            typeDiv.textContent = q.type || "Multiple Choice";
            Object.assign(typeDiv.style, metaBoxStyle);

            const markWrapper = document.createElement("div");
            Object.assign(markWrapper.style, metaBoxStyle);
            const markLabel = document.createElement("span");
    markLabel.textContent = "Mark: ";
    const markSelect = document.createElement("select");
    ["1 point", "2 points", "3 points"].forEach(optText => {
        const option = document.createElement("option");
        option.textContent = optText;
        if (q.mark === optText) option.selected = true;
        markSelect.appendChild(option);
    });
    Object.assign(markSelect.style, {
        border: "none",
        background: "transparent",
        color: "purple",
        fontWeight: "bold",
        marginLeft: "0.5rem"
    });
    markWrapper.appendChild(markLabel);
    markWrapper.appendChild(markSelect);


            const timeWrapper = document.createElement("div");
            Object.assign(timeWrapper.style, metaBoxStyle);
            const timeLabel = document.createElement("span");
    timeLabel.textContent = "Time: ";
    const timeSelect = document.createElement("select");
    ["30 sec", "1 min", "1.5 min", "2 mins"].forEach(optText => {
        const option = document.createElement("option");
        option.textContent = optText;
        if (q.time === optText) option.selected = true;
        timeSelect.appendChild(option);
    });
    Object.assign(timeSelect.style, {
        border: "none",
        background: "transparent",
        color: "purple",
        fontWeight: "bold",
        marginLeft: "0.5rem"
    });
    timeWrapper.appendChild(timeLabel);
    timeWrapper.appendChild(timeSelect);


            const deleteIcon = document.createElement("span");
            deleteIcon.className = "delete-question";
            deleteIcon.title = "Delete this question";
            deleteIcon.innerHTML = '<i class="fas fa-trash-alt"></i>';
            deleteIcon.style.cursor = "pointer";
            deleteIcon.style.color = "#d11a2a";
            deleteIcon.style.float = "right";
            deleteIcon.style.fontSize = "1.2rem";
            deleteIcon.addEventListener("click", () => {
                questionItem.remove();
                updateQuestionCount();
                updateQuestionTitles();
                saveQuestionsToLocalStorage();
            });

            metaRow.appendChild(typeDiv);
            metaRow.appendChild(markWrapper);
            metaRow.appendChild(timeWrapper);
            metaRow.appendChild(deleteIcon);
            questionItem.appendChild(metaRow);

            const title = document.createElement("strong");
            title.textContent = `Q${index + 1}: ${q.title.split(": ").slice(1).join(": ")}`;
            title.style.color = "black";
            title.style.fontSize = "1.1rem";
            questionItem.appendChild(title);

           let answerList;

if (q.type === "Open Ended") {
    answerList = document.createElement("div");
    answerList.style.marginTop = "0.5rem";

    const answerBox = document.createElement("div");
    answerBox.textContent = q.answers[0]?.text || "No sample answer";
    Object.assign(answerBox.style, {
        backgroundColor: "white",
        border: "2px solid gray",
        borderRadius: "2rem",
        padding: "0.3rem 1rem",
        color: "black",
        fontWeight: "normal",
        fontSize: "1rem"
    });

    answerList.appendChild(answerBox);
}  else {
    answerList = document.createElement("ul");
    answerList.style.listStyleType = "none";
    answerList.style.padding = "0";
    answerList.style.display = "flex";
    answerList.style.flexWrap = "wrap";
    answerList.style.gap = "1rem";
    answerList.style.marginTop = "0.5rem";

    q.answers.forEach(answer => {
        const li = document.createElement("li");
        li.textContent = answer.text;
        li.style.padding = "0.5rem 1rem";
        li.style.borderRadius = "5px";
        li.style.backgroundColor = "white";
        li.style.fontWeight = "200";
        li.style.border = "1px solid";
        li.style.color = answer.isCorrect ? "green" : "red";
        li.style.borderColor = answer.isCorrect ? "green" : "red";

        const icon = document.createElement("span");
        icon.textContent = answer.isCorrect ? "✓ " : "✗ ";
        icon.style.marginRight = "5px";

        li.prepend(icon);
        answerList.appendChild(li);
    });
}


            questionItem.appendChild(answerList);
            questionContainer.appendChild(questionItem);
            questionContainer.style.display = "block";
        });

        updateQuestionCount();
        }
function showErrorModal(message) {
    const modal = document.getElementById("errorModal");
    const text = document.getElementById("errorModalText");
    text.textContent = message;

    // ✅ Hide welcome modal if open
    if (modals.welcome && modals.welcome.style.display === "flex") {
        modals.welcome.style.display = "none";
    }

    modal.style.display = "flex";
}


        function validateMultipleChoiceInputs() {
            // Get the question input
            let questionInput;
            if (questionInputField.tagName === "INPUT") {
                questionInput = questionInputField.value.trim();
            } else {
                questionInput = questionInputField.innerText.trim();
            }
            
            // Get all answer inputs
            const answerInputs = Array.from(document.querySelectorAll(".answer-input"));
            const answerValues = answerInputs.map(input => input.value.trim());
            
            // Check if any answer input is empty
            const hasEmptyAnswer = answerInputs.some(input => input.value.trim() === "");
            
            // Check if any correct answer is selected
            const hasSelectedAnswer = document.querySelectorAll(".correct-check.selected").length > 0;
            
            // Get or create the error message element
            if (!errorMessage) {
                errorMessage = document.getElementById("errorMessage");
                if (!errorMessage) {
                    errorMessage = document.createElement("p");
                    errorMessage.id = "errorMessage";
                    errorMessage.style.color = "red";
                    errorMessage.style.display = "none";
                    if (document.querySelector(".button-container")) {
                        document.querySelector(".button-container").appendChild(errorMessage);
                    }
                }
            }
            
            // Create or get the fill warning message
            let fillWarning = document.getElementById("fillWarning");
            if (!fillWarning) {
                fillWarning = document.createElement("div");
                fillWarning.id = "fillWarning";
                fillWarning.style.color = "red";
                fillWarning.style.marginTop = "5px";
                if (answerContainer.parentNode) {
                    answerContainer.parentNode.insertBefore(fillWarning, answerContainer.nextSibling);
                }
            }
            
            // Validate inputs
        if (!questionInput || questionInput === "Type your question here...") {
        showErrorModal("Please enter a question.");
        return false;
    } else if (answerValues.length < 2) {
        showErrorModal("Please provide at least 2 answer options.");
        return false;
    } else if (hasEmptyAnswer) {
        showErrorModal("Please fill in all the answer fields.");
        return false;
    } else if (!hasSelectedAnswer) {
        showErrorModal("Please mark at least one answer as correct.");
        return false;
    }
    else {
                errorMessage.style.display = "none";
                fillWarning.textContent = "";  // clear warning
                return true;
            }
        }
    function validateDropQuizInputs() {
        const dropQuestion = dropQuestionInput.innerHTML;
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = dropQuestion;
        tempDiv.querySelectorAll('.blank-btn').forEach(btn => btn.remove());
        const cleanedQuestion = tempDiv.innerHTML.trim();

        const correctAnswers = Array.from(document.querySelectorAll(".correct-answer")).map(el => el.textContent);
        const incorrectAnswers = Array.from(document.querySelectorAll(".incorrect-answer")).map(el => el.textContent);

        const modal = document.getElementById("dropErrorModal");
        const messageText = document.getElementById("dropErrorMessageText");

        function showModal(message) {
            messageText.textContent = message;
            modal.style.display = "flex";
        }

        if (!cleanedQuestion || cleanedQuestion === "Type your question here...") {
            showModal("Please enter a question.");
            return false;
        }

        if (correctAnswers.length === 0 && incorrectAnswers.length === 0) {
            showModal("Please add at least one correct and one incorrect answer.");
            return false;
        }

        if (correctAnswers.length === 0) {
            showModal("Please add at least one correct answer.");
            return false;
        }

        if (incorrectAnswers.length === 0) {
            showModal("Please add at least one incorrect answer.");
            return false;
        }

        return true;
    }



        function saveDropQuestion() {
        if (!validateDropQuizInputs()) return;

        const dropQuestion = dropQuestionInput.innerHTML;
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = dropQuestion;
        tempDiv.querySelectorAll('.blank-btn').forEach(btn => btn.remove());
        const cleanedQuestion = tempDiv.innerHTML;

        const correctAnswers = Array.from(document.querySelectorAll(".correct-answer")).map(el => el.textContent);
        const incorrectAnswers = Array.from(document.querySelectorAll(".incorrect-answer")).map(el => el.textContent);

        const count = document.querySelectorAll(".saved-question").length + 1;

        const questionItem = document.createElement("div");
        questionItem.classList.add("saved-question");
    questionItem.dataset.type = "Drop Down";
        questionItem.style.backgroundColor = "#f2f2f2";
        questionItem.style.border = "1px solid #ccc";
        questionItem.style.padding = "1rem";
        questionItem.style.marginBottom = "1rem";
        questionItem.style.borderRadius = "10px";
        questionItem.style.width = "50rem";
        questionItem.style.margin = "1rem 2rem";

        const metaRow = document.createElement("div");
        metaRow.style.display = "flex";
        metaRow.style.justifyContent = "space-between";
        metaRow.style.marginBottom = "0.5rem";

        const metaBoxStyle = {
            backgroundColor: "white",
            border: "2px solid gray",
            borderRadius: "2rem",
            padding: "0.3rem 1rem",
            color: "purple",
            fontWeight: "bold",
            fontSize: "0.9rem"
        };

        const typeDiv = document.createElement("div");
        typeDiv.textContent = "Drop Down";
        Object.assign(typeDiv.style, metaBoxStyle);

        const markWrapper = document.createElement("div");
        Object.assign(markWrapper.style, metaBoxStyle);
        const markLabel = document.createElement("span");
        markLabel.textContent = "Mark: ";
        const markSelect = document.createElement("select");
        ["1 point", "2 points", "3 points"].forEach(optText => {
            const option = document.createElement("option");
            option.textContent = optText;
            markSelect.appendChild(option);
        });
        Object.assign(markSelect.style, {
            border: "none",
            background: "transparent",
            color: "purple",
            fontWeight: "bold",
            marginLeft: "0.5rem"
        });
        markWrapper.appendChild(markLabel);
        markWrapper.appendChild(markSelect);

        const timeWrapper = document.createElement("div");
        Object.assign(timeWrapper.style, metaBoxStyle);
        const timeLabel = document.createElement("span");
        timeLabel.textContent = "Time: ";
        const timeSelect = document.createElement("select");
        ["30 sec", "1 min", "1.5 min", "2 mins"].forEach(optText => {
            const option = document.createElement("option");
            option.textContent = optText;
            timeSelect.appendChild(option);
        });
        Object.assign(timeSelect.style, {
            border: "none",
            background: "transparent",
            color: "purple",
            fontWeight: "bold",
            marginLeft: "0.5rem"
        });
        timeWrapper.appendChild(timeLabel);
        timeWrapper.appendChild(timeSelect);

        const deleteIcon = document.createElement("span");
        deleteIcon.className = "delete-question";
        deleteIcon.title = "Delete this question";
        deleteIcon.innerHTML = '<i class="fas fa-trash-alt"></i>'; // Font Awesome
        deleteIcon.style.cursor = "pointer";
        deleteIcon.style.color = "#d11a2a";
        deleteIcon.style.float = "right";
        deleteIcon.style.fontSize = "1.2rem";

        metaRow.appendChild(typeDiv);
        metaRow.appendChild(markWrapper);
        metaRow.appendChild(timeWrapper);
        metaRow.style.marginBottom="1rem";
        metaRow.appendChild(deleteIcon);
        questionItem.appendChild(metaRow);

        deleteIcon.addEventListener("click", () => {
        questionItem.remove();
        updateQuestionCount();
        updateQuestionTitles(); // <- Re-number questions
    });

        const title = document.createElement("strong");
        title.textContent = `Q${count}: ${cleanedQuestion}`;
        title.style.color = "black";
        title.style.fontSize = "1.1rem";
        questionItem.appendChild(title);

        const answerList = document.createElement("ul");
        answerList.style.listStyleType = "none";
        answerList.style.padding = "0";
        answerList.style.display = "flex";
        answerList.style.flexWrap = "wrap";
        answerList.style.gap = "1rem";
        answerList.style.marginTop = "0.5rem";

        [...correctAnswers, ...incorrectAnswers].forEach((answer, index) => {
        const isCorrect = index < correctAnswers.length;

        const li = document.createElement("li");
        li.textContent = answer;
        li.style.padding = "0.5rem 1rem";
        li.style.borderRadius = "5px";
        li.style.backgroundColor = "white";
        li.style.fontWeight = "200";
        li.style.border = "1px solid";
        li.style.color = isCorrect ? "green" : "red";
        li.style.borderColor = isCorrect ? "green" : "red";

        const icon = document.createElement("span");
        icon.textContent = isCorrect ? "✓ " : "✗ ";
        icon.style.marginRight = "5px";

        li.prepend(icon);
        answerList.appendChild(li);
    });


        questionItem.appendChild(answerList);
        questionContainer.appendChild(questionItem);
        saveQuestionsToLocalStorage();
        questionContainer.style.display = "block";

        // Reset and close modal
        dropQuestionInput.innerHTML = "Type your question here...";
        answerOptionsdD.querySelectorAll(".correct-answer, .incorrect-answer").forEach(el => el.remove());
        modals.drop.style.display = "none";

        updateQuestionCount();
        document.getElementById("successModal").style.display = "flex";
            // ✅ Hide welcome modal if open
    if (modals.welcome && modals.welcome.style.display === "flex") {
        modals.welcome.style.display = "none";
    }

        }
        function insertEquation() {
            let inputField = document.querySelector(":focus");
            if (inputField) {
                document.execCommand("insertText", false, "f(x) = ");
            }
        }
        function updateQuestionTitles() {
        const savedQuestions = document.querySelectorAll(".saved-question");
        savedQuestions.forEach((qEl, index) => {
            const titleEl = qEl.querySelector("strong");
            if (titleEl) {
                // Extract actual question text without previous Q#
                const parts = titleEl.textContent.split(": ");
                const rawQuestion = parts.slice(1).join(": ");
                titleEl.textContent = `Q${index + 1}: ${rawQuestion}`;
            }
        });
        }
        // Formatting toolbar for text input
        function setupFormattingToolbar() {
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
        }
        // Event Listeners
        function setupEventListeners() {
            document.getElementById("saveOpenEnded").addEventListener("click", validateAndSaveOpenEndedQuestion);

            // Title editing
            quizTitle.addEventListener("blur", saveTitle);
            quizTitle.addEventListener("keypress", e => {
                if (e.key === "Enter") {
                    e.preventDefault();
                    quizTitle.blur();
                }
            });
            // Navigation
            backButton.addEventListener("click", () => window.location.href = "../php/Dashboard.php");
            addQuestionButton.addEventListener("click", () => modals.welcome.style.display = "flex");
            // Modal closes
            Object.entries(closes).forEach(([key, btn]) => {
                if (btn) {
                    btn.addEventListener("click", () => modals[key].style.display = "none");
                }
            });
            // Window click to close modals
            window.addEventListener("click", e => {
                Object.values(modals).forEach(modal => {
                    if (e.target === modal) modal.style.display = "none";
                });
            });

            // Modal type selection
            if (buttons.multipleChoice) {
                buttons.multipleChoice.addEventListener("click", () => {
                    modals.welcome.style.display = "none";
                    modals.second.style.display = "flex";
                    // Reset initial answer fields when opening multiple choice modal
                    answerContainer.innerHTML = '';
                    addInitialAnswerFields();
                });
            }

            if (buttons.drop) {
        buttons.drop.addEventListener("click", () => {
            modals.welcome.style.display = "none";
            modals.drop.style.display = "flex";
            dropQuestionInput.innerHTML = 'Type your question here...';

            // Remove old instance if exists
            const oldContainer = document.querySelector(".answer-optionsdD");
            if (oldContainer) oldContainer.remove();

            // Create container
            // Inside buttons.drop event listener → create two sections
    const answerOptionsdD = document.createElement("div");
    answerOptionsdD.className = "answer-optionsdD";
    answerOptionsdD.style.display = "flex";
    answerOptionsdD.style.flexDirection = "column";

    // 🆕 Button group
    const buttonGroup = document.createElement("div");
    buttonGroup.className = "button-group";
    buttonGroup.style.display = "flex";
    buttonGroup.style.gap = "1rem";

    // Add buttons
    const correctBtn = document.createElement("button");
    correctBtn.id = "correct";
    correctBtn.className = "correct";
    correctBtn.innerHTML = '<i class="fa-solid fa-plus"></i> Add Correct Answer';

    const incorrectBtn = document.createElement("button");
    incorrectBtn.id = "incorrect";
    incorrectBtn.className = "correct";
    incorrectBtn.innerHTML = '<i class="fa-solid fa-plus"></i> Add Incorrect Answer';

    buttonGroup.appendChild(correctBtn);
    buttonGroup.appendChild(incorrectBtn);

    // Add both to main container
    answerOptionsdD.appendChild(buttonGroup);

    // 🆕 Empty answer list (to ensure it's always present)
    const answerList = document.createElement("div");
    answerList.className = "answer-list";
    answerList.style.marginTop = "1rem";
    answerList.style.display = "flex";
    answerList.style.flexWrap = "wrap";
    answerList.style.gap = "0.5rem";

    answerOptionsdD.appendChild(answerList);

    // Insert into DOM
    const dropModalEditor = modals.drop.querySelector("#quizEditor");
    dropModalEditor.appendChild(answerOptionsdD);


            // Re-attach the event listeners to the dynamically added buttons
        correctBtn.addEventListener("click", () => {
        const blankBtn = dropQuestionInput.querySelector(".blank-btn");

        // 1. Insert ____ beside the blank button
        if (blankBtn) {
            const blankText = document.createTextNode(" ____ ");
            dropQuestionInput.insertBefore(blankText, blankBtn.nextSibling);

            // Move the cursor to the end of the drop input
            const range = document.createRange();
            const selection = window.getSelection();
            range.selectNodeContents(dropQuestionInput);
            range.collapse(false);
            selection.removeAllRanges();
            selection.addRange(range);
        }

        // 2. Create the correct answer input field below
        createAnswerField(true);
    });

            incorrectBtn.addEventListener("click", () => createAnswerField(false));
        });
    }


            // Dropdown question blank button
            if (buttons.insertBlank) {
                buttons.insertBlank.addEventListener('click', () => {
                    insertTextAtCursor(dropQuestionInput);
                });
            }

            // Save buttons
            if (buttons.saveQuiz) {
                buttons.saveQuiz.addEventListener("click", function () {
                    if (validateMultipleChoiceInputs()) {
                        // Get question input
                        let questionInput;
                        if (questionInputField.tagName === "INPUT") {
                            questionInput = questionInputField.value.trim();
                        } else {
                            questionInput = questionInputField.innerText.trim();
                        }
                        
                        // Get answer inputs
                        const answerInputs = Array.from(document.querySelectorAll(".answer-input"));
                        const answerValues = answerInputs.map(input => input.value.trim());
                        
                        // Save the question
                        saveQuestion(questionInput, answerValues);
                    }
                });
            }

            // Save drop quiz button
            if (buttons.saveDropQuiz) {
                buttons.saveDropQuiz.addEventListener("click", saveDropQuestion);
            }

            // Answer mode toggle
            const singleAnswerBtn = document.querySelector(".single-answer");
            const multipleAnswersBtn = document.querySelector(".multiple-answers");
            
            if (singleAnswerBtn && multipleAnswersBtn) {
                // By default, set single-answer as selected
                singleAnswerBtn.classList.add('selected');
                
                singleAnswerBtn.addEventListener("click", () => {
                    window.singleAnswerMode = true;
                    // Toggle selected class
                    singleAnswerBtn.classList.add('selected');
                    multipleAnswersBtn.classList.remove('selected');
                    
                    // Clear all selections when switching modes
                    document.querySelectorAll(".correct-check").forEach(btn => {
                        btn.classList.remove("selected");
                        btn.style.backgroundColor = "";
                        btn.style.color = "";
                    });
                });
                
                multipleAnswersBtn.addEventListener("click", () => {
                    window.singleAnswerMode = false;
                    // Toggle selected class
                    singleAnswerBtn.classList.remove('selected');
                    multipleAnswersBtn.classList.add('selected');
                    
                    // Clear all selections when switching modes
                    document.querySelectorAll(".correct-check").forEach(btn => {
                        btn.classList.remove("selected");
                        btn.style.backgroundColor = "";
                        btn.style.color = "";
                    });
                });
            }

            // Event delegation for dynamically added buttons
            answerContainer.addEventListener("click", (e) => {
                if (e.target.classList.contains("correct-check")) {
                    toggleCorrectAnswer(e.target);
                }
                if (e.target.closest(".delete")) {
                    const answerDiv = e.target.closest(".answer");
                    if (answerDiv) {
                        answerDiv.remove();
                    }
                }
            });

            // Dropdown question specific event listeners
            if (buttons.addCorrect) {
                buttons.addCorrect.addEventListener('click', () => createAnswerField(true));
            }
            
            if (buttons.addIncorrect) {
                buttons.addIncorrect.addEventListener('click', () => createAnswerField(false));
            }

            // Dropdown question input event listeners
            if (dropQuestionInput) {
                dropQuestionInput.addEventListener('input', () => {
                    updateBlankButton(dropQuestionInput);
                });
                
                dropQuestionInput.addEventListener('focus', function() {
                    if (this.textContent.trim() === 'Type your question here...') {
                        this.textContent = '';
                    }
                    updateBlankButton(this);
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

            // Question input field event listeners
            if (questionInputField) {
                questionInputField.addEventListener("focus", function () {
                    if (this.innerText.trim() === "Type your question here...") {
                        this.innerText = "";
                    }
                });

                questionInputField.addEventListener("blur", function () {
                    if (this.innerText.trim() === "") {
                        this.innerText = "Type your question here...";
                    }
                });
            }
        }
        function updateBlankButton(container) {
            const existingButton = container.querySelector('.blank-btn');
            if (existingButton) existingButton.remove();
            
            const actualTextContent = getActualTextContent(container);
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
                    container.appendChild(blankText);
                    
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
                    setTimeout(() => updateBlankButton(container), 0);
                });
                
                container.appendChild(blankBtn);
            }
        }
        // Initialize the quiz creator
        function initQuizCreator() {
        // Add initial answer fields
        addInitialAnswerFields();

        // Restore quiz title
        const savedTitle = localStorage.getItem("quizTitle");
        if (savedTitle) {
            quizTitle.innerText = savedTitle;
        }

        // Setup event listeners
        setupEventListeners();

        // Setup formatting toolbar
        setupFormattingToolbar();

        // Load saved questions
        loadQuestionsFromLocalStorage();
    }
    function validateAndSaveOpenEndedQuestion() {
    const questionTextEl = document.querySelector("#openEndedModal #questionInput");
    const sampleAnswerEl = document.getElementById("sampleAnswer");

    const questionText = questionTextEl?.innerText.trim();
    const sampleAnswer = sampleAnswerEl?.value.trim();

    if (!questionText || questionText === "Type your question here") {
        showErrorModal("Please enter the open-ended question.");
        return;
    }

    if (!sampleAnswer) {
        showErrorModal("Please provide a sample answer.");
        return;
    }

    const count = document.querySelectorAll(".saved-question").length + 1;

    const questionItem = document.createElement("div");
    questionItem.dataset.type = "Open Ended";
    questionItem.classList.add("saved-question");
    questionItem.style.backgroundColor = "#f2f2f2";
    questionItem.style.border = "1px solid #ccc";
    questionItem.style.padding = "1rem";
    questionItem.style.margin = "1rem 2rem";
    questionItem.style.borderRadius = "10px";
    questionItem.style.width = "50rem";

    // === Metadata Row ===
    const metaRow = document.createElement("div");
    metaRow.style.display = "flex";
    metaRow.style.justifyContent = "space-between";
    metaRow.style.marginBottom = "1rem";

    const metaBoxStyle = {
        backgroundColor: "white",
        border: "2px solid gray",
        borderRadius: "2rem",
        padding: "0.3rem 1rem",
        color: "purple",
        fontWeight: "bold",
        fontSize: "0.9rem"
    };

    const typeDiv = document.createElement("div");
    typeDiv.textContent = "Open Ended";
    Object.assign(typeDiv.style, metaBoxStyle);

    const markWrapper = document.createElement("div");
    Object.assign(markWrapper.style, metaBoxStyle);
    const markLabel = document.createElement("span");
    markLabel.textContent = "Mark: ";
    const markSelect = document.createElement("select");
    ["1 point", "2 points", "3 points"].forEach(optText => {
        const option = document.createElement("option");
        option.textContent = optText;
        markSelect.appendChild(option);
    });
    markSelect.style.border = "none";
    markSelect.style.background = "transparent";
    markSelect.style.color = "purple";
    markSelect.style.fontWeight = "bold";
    markSelect.style.marginLeft = "0.5rem";
    markWrapper.appendChild(markLabel);
    markWrapper.appendChild(markSelect);

    const timeWrapper = document.createElement("div");
    Object.assign(timeWrapper.style, metaBoxStyle);
    const timeLabel = document.createElement("span");
    timeLabel.textContent = "Time: ";
    const timeSelect = document.createElement("select");
    ["30 sec", "1 min", "1.5 min", "2 mins"].forEach(optText => {
        const option = document.createElement("option");
        option.textContent = optText;
        timeSelect.appendChild(option);
    });
    timeSelect.style.border = "none";
    timeSelect.style.background = "transparent";
    timeSelect.style.color = "purple";
    timeSelect.style.fontWeight = "bold";
    timeSelect.style.marginLeft = "0.5rem";
    timeWrapper.appendChild(timeLabel);
    timeWrapper.appendChild(timeSelect);

    const deleteIcon = document.createElement("span");
    deleteIcon.className = "delete-question";
    deleteIcon.title = "Delete this question";
    deleteIcon.innerHTML = '<i class="fas fa-trash-alt"></i>';
    deleteIcon.style.cursor = "pointer";
    deleteIcon.style.color = "#d11a2a";
    deleteIcon.style.float = "right";
    deleteIcon.style.fontSize = "1.2rem";
    deleteIcon.addEventListener("click", () => {
        questionItem.remove();
        updateQuestionCount();
        updateQuestionTitles();
        saveQuestionsToLocalStorage();
    });

    metaRow.appendChild(typeDiv);
    metaRow.appendChild(markWrapper);
    metaRow.appendChild(timeWrapper);
    metaRow.appendChild(deleteIcon);
    questionItem.appendChild(metaRow);

    const title = document.createElement("strong");
    title.textContent = `Q${count}: ${questionText}`;
    title.style.color = "black";
    title.style.fontSize = "1.1rem";
    questionItem.appendChild(title);

    const answerList = document.createElement("ul");
    answerList.style.listStyleType = "none";
    answerList.style.padding = "0";
    answerList.style.marginTop = "0.5rem";

    const li = document.createElement("li");
    li.textContent = sampleAnswer;
    li.style.padding = "0.5rem 1rem";
    li.style.borderRadius = "5px";
    li.style.backgroundColor = "white";
    li.style.border = "1px solid gray";
    li.style.color = "black";

    answerList.appendChild(li);
    questionItem.appendChild(answerList);

    const container = document.querySelector(".Questions-container");
    container.appendChild(questionItem);
    container.style.display = "block";

    updateQuestionCount();
    saveQuestionsToLocalStorage();

    document.getElementById("openEndedModal").style.display = "none";
    document.getElementById("successModal").style.display = "flex";
        // ✅ Hide welcome modal if open
    if (modals.welcome && modals.welcome.style.display === "flex") {
        modals.welcome.style.display = "none";
    }


    // Reset
    questionTextEl.innerText = "Type your question here...";
    sampleAnswerEl.value = "";
}


        // Initialize when DOM is fully loaded
        initQuizCreator();
    });
        const settingsModal = document.getElementById("settingsModal");
const settingsTitleInput = document.getElementById("settingsQuizTitle");
const totalQuestionsDisplay = document.getElementById("totalQuestionsDisplay");
const totalTimeDisplay = document.getElementById("totalTimeDisplay");
const resetQuizBtn = document.getElementById("resetQuizBtn");
const resetConfirmModal = document.getElementById("resetConfirmModal");
const confirmResetBtn = document.getElementById("confirmResetBtn");

document.querySelector("li.active").addEventListener("click", () => {
    // Open settings modal
    const totalQuestions = document.querySelectorAll(".saved-question").length;
    const timeInSeconds = totalQuestions * 30;
    const minutes = Math.floor(timeInSeconds / 60);
    const seconds = timeInSeconds % 60;

    settingsTitleInput.value = document.getElementById("quizTitle").innerText.trim();
    totalQuestionsDisplay.textContent = totalQuestions;
    totalTimeDisplay.textContent = `${minutes} min ${seconds} sec`;

    settingsModal.style.display = "flex";
});

settingsTitleInput.addEventListener("input", () => {
    document.getElementById("quizTitle").innerText = settingsTitleInput.value.trim();
    localStorage.setItem("quizTitle", settingsTitleInput.value.trim());
});

resetQuizBtn.addEventListener("click", () => {
    resetConfirmModal.style.display = "flex";
});

confirmResetBtn.addEventListener("click", () => {
    localStorage.removeItem("savedQuestions");
    localStorage.removeItem("quizTitle");
    document.querySelector(".Questions-container").innerHTML = "";
    document.getElementById("quizTitle").innerText = "Untitled Quiz";
    document.getElementById("resetConfirmModal").style.display = "none";
    document.getElementById("settingsModal").style.display = "none";
  document.querySelector(".Questions p").innerHTML = `0 Questions <span>(0 Points)</span>`;
});
document.querySelector(".settings-close").addEventListener("click", () => {
    document.getElementById("settingsModal").style.display = "none";
});
