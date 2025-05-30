<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userOtp = $_POST["otp"];
    $storedOtp = $_SESSION["otp"];

    if ($userOtp == $storedOtp) {
        // Đúng OTP → chuyển dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Sai mã OTP. Vui lòng thử lại.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nhập mã OTP</title>
</head>
<body>
    <h2>Nhập mã OTP đã gửi tới email của bạn</h2>
    <form method="POST">
        <input type="text" name="otp" placeholder="Nhập mã OTP" required>
        <button type="submit">Xác nhận</button>
    </form>
</body>
</html>
