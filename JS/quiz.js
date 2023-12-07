// Simulez un ensemble de questions pour le quiz
const questions = [
    {
        question: "Qu'est-ce que le HTML?",
        answers: [
            "Un langage de programmation",
            "Un langage de balisage pour créer des pages web",
            "Un système d'exploitation",
            "Une base de données"
        ],
        correctAnswer: 1
    },
    {
        question: "Que signifie CSS?",
        answers: [
            "Computer Style Sheets",
            "Creative Style System",
            "Cascading Style Sheets",
            "Colorful Style Sheets"
        ],
        correctAnswer: 2
    },
    {
        question: "Quel élément HTML est utilisé pour définir un paragraphe?",
        answers: [
            "<header>",
            "<paragraph>",
            "<p>",
            "<text>"
        ],
        correctAnswer: 2
    },
    {
        question: "À quoi sert la propriété CSS 'background-color'?",
        answers: [
            "Changer la couleur du texte",
            "Changer la couleur de l'arrière-plan d'un élément",
            "Définir l'espacement entre les lettres",
            "Créer des animations"
        ],
        correctAnswer: 1
    },
    {
        question: "Quel attribut HTML est utilisé pour définir une feuille de style externe?",
        answers: [
            "class",
            "src",
            "style",
            "href"
        ],
        correctAnswer: 3
    },
    {
        question: "Quel est le but de l'élément HTML <a>?",
        answers: [
            "Créer un paragraphe",
            "Insérer une image",
            "Créer un lien hypertexte",
            "Définir un titre"
        ],
        correctAnswer: 2
    },
    {
        question: "Comment insère-t-on un commentaire en HTML?",
        answers: [
            "// Ceci est un commentaire",
            "/* Ceci est un commentaire */",
            "<!-- Ceci est un commentaire -->",
            "# Ceci est un commentaire"
        ],
        correctAnswer: 2
    },
    {
        question: "Quelle propriété CSS est utilisée pour changer la police de caractères?",
        answers: [
            "font-family",
            "font-style",
            "text-style",
            "typeface"
        ],
        correctAnswer: 0
    },
    {
        question: "Quel est le rôle de l'élément HTML <title>?",
        answers: [
            "Définir un titre dans le corps de la page",
            "Définir le titre affiché dans l'onglet du navigateur",
            "Créer une grande en-tête",
            "Définir le titre d'une section"
        ],
        correctAnswer: 1
    },
    {
        question: "Que signifie 'HTML'?",
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

// Affiche la question actuelle à l'utilisateur
// ... (les autres parties du code restent les mêmes)

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
// Supposons que nous avons une fonction qui récupère les informations de l'utilisateur depuis la session


// ... Votre code existant pour showFinalResults ...

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

// ... Votre code existant pour showFinalResults continue ici ...

// Fonction pour afficher les résultats finaux
function showFinalResults() {
    let resultContent = `<div id="final-result"><h1>Votre score final est : ${score} / ${questions.length}</h1>`;

    if (score >= 5 && score <= 7) {
        // Afficher le premier badge et un message
        resultContent += `<img id="badge" src="RESSOURCES/Images/argent.png">
                          <p>Félicitations pour votre score!</p>`;
    } else if (score >= 8 && score <= 9) {
        // Afficher le deuxième badge et un message
        resultContent += `<img id="badge" src="RESSOURCES/Images/diamant.png">
                          <p>Excellent travail, presque parfait!</p>`;
    } else if (score === 10) {
        // Afficher un troisième badge et un message
        resultContent += `<img id="badge" src="RESSOURCES/Images/or.png">
                          <p>Incroyable, un score parfait!</p>`;
    } else {
        // Moins de 5 points
        resultContent += `<p>Essayez encore pour améliorer votre score.</p>`;
    }

    // Ajouter des boutons en fonction du score
    if (score < 5) {
        resultContent += `<div class="button-container">
                              <button onclick="window.location.href='cours.php';">Cours</button>
                              <button onclick="window.location.reload();">Recommencer</button>
                          </div>`;
    } else {
        resultContent += `<div class="button-container">
                              <button onclick="window.location.href='inde.php';">Accueil</button>
                              <button onclick="window.location.href='lieu.php';">Lieu 3D</button>
                              <button onclick="window.location.href='cours.php';">Cours</button>
                          </div>`;
                          updateCurrentStage();
    }

    resultContent += `</div>`;
    const questionContainer = document.querySelector('.question-container');
    questionContainer.innerHTML = resultContent;
}


// Démarrer le quiz avec la première question
showNextQuestion();
