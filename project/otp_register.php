<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
include("config/connect.php");

//Nhận dữ liệu từ form
$email = $_SESSION['Email'];
$username = $_SESSION['UserID'];
$password = password_hash($_SESSION['Password'], PASSWORD_DEFAULT);

// Tạo OTP
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;
$_SESSION['Email'] = $email;
$_SESSION['UserID'] = $username;
$_SESSION['Password'] = $password;

// Cấu hình gửi mail
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Host SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'duyquynguyen2003@gmail.com';  // Tài khoản Gmail
    $mail->Password   = 'duyquy2472003';     // Mật khẩu ứng dụng Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Người gửi và người nhận
    $mail->setFrom('duyquynguyen2003@gmail.com', 'HTThongtintuyensinh');
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
