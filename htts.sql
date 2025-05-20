-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 09:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `htts`
--

-- --------------------------------------------------------

--
-- Table structure for table `adviser`
--

CREATE TABLE `adviser` (
  `AdminID` int(10) NOT NULL,
  `Names` varchar(255) NOT NULL,
  `Sex` enum('Nam','Nữ','Khác','') NOT NULL,
  `Date of Birth` int(8) NOT NULL,
  `Origin` char(255) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dangkynganhhoc`
--

CREATE TABLE `dangkynganhhoc` (
  `DangKyID` int(10) NOT NULL,
  `HoSoID` int(10) NOT NULL,
  `Ma_nganh` int(10) NOT NULL,
  `Ma_To_Hop` int(3) NOT NULL,
  `Nguyen_Vong` int(2) NOT NULL,
  `Ket_Qua` enum('Trượt','Đỗ','Chờ','') NOT NULL,
  `Ngay_xet_tuyen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ketqua`
--

CREATE TABLE `ketqua` (
  `NotificationID` int(11) NOT NULL,
  `CCCD` int(12) NOT NULL,
  `TinNhanKetQua` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `UserID` int(12) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nganhhoc`
--

CREATE TABLE `nganhhoc` (
  `IDMaNganh` int(10) NOT NULL,
  `Ten_Nganh` varchar(255) NOT NULL,
  `Ma_Nganh` int(10) NOT NULL,
  `Chi_Tieu` int(4) NOT NULL,
  `To_Hop` varchar(255) NOT NULL,
  `Diem_Chuan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `nganhhoc`
--

INSERT INTO `nganhhoc` (`IDMaNganh`, `Ten_Nganh`, `Ma_Nganh`, `Chi_Tieu`, `To_Hop`, `Diem_Chuan`) VALUES
(1, 'Ngôn ngữ Anh', 7220201, 80, '\'K00\';\'D01\';\'D09\';\'D10\';\'D14\';\'D15\';\'D66\';\'D78\';\'D96\'', 0);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scoreprofile`
--

CREATE TABLE `scoreprofile` (
  `ScoreID` int(10) NOT NULL,
  `Toan` float NOT NULL,
  `Van` float NOT NULL,
  `Anh` float NOT NULL,
  `Ly` float NOT NULL,
  `Hoa` float NOT NULL,
  `Sinh` float NOT NULL,
  `Su` float NOT NULL,
  `Dia` float NOT NULL,
  `GDCD` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentID` int(10) NOT NULL,
  `Names` varchar(255) NOT NULL,
  `Sex` enum('Nam','Nữ','Khác','') NOT NULL,
  `Date of Birth` int(8) NOT NULL,
  `Origin` char(255) NOT NULL,
  `CCCD` varchar(12) NOT NULL,
  `HighSchool` varchar(255) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Score` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tintuc`
--

CREATE TABLE `tintuc` (
  `NewsID` int(10) NOT NULL,
  `Tieu_de` char(255) NOT NULL,
  `Noi_dung` text NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `tintuc`
--

INSERT INTO `tintuc` (`NewsID`, `Tieu_de`, `Noi_dung`, `Date`) VALUES
(1, 'DỰ THẢO ĐỀ ÁN TUYỂN SINH NĂM 2025', 'Mã trường: MDA\r\n<br><br>\r\nPhương thức tuyển sinh\r\nXét tuyển dựa vào kết quả thi tốt nghiệp THPT\r\n<br><br>\r\nTiêu chí tiếng Anh: Thí sinh có chứng chỉ tiếng Anh VSTEP hoặc chứng chỉ tiếng Anh quốc tế (đăng ký xác thực trên hệ thống) có thể quy đổi thành điểm môn tiếng Anh khi xét tuyển theo điểm thi tốt nghiệp THPT (tổ hợp A01, B08, D01, D07, D09, D0C, D10, D14, D15, D66, D78, D84, D96, K01)\r\nTiêu chí tiếng Trung Quốc: Thí sinh có chứng chỉ tiếng Trung Quốc HSK (đăng ký xác thực trên hệ thống) có thể quy đổi thành điểm môn Tiếng Trung Quốc khi xét tuyển theo điểm thi tốt nghiệp THPT vào ngành Ngôn ngữ Trung Quốc(Tổ hợp D04)\r\nChứng chỉ quốc tế, hồ sơ năng lực học tập\r\n<br><br>\r\nĐối tượng :Thí sinh có điểm trung bình chung (TBC) học tập từng năm học lớp 10, 11, 12 đạt 7.0 trở lên và đáp ứng một trong các điều kiện sau:\r\n<br><br>\r\nĐược chọn tham dự kỳ thi HSG Quốc gia do Bộ GD&ĐT tổ chức hoặc đoạt giải Nhất, Nhì, Ba hoặc Khuyến khích trong kỳ thi chọn HSG cấp tỉnh/thành phố do Sở GD&ĐT tổ chức (hoặc tương đương do các Đại học quốc gia, Đại học vùng tổ chức) các môn Toán, Lý, Hóa, Sinh, Tin, Ngoại ngữ, Tổ hợp trong thời gian học THPT;\r\n<br><br>\r\nCó ít nhất 1 trong các chứng chỉ Quốc tế sau: SAT, ACT...;\r\n<br><br>\r\nĐược chọn tham dự cuộc thi Đường lên đỉnh Olympia do Đài Truyền hình Việt Nam tổ chức từ vòng thi tháng trở lên\r\n<br><br>\r\nHọc sinh hệ chuyên (gồm chuyên Toán, Lý, Hóa, Sinh, Tin học, Ngoại ngữ) của các trường THPT và THPT chuyên trên toàn quốc, các lớp chuyên, hệ chuyên thuộc các Trường đại học, Đại học quốc gia, Đại học vùng.\r\n<br><br>\r\nXét tuyển thẳng HSG theo kết quả học THPT, HSG cấp quốc gia, quốc tế\r\n<br><br>\r\nThí sinh tốt nghiệp THPT năm 2025, đạt thành tích cao trong kỳ thi học sinh giỏi (HSG), cuộc thi Khoa học kỹ thuật (KHKT) do Bộ Giáo dục và Đào tạo tổ chức, cụ thể như sau:\r\n<br><br>\r\nThí sinh được triệu tập tham dự kỳ thi chọn đội tuyển quốc gia dự thi Olympic quốc tế và khu vực, hoặc đoạt giải Nhất, Nhì, Ba trong kỳ thi chọn HSG Quốc gia các môn văn hóa được xét tuyển thẳng vào các ngành học phù hợp với môn đạt giải.\r\n<br><br>\r\nThí sinh trong đội tuyển Quốc gia tham dự cuộc thi KHKT Quốc tế hoặc đạt giải Nhất, Nhì, Ba trong cuộc thi KHKT cấp Quốc gia do Bộ GD&ĐT tổ chức được xét tuyển thẳng vào ngành học phù hợp với lĩnh vực đề tài đã đăng ký dự thi.\r\n<br><br>\r\nSử dụng kết quả đánh giá tư duy của ĐH BKHN, ĐHQG\r\n<br><br>\r\nXét tuyển dựa vào kết quả học tập tại THPT\r\n<br><br>\r\nThí sinh tốt nghiệp THPT và kết quả học tập trong 6 học kỳ (Lớp 10,  11, và lớp 12). Xét tuyển thí sinh theo học bạ với các thí sinh đạt hạnh kiểm xếp loại Khá trở lên;\r\n<br><br>\r\nTổng điểm trung bình các môn học theo khối thi của 6 học kỳ THPT:  đạt từ 18 điểm trở lên.', '2025-05-20 12:54:29'),
(2, 'Về việc nghỉ học', 'Nhân dịp Lễ kỷ niệm ngày Giải phóng miền Nam 30/4 và ngày Quốc tế lao động 01/5, thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học từ ngày 30/4/2025 đến hết ngày 04/5/2025;\r\n<br><br>\r\n- Giáo viên lên kế hoạch dạy bù vào tuần dự trữ.', '2025-05-20 13:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `tohop`
--

CREATE TABLE `tohop` (
  `IDTo_Hop` int(10) NOT NULL,
  `Ma_To_Hop` char(3) NOT NULL,
  `Ten_To_Hop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adviser`
--
ALTER TABLE `adviser`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `dangkynganhhoc`
--
ALTER TABLE `dangkynganhhoc`
  ADD PRIMARY KEY (`DangKyID`);

--
-- Indexes for table `ketqua`
--
ALTER TABLE `ketqua`
  ADD PRIMARY KEY (`NotificationID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `email` (`Email`),
  ADD UNIQUE KEY `phone` (`Phone`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `nganhhoc`
--
ALTER TABLE `nganhhoc`
  ADD PRIMARY KEY (`IDMaNganh`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scoreprofile`
--
ALTER TABLE `scoreprofile`
  ADD PRIMARY KEY (`ScoreID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`NewsID`);

--
-- Indexes for table `tohop`
--
ALTER TABLE `tohop`
  ADD PRIMARY KEY (`IDTo_Hop`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nganhhoc`
--
ALTER TABLE `nganhhoc`
  MODIFY `IDMaNganh` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `NewsID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
