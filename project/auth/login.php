<?php

session_start();
include("../config/connect.php");

if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "Select * from login where UserID = '$username' and Password = '$password' ";
    $result = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($result);
    if ($total == 1) {
        echo "<script>window.location = '../index.php'</script>";
    } else {
        echo "<script>window.location = '../assets/catalog/modal.php'; 
        alert('Đăng nhập thất bại. Kiểm tra lại tài khoản hoặc mật khẩu');</script>";
    }   
}