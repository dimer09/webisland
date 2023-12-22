<?php
session_start(); // Démarrer la session


try {
    $pdo = new PDO('mysql:host=localhost;dbname=webisland', 'root', '');

    
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Récuperation du current_stage depuis la base de données 
        $stmt = $pdo->prepare("SELECT current_stage FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si l'utilisateur existe et a un current_stage
        $current_stage = $user ? (int)$user['current_stage'] : 1;
        echo $current_stage;
    } else {

        header('Location: ../PAGES/logsign.html'); // Rediriger vers la page de connexion
        exit();
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}


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
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/6573496707843602b8ffc6e2/1hh55dftd';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

    <div id="video-container">
        <video autoplay muted loop id="myVideo">
            <source src="Videos/video1.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    

        <div class="flex-container">
            <header>
                <nav>
                    <div class="nav-title">WEB ISLAND KINSHASA O2027</div>
                    <ul class="nav-links">
                        <li><a href="">Home</a></li>
                        <li><a href="map.php">Map</a></li>
                        <li><a href="forum.php">Forum</a></li>
                        <li><a href="cours.php">Courses</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
                <h1>
                    <?php

                        echo "<div class='stage'>";
                       
                        // affiche run message personnalisé
                        if (isset($_SESSION['username'])) {
                            echo "Welcome, " . htmlspecialchars($_SESSION['username']);
                        } else {
                            echo "Our Trip to Web Island";
                        }
                        echo "</div>";
                         // Si current_stage n'est pas défini, utiliser 1 par défaut
                        $total_stages = 5; 
                        echo "<div class='stages-container'>";

                        for ($stage = 1; $stage <= $total_stages; $stage++) {
                            $stage_class = $stage <= $current_stage ? "" : " locked";
                            $info_text = $stage <= $current_stage ? "Informations sur The Great Tree" : "This stage is locked";
                            echo "<div class='column column_$stage$stage_class'>";
                            echo "<h2>Visit $stage</h2>";
            
                            if ($stage <= $current_stage) {
                                // L'étape est débloquée
                                echo "<a href='stage$stage.php'>"; 
                            }
            
                       
                            echo "cick me";
            
                            if ($stage <= $current_stage) {
                                // Fermer la balise <a> si l'étape est débloquée
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
                <script src="JS/getUserInfo.js"></script> 
                <script>
       
                    getUserInfo().then(userInfo => {
                        if (userInfo.error) {
                            console.error(userInfo.error);
                           
                        } else {
                  
                            window.current_stage = userInfo.current_stage;
                            
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

        </div>
</body>
</html>