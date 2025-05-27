<?php
include("../config/connect.php");
if (!$conn) {
    echo 'Server is error';
}
else {
    if (isset($_POST['register'])) {
        // Lấy thông tin từ form đăng ký
        $userid = $_POST['UserID'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $confirm = $_POST['ConfirmPassword'];
        // Kiểm tra xem tên đăng nhập đã tồn tại chưa
        $sql = "SELECT * FROM login WHERE UserID='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Nếu tên đăng nhập đã tồn tại, hiển thị thông báo lỗi
            echo "Username already exists.";
        } else {
            // Nếu tên đăng nhập chưa tồn tại, thêm người dùng mới vào cơ sở dữ liệu
            $sql = "INSERT INTO login (UserID, Email, Password, ConfirmPassword) VALUES ('$userid', '$email', '$password', '$confirm')";
            if (mysqli_query($conn, $sql)) {
            // Chuyển hướng đến trang chính sau khi đăng ký thành công
                header("Location: /HTThongtintuyensinh/project/index.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
}
};