<?php
if (session_start() === PHP_SESSION_NONE) {
    session_start();
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
    </style>
</head>

<body>
    <div class="container">
        <?php include("layout/navbar.php"); ?>
        <div class="content">
            <div class="content-l">
                <div class="DKXT">
                    <div class="container">
                        <h2>Đăng ký Nguyện vọng</h2>

                        <!-- Ô nhập CCCD -->
                        <div class="form-group">
                            <label for="cccd">CCCD:</label>
                            <input type="number" id="cccd" placeholder="Nhập số CCCD" required />
                        </div>

                        <!-- Tiêu đề bảng -->
                        <div class="table-header">
                            <div>Thứ tự</div>
                            <div>Trường</div>
                            <div>Ngành</div>
                            <div>Tổ hợp môn</div>
                            <div>Chỉnh sửa</div>
                        </div>

                        <!-- Danh sách nguyện vọng -->
                        <div id="industry-list" class="industry-list"></div>

                        <!-- Nút thêm nguyện vọng -->
                        <button id="add-btn" class="btn">
                            <i class="fa fa-plus"></i> Thêm nguyện vọng
                        </button>
                        <!-- Nút lưu tất cả nguyện vọng -->
                        <button id="save-all-btn" class="btn">
                            <i class="fa fa-save"></i> Lưu
                        </button>
                    </div>
                </div>
            </div>

            <!-- Template dòng nguyện vọng -->
            <template id="row-template">
                <div class="industry-row">
                    <!-- Thứ tự -->
                    <select class="nv">
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>"><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
                        <?php endfor; ?>
                    </select>

                    <!-- Trường -->
                    <select class="truong">
                        <?php
                        $result = $conn->query("SELECT DISTINCT TenTruong FROM truong");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['TenTruong']}'>{$row['TenTruong']}</option>";
                        }
                        ?>
                    </select>

                    <!-- Ngành -->
                    <select class="nganh">
                        <?php
                        $result = $conn->query("SELECT DISTINCT Ten_Nganh FROM nganhhoc");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['Ten_Nganh']}'>{$row['Ten_Nganh']}</option>";
                        }
                        ?>
                    </select>

                    <!-- Tổ hợp môn -->
                    <select class="tohop">
                        <?php
                        $result = $conn->query("SELECT DISTINCT Ten_To_Hop FROM tohop");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['Ten_To_Hop']}'>{$row['Ten_To_Hop']}</option>";
                        }
                        ?>
                    </select>

                    <!-- Nút CRUD -->
                    <div class="crud">
                        <button class="btn btn-save"><i class="fa-solid fa-check"></i></button>
                        <button class="btn btn-set" style="display:none;"><i class="fa-solid fa-gear"></i></button>
                        <button class="btn btn-del"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
            </template>
            <div class="content-r">
                <div class="login">
                    <h1 class="title">Đăng nhập</h1>
                    <form action="" method="post">
                        <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            echo '<div class="account">
                                        <span> Tài khoản: </span>
                                        <label>' . $_SESSION['UserID'] . '</label>
                                    </div>
                                    <div class="account">
                                        <span>Họ và tên: </span>
                                        <label>' . $_SESSION['Name'] . '</label>
                                    </div>
                                    
                                ';
                        } else {
                            echo '<div class="account">
                                        <span> Tài khoản: </span>
                                        <label> chưa có thông tin</label>
                                    </div>
                                    <div class="account">
                                        <span>Họ và tên: </span>
                                        <label> chưa có thông tin</label>
                                    </div>
                            ';
                        }
                        ?>
                        <button class="btn">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <a href="<?= ROOT_URL ?>auth/logout.php">
                                Đăng xuất
                            </a>
                        </button>
                        <a href="">Đổi mật khẩu</a>

                    </form>
                </div>
                <div class="feature">
                    <h1 class="title">Tính năng</h1>
                    <ul>
                        <li><a href="">Thông báo từ ban quản trị</a></li>
                        <li><a href="">Chương trình đào tạo</a></li>
                        <li><a href="<?= ROOT_URL ?>DKXT.php">Đăng ký tuyển sinh</a></li>
                        <li><a href="<?= ROOT_URL ?>information.php">Xem thông tin hồ sơ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        include("layout/footer.php");
        ?>

        <script src="./assets/js/DKXT.js"></script>
        <script src="./assets/js/chatbox.js"></script>
</body>

</html>