<?php
// form.php
session_start();

$host = 'localhost'; // ou l'adresse de votre serveur de base de données
$dbname = 'webisland';
$dbUsername = 'root';
$dbPassword = '';

// Connection à la base de données
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Récupérer le mot de passe sans le hacher
   

    // Préparer une requête pour vérifier si l'utilisateur existe
    $sql = "SELECT * FROM Users WHERE username = '$username'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // L'utilisateur existe, vérifier le mot de passe
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            // Le mot de passe est correct, rediriger vers la page souhaitée
            $_SESSION['username'] = $username;
            $_SESSION['current_stage'] = $user['current_stage'];
            header('Location: ../inde.php');
            exit();
        } else {
            echo "Mot de passe incorrect";
            header('Location: ../sign.html');
        }
    } else {
        echo "Aucun utilisateur trouvé avec ce nom d'utilisateur";
        header('Location: ../sign.html');
    }
}

$conn->close();
?>
