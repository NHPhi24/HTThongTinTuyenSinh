<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_otp = $_POST['otp'];

    if ($user_otp == $_SESSION['otp']) {
        echo "✅ Xác thực thành công!";
    } else {
        echo "❌ Sai mã OTP!";
    }
}
?>

<form method="POST">
    <label>Nhập mã OTP:</label>
    <input type="text" name="otp" required>
    <button type="submit">Xác minh</button>
</form>
