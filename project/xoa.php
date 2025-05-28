<?php include 'config/connect.php'; ?>
<?php
$id = $_GET['id'];
$conn->query("DELETE FROM tintuc WHERE NewsID=$id");
header("Location: admin.php");
?>