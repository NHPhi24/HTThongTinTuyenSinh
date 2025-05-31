<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['otp'])) {
    $email = $_SESSION['email'] ?? null;
    $inputOtp = $_POST['otp'];

    if (!$email) {
        echo "Không tìm thấy email người dùng.";
        exit();
    }

    // Truy vấn OTP mới nhất theo email
    $stmt = $conn->prepare("SELECT otp, created_at FROM otps WHERE email = ? ORDER BY created_at DESC LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    if ($data && $data['otp'] == $inputOtp) {
        echo "<h2>Xác minh thành công!</h2>";
        // Bạn có thể cập nhật cờ 'đã xác minh' nếu muốn
    } else {
        echo "<h2>OTP không đúng hoặc đã hết hạn.</h2>";
    }
} else {
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Xác minh OTP</title>
</head>
<body>
  <h2>Nhập mã OTP đã gửi đến email: <?= htmlspecialchars($_SESSION['email'] ?? ''); ?></h2>
  <form action="verify_otp.php" method="POST">
    <input type="text" name="otp" placeholder="Nhập mã OTP" required>
    <button type="submit">Xác minh</button>
  </form>
</body>
</html>
<?php } ?>
<?php
$conn->close();