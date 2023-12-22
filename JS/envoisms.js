document.addEventListener('DOMContentLoaded', function() {
    const chatMessages = document.getElementById('chatMessages');
    const userList = document.querySelector('.user-list ul');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const spacename = document.getElementById('space_name');
    const users = document.querySelectorAll('.user');
    let currentReceiver = ''; 

    function setActiveUser(activeElement) {
        users.forEach(user => {
            if (user === activeElement) {
                user.classList.add('active');
                user.classList.remove('inactive');
            } else {
                user.classList.add('inactive');
                user.classList.remove('active');
            }
        });
    }

    userList.addEventListener('click', function(event) {
        const clickedUser = event.target.closest('.user');
        if (clickedUser) {
            const userName = clickedUser.querySelector('.username').textContent;
            loadUserMessages(userName);
            setActiveUser(clickedUser); // Définir l'utilisateur comme actif
        }
    });

    // Définir initialement le premier utilisateur comme actif
    if (users.length > 0) {
        setActiveUser(users[0]);
    }
    
    // Fonction pour charger les discussions de l'utilisateur sélectionné
    function loadUserMessages(userName) {
        spacename.innerHTML = `<p class="chat-header" >${userName}</p>`;
        currentReceiver = userName; // Mise à jour de l'utilisateur actuel sélectionné
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                displayMessages(this.responseText);
            }
        };
        xhr.open("GET", "loadMessages.php?user=" + userName, true);
        xhr.send();
    }
    
    // Fonction pour afficher les messages
    function displayMessages(jsonData) {
        const chatMessages = document.getElementById('chatMessages');
        const messages = JSON.parse(jsonData); // Convertir le JSON en objet JavaScript
        chatMessages.innerHTML = ''; // Effacer les anciens messages
    
        messages.forEach(function(message) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message');
    
            //vérifier si le receiver est 'forum'
            if (message.receiver.toLowerCase() === 'forum') {
                // Ajouter le nom de l'utilisateur qui a envoyé le message au forum
                messageElement.innerHTML = `
                    <span class="username">${message.sender}</span>
                    <span class="message-content">${message.message}</span>
                    <span class="message-time">${new Date(message.timestamp).toLocaleTimeString()}</span>
                `;
            } else {
                
                const messageType = message.sender === username ? 'sent' : 'received';
                messageElement.classList.add(messageType);
                messageElement.innerHTML = `
                    <span class="message-content">${message.message}</span>
                    <span class="message-time">${new Date(message.timestamp).toLocaleTimeString()}</span>
                `;
            }
    
            chatMessages.appendChild(messageElement);
        });
    
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    
    // Fonction pour envoyer un message
    function sendMessage() {
        const messageText = messageInput.value.trim();
        if (messageText && currentReceiver) {
            const data = new FormData();
            data.append('sender', username); // L'utilisateur actuellement connecté
            data.append('receiver', currentReceiver);
            data.append('message', messageText);
    
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    loadUserMessages(currentReceiver);
                }
            };
            xhr.open("POST", "sendMessage.php", true);
            xhr.send(data);
    
            messageInput.value = '';
        }
    }
    
    // Ajouter un écouteur d'événements à votre liste d'utilisateurs
    userList.addEventListener('click', function(event) {
        if (event.target.closest('.user')) {
            const userName = event.target.closest('.user').querySelector('.username').textContent;
            loadUserMessages(userName);
        }
    });
    
    // Écouteur d'événement pour le bouton d'envoi
    sendButton.addEventListener('click', sendMessage);
    
    // Écouteur d'événement pour la touche 'Enter'
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
});
