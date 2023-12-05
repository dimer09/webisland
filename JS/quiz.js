// Simulez un ensemble de questions pour le quiz
const questions = [
    {
        question: "Quelle était la principale conséquence de la signature du Statut International de Secret en 1689?",
        answers: [
            "La création du Ministère de la Magie",
            "Le camouflage du monde magique aux Moldus",
            "L'établissement d'Azkaban",
            "La fondation de la Confédération Internationale des Sorciers"
        ],
        correctAnswer: 1 // Index de la réponse correcte dans le tableau 'answers'
    },
    {
        question: "Qui a découvert les douze usages du sang de dragon ?",
        answers: [
            "Merlin",
            "Albus Dumbledore",
            "Nicolas Flamel",
            "Newt Scamander"
        ],
        correctAnswer: 1
    },
    {
        question: "Quel est le nom complet de Lord Voldemort ?",
        answers: [
            "Tom Elvis Jedusor",
            "Tom Marvolo Riddle",
            "Tom Jedusor",
            "Voldemort"
        ],
        correctAnswer: 1
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

// Fonction pour afficher les résultats finaux
function showFinalResults() {
    const questionContainer = document.querySelector('.question-container');
    questionContainer.innerHTML = `
        <div id="final-result">
            <h1>Votre score final est : ${score} / ${questions.length}</h1>
            ${score > 5 ? '<img id="badge" src="chemin_vers_votre_image_de_badge.png">' : ''}
            <div class="button-container">
                <button onclick="window.location.href='index.html';">Accueil</button>
                <button onclick="window.location.href='cours.html';">Cours</button>
            </div>
        </div>
    `;
}

// Démarrer le quiz avec la première question
showNextQuestion();
