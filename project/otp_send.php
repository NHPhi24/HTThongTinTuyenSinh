<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $email = $_SESSION['Email'] ?? null;

    if (!$email) {
        throw new Exception("Không có địa chỉ email để gửi OTP.");
    }

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'nguyenphi24032003@gmail.com';
    $mail->Password = 'ldsr vrvw kaxl zibx';  // ⚠️ Không nên công khai mật khẩu thật
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('nguyenphi24032003@gmail.com', 'Hệ thống xác thực');
    $mail->addAddress($email);

    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    $mail->isHTML(true);
    $mail->Subject = 'Mã OTP đăng ký';
    $mail->Body    = "Mã OTP của bạn là: <b>$otp</b>";

    $mail->send();

    header("Location: otp_verify.php");
    exit();
} catch (Exception $e) {
    echo 'Gửi mail thất bại. Lỗi: ' . $mail->ErrorInfo;
}