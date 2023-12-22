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
                    <source src="Videos/video1.mp4" type="video/mp4">
                </video>
                <div class="video-overlay"></div>
            <header class="main-header">
                <div class="title">WEB ISLAND KINSHASA O2027</div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="inde.php">Home</a></li>
                        <li><a href="map.php">Map</a></li>
                        <li><a href="forum.php">forum</a></li>
                        <li><a href="cours.php">Courses</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </header>
                    <aside class="user-list">
                        <ul>
                            <li class="user">
                                <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                                <span class="username">Marie-Madeleine</span>
                            </li>
                            <li class="user">
                                <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                                <span class="username">Joyeux</span>
                            </li>
                            <li class="user">
                                <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                                <span class="username">John-Larry </span>
                            </li>
                            <li class="user">
                                <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                                <span class="username">Jonathan</span>
                            </li>
                            <li class="user">
                                <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                                <span class="username">Merdi</span>
                            </li>
                            <li class="user">
                                <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                                <span class="username">forum</span>
                            </li>
                            <li class="user">
                                <img src="RESSOURCES/Images/user.png" alt="Profile" class="profile-pic">
                                <span class="username">Renard</span>
                            </li>
                        </ul>
                    </aside>

                    <!-- Espace de chat -->
                    <section class="chat-space">
                        <span class="space_name" id="space_name"></span>
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
