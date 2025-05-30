<?php
include("../config/connect.php");

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Lấy dữ liệu ngành + tên trường
$nganhRes = $conn->query("
    SELECT nganhhoc.*, truong.TenTruong 
    FROM nganhhoc 
    JOIN truong ON nganhhoc.MaTruong = truong.MaTruong
");
$nganhs = [];
while ($row = $nganhRes->fetch_assoc()) {
    $nganhs[] = $row;
}

// Lấy dữ liệu tổ hợp môn
$tohopRes = $conn->query("SELECT * FROM tohop");
$tohops = [];
while ($row = $tohopRes->fetch_assoc()) {
    $tohops[] = $row;
}

// Trả dữ liệu JSON gộp
echo json_encode([
    'nganhs' => $nganhs,
    'tohops' => $tohops
]);
?>