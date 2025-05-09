// Chuyển đổi giữa các form
const urlParams = new URLSearchParams(window.location.search);
const formType = urlParams.get("form");

// Thêm vào các form .hidden để ẩn tất cả các form
function hideAllForms() {
    document.getElementById("loginForm").classList.add("hidden");
    document.getElementById("signupForm").classList.add("hidden");
    document.getElementById("forgotPwForm").classList.add("hidden");
    document.getElementById("otpForm").classList.add("hidden");
}

function showForm(formId) {
    hideAllForms();
    document.getElementById(formId).classList.remove("hidden");
}

// Hiển thị form theo URL ban đầu
switch (formType) {
    case "login":
        showForm("loginForm");
        break;
    case "signup":
        showForm("signupForm");
        break;
    default:
        showForm("loginForm");
}

// Giao diện chuyển form bằng click dòng chữ
document.getElementById("toggle-signup").addEventListener("click", () => showForm("signupForm"));
document.getElementById("toggle-signin").addEventListener("click", () => showForm("loginForm"));
document.getElementById("toggle-forgetPw").addEventListener("click", () => showForm("forgotPwForm"));
document.getElementById("back-to-login").addEventListener("click", () => showForm("loginForm"));


document.getElementById("back-to-index").addEventListener("click", () => {
    window.location.href = "index.html"; // Đường dẫn đến trang chủ
});

// Chức năng ẩn hiển mật khẩu
const eyeIcon = document.querySelector('.eye');
const passwordInput = document.querySelector('input[type="password"]');

// Thêm sự kiện click vào icon mắt
eyeIcon.addEventListener('click', function () {
    // Kiểm tra nếu mật khẩu đang bị ẩn
    if (passwordInput.type === 'password') {
        // Thay đổi type thành text để hiển thị mật khẩu
        passwordInput.type = 'text';
        // Thay đổi icon thành mắt mở
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    } else {
        // Thay đổi type thành password để ẩn mật khẩu
        passwordInput.type = 'password';
        // Thay đổi icon thành mắt nhắm
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    }
});