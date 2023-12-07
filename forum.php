<?php 

    session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/forum.css">
    <title>Forum Web Island</title>
    
</head>
<body>

    <div id="video-container">
        <video autoplay muted loop id="myVideo">
            <source src="Videos/video2.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    <header class="main-header">
        <div class="title">WEB ISLAND KINSHASA O2027</div>
        <nav class="main-nav">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
                
            

            <aside class="user-list">
                <ul>
                    <!-- Répétez cet élément li pour chaque utilisateur -->
                    <li class="user">
                        <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                        <span class="username">Marie-Madeleine</span>
                    </li>
                    <li class="user">
                        <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                        <span class="username">Marie-Madeleine</span>
                    </li>
                    <li class="user">
                        <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                        <span class="username">Marie-Madeleine</span>
                    </li>
                    <li class="user">
                        <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                        <span class="username">Marie-Madeleine</span>
                    </li>
                    <li class="user">
                        <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                        <span class="username">Marie-Madeleine</span>
                    </li>
                    <li class="user">
                        <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                        <span class="username">Marie-Madeleine</span>
                    </li>
                    <li class="user">
                        <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                        <span class="username">Marie-Madeleine</span>
                    </li>
                    <!-- Ajoutez plus d'utilisateurs ici -->
                </ul>
            </aside>

            <!-- Espace de chat -->
            <section class="chat-space">
                <div class="chat-messages" id="chatMessages">
                    <!-- Les messages seront ajoutés ici -->
                </div>
                <div class="chat-input">
                    <input type="text" id="messageInput" placeholder="Type your message here...">
                    <button id="sendButton">Send</button>
                </div>
            




        </section>
    </div>
    <script>
        var username = <?php echo json_encode($_SESSION['username'] ?? 'Guest'); ?>;
    </script>
    <script src="JS/envoisms.js" defer></script>
</body>
</html>
