// Vous pouvez remplacer cette variable par la récupération de la session ou une autre méthode.
const username = "Harry Potter"; // Exemple de nom d'utilisateur

document.getElementById('username').textContent = username;

const answerList = document.getElementById('answer-list');
const userScore = document.getElementById('user-score');
const questionNumber = document.getElementById('question-number');

let score = 0;

answerList.addEventListener('click', function(event) {
    if (event.target.tagName === 'LI') {
        // Simuler une vérification de réponse correcte ou incorrecte.
        const isCorrect = Math.random() > 0.5; // Exemple aléatoire
        if (isCorrect) {
            score++;
            event.target.style.backgroundColor = 'lightgreen';
        } else {
            event.target.style.backgroundColor = 'salmon';
        }
        userScore.textContent = score;
        
        // Mettre à jour le numéro de la question et passer à la suivante
        questionNumber.textContent = parseInt(questionNumber.textContent) + 1;
        
        // Désactiver les autres réponses après le choix
        Array.from(answerList.children).forEach(li => {
            li.style.pointerEvents = 'none';
        });
    }
});
