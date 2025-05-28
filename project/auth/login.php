<?php

session_start();
include("../config/connect.php");

if (isset($_POST['Login'])) {
    $username = $_POST['username']; //biến lấy dữ liệu từ input username 
    $password = $_POST['password']; // biến lấy dữ liệu từ input password

    $sql = "Select * from login where UserID = '$username' and Password = '$password' "; //cậu lệnh truy vấn 
    $result = mysqli_query($conn, $sql); //truy vấn câu lệnh trên với database

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //người dùng đã đăng nhập thành công 
            $_SESSION['loggedin'] = true;
            $_SESSION['UserID'] = $row['UserID']; //lưu dữ liệu vào phiên
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Password'] = $row['Password'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['Phone'] = $row['Phone'];
            $_SESSION['role'] = $row['role'];
        }
        echo "<script>window.location = '../index.php'</script>"; //khi đăng nhập thành công sẽ dẫn đến trang index.php
    } else {
        //trường hợp đăng nhập không thành công sẽ dẫn đến trang modal.php và thông báo đăng nhập thất bại
        echo "<script>window.location = '../assets/catalog/modal.php';  
        alert('Đăng nhập thất bại. Kiểm tra lại tài khoản hoặc mật khẩu');
        </script>";
    }
}