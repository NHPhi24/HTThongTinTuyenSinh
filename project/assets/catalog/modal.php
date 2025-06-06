=<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập</title>

    <link rel="icon" href="./assets/img/logo.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <div class="container">

        <!-- Đăng nhập -->
        <div class="formpage" id="loginForm">
            <form action="/HTThongtintuyensinh/project/auth/login.php" method="POST" autocomplete="off">
                <h2>Login</h2>
                <div class="entryfield">
                    <span class="fa fa-user user"></span>
                    <input type="text" name="username" placeholder="Tên đăng nhập" required />
                </div>
                <div class="entryfield">
                    <span class="fa fa-lock lock"></span>
                    <input type="password" name="password" placeholder="Mật khẩu" required />
                    <span class="fa fa-eye-slash eye"></span>
                </div>

                <div class="forgetPw">
                    <span id="toggle-forgetPw">Forgot password?</span>
                </div>

                <div class="entryfield">
                    <input type="submit" name="Login" value="Login" />
                </div>

                <p class="newAccount">
                    Don't have an account? <span id="toggle-signup">Sign up now</span>
                </p>
            </form>
        </div>

        <!-- Đăng ký -->
        <div class="formpage hidden" id="signupForm">
            <form action="/HTThongtintuyensinh/project/otp_register.php" method="POST">
                <h2>Đăng ký</h2>
                <div class="entryfield">
                    <span class="fa fa-user user"></span>
                    <input type="text" name="Name" placeholder="Tên đăng nhập" required />
                </div>
                <div class="entryfield">
                    <span class="fa fa-user user"></span>
                    <input type="text" name="CCCD" placeholder="CCCD" required />
                </div>
                <div class="entryfield">
                    <span class="fa fa-user user"></span>
                    <input type="text" name="Email" placeholder="Email" required />
                </div>
                <div class="entryfield">
                    <span class="fa fa-lock lock"></span>
                    <input type="password" name="password" placeholder="Mật khẩu" required />
                    <span class="fa fa-eye-slash eye"></span>
                </div>
                <div class="entryfield">
                    <span class="fa fa-lock lock"></span>
                    <input type="password" name="confirm_pwd" placeholder="Nhập lại mật khẩu" required />
                    <span class="fa fa-eye-slash eye"></span>
                </div>
                <div class="entryfield">
                    <input type="submit"value="Đăng ký" />
                </div>

                <p class="newAccount">
                    Already have an account? <span id="toggle-signin">Sign in now</span>
                </p>
            </form>
        </div>

        <!-- Nhập mã OTP -->
        <div class="formpage hidden" id="otpForm">
            <form action="/HTThongtintuyensinh/project/auth/verify_otp.php" method="POST">
                <h2>Nhập mã xác nhận</h2>
                <p>Mã OTP đã được gửi đến email của bạn.</p>
                <div class="entryfield">
                    <input type="text" name="otp" placeholder="Nhập mã xác nhận" required />
                </div>
                <p id="countdown">Thời gian còn lại: <span id="timer">60</span> giây</p>
                <div class="entryfield">
                    <button type="submit" name="action" value="verify">Xác nhận</button>
                </div>
                <div class="entryfield">
                    <button type="submit" name="action" value="resend">Gửi lại mã</button>
                </div>
            </form>
        </div>

        <!-- Quên mật khẩu -->
        <div class="formpage hidden" id="forgotPwForm">
            <form action="/HTThongtintuyensinh/project/auth/forgot_password.php" method="POST">
                <h2>Khôi phục mật khẩu</h2>
                <p>Vui lòng nhập email đã đăng ký!</p>
                <div class="entryfield">
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="entryfield">
                    <input type="submit" value="Xác nhận" />
                </div>
                <div class="switch-form">
                    <p class="switch-form" id="back-to-login">Quay lại đăng nhập</p>
                </div>
            </form>
        </div>

        <!-- Đổi mật khẩu -->
        <div class="formpage hidden" id="changePwForm">
            <form action="/HTThongtintuyensinh/project/auth/change_password.php" method="POST">
                <h2>Đổi mật khẩu</h2>
                <div class="entryfield">
                    <span class="fa fa-lock lock"></span>
                    <input type="password" name="old_password" placeholder="Mật khẩu cũ" required />
                    <span class="fa fa-eye-slash eye"></span>
                </div>
                <div class="entryfield">
                    <span class="fa fa-lock lock"></span>
                    <input type="password" name="new_password" placeholder="Mật khẩu mới" required />
                    <span class="fa fa-eye-slash eye"></span>
                </div>
                <div class="entryfield">
                    <span class="fa fa-lock lock"></span>
                    <input type="password" name="confirm_new_password" placeholder="Nhập lại mật khẩu" required />
                    <span class="fa fa-eye-slash eye"></span>
                </div>
                <div class="entryfield">
                    <input type="submit" value="Xác nhận" />
                </div>
            </form>
        </div>

        <!-- Quay về trang chủ -->
        <div class="backhome">
            <span class="fas fa-home" id="back-to-index"></span>
        </div>

    </div>

    <script src="../js/login.js"></script>
</body>

</html>
