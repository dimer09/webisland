<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Web Island</title>
    <link rel="stylesheet" href="CSS/stage1.css">
</head>
<body>
    
    <?php
    session_start(); // Assurez-vous de démarrer la session au début du script
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : "Etranger"; // Remplacer "Invité" par un texte de votre choix si la session n'est pas définie
    ?>
    <div class="user-info">
        <img src="RESSOURCES/Images/logo.png" alt="Logo Web Island" class="site-logo">
        <span class="user-name">User: <span id="username"><?php echo htmlspecialchars($username); ?></span></span>
        
        <div class="user-results">
            Score: <span id="user-score">0</span></div>
    </div>

    <div class="question-container">
        <h2 class="quiz-title">At the Beginning of the web...Stage 1</h2>
        <div class="question">
            <p>Q. "Qu'est-ce que le HTML?"</p>
            <ul class="answer-list" id="answer-list">
                <li>The creation of the Ministry of Magic</li>
                <li>The hiding of the wizarding world from Muggles</li>
                <li>The establishment of Azkaban</li>
                <li>The founding of the International Confederation of Wizards</li>
            </ul>
            <div class="timer">30 seconds</div>
            <div class="points">1 point</div>
        </div>

    </div>
    <!-- Conteneur pour le résultat final -->
    <div id="final-result" style="display: none;">
        <h2 id="final-score">Votre score : </h2>
        <img id="badge" src="" alt="Badge" style="display: none;">
        <div class="button-container">
            <button onclick="window.location.href='index.html';">Accueil</button>
            <button onclick="window.location.href='cours.html';">Cours</button>
        </div>
    </div>


    <script src="JS/quiz.js"></script>
</body>
</html>
