document.addEventListener("DOMContentLoaded", () => {
  // Tạo HTML
  const chatHTML = `
    <div class="chat-button" id="chatButton"><img src="./img/mess.jpeg" alt="chat"></div>
    <div class="chat-box" id="chatBox">
      <div class="chat-header">
        <p>Chat</p>
        <button class="closeChat fa-solid fa-xmark" id="closeChat"></button>
      </div>
      <div class="chat-content" id="chatContent">
        
      </div>

      <div class="chat-quick-options" id="chatQuickOptions">
        <button class="quick-option"></button>
        <button class="quick-option"></button>
        <button class="quick-option"></button>
      </div>
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
    //localStorage.removeItem('chatMessages')
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
  const message = chatInput.value.trim().toLowerCase();
    if (message) {
      displayMessage(message, 'user');
      saveMessage(message, 'user');
      chatInput.value = '';

      setTimeout(() => {
        let reply = "Xin lỗi, tôi chưa hiểu câu hỏi của bạn.";

        switch (true) {
          case message.includes("") || message.includes(""):
            reply = "";
            break;
        }

        displayMessage(reply, 'admin');
        saveMessage(reply, 'admin');
      }, 1000);
    }
  });

  chatInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') sendMessageButton.click();
  });

  const quickOptions = document.querySelectorAll('.quick-option');

  quickOptions.forEach(option => {
    option.addEventListener('click', () => {
      const message = option.textContent;
      displayMessage(message, 'user');
      saveMessage(message, 'user');

      setTimeout(() => {

        if (message.includes("")) {
          reply = "";
          pageLink = "";
        } else if (message.includes("")) {
          reply = "";
        } else if (message.includes("")) {
          reply = "";
        }

        displayMessage(reply, 'admin');
        saveMessage(reply, 'admin');
      }, 1000);
    });
  });
});



