<?php
include("../config/connect.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    // Lấy dữ liệu từ form và escape
    $CCCD = mysqli_real_escape_string($conn, $_POST['CCCD']);
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);

    // Kiểm tra CCCD đã tồn tại
    $select_cccd = "SELECT * FROM `login` WHERE UserID = '$CCCD'";
    $result = mysqli_query($conn, $select_cccd);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('CCCD đã tồn tại'); window.location='../assets/catalog/modal.php';</script>";
        exit();
    }

    // Kiểm tra mật khẩu
    if ($pwd != $confirm_pwd) {
        echo "<script>alert('Mật khẩu không trùng khớp'); window.location='../assets/catalog/modal.php'; </script>";
        exit();
    }

    // Mã hóa mật khẩu
    $pass = password_hash($pwd, PASSWORD_DEFAULT);

    // Thêm vào CSDL
    $sql = "INSERT INTO `login` (UserID, Name, Password, Email) VALUES ('$CCCD','$name', '$pass', '$email')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "<script>alert('Đăng Ký Tài Khoản Thành Công!'); window.location='../assets/catalog/modal.php';</script>";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
}
