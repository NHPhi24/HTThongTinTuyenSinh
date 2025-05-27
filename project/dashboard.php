<?php
// Tùy chọn: Kiểm tra phiên đăng nhập nếu muốn bảo vệ trang dashboard
// session_start();
// if (!isset($_SESSION['logged_in'])) {
//     header("Location: login.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        body {
            background: #e0f2fe;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            max-width: 800px;
            margin: 80px auto;
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            color: #0f172a;
            font-size: 32px;
            margin-bottom: 20px;
        }

        p {
            color: #334155;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>🎉 Chào mừng đến với hệ thống!</h1>
        <p>Bạn đã đăng ký và xác thực tài khoản thành công.</p>
        <a href="logout.php" class="btn">Đăng xuất</a>
    </div>
</body>
</html>
