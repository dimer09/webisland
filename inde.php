<?php
session_start(); // Démarrer la session

// Connectez-vous à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=webisland', 'root', '');

    // Vérifiez si le username est enregistré dans la session
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Récupérez le current_stage depuis la base de données pour cet utilisateur
        $stmt = $pdo->prepare("SELECT current_stage FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si l'utilisateur existe et a un current_stage, utilisez-le, sinon définissez-le à 1
        $current_stage = $user ? (int)$user['current_stage'] : 1;
        echo $current_stage;
    } else {
        // Si l'utilisateur n'est pas connecté, définissez current_stage à 1 ou redirigez vers la page de connexion
        // $current_stage = 1; // Optionnel: Décommentez si vous voulez montrer la première étape même si l'utilisateur n'est pas connecté
        header('Location: logsign.html'); // Redirigez vers la page de connexion
        exit();
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

// ... (Le reste de votre code HTML et PHP pour afficher la page)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Web Island</title>
</head>
<body>

    <div id="video-container">
        <video autoplay muted loop id="myVideo">
            <source src="Videos/video2.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    

        <div class="flex-container">
            <header>
                <nav>
                    <div class="nav-title">WEB ISLAND KINSHASA O2027</div>
                    <ul class="nav-links">
                        <li><a href="#home">Map</a></li>
                        <li><a href="forum.php">Forum</a></li>
                        <li><a href="">Courses</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </nav>
                <h1>
                    <?php
                       
                        // Vérifiez si l'utilisateur est connecté et affichez un message personnalisé
                        if (isset($_SESSION['username'])) {
                            echo "Welcome, " . htmlspecialchars($_SESSION['username']);
                        } else {
                            echo "Our Trip to Web Island";
                        }
                         // Si current_stage n'est pas défini, utilisez 1 par défaut
                        $total_stages = 5; // Le nombre total d'étapes (stages)
                        echo "<div class='stages-container'>";

                        for ($stage = 1; $stage <= $total_stages; $stage++) {
                            $stage_class = $stage <= $current_stage ? "" : " locked";
                            $info_text = $stage <= $current_stage ? "Informations sur The Great Tree" : "This stage is locked";
                            echo "<div class='column column_$stage$stage_class'>";
                            echo "<h2>Visit $stage</h2>";
            
                            if ($stage <= $current_stage) {
                                // L'étape est débloquée, donc nous créons un lien vers la page de l'étape
                                echo "<a href='stage$stage.php'>"; // Assurez-vous que le lien est correct
                            }
            
                            // Afficher l'image de l'étape
                            echo "cick me";
            
                            if ($stage <= $current_stage) {
                                // Fermez la balise <a> si l'étape est débloquée
                                echo "</a>";
                            } elseif ($stage_class == " locked") {
                                // Afficher une icône de verrouillage pour les étapes verrouillées
                                echo "<div class='lock-overlay'><img src='RESSOURCES/Images/padlock.png' class='lock-icon' alt='Locked'></div>";
                            }
            
                            // Informations sur l'étape ou message de verrouillage
                            echo "<div class='info'>$info_text</div>";
                            echo "</div>"; // Fin de la colonne pour cette étape
                        }
                        ?>
                       
                                
                        
                </h1>
                <p>Here are some postcards from our trip to Web Island. Enjoy !!!</p>
                <script src="JS/getUserInfo.js"></script> <!-- Ce script contient la fonction getUserInfo() -->
                <script>
                    // Lorsque la page est chargée, récupérez les informations de l'utilisateur
                    getUserInfo().then(userInfo => {
                        if (userInfo.error) {
                            console.error(userInfo.error);
                            // Rediriger vers la page de connexion ou gérer l'erreur
                        } else {
                            // Utiliser les informations récupérées, par exemple :
                            window.current_stage = userInfo.current_stage;
                            // Mettre à jour l'interface utilisateur avec les informations récupérées
                        }
                    });
                </script>
            </header>
        
            <footer>
                
                <h2 class="nav-title">
                    WEB ISLAND KINSHASA O2027@Copy-right dodo.com
                </h2>
        
            </footer>
        </div>

        <script>
            var video = document.getElementById('myVideo');
            var videoSources = [
            "Videos/video1.mp4",
            "Videos/video2.mp4"
            ];
            var currentIndex = 0;
        
            video.addEventListener('ended', function () {
            currentIndex++;
            if (currentIndex >= videoSources.length) {
                currentIndex = 0;
            }
            video.src = videoSources[currentIndex];
            video.load();
            video.play();
            });
        </script>
         <script>
        // Déclarez une variable JavaScript pour le nom d'utilisateur
        var username = <?php echo json_encode($_SESSION['username'] ?? 'Guest'); ?>;
        document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chatMessages');
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        console.log({ chatMessages, messageInput, sendButton });
        // const username = "<?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>"; 
        // Utilisez 'Guest' comme nom par défaut
       
        console.log('Nom d\'utilisateur :', username);
        

        function sendMessage() {
            const message = messageInput.value.trim();
            if (message) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                messageElement.innerHTML = `
                    <span class="username">${username}</span>: ${message}
                `;

                chatMessages.appendChild(messageElement);
                messageInput.value = '';
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        sendButton.addEventListener('click', sendMessage);

        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    });


        </script>

        <!-- Incluez vos fichiers JavaScript après avoir déclaré la variable username -->
        <!-- <script src="JS/envoisms.js" defer></script> -->

</div>



    
</body>
</html>