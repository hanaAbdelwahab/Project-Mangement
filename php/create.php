<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz UI</title>
    <link rel="stylesheet" href="../css/create.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Additional styling for the blank button */
        .blank-btn {
            background-color:transparent;
            border: 2px dotted #ccc;
            border-radius: 1rem;
            padding: 2px 8px;
            margin-left: 5px;
            cursor: pointer;
            font-size: 1rem;
            display: inline-block;
            color: #ccc;
        }
        .blank-btn:hover {
            background-color: #e0e0e0;
            color: purple;
        }
        /* Add a container for text content in the question input */
        .text-content {
            display: inline;
        }
        .correct-answer {
            border: 2px solid green;
            padding: 5px;
            margin-top: 5px;
            border-radius: 4px;
        }
        .Questions p{
            color: purple;
            font-weight: 900;
            margin: 1rem;
        }
        .addQ{
    color: white;
    background-color: #6b1f9e;
    padding: 0.5rem;
    margin: 1rem;
    border-radius: 1rem;
    border: none;
    font-size: 0.9rem;
    font-weight: 700;
}
.question-input[contenteditable]:empty:before {
    content: attr(data-placeholder);
    color:rgb(202, 202, 202);
    pointer-events: none;
    display: block;
}
.blank-btn {
    background-color: transparent;
    border: 2px dotted #ccc;
    border-radius: 2rem;
    padding: 4px 10px;
    margin-top: 10px;
    cursor: pointer;
    color: #666;
    font-size: 1rem;
}
.blank-btn:hover {
    background-color: #f0f0f0;
    color: purple;
}
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <i class="fa-solid fa-circle-arrow-left" id="back"></i>
            <h2>QuizzyVerse</h2>
            <ul>
                <li ondblclick="editTitle(this)" contenteditable="true" spellcheck="false" id="quizTitle">Untitled Quiz</li>
                <li id="publishbtn"><i class="fas fa-file-import"></i> Publish</li>
                <li id="previewBtn"><i class="fa-solid fa-forward"></i> Preview</li>
                <li class="active"><i class="fa-solid fa-gear"></i> Settings</li>
            </ul>
        </div>
        <div class="Questions">
            <p>0 Question<span> (0 Point)</span></p>
            <button class="addQ"><i class="fa-solid fa-plus"></i> Add Question</button>
            <div class="Questions-container">
                
            </div>
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
                    <div id="questionInput" contenteditable="true" class="question-input" data-placeholder="Type your question here"></div>
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
                <div id="dropQuestionInput" contenteditable="true" class="question-input" data-placeholder="Type your question here"></div>
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

        <!-- Preview Modal -->
        <!-- PREVIEW MODAL -->
<div id="previewModal" class="modal" style="display: none;">
   <div class="modal-content2">
      <span class="close preview-close">&times;</span>
      <h2>Quiz Preview</h2>
      <div id="previewContent"></div>
   </div>
</div>

<!-- PUBLISH MODAL -->
<!-- Example structure for publishModal -->
<div id="publishModal" class="modal" style="display:none;">
  <div class="modal-content" style="
    width: 300px;
    padding: 1.5rem;
    background-color: white;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  ">
    
    <h3 style="margin-bottom: 1rem; color:green;">Your Quiz Code!</h3>
    
    <div id="codeBox" data-code="--------" style="
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 1.5rem;
      background: #f4f4f4;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      margin-bottom: 1rem;
      cursor: pointer;
    ">
      <span class="code-text">--------</span>
      <i class="fa-solid fa-copy"></i>
    </div>
    
    <button id="goToDashboardBtn" style="
      padding: 0.5rem 1rem;
      background-color: #6b1f9e;
      color: white;
      border: none;
      border-radius: 6px;
      margin-top: 1rem;
      cursor: pointer;
    ">Go to Dashboard</button>
  </div>
</div>
</div>

    <script src="../js/create.js"></script>
</body>
</html>