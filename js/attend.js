
document.addEventListener("DOMContentLoaded", function () {
    const fullscreenBtn = document.getElementById('fullscreen-btn');
    const correctAnswers = {
        "q1": "q1-a", // Central Processing Unit
        "q2": "q2-b", // Random Access Memory
        "q3": "q3-c", // Hard Disk
        "q4": "q4-b", // Mouse
        "q5": "HyperText Markup Language",
        "q6": "python",
        "q7": "q7-b", // Linux
        "q8": "Uniform Resource Locator",
        "q9": "chrome",
        "q10": "q10-b" // HTML
    }
    fullscreenBtn.addEventListener('click', function() {
        if (!document.fullscreenElement &&  // If not already in fullscreen
            !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {  // For older browsers
            // Try to go fullscreen
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) { // Firefox
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari and Opera
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
                document.documentElement.msRequestFullscreen();
            }
        } else {  // If already in fullscreen, exit fullscreen
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { // Firefox
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { // IE/Edge
                document.msExitFullscreen();
            }
        }
    });
    // ✅ Handle dropdown selection for question 9 (q9) with countdown
    const q9Select = document.querySelector('#q9 select');
    if (q9Select) {
        q9Select.style.color = 'black';
        q9Select.addEventListener('change', function() {
            if (!answeredQuestions['q9']) {
                answeredQuestions['q9'] = true;
                
                const selectedOption = q9Select.value;
                const correctOption = correctAnswers['q9'];
                
                const feedback = document.createElement('div');
                feedback.style.marginTop = '10px';
                feedback.classList.add('feedback');
                
                // Mark the answer as correct or wrong
                if (selectedOption === correctOption) {
                    q9Select.classList.add('correct');
                    q9Select.style.color = 'white';
                    feedback.textContent = 'Correct!';
                    feedback.style.color = 'rgb(1, 173, 1)';
                } else {
                    q9Select.classList.add('wrong');
                    q9Select.style.color = 'white';
                    feedback.innerHTML = `Incorrect. Correct answer: <strong style="color:rgb(1, 173, 1);">${correctAnswers["q9"]}</strong>`;
                    feedback.style.color = 'rgb(252, 39, 39)';
                }
                
                // Disable the dropdown
                q9Select.disabled = true;
                
                // Prevent duplicate feedback
                const existingFeedback = document.querySelector('#q9 .feedback');
                if (existingFeedback) existingFeedback.remove();
                
                document.getElementById('q9').appendChild(feedback);
                
                // Countdown timer
                const timerContainer = document.createElement('div');
                timerContainer.className = 'timer-display';
                document.getElementById('q9').appendChild(timerContainer);
                
                let secondsLeft = 2;
                timerContainer.textContent = `Next question in ${secondsLeft} seconds...`;
                
                if (autoNavigationTimer) {
                    clearInterval(autoNavigationTimer);
                }
                
                autoNavigationTimer = setInterval(() => {
                    secondsLeft--;
                    timerContainer.textContent = `Next question in ${secondsLeft} seconds...`;
                    
                    if (secondsLeft <= 0) {
                        clearInterval(autoNavigationTimer);
                        autoNavigationTimer = null;
                        goToNextQuestion();
                    }
                }, 1000);
            }
        });
    };

    const questions = document.querySelectorAll('.question-container');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitContainer = document.getElementById('submit-container');
    let currentQuestion = 0;
    let autoNavigationTimer = null;

    const answeredQuestions = {};

    function goToNextQuestion() {
        if (currentQuestion < questions.length - 1) {
            currentQuestion++;
            showQuestion(currentQuestion);
        } else {
            calculateScore();
        }
    }

    function calculateScore() {
        let score = 0;
        let total = Object.keys(correctAnswers).length;

        Object.keys(correctAnswers).forEach(qid => {
            let userAnswer = "";
            const questionEl = document.getElementById(qid);
            const correctAnswer = correctAnswers[qid];

            const radioChecked = questionEl.querySelector('input[type="radio"]:checked');
            if (radioChecked) {
                userAnswer = radioChecked.id;

                const options = questionEl.querySelectorAll('.mcq-option');
                options.forEach(opt => {
                    const optInput = opt.querySelector('input');
                    if (optInput.id === correctAnswer) {
                        opt.classList.add('correct');
                    } else if (optInput.id === userAnswer && userAnswer !== correctAnswer) {
                        opt.classList.add('wrong');
                    } else {
                        opt.classList.add('disabled');
                    }
                    opt.style.pointerEvents = 'none';
                });

                if (userAnswer === correctAnswer) score++;
                return;
            }

            const textInput = questionEl.querySelector('input[type="text"]');
            if (textInput) {
                userAnswer = textInput.value.trim().toLowerCase();
                const correct = correctAnswer.toLowerCase();
                if (userAnswer === correct) {
                    textInput.classList.add('correct');
                    score++;
                } else {
                    textInput.classList.add('wrong');
                }
                textInput.disabled = true;
                return;
            }

            const selectInput = questionEl.querySelector('select');
            if (selectInput) {
                userAnswer = selectInput.value;
                if (userAnswer === correctAnswer) {
                    selectInput.classList.add('correct');
                    score++;
                } else {
                    selectInput.classList.add('wrong');
                }
                selectInput.disabled = true;
                return;
            }
        });

        localStorage.setItem("score", score);
        localStorage.setItem("total", total);
        window.location.href = "result.php";
    }

    function handleOptionClick(questionId, optionElement) {
        answeredQuestions[questionId] = true;

        const input = optionElement.querySelector('input');
        input.checked = true;

        const options = document.querySelectorAll(`#${questionId} .mcq-option`);
        const selectedOption = input.id;
        const correctOption = correctAnswers[questionId];

        options.forEach(opt => {
            const optInput = opt.querySelector('input');
            if (optInput.id === correctOption) {
                opt.classList.add('correct');
            } else if (optInput.id === selectedOption && selectedOption !== correctOption) {
                opt.classList.add('wrong');
            } else {
                opt.classList.add('disabled');
            }
            opt.style.pointerEvents = 'none';
        });

        const timerContainer = document.createElement('div');
        timerContainer.className = 'timer-display';
        document.querySelector(`#${questionId}`).appendChild(timerContainer);

        let secondsLeft = 2;
        timerContainer.textContent = currentQuestion === questions.length - 1
            ? `Result will be shown in ${secondsLeft} seconds...`
            : `Next question in ${secondsLeft} seconds...`;

        if (autoNavigationTimer) {
            clearInterval(autoNavigationTimer);
        }

        autoNavigationTimer = setInterval(() => {
            secondsLeft--;
            timerContainer.textContent = currentQuestion === questions.length - 1
                ? `Result will be shown in ${secondsLeft} seconds...`
                : `Next question in ${secondsLeft} seconds...`;

            if (secondsLeft <= 0) {
                clearInterval(autoNavigationTimer);
                autoNavigationTimer = null;
                goToNextQuestion();
            }
        }, 1000);
    }

    function setupQuestionListeners() {
        questions.forEach(question => {
            const questionId = question.id;
            const options = question.querySelectorAll('.mcq-option');

            options.forEach(option => {
                option.addEventListener('click', function () {
                    if (!answeredQuestions[questionId] && this.querySelector('input[type="radio"]')) {
                        handleOptionClick(questionId, this);
                    }
                });
            });
        });
    }

    function showQuestion(index) {
        if (autoNavigationTimer) {
            clearInterval(autoNavigationTimer);
            autoNavigationTimer = null;
        }

        questions.forEach((question, i) => {
            question.style.display = i === index ? 'block' : 'none';
        });

        if (prevBtn) prevBtn.style.display = index > 0 ? 'inline-block' : 'none';
        if (nextBtn) nextBtn.style.display = index === questions.length - 1 ? 'none' : 'inline-block';
        if (submitContainer) submitContainer.style.display = 'none';
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            if (currentQuestion > 0) {
                currentQuestion--;
                showQuestion(currentQuestion);
            }
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            goToNextQuestion();
        });
    }

    setupQuestionListeners();
    showQuestion(currentQuestion);

    // ✅ Handle text input questions with Enter key and countdown
    const q5Input = document.querySelector('#q5 input[type="text"]');
    if (q5Input) {
        q5Input.style.color = 'black';
        q5Input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const userAnswer = q5Input.value.trim().toLowerCase();
                const correctAnswer = correctAnswers["q5"].toLowerCase();

                const feedback = document.createElement('div');
                feedback.style.marginTop = '10px';

                if (userAnswer === correctAnswer) {
                    q5Input.classList.add('correct');
                    q5Input.style.color='white';
                    feedback.textContent = 'Correct!';
                    feedback.style.color = 'rgb(1, 173, 1)';
                } else {
                    q5Input.classList.add('wrong');
                    q5Input.style.color='white';
                    feedback.innerHTML = `Incorrect. Correct answer: <strong style="color:rgb(1, 173, 1);">${correctAnswers["q5"]}</strong>`;
                    feedback.style.color = 'rgb(252, 39, 39)';
                }

                q5Input.disabled = true;

                // Prevent duplicate feedback
                const existingFeedback = document.querySelector('#q5 .feedback');
                if (existingFeedback) existingFeedback.remove();

                feedback.classList.add('feedback');
                document.getElementById('q5').appendChild(feedback);

                // Countdown timer like MCQs
                const timerContainer = document.createElement('div');
                timerContainer.className = 'timer-display';
                document.getElementById('q5').appendChild(timerContainer);

                let secondsLeft = 2;
                timerContainer.textContent = `Next question in ${secondsLeft} seconds...`;

                if (autoNavigationTimer) {
                    clearInterval(autoNavigationTimer);
                }

                autoNavigationTimer = setInterval(() => {
                    secondsLeft--;
                    timerContainer.textContent = `Next question in ${secondsLeft} seconds...`;

                    if (secondsLeft <= 0) {
                        clearInterval(autoNavigationTimer);
                        autoNavigationTimer = null;
                        goToNextQuestion();
                    }
                }, 1000);
            }
        });
    }

    // ✅ Handle Enter key for question 8 (q8) with countdown
    const q8Input = document.querySelector('#q8 input[type="text"]');
    if (q8Input) {
        q8Input.style.color = 'black';
        q8Input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const userAnswer = q8Input.value.trim().toLowerCase();
                const correctAnswer = correctAnswers["q8"].toLowerCase();

                const feedback = document.createElement('div');
                feedback.style.marginTop = '10px';

                if (userAnswer === correctAnswer) {
                    q8Input.classList.add('correct');
                    q8Input.style.color = 'white';
                    feedback.textContent = 'Correct!';
                    feedback.style.color = 'rgb(1, 173, 1)';
                } else {
                    q8Input.classList.add('wrong');
                    q8Input.style.color = 'white';
                    feedback.innerHTML = `Incorrect. Correct answer: <strong style="color:rgb(1, 173, 1);">${correctAnswers["q8"]}</strong>`;
                    feedback.style.color = 'rgb(252, 39, 39)';
                }

                q8Input.disabled = true;

                // Prevent duplicate feedback
                const existingFeedback = document.querySelector('#q8 .feedback');
                if (existingFeedback) existingFeedback.remove();

                feedback.classList.add('feedback');
                document.getElementById('q8').appendChild(feedback);

                // Countdown timer like MCQs
                const timerContainer = document.createElement('div');
                timerContainer.className = 'timer-display';
                document.getElementById('q8').appendChild(timerContainer);

                let secondsLeft = 2;
                timerContainer.textContent = `Next question in ${secondsLeft} seconds...`;

                if (autoNavigationTimer) {
                    clearInterval(autoNavigationTimer);
                }

                autoNavigationTimer = setInterval(() => {
                    secondsLeft--;
                    timerContainer.textContent = `Next question in ${secondsLeft} seconds...`;

                    if (secondsLeft <= 0) {
                        clearInterval(autoNavigationTimer);
                        autoNavigationTimer = null;
                        goToNextQuestion();
                    }
                }, 1000);
            }
        });
    }

    // ✅ Handle dropdown selection for question 6 (q6) with countdown
    const q6Select = document.querySelector('#q6 select');
    if (q6Select) {
        q6Select.style.color = 'black';
        q6Select.addEventListener('change', function() {
            if (!answeredQuestions['q6']) {
                answeredQuestions['q6'] = true;
                
                const selectedOption = q6Select.value;
                const correctOption = correctAnswers['q6'];
                
                const feedback = document.createElement('div');
                feedback.style.marginTop = '10px';
                feedback.classList.add('feedback');
                
                // Mark the answer as correct or wrong
                if (selectedOption === correctOption) {
                    q6Select.classList.add('correct');
                    q6Select.style.color='white';
                    feedback.textContent = 'Correct!';
                    feedback.style.color = 'rgb(1, 173, 1)';
                } else {
                    q6Select.classList.add('wrong');
                    q6Select.style.color='white';
                    feedback.innerHTML = `Incorrect. Correct answer: <strong style="color:rgb(1, 173, 1);">${correctAnswers["q6"]}</strong>`;
                    feedback.style.color = 'rgb(252, 39, 39)';
                }
                
                // Disable the dropdown
                q6Select.disabled = true;
                
                // Prevent duplicate feedback
                const existingFeedback = document.querySelector('#q6 .feedback');
                if (existingFeedback) existingFeedback.remove();
                
                document.getElementById('q6').appendChild(feedback);
                
                // Countdown timer
                const timerContainer = document.createElement('div');
                timerContainer.className = 'timer-display';
                document.getElementById('q6').appendChild(timerContainer);
                
                let secondsLeft = 2;
                timerContainer.textContent = `Next question in ${secondsLeft} seconds...`;
                
                if (autoNavigationTimer) {
                    clearInterval(autoNavigationTimer);
                }
                
                autoNavigationTimer = setInterval(() => {
                    secondsLeft--;
                    timerContainer.textContent = `Next question in ${secondsLeft} seconds...`;
                    
                    if (secondsLeft <= 0) {
                        clearInterval(autoNavigationTimer);
                        autoNavigationTimer = null;
                        goToNextQuestion();
                    }
                }, 1000);
            }
        });
    }
});