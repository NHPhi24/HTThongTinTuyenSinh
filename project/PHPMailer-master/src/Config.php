<?php
$host = 'localhost';
$db = 'otp_demo';
$user = 'root';
$pass = ''; // Mặc định XAMPP để trống

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
