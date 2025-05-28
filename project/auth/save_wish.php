<?php
session_start(); // ✅ Lấy thông tin CCCD từ session

include("../config/connect.php");

// Kiểm tra xem người dùng đã đăng nhập chưa (có CCCD trong session không)
if (!isset($_SESSION['cccd'])) {
    echo json_encode(['status' => 'error', 'message' => 'Chưa đăng nhập']);
    exit;
}

$cccd = $_SESSION['cccd'];

// Lấy dữ liệu JSON từ fetch gửi lên
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['nguyenvong'])) {
    echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ']);
    exit;
}

$nguyenvongs = $data['nguyenvong'];
$date = date('Y-m-d');

foreach ($nguyenvongs as $nv) {
    $nguyen_vong = $nv['nv'];
    $ten_truong = $nv['truong'];
    $ten_nganh = $nv['nganh'];
    $ten_to_hop = $nv['tohop'];

    // Lấy mã tương ứng
    $query = "
        SELECT t.MaTruong, n.MaNganh, th.IDTo_Hop
        FROM truong t
        JOIN nganhhoc n ON t.MaNganh = n.MaNganh
        JOIN tohop th ON n.Ma_To_Hop = th.Ma_To_Hop
        WHERE t.TenTruong = ? AND n.Ten_Nganh = ? AND th.Ten_To_Hop = ?
        LIMIT 1
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $ten_truong, $ten_nganh, $ten_to_hop);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) continue;

    $maTruong = $row['MaTruong'];
    $maNganh = $row['MaNganh'];
    $idToHop = $row['IDTo_Hop'];

    // Kiểm tra xem đã tồn tại chưa
    $check_sql = "SELECT DangKyID FROM dangkynganhhoc WHERE CCCD=? AND MaTruong=? AND MaNganh=? AND IDTo_Hop=? AND Nguyen_Vong=?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("sssis", $cccd, $maTruong, $maNganh, $idToHop, $nguyen_vong);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows == 0) {
        // Chưa có: thêm mới
        $insert_sql = "INSERT INTO dangkynganhhoc (CCCD, MaTruong, MaNganh, IDTo_Hop, Nguyen_Vong, Ket_Qua, Ngay_xet_tuyen)
                       VALUES (?, ?, ?, ?, ?, NULL, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sssis", $cccd, $maTruong, $maNganh, $idToHop, $nguyen_vong, $date);
        $insert_stmt->execute();
    } else {
        // Đã có: cập nhật ngày xét tuyển (nếu muốn)
        $update_sql = "UPDATE dangkynganhhoc SET Ngay_xet_tuyen=? WHERE CCCD=? AND MaTruong=? AND MaNganh=? AND IDTo_Hop=? AND Nguyen_Vong=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssis", $date, $cccd, $maTruong, $maNganh, $idToHop, $nguyen_vong);
        $update_stmt->execute();
    }
}

echo json_encode(['status' => 'success', 'message' => 'Lưu thành công']);
?>
