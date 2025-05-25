<?php
session_start(); //bắt đầu phiên
if (isset($_SESSION["UserID"])) { //kiểm trả phiên userID đã tồn tại chưa
    unset($_SESSION["UserID"]); //nếu có thì xóa phiên
    session_destroy(); // hủy phiên 
}
header("location: ../index.php"); //đưa về index