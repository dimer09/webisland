<?php
session_start();
require 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
 
    $sender = $_SESSION['username'];
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];
    $timestamp = date('Y-m-d H:i:s'); 

    $stmt = $pdo->prepare("INSERT INTO messages (sender, receiver, message, timestamp) VALUES (?, ?, ?, ?)");
    $stmt->execute([$sender, $receiver, $message, $timestamp]);

    echo "Message sent";
} else {
    echo "No POST data received";
}

?>

