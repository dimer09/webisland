
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chatMessages');
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        console.log({ chatMessages, messageInput, sendButton });
        // const username = "<?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>"; 
        // Utilisez 'Guest' comme nom par défaut
       
        console.log('Nom d\'utilisateur :', username);
        

        function sendMessage() {
            const message = messageInput.value.trim();
            if (message) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                messageElement.innerHTML = `
                    <span class="username">${username}</span>: ${message}
                `;

                chatMessages.appendChild(messageElement);
                messageInput.value = '';
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        sendButton.addEventListener('click', sendMessage);

        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    });

