<?php
// form.php
session_start();

$host = 'localhost'; // ou l'adresse de votre serveur de base de données
$dbname = 'webisland';
$username = 'root';
$password = '';

// Connection à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $conn->real_escape_string($_POST['username']);
    session_start();
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hacher le mot de passe

    // Insérer les données dans la base de données
    $sql = "INSERT INTO Users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Rediriger l'utilisateur vers map.html
        header('Location: ../inde.php');
        exit();
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
