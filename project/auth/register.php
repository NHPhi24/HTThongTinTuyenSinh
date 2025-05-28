<?php
include("../config/connect.php");



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

    $sql = " Insert into `login`(UserID, Name, Password, Email)
        Values ('$CCCD','$name', '$pass', '$email')";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "<script>alert('Đăng Ký Tài Khoản Thành Công!'); window.location='../assets/catalog/modal.php';</script>";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
}