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
    <link rel="stylesheet" href="./assets/css/infomation.css">
    <link rel="stylesheet" href="./assets/css/chatbox.css">
    <title>HỆ THỐNG TUYỂN SINH TRỰC TUYẾN</title>
</head>

<body>
    <div class="container">
        <?php include("layout/navbar.php"); ?>
        <div class="content">
            <div class="content-l">
                <div class="inf-l">
                    <div class="inf-ll">
                        <div class="inf-l-infor">
                            <h4>Thông tin thí sinh</h4>
                            <div class="separate"></div>
                            <?php
                            $sql = "select  * from student st, login l  where st.CCCD = " . $_SESSION['UserID'] . " and st.CCCD = l.UserID";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                        <div class="inf-1">
                                            <label>Số CCCD: </label>
                                            <p>' . $_SESSION['UserID'] . '</p>
                                        </div>
                                        <div class="inf-1">
                                            <label>Họ và tên: </label>
                                            <p>' . $_SESSION['Name'] . '</p>
                                        </div>
                                        <div class="inf-1">
                                            <label>Ngày sinh: </label>
                                            <p>' . $row['DateOfBirth'] . '</p>
                                        </div>
                                        <div class="inf-1">
                                            <label>Giới tính </label>
                                            <p>' . $row['Sex'] . '</p>
                                        </div>
                                        <div class="inf-1">
                                            <label>Địa chỉ</label>
                                            <p>' . $row['Origin'] . '</p>
                                        </div>
                                        <div class="inf-1">
                                            <label>Trường THPT: </label>
                                            <p>' . $row['HighSchool'] . '</p>
                                        </div>
                                        <div class="inf-1">
                                            <label>Số điện thoại: </label>
                                            <p>' . $row['Phone'] . '</p>
                                        </div>
                                        <div class="inf-1">
                                            <label>Email: </label>
                                            <p>' . $_SESSION['Email'] . '</p>
                                        </div>
                                        <div class="inf-img">
                                            <img src="./assets/img/user.jpg" alt="">
                                        </div>
                                        ';
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <div class="inf-gpa">
                        <?php
                        $sql = "Select * from scoreprofile sc, student st where sc.ScoreID = " . $_SESSION['UserID'] . " && sc.ScoreID = st.CCCD";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                <div class="inf-1">
                                    <label>CCCD: </label>
                                    <p>' . $_SESSION["UserID"] . '</p>
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn Toán: </label>
                                    <p>' . $row['Toan'] . '</p>
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn Văn: </label>
                                    <p>' . $row['Van'] . '</p>
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn Anh: </label>
                                    <p>' . $row['Anh'] . '</p>
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn Lý: </label>
                                    <p>' . $row['Ly'] . '</p>
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn Hóa: </label>
                                    <p>' . $row['Hoa'] . '</p>
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn Sinh: </label>
                                    <p>' . $row['Sinh'] . '</p>
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn Sử: </label>
                                    <p>' . $row['Su'] . '</p>
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn Địa: </label>
                                    <p>' . $row['Dia'] . '</p>
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn GDCD: </label>
                                    <p>' . $row['GDCD'] . '</p>
                                </div>
                                ';
                            }
                        }
                        ?>

                    </div>

                </div>
                <div class="inf-lr">
                    <div class="inf-add">
                        <h4>Thêm thông tin thí sinh</h4>
                        <div class="separate"></div>
                        <form action="<?= ROOT_URL ?>auth/infor_crud.php" method="post">
                            <?php
                            $sql = "select * from student where CCCD = " . $_SESSION['UserID'] . " ";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                    <div class="inf-1">
                                        <label>Số STT: </label>
                                        <input type="text" name="STT" value= "' . $row['student_ID'] . '" placeholder="Nhập STT:">
                                    </div>
                                    <div class="inf-1"> 
                                        <label>Số CCCD: </label>
                                        <input type="text" name="CCCD" value = "' . $_SESSION['UserID'] . ' " placeholder="Nhập CCCD:">
                                    </div>
                                    <div class="inf-1">
                                        <label>Họ và tên: </label>
                                        <input type="text" name="Name" value = "' . $_SESSION['Name'] . ' " placeholder="Nhập họ và tên: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Ngày sinh: </label>
                                        <input type="date" name="date" value=' . $row['DateOfBirth'] . '> 
                                    </div>
                                    <div class="inf-1">
                                        <label>Giới tính: </label>
                                        <input type="radio" name="sex" value ="Nam" ' . ($row['Sex'] == 'Nam' ? 'checked' : '') . ' checked="checked"> <span>Nam</span>
                                        <input type="radio" name="sex" value = "Nữ" ' . ($row['Sex'] == 'Nữ' ? 'checked' : '') . '> <span>Nữ</span>
                                    </div>
                                    <div class="inf-1">
                                        <label>Địa chỉ: </label>
                                        <input type="text" name="diachi" value = "' . $row['Origin'] . ' " placeholder="Nhập địa chỉ:">
                                    </div>
                                    <div class="inf-1">
                                        <label>Trường THPT: </label>
                                        <input type="text" name="THPT" value = "' . $row['HighSchool'] . '"  placeholder="Nhập trường THPT: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Số điện thoại: </label>
                                        <input type="text" name="phone" value = "' . $row['Phone'] . '" placeholder="Nhập số điện thoại: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Email: </label>
                                        <input type="text" name="Email" value = "' . $_SESSION['Email'] . '" placeholder="Nhập Email: ">
                                    </div>
                                    ';
                                }
                            }
                            if (mysqli_num_rows($result) == 0) {
                                echo '
                                    <div class="inf-1">
                                        <label>Số STT: </label>
                                        <input type="text" name="STT" placeholder="Nhập STT:">
                                    </div>
                                    <div class="inf-1">
                                    <label>Số CCCD: </label>
                                        <input type="text" name="CCCD" value = "' . $_SESSION['UserID'] . ' " placeholder="Nhập CCCD:">
                                    </div>
                                    <div class="inf-1">
                                        <label>Họ và tên: </label>
                                        <input type="text" name="Name" value = "' . $_SESSION['Name'] . ' " placeholder="Nhập họ và tên: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Ngày sinh: </label>
                                        <input type="date" name="date"> 
                                    </div>
                                    <div class="inf-1">
                                        <label>Giới tính: </label>
                                        <input type="radio" name="sex" value ="Nam"  checked="checked"> <span>Nam</span>
                                        <input type="radio" name="sex" value = "Nữ" > <span>Nữ</span>
                                    </div>
                                    <div class="inf-1">
                                        <label>Địa chỉ: </label>
                                        <input type="text" name="diachi" placeholder="Nhập địa chỉ:">
                                    </div>
                                    <div class="inf-1">
                                        <label>Trường THPT: </label>
                                        <input type="text" name="THPT" placeholder="Nhập trường THPT: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Số điện thoại: </label>
                                        <input type="text" name="phone" placeholder="Nhập số điện thoại: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Email: </label>
                                        <input type="text" name="Email" value = ' . $_SESSION['Email'] . ' placeholder="Nhập Email: ">
                                    </div>
                                ';
                            }

                            ?>
                            <div class="separate"></div>
                            <div class="div-btn">
                                <button class="btn btn-add" name="add">Thêm thông tin </button>
                                <button class="btn btn-set" name=" set">Sửa thông tin</button>
                                <button class="btn btn-del" name="del">Xóa thông tin</button>
                            </div>
                        </form>
                    </div>

                    <div class="inf-gpa-add">
                        <form action="<?= ROOT_URL ?>auth/infor_crud.php" method="POST">
                            <?php
                            $sql = "Select * from scoreprofile sc, student st where sc.ScoreID = " . $_SESSION['UserID'] . " and sc.ScoreID = st.CCCD ";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                    <div class="inf-1">
                                        <label>CCCD:  </label>
                                        <input type="float" name="CCCD" value="' . $_SESSION['UserID'] . '" placeholder="Nhập điểm môn toán: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Điểm môn toán: </label>
                                        <input type="float" name="Toan" value="' . $row['Toan'] . '" placeholder="Nhập điểm môn toán: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Điểm môn văn: </label>
                                        <input type="float" name="Van" value = "' . $row['Van'] . '"  placeholder="Nhập điểm môn văn: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Điểm môn anh: </label>
                                        <input type="float" name="Anh" value = "' . $row['Anh'] . '" placeholder="Nhập điểm môn anh: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Điểm môn lý: </label>
                                        <input type="float" name="Ly" value = "' . $row['Ly'] . '" placeholder="Nhập điểm môn lý: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Điểm môn hóa: </label>
                                        <input type="float" name="Hoa" value = "' . $row['Hoa'] . '" placeholder="Nhập điểm môn hóa: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Điểm môn Sinh: </label>
                                        <input type="float" name="Sinh" value = "' . $row['Sinh'] . '" placeholder="Nhập điểm môn Sinh: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Điểm môn sử: </label>
                                        <input type="float" name="Su" value = "' . $row['Su'] . '" placeholder="Nhập điểm môn sử: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Điểm môn địa lý: </label>
                                        <input type="float" name="Dia" value = "' . $row['Dia'] . '" placeholder="Nhập điểm môn địa: ">
                                    </div>
                                    <div class="inf-1">
                                        <label>Điểm môn GDCD: </label>
                                        <input type="float" name="GDCD" value = "' . $row['GDCD'] . '" placeholder="Nhập điểm môn GDCD: ">
                                    </div>
                                    ';
                                }
                            }
                            if (mysqli_num_rows($result) == 0) {
                                echo '
                                <div class="inf-1">
                                    <label>CCCD:  </label>
                                    <input type="float" name="CCCD" value="' . $_SESSION['UserID'] . '" placeholder="Nhập điểm môn toán: ">
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn toán: </label>
                                    <input type="float" name="Toan" placeholder="Nhập điểm môn toán: ">
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn văn: </label>
                                    <input type="float" name="Van"placeholder="Nhập điểm môn văn: ">
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn anh: </label>
                                    <input type="float" name="Anh" placeholder="Nhập điểm môn anh: ">
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn lý: </label>
                                    <input type="float" name="Ly" placeholder="Nhập điểm môn lý: ">
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn hóa: </label>
                                    <input type="float" name="Hoa" placeholder="Nhập điểm môn hóa: ">
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn Sinh: </label>
                                    <input type="float" name="Sinh" placeholder="Nhập điểm môn Sinh: ">
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn sử: </label>
                                    <input type="float" name="Su" placeholder="Nhập điểm môn sử: ">
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn địa lý: </label>
                                    <input type="float" name="Dia" placeholder="Nhập điểm môn địa: ">
                                </div>
                                <div class="inf-1">
                                    <label>Điểm môn GDCD: </label>
                                    <input type="float" name="GDCD" placeholder="Nhập điểm môn GDCD: ">
                                </div>
                                ';
                            }

                            ?>
                            <div class="separate"></div>
                            <div class="div-btn">
                                <button class="btn btn-add" name="add_sroce">Thêm điểm
                                </button>
                                <button class="btn btn-set" name="set_score">Sửa điểm
                                </button>
                                <button class="btn btn-del" name="del_score">Xóa điểm
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="content-r">
                <?php include("layout/feature.php"); ?>
            </div>
        </div>
        <?php include("layout/footer.php"); ?>
        <script src="./assets/js/chatbox.js"></script>

</body>

</html>