function setGenericProgress(percent, circleElement, textElement) {
  if (!circleElement || !textElement) {
    console.error("Progress elements not found for animation.");
    return;
  }
  const radius = circleElement.r.baseVal.value;
  const circumference = 2 * Math.PI * radius;

  circleElement.style.strokeDasharray = `${circumference} ${circumference}`;
  if (percent === 0) {
    circleElement.style.strokeDashoffset = circumference;
  }

  circleElement.getBoundingClientRect(); 

  const offset = circumference - (percent / 100) * circumference;
  circleElement.style.strokeDashoffset = offset;

  textElement.textContent = `${percent}%`;
}

let currentProfilePercent = 0;
const targetProfilePercent = 90;
const profileCircle = document.getElementById('profileProgressCircle');
const profileText = document.getElementById('profileProgressValue');

if (profileCircle && profileText) {
    setGenericProgress(0, profileCircle, profileText);
    setTimeout(() => {
      const profileInterval = setInterval(() => {
        if (currentProfilePercent < targetProfilePercent) {
          currentProfilePercent++;
          setGenericProgress(currentProfilePercent, profileCircle, profileText);
        } else {
          setGenericProgress(targetProfilePercent, profileCircle, profileText);
          clearInterval(profileInterval);
        }
      }, 25);
    }, 100);
}

const quizzesTaken = 12;
const totalQuizzes = 25;
const quizAverageScore = 78;

const quizzesTakenEl = document.getElementById('quizzesTaken');
const totalQuizzesEl = document.getElementById('totalQuizzes');
const quizAverageEl = document.getElementById('quizAverage');

if(quizzesTakenEl) quizzesTakenEl.textContent = quizzesTaken;
if(totalQuizzesEl) totalQuizzesEl.textContent = totalQuizzes;
if(quizAverageEl) quizAverageEl.textContent = quizAverageScore;

const quizProgressPercent = totalQuizzes > 0 ? Math.round((quizzesTaken / totalQuizzes) * 100) : 0;
const quizCircle = document.getElementById('quizProgressCircle');
const quizText = document.getElementById('quizProgressValue');

if (quizCircle && quizText) {
    let currentQuizPercent = 0;
    setGenericProgress(0, quizCircle, quizText);
    setTimeout(() => { 
      const quizInterval = setInterval(() => {
        if (currentQuizPercent < quizProgressPercent) {
          currentQuizPercent++;
          setGenericProgress(currentQuizPercent, quizCircle, quizText);
        } else {
          setGenericProgress(quizProgressPercent, quizCircle, quizText);
          clearInterval(quizInterval);
        }
      }, 30); 
    }, 200); 
}

const editPersonalInfoBtn = document.getElementById('editPersonalInfoBtn');
const savePersonalInfoBtn = document.getElementById('savePersonalInfoBtn');
const cancelPersonalInfoBtn = document.getElementById('cancelPersonalInfoBtn');
const personalInfoCard = document.querySelector('.personal-info-card');

const originalValues = {};

if (editPersonalInfoBtn && savePersonalInfoBtn && cancelPersonalInfoBtn && personalInfoCard) {
  editPersonalInfoBtn.addEventListener('click', () => {
    personalInfoCard.querySelectorAll('.info-item').forEach(item => {
      const displaySpan = item.querySelector('.info-value-display');
      const editInput = item.querySelector('.info-value-edit');
      
      if (displaySpan && editInput) {
        const field = displaySpan.dataset.field;
        originalValues[field] = displaySpan.textContent; 
        editInput.value = displaySpan.textContent; 

        displaySpan.style.display = 'none';
        editInput.style.display = 'block';
      }
    });

    editPersonalInfoBtn.style.display = 'none';
    savePersonalInfoBtn.style.display = 'inline-block';
    cancelPersonalInfoBtn.style.display = 'inline-block';
  });

  savePersonalInfoBtn.addEventListener('click', () => {
    personalInfoCard.querySelectorAll('.info-item').forEach(item => {
      const displaySpan = item.querySelector('.info-value-display');
      const editInput = item.querySelector('.info-value-edit');

      if (displaySpan && editInput) {
        displaySpan.textContent = editInput.value; 
        console.log(`Saved ${editInput.dataset.field}: ${editInput.value}`);

        displaySpan.style.display = 'flex';
        editInput.style.display = 'none';
      }
    });

    editPersonalInfoBtn.style.display = 'inline-block';
    savePersonalInfoBtn.style.display = 'none';
    cancelPersonalInfoBtn.style.display = 'none';
  });

  cancelPersonalInfoBtn.addEventListener('click', () => {
    personalInfoCard.querySelectorAll('.info-item').forEach(item => {
      const displaySpan = item.querySelector('.info-value-display');
      const editInput = item.querySelector('.info-value-edit');
      
      if (displaySpan && editInput) {
        const field = displaySpan.dataset.field;
        displaySpan.textContent = originalValues[field] || displaySpan.textContent; 
        editInput.value = originalValues[field] || editInput.value;

        displaySpan.style.display = 'flex';
        editInput.style.display = 'none';
      }
    });

    editPersonalInfoBtn.style.display = 'inline-block';
    savePersonalInfoBtn.style.display = 'none';
    cancelPersonalInfoBtn.style.display = 'none';
  });
}

function cancelLocation() {
  const locationInput = document.getElementById('location');
  if (locationInput) locationInput.value = 'California';
}
function saveLocation() {
  const locationInput = document.getElementById('location');
  if (locationInput) {
    console.log('Location saved:', locationInput.value);
  }
}

const editBioBtn = document.getElementById('editBioBtn');
const bioTextarea = document.getElementById('bioTextarea');
const bioActionsDiv = document.getElementById('bioActions');
const saveBioBtn = document.getElementById('saveBioBtn');
const cancelBioBtn = document.getElementById('cancelBioBtn');
let originalBio = '';

if (editBioBtn && bioTextarea && bioActionsDiv && saveBioBtn && cancelBioBtn) {
    originalBio = bioTextarea.value;

    editBioBtn.addEventListener('click', () => {
        bioTextarea.readOnly = false;
        bioTextarea.focus();
        originalBio = bioTextarea.value;
        bioActionsDiv.style.display = 'flex';
        editBioBtn.style.display = 'none';
    });

    saveBioBtn.addEventListener('click', () => {
        bioTextarea.readOnly = true;
        console.log("Bio saved:", bioTextarea.value);
        originalBio = bioTextarea.value;
        bioActionsDiv.style.display = 'none';
        editBioBtn.style.display = 'inline-block';
    });

    cancelBioBtn.addEventListener('click', () => {
        bioTextarea.value = originalBio;
        bioTextarea.readOnly = true;
        bioActionsDiv.style.display = 'none';
        editBioBtn.style.display = 'inline-block';
    });
}

const editPasswordBtn = document.getElementById('editPasswordBtn');
if (editPasswordBtn) {
  editPasswordBtn.addEventListener('click', () => {
    window.location.href = 'change-password.php';
  });
}