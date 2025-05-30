<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];

    // Tạo mã OTP ngẫu nhiên
    $otp = rand(100000, 999999);

    // Lưu thông tin vào session
    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;
    $_SESSION["otp"] = $otp;

    // Gửi OTP qua email
    include 'otp_send.php';

    // Chuyển sang trang nhập OTP
    header("Location: otp_verify.php");
    exit();
}
?>
