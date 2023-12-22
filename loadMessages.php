<?php

session_start();
require 'db_connect.php'; 


if (!isset($_SESSION['username'])) {
  
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

$sender = $_SESSION['username']; // Nom d'utilisateur connecté
$receiver = $_GET['user'];
$messages = [];

if ($receiver == 'forum') {
    
    $stmt = $pdo->prepare(
        "SELECT sender, receiver, message, timestamp 
         FROM messages 
         WHERE receiver = 'forum' 
         ORDER BY `timestamp` ASC"
    );
    $stmt->execute();
} else {
   
    $stmt = $pdo->prepare(
        "SELECT sender, receiver, message, timestamp 
         FROM messages 
         WHERE (receiver = :username AND sender = :usernametwo) 
            OR (receiver = :usernamethree AND sender = :usernamefour) 
         ORDER BY `timestamp` ASC"
    );

    
    $stmt->execute(['username' => $receiver, 
                    'usernametwo' => $sender,
                    'usernamethree' => $sender,
                    'usernamefour' => $receiver]);
}

$messages = $stmt->fetchAll();

// Encoder les messages en JSON et les renvoyez au client
header('Content-Type: application/json'); // Informer le navigateur renvoie du JSON
echo json_encode($messages);

?>
