<div class="login">
    <h1 class="title">Đăng nhập</h1>
    <form action="" method="get">
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
    <ul class="tinhnang">
        <li><a href="">Thông báo từ ban quản trị</a></li>
        <li><a href="">Chương trình đào tạo</a></li>
        <li><a href="<?= ROOT_URL ?>DKXT.php">Đăng ký tuyển sinh</a></li>
        <li><a href="<?= ROOT_URL ?>information.php">Xem thông tin hồ sơ</a></li>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            if ($_SESSION['role']  == "admin") {
                echo '<a href = "admin.php" > Dashboard </a>';
            }
        }
        ?>
    </ul>
</div>