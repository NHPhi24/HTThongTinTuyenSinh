<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
$conn = new mysqli("localhost", "root", "", "htts");

//Đẩy dữ liệu từ form
$email = $_POST['email'];
$username = $_POST['UserID'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Tạo OTP
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;
$_SESSION['email'] = $email;
$_SESSION['UserID'] = $username;
$_SESSION['password'] = $password;

// Cấu hình gửi mail
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Host SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your_email@gmail.com';  // Tài khoản Gmail
    $mail->Password   = 'your_app_password';     // Mật khẩu ứng dụng Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Người gửi và người nhận
    $mail->setFrom('your_email@gmail.com', 'Tên Website');
    $mail->addAddress($email);

    // Nội dung
    $mail->isHTML(true);
    $mail->Subject = 'Xác thực OTP';
    $mail->Body    = "Xin chào $username,<br><br>Mã OTP của bạn là: <b>$otp</b><br><br>Vui lòng nhập mã này để hoàn tất đăng ký.";

    $mail->send();
    echo "Mã OTP đã được gửi tới email của bạn.";
    echo "<a href='verify.php'>Nhập mã OTP</a>";
} catch (Exception $e) {
    echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
}
?>
