document.addEventListener("DOMContentLoaded", () => {
  // Tạo HTML
  const chatHTML = `
    <div class="chat-button" id="chatButton"></div>
    <div class="chat-box" id="chatBox">
      <div class="chat-header">
        <p>Chat</p>
        <button class="closeChat fa-solid fa-xmark" id="closeChat"></button>
      </div>
      <div class="chat-content" id="chatContent"></div>
      <div class="chat-input-area">
        <input type="text" id="chatInput" placeholder="Type a message..." />
        <button id="sendMessage">Send</button>
      </div>
    </div>
  `;
  document.body.insertAdjacentHTML("beforeend", chatHTML);

  
  const chatButton = document.getElementById('chatButton');
  const chatBox = document.getElementById('chatBox');
  const closeChat = document.getElementById('closeChat');
  const chatInput = document.getElementById('chatInput');
  const sendMessageButton = document.getElementById('sendMessage');
  const chatContent = document.getElementById('chatContent');

  chatButton.addEventListener('click', () => {
    chatBox.style.display = 'flex';
    loadMessages();
  });

  closeChat.addEventListener('click', () => {
    chatBox.style.display = 'none';
  });

  function displayMessage(message, sender) {
    const msg = document.createElement('div');
    msg.classList.add('chat-message', sender === 'user' ? 'user-message' : 'admin-message');
    msg.textContent = message;
    chatContent.appendChild(msg);
    chatContent.scrollTop = chatContent.scrollHeight;
  }

  function saveMessage(message, sender) {
    const messages = JSON.parse(localStorage.getItem('chatMessages')) || [];
    messages.push({ message, sender });
    localStorage.setItem('chatMessages', JSON.stringify(messages));
  }

  function loadMessages() {
    chatContent.innerHTML = '';
    const messages = JSON.parse(localStorage.getItem('chatMessages')) || [];
    messages.forEach(({ message, sender }) => displayMessage(message, sender));
  }

  sendMessageButton.addEventListener('click', () => {
    const message = chatInput.value.trim();
    if (message) {
      displayMessage(message, 'user');
      saveMessage(message, 'user');
      chatInput.value = '';
      setTimeout(() => {
        const reply = "Cảm ơn bạn đã nhắn!";
        displayMessage(reply, 'admin');
        saveMessage(reply, 'admin');
      }, 1000);
    }
  });

  chatInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') sendMessageButton.click();
  });
});
