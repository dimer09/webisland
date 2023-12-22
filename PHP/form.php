<?php
// form.php
session_start();

$host = 'localhost'; // ou l'adresse de votre serveur de base de données
$dbname = 'webisland';
$db_username = 'root';
$db_password = '';

// Connection à la base de données
$conn = new mysqli($host, $db_username, $db_password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hacher le mot de passe

    // Vérifier si l'username ou l'email existe déjà
    $sql_check = "SELECT * FROM Users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {

        header('Location: ../logsign.html');
       
        
    } else {
        // Insérer les données dans la base de données
        $sql_insert = "INSERT INTO Users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql_insert) === TRUE) {
            // Rediriger l'utilisateur vers La page d accueil
            header('Location: ../inde.php');
            exit();
        } else {
            echo "Erreur : " . $sql_insert . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
