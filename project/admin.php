<?php include 'config/connect.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản lý Tin Tức</title>
</head>

<body>
    <h2>Danh sách Tin tức</h2>
    <a href="them.php">+ Thêm tin mới</a>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Nội dung</th>
            <th>Ngày</th>
        </tr>
        <?php
        $sql = "SELECT * FROM tintuc ORDER BY NewsID DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['NewsID'] ?></td>
            <td><?= $row['Tieu_de'] ?></td>
            <td><?= substr(strip_tags($row['Noi_dung']), 0, 100) . "..." ?></td>
            <td><?= $row['Date'] ?></td>
            <td>
                <a href="sua.php?id=<?= $row['NewsID'] ?>">Sửa</a> |
                <a href="xoa.php?id=<?= $row['NewsID'] ?>" onclick="return confirm('Xoá tin này?')">Xoá</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.php">Quay lại</a>
</body>

</html>