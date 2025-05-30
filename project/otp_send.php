<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $email = $_SESSION['email'] ?? null;

    if (!$email) {
        throw new Exception("Không có địa chỉ email để gửi OTP.");
    }

    // Cấu hình PHPMailer
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'duyquynguyen2003@gmail.com'; // Email gửi
    $mail->Password = 'zdnc vpzi izqt ugfs'; // Mật khẩu ứng dụng
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('duyquynguyen2003@gmail.com', 'Tên của bạn');
    $mail->addAddress($email); // Gửi tới email đã lưu

    $otp = rand(100000, 999999); // Tạo OTP
    $_SESSION['otp'] = $otp;

    $mail->isHTML(true);
    $mail->Subject = 'Mã OTP đăng ký';
    $mail->Body    = "Mã OTP của bạn là: <b>$otp</b>";

    $mail->send();
    echo 'Đã gửi OTP tới email của bạn.';
} catch (Exception $e) {
    echo 'Gửi mail thất bại. Lỗi: ', $mail->ErrorInfo;
}
?>
