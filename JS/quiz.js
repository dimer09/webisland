
const questions = [
    {
        question: "What is HTML?",
        answers: [
            "A programming language",
            "A markup language for creating web pages",
            "An operating system",
            "A database"
        ],
        correctAnswer: 1
    },
    {
        question: "What does CSS stand for?",
        answers: [
            "Computer Style Sheets",
            "Creative Style System",
            "Cascading Style Sheets",
            "Colorful Style Sheets"
        ],
        correctAnswer: 2
    },
    {
        question: "Which HTML element is used to define a paragraph?",
        answers: [
            "<header>",
            "<paragraph>",
            "<p>",
            "<text>"
        ],
        correctAnswer: 2
    },
    {
        question: "What is the purpose of the CSS 'background-color' property?",
        answers: [
            "Change the color of the text",
            "Change the background color of an element",
            "Set the spacing between letters",
            "Create animations"
        ],
        correctAnswer: 1
    },
    {
        question: "Which HTML attribute is used to define an external style sheet?",
        answers: [
            "class",
            "src",
            "style",
            "href"
        ],
        correctAnswer: 3
    },
    {
        question: "What is the purpose of the HTML <a> element?",
        answers: [
            "Create a paragraph",
            "Insert an image",
            "Create a hyperlink",
            "Define a title"
        ],
        correctAnswer: 2
    },
    {
        question: "How do you insert a comment in HTML?",
        answers: [
            "// This is a comment",
            "/* This is a comment */",
            "<!-- This is a comment -->",
            "# This is a comment"
        ],
        correctAnswer: 2
    },
    {
        question: "Which CSS property is used to change the font of text?",
        answers: [
            "font-family",
            "font-style",
            "text-style",
            "typeface"
        ],
        correctAnswer: 0
    },
    {
        question: "What is the role of the HTML <title> element?",
        answers: [
            "Define a title in the body of the page",
            "Define the title displayed in the browser tab",
            "Create a large header",
            "Define the title of a section"
        ],
        correctAnswer: 1
    },
    {
        question: "What does 'HTML' stand for?",
        answers: [
            "Hyper Text Markup Language",
            "High Text Machine Language",
            "Hyper Tabular Markup Language",
            "None of the above"
        ],
        correctAnswer: 0
    }
];




let currentQuestionIndex = 0;
let score = 0;

const userScore = document.getElementById('user-score');
const questionNumber = document.getElementById('question-number');
const questionContainer = document.querySelector('.question-container');


// Fonction pour afficher la question suivante
function showNextQuestion() {
    // Retirer le contenu actuel de la question
    const questionEl = document.querySelector('.question');
    questionEl.innerHTML = '';

    if (currentQuestionIndex < questions.length) {
        const currentQuestion = questions[currentQuestionIndex];
        const questionText = document.createElement('p');
        questionText.textContent = 'Q. ' + currentQuestion.question;
        questionEl.appendChild(questionText);

        const answerList = document.createElement('ul');
        answerList.classList.add('answer-list');
        currentQuestion.answers.forEach((answer, index) => {
            const answerItem = document.createElement('li');
            answerItem.textContent = answer;
            answerItem.onclick = function() { checkAnswer(index, currentQuestion.correctAnswer); };
            answerList.appendChild(answerItem);
        });

        questionEl.appendChild(answerList);
    } else {
        showFinalResults();
    }
}

// Fonction pour vérifier la réponse et afficher la suivante
function checkAnswer(selectedIndex, correctIndex) {
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
            console.log(data); // Traitee la réponse du serveur ici
        })
        .catch(error => console.error('Error:', error));
    }
}

// Fonction pour afficher les résultats finaux
function showFinalResults() {
    let resultContent = `<div id="final-result"><h1>Your final score  is : ${score} / ${questions.length}</h1>`;

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
