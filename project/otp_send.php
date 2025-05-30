<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';  // Sửa lại cho đúng SMTP server của bạn
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@example.com';  // Email gửi OTP
    $mail->Password = 'your_password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('your_email@example.com', 'OTP Service');
    $mail->addAddress($_SESSION["email"]);

    $mail->isHTML(true);
    $mail->Subject = 'Your OTP Code';
    $mail->Body    = 'Mã OTP của bạn là: <b>' . $_SESSION["otp"] . '</b>';

    if (!$mail->send()) {
        echo 'Lỗi gửi email: ' . $mail->ErrorInfo;
        exit();
    }
} catch (Exception $e) {
    echo "Gửi mail thất bại. Lỗi: {$mail->ErrorInfo}";
    exit();
}
?>
