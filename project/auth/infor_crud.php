<?php
session_start();
include("../config/connect.php");
if (isset($_POST["add"])) {
    $stt = $_POST["STT"];
    $name = $_POST['Name'];
    $sex = $_POST['sex'];
    $ngaysinh = $_POST['date'];
    $diachi = $_POST['diachi'];
    $cccd = $_POST['CCCD'];
    $thpt = $_POST['THPT']; // Make sure to include this
    $phone = $_POST['phone'];
    $email = $_POST['Email'];

    $sql = "INSERT INTO student(student_ID, Names, Sex, DateOfBirth, Origin, CCCD, HighSchool, Phone, Email)
            VALUES ('$stt', '$name', '$sex', '$ngaysinh', '$diachi', '$cccd', '$thpt', '$phone', '$email')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script> alert('Thêm thành công!');
            window.location.href = '../information.php';
            </script>";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
} else if (isset($_POST['set'])) {
    // Corrected UPDATE statement
    $stt = $_POST["STT"];
    $name = $_POST['Name'];
    $sex = $_POST['sex'];
    $ngaysinh = $_POST['date'];
    $diachi = $_POST['diachi'];
    $cccd = $_POST['CCCD'];
    $thpt = $_POST['THPT']; // Make sure to include this
    $phone = $_POST['phone'];
    $email = $_POST['Email'];
    $sql = "UPDATE student SET student_ID = '$stt', Names = '$name', Sex = '$sex', DateOfBirth = '$ngaysinh', 
            Origin = '$diachi', CCCD = '$cccd', HighSchool = '$thpt', Phone = '$phone', Email = '$email' 
            WHERE CCCD = '$cccd'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Sửa thành công!');
             window.location.href = '../information.php';
             </script>";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
} else if (isset($_POST["del"])) {
    $cccd = $_POST['CCCD'];
    $sql = "DELETE from student where CCCD = '$cccd'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('xóa thành công!');
            window.location.href = '../information.php';</script>";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
} else if (isset($_POST["add_sroce"])) {
    $cccd = $_SESSION['UserID'];
    $toan = $_POST['Toan'];
    $van = $_POST['Van'];
    $anh = $_POST['Anh'];
    $ly = $_POST['Ly'];
    $hoa = $_POST['Hoa'];
    $sinh = $_POST['Sinh'];
    $su = $_POST['Su'];
    $dia = $_POST['Dia'];
    $gdcd = $_POST['GDCD'];

    $sql = "INSERT INTO scoreprofile(ScoreID, Toan, Van, Anh, Ly, Hoa, Sinh, Su, Dia, GDCD) 
    VALUES('$cccd', '$toan', '$van', '$anh', '$ly', '$hoa', '$sinh', '$su', '$dia', '$gdcd')";
    if ($result = mysqli_query($conn, $sql)) {
        echo "<script>alert('thêm điểm thành công!');
            window.location.href = '../information.php';</script>";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
} else if (isset($_POST["set_score"])) {
    $cccd = $_POST['CCCD'];
    $toan = $_POST['Toan'];
    $van = $_POST['Van'];
    $anh = $_POST['Anh'];
    $ly = $_POST['Ly'];
    $hoa = $_POST['Hoa'];
    $sinh = $_POST['Sinh'];
    $su = $_POST['Su'];
    $dia = $_POST['Dia'];
    $gdcd = $_POST['GDCD'];

    $sql = "UPDATE scoreprofile SET Toan = '$toan', Van = '$van', 
    Anh = '$anh', Ly = '$ly', Hoa = '$hoa', Sinh = '$sinh', Su = '$su', Dia = '$dia', GDCD = '$gdcd' ";
    if ($result = mysqli_query($conn, $sql)) {
        echo "<script>alert('Sửa điểm thành công!');
            window.location.href = '../information.php';</script>";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
} else if (isset($_POST["del_score"])) {
    $cccd = $_POST['CCCD'];
    $sql = "DELETE from scoreprofile where ScoreID = '$cccd'";
    if ($result = mysqli_query($conn, $sql)) {
        echo "<script>alert('xóa điểm thành công!');
            window.location.href = '../information.php';</script>";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
}