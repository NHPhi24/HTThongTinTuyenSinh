<?php
session_start();
include("config/connect.php"); // Đảm bảo đúng đường dẫn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userOtp = $_POST["otp"] ?? '';
    $storedOtp = $_SESSION["otp"] ?? '';

    if ($userOtp == $storedOtp) {
        $CCCD = $_SESSION["CCCD"] ?? '';
        $name = $_SESSION["username"] ?? '';
        $email = $_SESSION["Email"] ?? '';
        $pwd = $_SESSION["password"] ?? '';
        $confirm_pwd = $_SESSION["confirm_pwd"] ?? '';

        if (!$conn) {
            die("Lỗi kết nối: " . mysqli_connect_error());
        }

        $check = mysqli_query($conn, "SELECT * FROM login WHERE UserID = '$CCCD'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('CCCD đã tồn tại'); window.location='assets/catalog/modal.php';</script>";
            exit();
        }

        if ($pwd !== $confirm_pwd) {
            echo "<script>alert('Mật khẩu không trùng khớp'); window.location='assets/catalog/modal.php';</script>";
            exit();
        }

        $query = "INSERT INTO login (UserID, Name, Email, Password) VALUES ('$CCCD', '$name', '$email', '$pwd')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Đăng ký thành công!'); window.location='assets/catalog/modal.php';</script>";
            exit();
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Sai mã OTP. Vui lòng thử lại!'); window.location='otp_verify.php';</script>";
    }
}
?>

<!-- Giao diện nhập OTP -->
<!DOCTYPE html>
<html>
<head>
    <title>Nhập mã OTP</title>
</head>
<body>
    <h2>Nhập mã OTP đã gửi tới email</h2>
    <form action="otp_verify.php" method="POST">
        <input type="text" name="otp" placeholder="Nhập mã OTP" required>
        <button type="submit">Xác nhận</button>
    </form>
</body>
</html>
