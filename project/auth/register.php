<?php
include("../config/connect.php");
if (!$conn) {
    echo 'Server is error';


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
        // Lấy dữ liệu từ form
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Kiểm tra mật khẩu khớp
        if ($password !== $confirm_password) {
            die("Mật khẩu không khớp.");
        }

        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Ghi dữ liệu vào DB (giả sử bảng users có các cột: username, email, password)
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
            if (mysqli_stmt_execute($stmt)) {
                echo "Đăng ký thành công!";
            } else {
                echo "Lỗi khi ghi dữ liệu: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Lỗi prepare: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);