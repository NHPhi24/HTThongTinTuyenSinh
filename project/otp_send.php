<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Kiểm tra xem có email trong session không
    $email = $_SESSION['email'] ?? null;

    if (!$email) {
        throw new Exception("Không có địa chỉ email để gửi OTP.");
    }

    // Cấu hình server SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@gmail.com';         // ⚠️ Đổi thành email của bạn
    $mail->Password = 'your_app_password';            // ⚠️ Đổi thành mật khẩu ứng dụng Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Người gửi và người nhận
    $mail->setFrom('your_email@gmail.com', 'Tên người gửi');
    $mail->addAddress($email);

    // Tạo mã OTP và lưu vào session
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    // Thiết lập nội dung email
    $mail->isHTML(true);
    $mail->Subject = 'Mã OTP đăng ký';
    $mail->Body    = "Mã OTP của bạn là: <b>$otp</b>";

    $mail->send();
    echo 'Đã gửi OTP tới email của bạn.';
} catch (Exception $e) {
    echo 'Gửi mail thất bại. Lỗi: ' . $e->getMessage();
}
?>
