<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["username"] = $_POST["Name"] ?? '';
    $_SESSION["CCCD"] = $_POST["CCCD"] ?? '';
    $_SESSION["Email"] = $_POST["Email"] ?? '';
    $_SESSION["password"] = $_POST["password"] ?? '';
    $_SESSION["confirm_pwd"] = $_POST["confirm_pwd"] ?? '';

    if (empty($_SESSION["Email"])) {
        die("Email không được để trống.");
    }

    header("Location: otp_send.php");
    exit();
}
?>
