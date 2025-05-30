<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["CCCD"];
    $email = $_POST["email"];

    // Tạo mã OTP ngẫu nhiên
    $otp = rand(100000, 999999);

    // Lưu thông tin vào session
    $_SESSION["username"] = $_POST['CCCD'];
    $_SESSION["otp"] =$_POST['otp'];
    $_SESSION['email'] = $_POST['email'];

    // Gửi OTP qua email
    include 'otp_send.php';

    // Chuyển sang trang nhập OTP
    header("Location: otp_verify.php");
    exit();
}
?>
