<?php include 'config/connect.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tieude = $_POST['tieude'];
    $noidung = $_POST['noidung'];
    $stmt = $conn->prepare("INSERT INTO tintuc (Tieu_de, Noi_dung) VALUES (?, ?)");
    $stmt->bind_param("ss", $tieude, $noidung);
    $stmt->execute();
    header("Location: admin.php");
}
?>
<h2>Thêm tin mới</h2>
<form method="POST">
    Tiêu đề: <br><input type="text" name="tieude" required><br><br>
    Nội dung: <br><textarea name="noidung" rows="10" cols="60" required></textarea><br><br>
    <button type="submit">Thêm</button>
</form>
<a href="index.php">Quay lại</a>