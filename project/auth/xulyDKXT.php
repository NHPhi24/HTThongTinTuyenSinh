<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'htts');
if (!$conn) {
    echo 'Server is error';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the session
    $cccd = $_SESSION['UserID'];

    // Check which button was pressed
    if (isset($_POST['add_dkxt'])) {
        // Handle adding a new entry
        $truong = $_POST['Truongs'];
        $nganh = $_POST['Nganhs'];
        $tohop = $_POST['ToHop'];
        $stt_nv = $_POST['STT_NV'];
        // Prepare and execute the insert query
        $sql = "INSERT INTO dkxt (CCCD, TenTruong, Ten_Nganh, ToHop, NV) 
        VALUES ('$cccd', '$truong' , '$nganh', '$tohop', '$stt_nv')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script> alert('Thêm thành công!');
            window.location.href = '../DKXT.php';
            </script>";
        } else {
            echo "Có lỗi xảy ra: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['set_dkxt'])) {
        // Handle editing an existing entry
        $truong = $_POST['Truongs'];
        $nganh = $_POST['Nganhs'];
        $tohop = $_POST['ToHop'];
        $stt_nv = $_POST['STT_NV'];

        // Prepare and execute the update query
        $sql = "UPDATE dkxt SET TenTruong = '$truong', Ten_Nganh = '$nganh', ToHop = '$tohop', 
        NV = '$stt_nv' WHERE CCCD = '$cccd' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Sửa thành công!');
             window.location.href = '../DKXT.php';
             </script>";
        } else {
            echo "Có lỗi xảy ra: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['del_dkxt'])) {
        // Prepare and execute the delete query
        $sql = "DELETE FROM dkxt WHERE CCCD = '$cccd'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('xóa thành công!');
            window.location.href = '../information.php';</script>";
        } else {
            echo "Có lỗi xảy ra: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['save_all'])) {
        // Handle saving all entries
        if (isset($_POST['STT_NV']) && is_array($_POST['STT_NV'])) {
            foreach ($_POST['STT_NV'] as $index => $stt_nv) {
                // Nếu không có NV_ID thì là mới
                if (empty($_POST['NV_ID'][$index])) {
                    $truong = $_POST['Truongs'][$index];
                    $nganh = $_POST['Nganhs'][$index];
                    $tohop = $_POST['ToHop'][$index];
                    // Kiểm tra tồn tại trước khi thêm
                    $check_sql = "SELECT 1 FROM dkxt WHERE CCCD='$cccd' AND TenTruong='$truong' AND Ten_Nganh='$nganh' AND ToHop='$tohop' AND NV='$stt_nv'";
                    $check_result = mysqli_query($conn, $check_sql);
                    if (mysqli_num_rows($check_result) == 0) {
                        // Insert new entries nếu chưa tồn tại
                        $sql = "INSERT INTO dkxt (CCCD, TenTruong, Ten_Nganh, ToHop, NV) 
                        VALUES ('$cccd', '$truong', '$nganh', '$tohop', '$stt_nv')";
                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                            echo "Có lỗi xảy ra: " . mysqli_error($conn);
                        }
                    }
                }
            }
            echo "<script>alert('Thêm toàn bộ thành công!');
            window.location.href = '../DKXT.php';
            </script>";
        } else {
            echo "Không có dữ liệu để lưu.";
        }
    }
}

