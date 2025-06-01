<?php
if (session_start() === PHP_SESSION_NONE) {
    session_start();
}
$conn = new mysqli('localhost', 'root', '', 'htts');
$cccd = $_SESSION['UserID'];
$sql = "SELECT * FROM dkxt WHERE CCCD = '$cccd' ORDER BY NV ASC";
$result = mysqli_query($conn, $sql);
$nguyenvongList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $nguyenvongList[] = $row;
}

// Lấy danh sách trường
$truongList = [];
$resTruong = mysqli_query($conn, "SELECT DISTINCT TenTruong FROM truong");
while ($row = mysqli_fetch_assoc($resTruong)) {
    $truongList[] = $row['TenTruong'];
}

// Lấy danh sách ngành
$nganhList = [];
$resNganh = mysqli_query($conn, "SELECT DISTINCT Ten_Nganh FROM nganhhoc");
while ($row = mysqli_fetch_assoc($resNganh)) {
    $nganhList[] = $row['Ten_Nganh'];
}

// Lấy danh sách tổ hợp môn (cả mã và tên)
$tohopList = [];
$resToHop = mysqli_query($conn, "SELECT DISTINCT Ma_To_Hop, Ten_To_Hop FROM tohop");
while ($row = mysqli_fetch_assoc($resToHop)) {
    $tohopList[] = [
        'MaToHop' => $row['Ma_To_Hop'],
        'TenToHop' => $row['Ten_To_Hop']
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/DKXT.css">
    <link rel="stylesheet" href="./assets/css/chatbox.css">
    <title>HỆ THỐNG TUYỂN SINH TRỰC TUYẾN</title>
    <style>
    .footer {
        bottom: 0;
    }

    .dkxt {
        width: 100%;
        display: flex;
        justify-content: space-around;
    }

    .nv,
    .nganh,
    .truong,
    .tohop {
        margin: 0 6px;
    }
    </style>
</head>

<body>
    <div class="container">
        <?php include("layout/navbar.php"); ?>
        <div class="content">
            <div class="content-l">
                <div class="DKXT">
                    <div class="container">
                        <form name="DKNV" action="<?= ROOT_URL ?>auth/xulyDKXT.php" method="post">
                            <h2>Đăng ký Nguyện vọng</h2>

                            <!-- Ô nhập CCCD -->
                            <?php
                            echo '
                                <div class="form-group">
                                    <label for="cccd">CCCD:</label>
                                    <input type="number" name="cccd" value= "' . $_SESSION['UserID'] . '" id="cccd" placeholder="Nhập số CCCD" required />
                                </div>
                                ';
                            ?>

                            <!-- Tiêu đề bảng -->
                            <div class="table-header">
                                <div>Thứ tự</div>
                                <div>Trường</div>
                                <div>Ngành</div>
                                <div>Tổ hợp môn</div>
                                <div>Chỉnh sửa</div>
                            </div>

                            <!-- Danh sách nguyện vọng -->
                            <div id="industry-list" class="industry-list">
                                <?php foreach ($nguyenvongList as $index => $nv): ?>
                                <div class="industry-row">
                                    <input type="hidden" name="NV_ID[]" value="<?= isset($nv['id']) ? $nv['id'] : '' ?>">

                                    <!-- Thứ tự -->
                                    <select name="STT_NV[]" class="nv">
                                        <?php for ($i = 1; $i <= 30; $i++): ?>
                                        <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>"
                                            <?= $nv['NV'] == $i ? 'selected' : '' ?>>
                                            <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
                                        </option>
                                        <?php endfor; ?>
                                    </select>

                                    <!-- Trường -->
                                    <select name="Truongs[]" class="truong">
                                        <?php foreach ($truongList as $truong): ?>
                                        <option value="<?= $truong ?>" <?= $nv['TenTruong'] == $truong ? 'selected' : '' ?>>
                                            <?= $truong ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <!-- Ngành -->
                                    <select name="Nganhs[]" class="nganh">
                                        <option value="<?= $nv['Ten_Nganh'] ?>" selected><?= $nv['Ten_Nganh'] ?></option>
                                    </select>


                                    <!-- Tổ hợp môn -->
                                    <select name="ToHop[]" class="tohop">
                                        <?php foreach ($tohopList as $tohop): ?>
                                        <option value="<?= $tohop['MaToHop'] ?>" <?= $nv['ToHop'] == $tohop['MaToHop'] ? 'selected' : '' ?>>
                                            <?= $tohop['TenToHop'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <!-- Nút CRUD -->
                                    <div class="crud">
                                        <input class="btn btn-save" type="button" value="Lưu" name="add_dkxt">
                                        <input class="btn btn-set" type="button" value="Sửa" name="set_dkxt">
                                        <input class="btn btn-del" type="button" value="Xóa" name="del_dkxt">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Nút thêm nguyện vọng -->
                            <button id="add-btn" class="btn" type="button">
                                <i class="fa fa-plus"></i> Thêm nguyện vọng
                            </button>
                            <!-- Nút lưu tất cả nguyện vọng -->
                            <!-- <button id="save-all-btn" class="btn" type="submit" name="save_all">
                                <i class="fa fa-save"></i> Lưu
                            </button> -->
                            <input type="submit" class="btn" id="save-all-btn" name="save_all" value="Lưu toàn bộ">
                        </form>
                    </div>
                </div>
            </div>

            <!-- Template dòng nguyện vọng -->
            <template id="row-template">
                <div class="industry-row">
                    <!-- Thứ tự -->
                    <select name="STT_NV[]" class="nv">
                        <?php for ($i = 1; $i <= 30; $i++): ?>
                        <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>">
                            <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
                        </option>
                        <?php endfor; ?>
                    </select>

                    <!-- Trường -->
                    <select name="Truongs[]" class="truong">

                    </select>

                    <!-- Ngành -->
                    <select name="Nganhs[]" class="nganh">
                        <option disabled selected>--Chọn ngành--</option>
                    </select>


                    <!-- Tổ hợp môn -->
                    <select name="ToHop[]" class="tohop">
                        <option disabled selected>--Chọn tổ hợp--</option>
                    </select>

                    <!-- Nút CRUD -->
                    <div class="crud">
                        <input class="btn btn-save" type="button" value="Lưu" name="add_dkxt">
                        <input class="btn btn-set" type="button" value="Sửa" name="set_dkxt">
                        <input class="btn btn-del" type="button" value="Xóa" name="del_dkxt">
                    </div>
                </div>
            </template>


            <div class="content-r">
                <?php include("layout/feature.php"); ?>
            </div>
        </div>
        <?php
        include("layout/footer.php");
        ?>
        <script src="./assets/js/DKXT.js"></script>

        <!-- <script src="./assets/js/xulyDKXT.js"></script> -->
        <script src="./assets/js/chatbox.js"></script>
</body>

</html>