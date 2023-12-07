<?php
session_start(); // Démarrer la session

// Vérifiez si le username est enregistré dans la session
if (!isset($_SESSION['username'])) {
    // Si le username n'est pas dans la session, renvoyez une erreur ou redirigez
    exit('Utilisateur non connecté');
}
echo 'l user is connected';
$username = $_SESSION['username'];

// Connectez-vous à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=webisland', 'root', '');

    // D'abord, récupérez le current_stage actuel pour ce username
    $stmt = $pdo->prepare("SELECT current_stage FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifiez si le username existe dans la base de données
    if ($result) {
        $current_stage = (int)$result['current_stage'];
        $current_stage++; // Incrémentez la valeur de current_stage

        // Maintenant, mettez à jour le current_stage dans la base de données pour l'utilisateur
        $updateStmt = $pdo->prepare("UPDATE users SET current_stage = :current_stage WHERE username = :username");
        $updateStmt->execute(['current_stage' => $current_stage, 'username' => $username]);

        echo "Stage mis à jour avec succès pour l'utilisateur $username";

        // Après la mise à jour de la base de données...
        if ($updateStmt->execute(['current_stage' => $current_stage, 'username' => $username])) {
            // Mettez à jour la variable de session avec le nouveau current_stage
            $_SESSION['current_stage'] = $current_stage;
            $_SESSION['username'] = $username;
            echo "Stage mis à jour avec succès pour l'utilisateur $username";
        } else {
            echo "Erreur lors de la mise à jour du stage.";
        }

    } else {
        exit('Utilisateur introuvable dans la base de données');
    }
    
} catch (PDOException $e) {
    exit("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
