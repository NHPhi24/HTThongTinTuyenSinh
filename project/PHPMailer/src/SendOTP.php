<?php
session_start();
require 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];
    $otp = rand(100000, 999999);
    $_SESSION['email'] = $email;

    // Lưu vào database
    $stmt = $conn->prepare("INSERT INTO otps (email, otp) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $stmt->close();

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@gmail.com';
        $mail->Password   = 'your_app_password';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('your_email@gmail.com', 'OTP System');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Mã OTP của bạn';
        $mail->Body    = "Mã OTP: <b>$otp</b>";

        $mail->send();
        header("Location: verify_otp.php");
        exit();
    } catch (Exception $e) {
        echo "Không thể gửi email: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>