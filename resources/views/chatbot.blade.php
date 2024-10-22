<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chatbot</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f7f6;
      margin: 0;
      padding: 0;
    }
    .chat-container {
      max-width: 600px;
      margin: 30px auto;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      display: flex;
      flex-direction: column;
    }
    .chat-header {
      background-color: #4CAF50;
      padding: 15px;
      color: white;
      text-align: center;
    }
    .chat-body {
      padding: 15px;
      height: 400px;
      overflow-y: auto;
      border-bottom: 1px solid #e1e1e1;
    }
    .chat-message {
      margin-bottom: 15px;
      display: flex;
    }
    .chat-message p {
      padding: 10px;
      border-radius: 10px;
      max-width: 70%;
    }
    .chat-message.user p {
      background-color: #DCF8C6;
      margin-left: auto;
    }
    .chat-message.bot p {
      background-color: #F1F0F0;
    }
    .chat-footer {
      display: flex;
      padding: 10px;
      background-color: #f4f7f6;
    }
    .chat-footer input {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .chat-footer button {
      padding: 10px;
      background-color: #4CAF50;
      border: none;
      color: white;
      border-radius: 5px;
      margin-left: 10px;
    }
  </style>
</head>
<body>

  <div class="chat-container">
    <div class="chat-header">
      Chatbot
    </div>
    <div class="chat-body" id="chat-body">
      <!-- Chat messages will appear here -->
    </div>
    <div class="chat-footer">
      <input type="text" id="user-input" placeholder="Type a message..." />
      <button onclick="sendMessage()">Send</button>
    </div>
  </div>

  <script>
    const chatBody = document.getElementById('chat-body');
    const userInput = document.getElementById('user-input');

    function sendMessage() {
      const message = userInput.value.trim();
      if (message) {
        addMessageToChat('user', message);
        userInput.value = '';

        // Call the Laravel API for the chatbot
        fetch('/api/chatbot', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token if needed for security
          },
          body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
          addMessageToChat('bot', data.response);
        })
        .catch(error => {
          addMessageToChat('bot', 'Sorry, something went wrong.');
        });
      }
    }

    function addMessageToChat(sender, message) {
      const messageElement = document.createElement('div');
      messageElement.classList.add('chat-message', sender);
      messageElement.innerHTML = `<p>${message}</p>`;
      chatBody.appendChild(messageElement);
      chatBody.scrollTop = chatBody.scrollHeight;
    }
  </script>

</body>
</html>
