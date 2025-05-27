<?php
session_start();
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_otp = $_POST['otp'];

    if ($entered_otp == $_SESSION['otp']) {
        $conn = new mysqli("localhost", "root", "", "ten_database");
        $email = $_SESSION['Email'];
        $username = $_SESSION['UserID'];
        $password = password_hash($_SESSION['Password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (UserID, Email, Password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            echo "<div class='success'>🎉 Đăng ký thành công!</div>";
            session_destroy();
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Lỗi khi ghi dữ liệu.";
        }
    } else {
        $error = "❌ Mã OTP không đúng!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác thực OTP</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .otp-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        input {
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            width: 100%;
        }
        button {
            padding: 10px 20px;
            background: #2563eb;
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .success {
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form method="POST" class="otp-box">
        <h2>Nhập mã OTP</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <input type="text" name="otp" placeholder="Nhập mã OTP" required>
        <button type="submit">Xác nhận</button>
    </form>
</body>
</html>
