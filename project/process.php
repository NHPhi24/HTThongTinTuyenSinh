<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = trim($_POST["UserID"]);
    $email = trim($_POST["Email"]);
    $password = $_POST["Password"];
    $confirm_password = $_POST["ConfirmPassword"];

    // Kiểm tra mật khẩu khớp
    if ($password !== $confirm_password) {
        die("Mật khẩu xác nhận không khớp.");
    }

    // Kiểm tra trùng email
    $check_sql = "SELECT * FROM users WHERE Email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if ($result->num_rows > 0) {
        die("Email đã được đăng ký.");
    }

    // Lưu dữ liệu tạm thời vào session
    $_SESSION['UserID'] = $username;
    $_SESSION['Email'] = $email;
    $_SESSION['Password'] = $password;

    // Tạo OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    // Gửi email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'duyquynguyen2003@gmail.com'; // Tài khoản Gmail
        $mail->Password   = 'duyquy2472003';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('duyquynguyen2003@gmail.com', 'HTThongtintuyensinh');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Mã OTP xác nhận đăng ký';
        $mail->Body    = "Xin chào <b>$username</b>,<br><br>Mã OTP của bạn là: <strong>$otp</strong><br><br>Vui lòng nhập mã này để hoàn tất đăng ký.";

        $mail->send();
        header("Location: otp_verify.php");
        exit();
    } catch (Exception $e) {
        echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
    }
}
?>
