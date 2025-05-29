<?php
include("../config/connect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
if (isset($_POST["resgister"])) {
    // Lấy dữ liệu từ form
    $CCCD = $_POST['CCCD'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $pwd = $_POST['password'];
    $confirm_pwd = $_POST['confirm_pwd'];

    $select_cccd = "select * from `login` where UserID = '$CCCD' ";
    $result = mysqli_query($conn, $select_cccd);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('CCCD đã tồn tại'); </script>";
    };

    if ($pwd == $confirm_pwd) {
        $pass = $pwd;
        
    } else {
        echo "<script>alert('Mật khẩu không trùng khớp'); window.location='../assets/catalog/modal.php'; </script>";
    }
    // Tạo OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['Email'] = $email;
    $_SESSION['UserID'] = $username;
    $_SESSION['Password'] = $password;

    // Cấu hình gửi mail
    $mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Host SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'duyquynguyen2003@gmail.com';  // Tài khoản Gmail
    $mail->Password   = 'duyquy2472003';     // Mật khẩu ứng dụng Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Người gửi và người nhận
    $mail->setFrom('duyquynguyen2003@gmail.com', 'HTThongtintuyensinh');
    $mail->addAddress($email);

    // Nội dung
    $mail->isHTML(true);
    $mail->Subject = 'Xác thực OTP';
    $mail->Body    = "Xin chào $username,<br><br>Mã OTP của bạn là: <b>$otp</b><br><br>Vui lòng nhập mã này để hoàn tất đăng ký.";

    $mail->send();
    echo "Mã OTP đã được gửi tới email của bạn.";
    echo "<a href='otp_verify.php'>Nhập mã OTP</a>";
} catch (Exception $e) {
    echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";

    
    }
}