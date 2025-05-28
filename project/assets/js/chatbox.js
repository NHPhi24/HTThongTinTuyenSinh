document.addEventListener("DOMContentLoaded", () => {
  // Tạo HTML
    const chatHTML = `
      <div class="chat-button" id="chatButton"><img src="./assets/img/mess.jpeg" alt="chat"></div>
      <div class="chat-box" id="chatBox">
        <div class="chat-header">
          <p>Chat</p>
          <button class="closeChat fa-solid fa-xmark" id="closeChat"></button>
        </div>
        <div class="chat-content" id="chatContent">
          
        </div>

        <div class="chat-quick-options" id="chatQuickOptions">
          <button class="quick-option">Phí xét tuyển</button>
          <button class="quick-option">Hình thức đăng ký</button>
          <button class="quick-option">Thời gian xét tuyển</button>
          <button class="quick-option">Các ngành hot</button>
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
    const quickOptions = document.querySelectorAll('.quick-option');

    chatButton.addEventListener('click', () => {
      chatBox.style.display = 'flex';
      //localStorage.removeItem('chatMessages');
      loadMessages();
      chatInput.focus();
    });

    closeChat.addEventListener('click', () => {
      chatBox.style.display = 'none';
    });

    sendMessageButton.addEventListener('click', handleUserMessage);
    chatInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') handleUserMessage();
    });

    quickOptions.forEach(option => {
      option.addEventListener('click', () => {
        handleQuickOption(option.textContent);
      });
    });

    function handleUserMessage() {
      const message = chatInput.value.trim();
      if (!message) return;

      appendMessage(message, 'user');
      saveMessage(message, 'user');
      chatInput.value = '';

      setTimeout(() => autoReply(message), 1000);
    }

    function handleQuickOption(message) {
      appendMessage(message, 'user');
      saveMessage(message, 'user');

      setTimeout(() => autoReply(message), 1000);
    }

    function autoReply(message) {
      let reply = "Xin lỗi, tôi chưa hiểu câu hỏi của bạn.";
      message = message.toLowerCase();

      if (message.includes("phí xét tuyển")) {
        reply = "Phí xét tuyển là 20.000 đồng/nguyện vọng.";
      }else if (message.includes("thời gian xét tuyển") ) {
        reply = "Thời gian xét tuyển thường bắt đầu từ tháng 6 hàng năm.";
      } else if (message.includes("hình thức đăng ký")) {
        reply = "Đăng ký trực tiếp hoặc đăng ký xét tuyển trực tuyến qua website chính thức của trường.";
      } else if (message.includes("xét học bạ")) {
        reply = "Trường có xét tuyển bằng học bạ THPT theo nhiều phương thức khác nhau.";
      } else if (message.includes("nguyện vọng")) {
        reply = "Bạn có thể đăng ký nhiều nguyện vọng, không giới hạn số lượng. Nguyện vọng được xét theo thứ tự ưu tiên.";
      }else if (message.includes("hồ sơ")) {
        reply = "Hồ sơ đăng ký gồm: phiếu đăng ký xét tuyển, học bạ, bằng tốt nghiệp (hoặc giấy chứng nhận tốt nghiệp tạm thời), giấy tờ ưu tiên (nếu có).";
      } else if (message.includes("nộp hồ sơ")) {
        reply = "Bạn có thể nộp hồ sơ trực tuyến qua hệ thống tuyển sinh của trường trên website chính thức.";
      } else if (message.includes("sau khi đăng ký")) {
        reply = "Sau khi đăng ký, bạn cần theo dõi thông báo kết quả xét tuyển trên website và chuẩn bị hồ sơ nhập học khi trúng tuyển.";
      }else if (message.includes("công nghệ thông tin") || message.includes("cntt")) {
        reply = "Ngành Công nghệ Thông tin bao gồm các môn học chính như: Lập trình, Cấu trúc dữ liệu và giải thuật, Cơ sở dữ liệu, Mạng máy tính, Hệ điều hành, Trí tuệ nhân tạo, Phát triển phần mềm, An ninh mạng và nhiều môn thực hành khác.";
      }else if (message.includes("ngành hot") || message.includes("dễ xin việc")) {
        reply = "Hiện nay, các ngành như Công nghệ Thông tin, Kinh tế, Quản trị Kinh doanh, Marketing, và Logistics đang rất “hot” và có nhiều cơ hội việc làm.";
      }

      appendMessage(reply, 'admin');
      saveMessage(reply, 'admin');
    }

    function appendMessage(message, sender) {
      const msg = document.createElement('div');
      msg.className = `chat-message ${sender === 'user' ? 'user-message' : 'admin-message'}`;
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
      messages.forEach(({ message, sender }) => appendMessage(message, sender));
    }
});


