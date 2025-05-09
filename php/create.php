<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz UI</title>
    <link rel="stylesheet" href="../css/create.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <i class="fa-solid fa-circle-arrow-left" id="back"></i>
            <h2>QuizzyVerse</h2>
            <ul>
                <li ondblclick="editTitle(this)" contenteditable="true" spellcheck="false" id="quizTitle">Untitled Quiz</li>
                <li><i class="fas fa-file-import"></i> Publish</li>
                <li><i class="fa-solid fa-forward"></i> preview</li>
                <li class="active"><i class="fa-solid fa-gear"></i> Settings</li>
            </ul>
        </div>
        <div class="Questions">
            <p>0 Question<span> (0 Point)</span></p>
            <button class="addQ"><i class="fa-solid fa-plus"></i> Add Question</button>
            <div id="quizDisplay" class="quiz-container"></div>
        </div>
        <!-- Welcome Modal -->
        <div id="welcomeModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Which Type Of Question do you want:</p>
                <div class="choices">
                    <button id="multipleChoiceBtn"><i class="fa-solid fa-square-check" style="color: purple;"></i> Multiple Choice</button>
                    <button id="DropBtn"><i class="fa-solid fa-square-caret-down" style="color: purple;"></i> Drop down</button>
                    <button><i class="fa-solid fa-pen" style="color: purple;"></i> Open Ended</button>
                </div>
            </div>
        </div>

        <!-- Multiple Choice Modal -->
        <div id="secondModal" class="modal" style="display: none;">
            <div class="modal-content2">
                <span class="close second-close">&times;</span>

                <!-- Quiz Formatting Toolbar -->
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

                <!-- Quiz Editor -->
                <div id="quizEditor">
                    <div class="question-box">
                        <div id="questionInput" contenteditable="true" class="question-input">Type your question here...</div>
                        <div class="answer-options">
                            <button id="addAnswerBtn" class="add-answer">+</button>

                            <div class="answer blue">
                                <button class="correct-check">✔</button>
                                <span class="delete" title="Delete"><i class="fas fa-trash-alt"></i></span>
                                <input type="text" class="answer-input" placeholder="Type answer option here...">
                            </div>

                            <div class="answer teal">
                                <button class="correct-check">✔</button>
                                <span class="delete" title="Delete"><i class="fas fa-trash-alt"></i></span>
                                <input type="text" class="answer-input" placeholder="Type answer option here...">
                            </div>

                            <div class="answer yellow">
                                <button class="correct-check">✔</button>
                                <span class="delete" title="Delete"><i class="fas fa-trash-alt"></i></span>
                                <input type="text" class="answer-input" placeholder="Type answer option here...">
                            </div>

                            <div class="answer red">
                                <button class="correct-check">✔</button>
                                <span class="delete" title="Delete"><i class="fas fa-trash-alt"></i></span>
                                <input type="text" class="answer-input" placeholder="Type answer option here...">
                            </div>
                        </div>

                        <!-- Quiz Options -->
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
        <div id="DropModal" class="modal" style="display: none;">
            <div class="modal-content2">
                <span class="close Drop-close">&times;</span>
                
                <!-- Quiz Formatting -->
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
                <!-- Quiz Editor -->
                <div id="quizEditor">
                    <div class="question-box">
                        <div id="dropQuestionInput" contenteditable="true" class="question-input">Type your question here...</div>
                    </div>
        
                    <!-- Answer Options -->
                    <div class="answer-optionsdD">
                        <!-- Buttons to add correct or incorrect answers -->
                        <button id="correct" class="correct"><i class="fa-solid fa-plus"></i> Add Correct Answer</button>
                        <button id="incorrect" class="correct"><i class="fa-solid fa-plus"></i> Add Incorrect Answer</button>
                        <div id="correctAnswerContainer"></div> <!-- Container for correct answers -->
                    </div>
        
                    <!-- Quiz Options -->
                    <div class="button-container2">
                        <button id="saveQuiz" class="save-btn-D">Save Quiz</button>
                        <p id="errorMessage" style="color: red; display: none;">Please fill in the question and the answers!</p>
                    </div>
                </div>
            </div>
        </div>
    <script src="../js/create.js"></script>
    <script src="../js/display.js"></script>
</body>
</html>