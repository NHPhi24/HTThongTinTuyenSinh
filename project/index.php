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
    <link rel="stylesheet" href="./assets/css/chatbox.css">
    <link rel="stylesheet" href="./assets/css/carousel.css">
    <title>HỆ THỐNG TUYỂN SINH TRỰC TUYẾN</title>
</head>

<body>
    <div class="container">
        <?php
        include("layout/navbar.php");
        ?>
        <div class="content">
            <div class="content-l">
                <h1 class="title">Tin Tức</h1>
                <div class="carousel">
                    <i class="fa-solid fa-angle-left" id="prevBtn"></i>
                    <div class="carousel-track">
                    <?php
                    $sql = "SELECT * FROM tintuc ORDER BY Date DESC LIMIT 10";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <div class="item-carousel">
                                    <div class="top-item">
                                        <span class="date">' . $row['Date'] . '</span>
                                        <span clas="time"></span>
                                    </div>
                                    <div class="bottom-item "> <a href="tintuc.php?id=' . $row['NewsID'] . '">
                                        <p class="text-warp">' . $row['Tieu_de'] . '</p> </a>
                                    </div>
                                </div>
                            ';
                        }
                    }
                    ?>
                    </div>
                    <i class="fa-solid fa-angle-right" id="nextBtn"></i>
                </div>
                <h1 class="title">Thông báo</h1>
                <div class="announce">
                    <div class="announce-l">
                        <img src="./assets/img/ChungNhan.png" alt="">
                        <?php
                        $sql = 'select * from tintuc order by Date desc limit 4,1';
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                <div class="top-item">
                                    <span class="date">' . $row['Date'] . '</span>
                                </div>
                                <div class="content-announce">
                                    <a href="tintuc.php?id=' . $row['NewsID'] . '">
                                        ' . $row['Tieu_de'] . '
                                    </a>
                                </div>
                                ';
                            }
                        }

                        ?>

                    </div>
                    <div class="announce-r">
                        <div class="ann-r-l">
                            <?php
                            $sql = 'select * from tintuc order by Date desc limit 5,13';
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="item-intro">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <i class="fa-solid fa-angles-right"></i>
                                                            <p class="content-intro"><a href="tintuc.php?id=' . $row['NewsID'] . '">' . $row['Tieu_de'] . '</a></p>
                                                        </td>
                                                        <td>
                                                            <div class="top-item">
                                                                <span class="date">' . $row['Date'] . '</span>
                                                                <span clas="time"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    ';
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <h1 class="title">Hướng dẫn</h1>
                <div class="intro">
                    <?php
                    $sql = 'Select * from tintuc where Tieu_de Like "Hướng dẫn%" order by Tieu_de limit 4';
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="item-intro">
                                    <table>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <i class="fa-solid fa-angles-right"></i>
                                                    <p class="content-intro"><a href="tintuc.php?id=' . $row['NewsID'] . '">' . $row['Tieu_de'] . '</a></p>
                                                </td>
                                                <td>
                                                    <div class="top-item">
                                                        <span class="date">' . $row['Date'] . '</span>
                                                        <span clas="time"></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            
                            ';
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
                        $sql = "select * from student st, login l where st.CCCD = l.UserID limit 1 ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="account">
                                        <span> Tài khoản: </span>
                                        <label for="">' . $row['CCCD'] . '</label>
                                    </div>
                                    <div class="account">
                                        <span>Họ và tên: </span>
                                        <label for="">' . $row['Names'] . '</label>
                                    </div>
                                    <button class="btn">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <span>Đăng xuất</span>
                                    </button>
                                    <a href="">Đổi mật khẩu</a>
                                ';
                            }
                        }

                        ?>

                    </form>
                </div>
                <div class="feature">
                    <h1 class="title">Tính năng</h1>
                    <ul class="tinhnang">
                        <li><a href="">Thông báo từ ban quản trị</a></li>
                        <li><a href="">Chương trình đào tạo</a></li>
                        <li><a href="./assets/catalog/DKXT.html">Đăng ký tuyển sinh</a></li>
                        <li><a href="./assets/catalog/information.html">Xem thông tin hồ sơ</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <?php
        include("layout/footer.php");
        ?>
        <script src="./assets/js/carousel.js"></script>
        <script src="./assets/js/chatbox.js">
        </script>
</body>

</html>