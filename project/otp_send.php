<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
//require 'PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/SMTP.php';
//require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    // Server settings
        $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'a04e22f2eaaa31';
    $mail->Password   = '4a149394d8561e';
    $mail->Port       = 587;

    $mail->setFrom('test@example.com', 'Mailer');
    $mail->addAddress('duyquynguyen2003@gmail.com');
    $mail->isHTML(true);

    // Nội dung
    $otp = rand(100000, 999999);
    $mail->isHTML(true);
    $mail->Subject = 'Mã OTP của bạn';
    $mail->Body    = "<h3>OTP của bạn là: <strong>$otp</strong></h3>";

    $mail->send();
    echo "Đã gửi OTP thành công: $otp";
} catch (Exception $e) {
    echo "Gửi mail thất bại. Lỗi: {$mail->ErrorInfo}";
};