<?php
$host = 'localhost'; //  serveur de base de données
$db   = 'webisland'; // le nom  de données
$user = 'root'; //  d'utilisateur pour la base de données
$pass = ''; // le mot de passe pour l'utilisateur de la base de données
$charset = 'utf8mb4'; // le jeu de caractères à utiliser

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
