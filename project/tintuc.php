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
    <link rel="stylesheet" href="./assets/css/id.css">
    <link rel="stylesheet" href="./assets/css/chatbox.css">
    <title>HỆ THỐNG TUYỂN SINH TRỰC TUYẾN</title>
</head>

<body>
    <div class="container">
        <?php
        include("layout/navbar.php");
        ?>
        <div class="content">
            <div class="content-l">
                <div class="cont">
                    <?php
                    if (isset($_GET['id']) && !empty($_GET['id'])) { //kiểm tra get ID đã tồn tại hay chưa
                        $id = $_GET["id"]; //khởi  tạo biến $id
                        $sql = "select * from tintuc where NewsID = $id "; //câu lệnh truy vấn 
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                    <h1>' . $row['Tieu_de'] . '</h1> 
                                    <p>' . $row['Noi_dung'] . '</p>
                                ';
                            }
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="content-r">
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
            </div>
        </div>
        <?php include("layout/footer.php"); ?>
        <script src="../js/chatbox.js">
        </script>

</body>

</html>