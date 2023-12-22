// Simulez un ensemble de questions pour le quiz
const questions = [
    {
        question: "How do you select an element with a specific class in CSS?",
        answers: [
            "Using the # symbol followed by the class name",
            "Using the . symbol followed by the class name",
            "Using the class name directly",
            "Using the tag name followed by the class name"
        ],
        correctAnswer: 1
    },
    {
        question: "What is the difference between HTML <div> and <span> elements?",
        answers: [
            "<div> is inline while <span> is a block",
            "<div> and <span> have no difference",
            "<div> is a block element while <span> is an inline element",
            "There is no <span> element in HTML"
        ],
        correctAnswer: 2
    },
    {
        question: "What is the purpose of the 'alt' attribute in an <img> tag?",
        answers: [
            "To change the size of the image",
            "To create a hyperlink",
            "To provide alternative text if the image does not load",
            "To specify the image source"
        ],
        correctAnswer: 2
    },
    {
        question: "How do you center an element with CSS?",
        answers: [
            "Use 'text-align: center;' for all elements",
            "Use 'margin: auto;' for block elements",
            "Use 'align-items: center;' for all elements",
            "Use 'justify-content: center;' for inline elements"
        ],
        correctAnswer: 1
    },
    {
        question: "What is the 'placeholder' attribute in an HTML form field?",
        answers: [
            "An error message to display if the field is not filled out correctly",
            "Default text that will be submitted if the user enters nothing",
            "Example text displayed in the field until it is filled out",
            "A directive for the browser on how to validate the field"
        ],
        correctAnswer: 2
    },
    {
        question: "How do you add a comment in CSS?",
        answers: [
            "// This is a comment",
            "<!-- This is a comment -->",
            "/* This is a comment */",
            "# This is a comment"
        ],
        correctAnswer: 2
    },
    {
        question: "Which HTML tag is used to include a JavaScript file?",
        answers: [
            "<script>",
            "<javascript>",
            "<js>",
            "<link>"
        ],
        correctAnswer: 0
    },
    {
        question: "What does 'Responsive Design' mean in web development?",
        answers: [
            "A design that adapts to the speed of the Internet connection",
            "A design that changes depending on the device used to view the site",
            "A design that uses lots of videos and animations",
            "A design that reacts to user actions in real time"
        ],
        correctAnswer: 1
    },
    {
        question: "How do you apply CSS styling to an HTML element with a specific ID?",
        answers: [
            "Using the . symbol followed by the ID",
            "Using the # symbol followed by the ID",
            "Using the ID name directly",
            "Using the tag name followed by the ID"
        ],
        correctAnswer: 1
    },
    {
        question: "What is a 'pseudo-element' in CSS?",
        answers: [
            "An element that exists only in CSS and not in HTML",
            "An HTML element that is hidden on the page",
            "A specific part of an element, like ::first-line or ::before",
            "An HTML element dynamically created with JavaScript"
        ],
        correctAnswer: 2
    }
];




let currentQuestionIndex = 0;
let score = 0;
let timer;

const userScore = document.getElementById('user-score');
const questionNumber = document.getElementById('question-number');
const questionContainer = document.querySelector('.question-container');
timerDisplay = document.querySelector('.timer'); 

const timePerQuestion = 10; // 30 secondes pour cet exemple

// Fonction pour arrêter le minuteur
function stopTimer() {
    clearInterval(timer);
}

function showNextQuestion() {
    // Arrêtez le minuteur actuel avant de démarrer le suivant
    stopTimer();

    // Retirer le contenu actuel de la question
    const questionEl = document.querySelector('.question');
    questionEl.innerHTML = '';

    // Vérifier si il reste des questions
    if (currentQuestionIndex < questions.length) {
        const currentQuestion = questions[currentQuestionIndex];

        // Créer l'élément de texte de la question
        const questionText = document.createElement('p');
        questionText.textContent = 'Q. ' + currentQuestion.question;
        questionEl.appendChild(questionText);

        // Créer la liste des réponses
        const answerList = document.createElement('ul');
        answerList.classList.add('answer-list');
        currentQuestion.answers.forEach((answer, index) => {
            const answerItem = document.createElement('li');
            answerItem.textContent = answer;
            answerItem.onclick = function() { 
                checkAnswer(index, currentQuestion.correctAnswer); 
            };
            answerList.appendChild(answerItem);
        });

        questionEl.appendChild(answerList);

        // Ajouter le minuteur à la question
        const timerElement = document.createElement('div');
        timerElement.className = 'timer';
        questionEl.appendChild(timerElement);

        timerDisplay = document.querySelector('.timer');
        startTimer();
    } else {
        // Si il n'y a plus de questions, afficher les résultats finaux
        showFinalResults();
    }
}


// Fonction pour démarrer le minuteur
function startTimer() {
    let timeLeft = timePerQuestion;
    timerDisplay.textContent = `${timeLeft} seconds`;

    // Mettre à jour le minuteur chaque seconde
    timer = setInterval(function() {
        timeLeft--;
        timerDisplay.textContent = `${timeLeft} seconds`;
        if (timeLeft <= 0) {
            clearInterval(timer); // Arrête le minuteur
            timerDisplay.textContent = "Time's up!";
            // Utilisateur n'a pas répondu à temps
            currentQuestionIndex++;
            setTimeout(showNextQuestion, 1000); // Afficher la question suivante après une seconde
        }
    }, 1000);
}


// Fonction pour vérifier la réponse et afficher la suivante
function checkAnswer(selectedIndex, correctIndex) {
    stopTimer(); 
    if (selectedIndex === correctIndex) {
        score++;
        userScore.textContent = score;
    }
    currentQuestionIndex++;
    showNextQuestion();
}

// Appelez cette fonction à l'intérieur de showFinalResults quand le score est supérieur à 5
function updateCurrentStage() {
    if (score > 5) {
        window.current_stage = window.current_stage + 1;; // Incrémenter la variable globale current_stage

        // Envoyer la nouvelle valeur au serveur pour mise à jour en base de données
        fetch('PHP/currentstage.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `current_stage=${window.current_stage}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Traitez la réponse du serveur ici
        })
        .catch(error => console.error('Error:', error));
    }
}


// Fonction pour afficher les résultats finaux
function showFinalResults() {
    let resultContent = `<div id="final-result"><h1>Your final score is est : ${score} / ${questions.length}</h1>`;

    if (score >= 5 && score <= 7) {
        // Afficher le premier badge et un message
        resultContent += `<img id="badge" src="RESSOURCES/Images/argent.png">
                          <p>Congratulations for your score!</p>`;
    } else if (score >= 8 && score <= 9) {
        // Afficher le deuxième badge et un message
        resultContent += `<img id="badge" src="RESSOURCES/Images/diamant.png">
                          <p>Excellent work, almost perfect!</p>`;
    } else if (score === 10) {
        // Afficher un troisième badge et un message
        resultContent += `<img id="badge" src="RESSOURCES/Images/or.png">
                          <p>Incredible, a perfect score!</p>`;
    } else {
        // Moins de 5 points
        resultContent += `<p>Try again to improve your score.</p>`;
    }

    // Ajouter des boutons en fonction du score
    if (score < 5) {
        resultContent += `<div class="button-container">
                              <button onclick="window.location.href='cours.php';">Courses</button>
                              <button onclick="window.location.reload();">Restart</button>
                          </div>`;
    } else {
        resultContent += `<div class="button-container">
                              <button onclick="window.location.href='inde.php';">Home</button>
                              <button onclick="window.location.href='cours.php';">Courses</button>
                          </div>`;
                          updateCurrentStage();
    }

    resultContent += `</div>`;
    const questionContainer = document.querySelector('.question-container');
    questionContainer.innerHTML = resultContent;
}


// Démarrer le quiz avec la première question
showNextQuestion();
