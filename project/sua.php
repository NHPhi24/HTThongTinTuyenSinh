<?php include 'config/connect.php'; ?>
<?php
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tieude = $_POST['tieude'];
    $noidung = $_POST['noidung'];
    $stmt = $conn->prepare("UPDATE tintuc SET Tieu_de=?, Noi_dung=? WHERE NewsID=?");
    $stmt->bind_param("ssi", $tieude, $noidung, $id);
    $stmt->execute();
    header("Location: bdk.php");
}

$result = $conn->query("SELECT * FROM tintuc WHERE NewsID=$id");
$row = $result->fetch_assoc();
?>
<h2>Sửa tin</h2>
<form method="POST">
    Tiêu đề: <br><input type="text" name="tieude" value="<?= $row['Tieu_de'] ?>" required><br><br>
    Nội dung: <br><textarea name="noidung" rows="10" cols="60" required><?= $row['Noi_dung'] ?></textarea><br><br>
    <button type="submit">Cập nhật</button>
</form>
<a href="admin.php">Quay lại</a>