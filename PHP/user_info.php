<?php
// path_to_your_server_endpoint_to_get_user_info.php
session_start(); // Démarrer la session PHP

// Assurez-vous que l'utilisateur est connecté avant de procéder
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Effectuez votre requête à la base de données ici pour récupérer les informations de l'utilisateur
    // ...
    // Puis renvoyez ces informations au front-end
    echo json_encode($userInfo); // $userInfo est un tableau associatif contenant les informations de l'utilisateur
} else {
    // Si l'utilisateur n'est pas connecté, renvoyez un message d'erreur
    echo json_encode(['error' => 'User not logged in']);
}
