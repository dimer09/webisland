<?php
session_start(); // Démarrer la session

$current_stage = 1;
$stages_info = [];

// Connection to db
try {
    $pdo = new PDO('mysql:host=localhost;dbname=webisland', 'root', '');

    // Vérifiez si le username est enregistré dans la session
    if (!isset($_SESSION['username'])) {
        header('Location: logsign.html'); // Redirigez vers la page de connexion
        exit();
    }

    $username = $_SESSION['username'];

    // Récupérez le current_stage depuis la base de données pour cet utilisateur
    $stmt = $pdo->prepare("SELECT current_stage FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si l'utilisateur existe et a un current_stage
    if ($user) {
        $current_stage = (int)$user['current_stage'];
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
    <link rel="stylesheet" href="CSS/map.css">
    <title>Web Island</title>
</head>
<body>

    <div id="video-container">
        <video autoplay muted loop id="myVideo">
            <source src="Videos/video2.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>

    <nav class="navigation-bar">
    <div class="nav-container">
        <span class="nav-title">WEB ISLAND KINSHASA 02027</span>
        <ul class="nav-links">
            <li><a href="inde.php">Home</a></li>
            <li><a href="" >Map</a></li>
            <li><a href="forum.php">Forum</a></li>
            <li><a href="cours.php">Cours</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </div>
</nav>
        <div id="map-area">
            <table>
                <tr>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_01.png" alt=""></th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_02.png" alt=""></th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_03.png" alt=""></th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_04.png" alt=""></th>
                    <th class="map-part" id="part-4" style="position: relative;">
                        <img src="RESSOURCES/Images/MAP_PARTS/map_part_05.png" alt="">
                        <?php
                        echo "<div class='location-bubble column_1'>"; 
                        echo "</div>";
                        ?>
                            <span class="location-info">
                                Welcome to stage One : The Forest, you'll 
                                need more information about basic of web to pass 
                                this stage. 
                            </span>
                        </div>
                    </th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_06.png" alt=""></th>
                </tr>
                <tr>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_07.png" alt=""></th>
                    <th class="map-part" id="part-4" style="position: relative;">
                        <img src="RESSOURCES/Images/MAP_PARTS/map_part_08.png" alt="">
                        <div class="location-bubble" id="location1">
                        <?php
                        echo "<div class='location-bubble column_2'>"; 
                        echo "</div>";
                        ?>
                            <span class="location-info">
                                Welcome to stage Four : The Forest, you'll 
                                need more information about basic of web to pass 
                                this stage.
                            </span>
                        </div>
                    </th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_09.png" alt=""></th>
                    <th class="map-part" id="part-4" style="position: relative;">
                        <img src="RESSOURCES/Images/MAP_PARTS/map_part_10.png" alt="">
                        <div class="location-bubble" id="location1">
                            <?php
                            echo "<div class='location-bubble column_3'>"; 
                            echo "</div>";
                            ?>
                            <span class="location-info">
                                Welcome to stage three : The Forest, you'll 
                                need more information about basic of web to pass 
                                this stage.
                            </span>
                        </div>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_11.png" alt=""></th>
                    <th class="map-part" id="part-4" style="position: relative;">
                        <img src="RESSOURCES/Images/MAP_PARTS/map_part_12.png" alt="">
                        <div class="location-bubble" id="location1">
                        <?php
                        echo "<div class='location-bubble column_4'>"; 
                        echo "</div>";
                        ?>
                            <span class="location-info">
                                Welcome to stage five : The Forest, you'll 
                                need more information about basic of web to pass 
                                this stage.
                            </span>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_13.png" alt=""></th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_14.png" alt=""></th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_15.png" alt=""></th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_16.png" alt=""></th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_17.png" alt=""></th>
                    <th><img src="RESSOURCES/Images/MAP_PARTS/map_part_18.png" alt=""></th>
                </tr>
            </table>
        
                      
        </div>
    </div>
    <script src="JS/mapScript.js"></script> 
</body>
</html>
    
