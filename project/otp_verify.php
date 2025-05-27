<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_otp = $_POST['otp'];
    if ($entered_otp == $_SESSION['otp']) {
        $conn = new mysqli("localhost", "root", "", "ten_database");
        $email = $_SESSION['email'];
        $username = $_SESSION['UserID'];
        $password = $_SESSION['password'];

        $stmt = $conn->prepare("INSERT INTO users (UserID, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

        echo "<div class='success'> Đăng ký thành công!</div>";
        session_destroy();
        exit;
    } else {
        $error = "Mã OTP không đúng!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Nhập mã OTP</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }
        body {
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .otp-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
            width: 300px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #1d4ed8;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            font-size: 18px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <form method="POST" class="otp-container">
        <h2>Nhập mã OTP</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <input type="text" name="otp" placeholder="Nhập mã OTP" required>
        <button type="submit">Xác nhận</button>
    </form>
</body>
</html>
