// ----- 1. Xử lý chuyển đổi form theo URL và click -----
const urlParams = new URLSearchParams(window.location.search);
const formType = urlParams.get("form");

function hideAllForms() {
    const forms = ["loginForm", "signupForm", "forgotPwForm", "otpForm", "changePwForm"];
    forms.forEach(id => {
        const form = document.getElementById(id);
        if (form) form.classList.add("hidden");
    });
}

function showForm(formId) {
    hideAllForms();
    const form = document.getElementById(formId);
    if (form) form.classList.remove("hidden");
}

// Hiển thị form theo URL
switch (formType) {
    case "login": showForm("loginForm"); break;
    case "signup": showForm("signupForm"); break;
    case "changePw": showForm("changePwForm"); break;
    default: showForm("loginForm"); break;
}

// Các nút chuyển form
document.getElementById("toggle-signup")?.addEventListener("click", () => showForm("signupForm"));
document.getElementById("toggle-signin")?.addEventListener("click", () => showForm("loginForm"));
document.getElementById("toggle-forgetPw")?.addEventListener("click", () => showForm("forgotPwForm"));
document.getElementById("back-to-login")?.addEventListener("click", () => showForm("loginForm"));
document.getElementById("back-to-index")?.addEventListener("click", () => {
    window.location.href = "/HTThongtintuyensinh/project/index.php";
});

// ----- 2. Ẩn/hiện mật khẩu cho tất cả các field -----
document.querySelectorAll('.eye').forEach(eyeIcon => {
    eyeIcon.addEventListener('click', () => {
        const passwordInput = eyeIcon.previousElementSibling;
        if (passwordInput && passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    });
});

// ----- 3. Countdown OTP nếu có form OTP -----
const timerEl = document.getElementById("timer");
if (timerEl) {
    let timeLeft = 60;
    const countdown = setInterval(() => {
        timeLeft--;
        timerEl.textContent = timeLeft;
        if (timeLeft <= 0) {
            clearInterval(countdown);
            timerEl.textContent = "Hết thời gian";
        }
    }, 1000);
}
// ----- 4. Hiển thị thông báo lỗi nếu có -----
const errorMessage = urlParams.get("error");