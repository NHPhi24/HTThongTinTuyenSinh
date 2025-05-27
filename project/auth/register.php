<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
</head>
<body>
    <h2>Form Đăng ký</h2>
    <form action="process.php" method="POST">
        <label for="UserID">Tên đăng nhập:</label>
        <input type="text" name="UserID" required><br><br>

        <label for="Email">Email:</label>
        <input type="email" name="Email" required><br><br>

        <label for="Password">Mật khẩu:</label>
        <input type="password" name="Password" required><br><br>

        <label for="ConfirmPassword">Xác nhận mật khẩu:</label>
        <input type="password" name="ConfirmPassword" required><br><br>

        <button type="submit" name="register">Đăng ký</button>
    </form>
</body>
</html>