<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["CCCD"] ?? '';
    $email = $_POST["email"] ?? '';

    if (empty($email)) {
        die("Email không được để trống.");
    }

    // Lưu thông tin vào session
    $_SESSION["username"] = $username;
    $_SESSION['email'] = $email;

    // Chuyển sang file otp_send.php để gửi OTP
    header("Location: otp_send.php");
    exit();
}
?>
