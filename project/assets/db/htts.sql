-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 27, 2025 lúc 07:44 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `htts`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `adviser`
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
-- Cấu trúc bảng cho bảng `dangkynganhhoc`
--

CREATE TABLE `dangkynganhhoc` (
  `DangKyID` int(10) NOT NULL,
  `CCCD` varchar(12) NOT NULL,
  `MaTruong` int(10) NOT NULL,
  `MaNganh` int(10) NOT NULL,
  `IDTo_Hop` int(3) NOT NULL,
  `Nguyen_Vong` int(2) NOT NULL,
  `Ket_Qua` enum('Trượt','Đỗ','Chờ','') NOT NULL,
  `Ngay_xet_tuyen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ketqua`
--

CREATE TABLE `ketqua` (
  `NotificationID` int(11) NOT NULL,
  `CCCD` int(12) NOT NULL,
  `TinNhanKetQua` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login`
--

CREATE TABLE `login` (
  `UserID` varchar(12) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `role` enum('user','admin','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `login`
--

INSERT INTO `login` (`UserID`, `Name`, `Password`, `Email`, `role`) VALUES
('001100056789', 'Ngô Thị B', 'ngothib123', '001100056789@gmail.com', 'user'),
('001200012345', 'Nguyễn Văn A', '001200012345', '001200012345@gmail.com', 'user'),
('001203012345', 'Nguyễn Phi', 'phi123', 'nguyenphi24032003@gmail.com', 'user'),
('001530014785', 'nguyen thi c', 'nguyenthic123', '001530014785@gmail.com', 'user'),
('admin', 'Quản trị viên', 'admin123', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganhhoc`
--

CREATE TABLE `nganhhoc` (
  `MaNganh` int(10) NOT NULL,
  `Ten_Nganh` varchar(255) NOT NULL,
  `Chi_Tieu` int(4) NOT NULL,
  `Ma_To_Hop` char(3) NOT NULL,
  `Diem_Chuan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `scoreprofile`
--

CREATE TABLE `scoreprofile` (
  `ScoreID` varchar(12) NOT NULL,
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

--
-- Đang đổ dữ liệu cho bảng `scoreprofile`
--

INSERT INTO `scoreprofile` (`ScoreID`, `Toan`, `Van`, `Anh`, `Ly`, `Hoa`, `Sinh`, `Su`, `Dia`, `GDCD`) VALUES
('001100056789', 9, 6, 7, 0, 0, 0, 8, 4, 10),
('001200012345', 9, 6, 7, 0, 0, 0, 8, 4, 10),
('001203012345', 9, 6, 7, 0, 0, 0, 8, 4, 10),
('001530014785', 9, 8, 7, 0, 0, 0, 8, 4, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `student_ID` int(10) NOT NULL,
  `Names` varchar(255) NOT NULL,
  `Sex` enum('Nam','Nữ','Khác','') NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Origin` char(255) NOT NULL,
  `CCCD` varchar(12) NOT NULL,
  `HighSchool` varchar(255) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`student_ID`, `Names`, `Sex`, `DateOfBirth`, `Origin`, `CCCD`, `HighSchool`, `Phone`, `Email`) VALUES
(1, 'Nguyễn Văn A ', 'Nam', '2007-09-11', 'số 255 Phố A, Huyện B, T.P Hà Nội', '001200012345', 'THPT DEF', '123456789', '001200012345@gmail.com'),
(2, 'Nguyễn Phi', 'Nam', '2003-04-16', 'Khu 5, Xóm 7, xã B,  Quận G, TP.HCM', '001203012345', 'TPHT gì gì đó ', '0345678912', '001203012345@gmail.com'),
(3, 'Ngô Thị B', 'Nữ', '2003-04-16', 'Khu B, Huyện B, TP. B', '001100056789', 'THPT B', '0366666666', '001100056789@gmail.com'),
(4, 'nguyen thi c ', 'Nam', '2025-04-29', 'Hà Nội', '001530014785', 'THPT Chiến thắng', '013456789', '001530014785@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `NewsID` int(10) NOT NULL,
  `Tieu_de` char(255) NOT NULL,
  `Noi_dung` text NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`NewsID`, `Tieu_de`, `Noi_dung`, `Date`) VALUES
(1, 'Về việc nghỉ học', 'Nhân dịp Lễ kỷ niệm ngày Giải phóng miền Nam 30/4 và ngày Quốc tế lao động 01/5, thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học từ ngày 30/4/2025 đến hết ngày 04/5/2025;\r\n<br><br>\r\n- Giáo viên lên kế hoạch dạy bù vào tuần dự trữ.', '2025-05-21 16:07:48'),
(2, 'Đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025', 'Thực hiện Kế hoạch năm học, để triển khai đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025 cho sinh viên hệ tín chỉ, Thừa lệnh Hiệu trưởng Phòng Đào tạo Đại học tổ chức cho sinh viên đăng ký trực tuyến các học phần (đăng ký nguyện vọng các môn cần học) như sau:\r\n<br><br>\r\n            Từ ngày 12/5/2025 đến hết 12h00 ngày 15/5/2025: Sinh viên đăng nhập vào trang: daotao.humg.edu.vn để đăng ký các học phần mong muốn học (đăng ký nguyện vọng các môn cần học) trong học kỳ phụ để: hoàn thành chương trình, kế hoạch đào tạo; cải thiện kết quả học tập (tối đa 05 học phần).\r\n<br><br>\r\n* Lưu ý: Phòng Đào tạo Đại học sẽ căn cứ vào nguyện vọng đăng ký này để mở lớp học phần và đăng ký cho sinh viên. Sinh viên có thể hiệu chỉnh kết quả đăng ký trong thời gian đăng ký chính thức.\r\n<br><br>\r\n            Đề nghị Ban chủ nhiệm các Khoa, Ban chủ nhiệm các Bộ môn, Giáo viên chủ nhiệm và Phòng Công tác Chính trị - Sinh viên thông báo cho sinh viên thuộc đơn vị mình quản lý thực hiện nghiêm túc thông báo này./.', '2025-05-20 00:00:00'),
(3, 'Thông báo về việc nghỉ học ngày lễ Giỗ tổ Hùng Vương năm 2025', 'Nhân dịp Lễ ngày Giỗ tổ Hùng Vương 10/3 (âm lịch), thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học ngày 07/4/2025 (thứ Hai).\r\n<br><br>\r\nĐề nghị BCN các khoa và bộ môn, giáo viên chủ nhiệm thông báo cho các lớp sinh viên thuộc đơn vị mình quản lý biết để thực hiện.', '2025-05-20 14:05:49'),
(4, 'Về việc nghỉ học', 'Nhân dịp Lễ kỷ niệm ngày Giải phóng miền Nam 30/4 và ngày Quốc tế lao động 01/5, thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học từ ngày 30/4/2025 đến hết ngày 04/5/2025;\r\n<br><br>\r\n- Giáo viên lên kế hoạch dạy bù vào tuần dự trữ.', '2025-05-20 00:00:00'),
(5, 'Đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025', 'Thực hiện Kế hoạch năm học, để triển khai đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025 cho sinh viên hệ tín chỉ, Thừa lệnh Hiệu trưởng Phòng Đào tạo Đại học tổ chức cho sinh viên đăng ký trực tuyến các học phần (đăng ký nguyện vọng các môn cần học) như sau:\r\n<br><br>\r\n            Từ ngày 12/5/2025 đến hết 12h00 ngày 15/5/2025: Sinh viên đăng nhập vào trang: daotao.humg.edu.vn để đăng ký các học phần mong muốn học (đăng ký nguyện vọng các môn cần học) trong học kỳ phụ để: hoàn thành chương trình, kế hoạch đào tạo; cải thiện kết quả học tập (tối đa 05 học phần).\r\n<br><br>\r\n* Lưu ý: Phòng Đào tạo Đại học sẽ căn cứ vào nguyện vọng đăng ký này để mở lớp học phần và đăng ký cho sinh viên. Sinh viên có thể hiệu chỉnh kết quả đăng ký trong thời gian đăng ký chính thức.\r\n<br><br>\r\n            Đề nghị Ban chủ nhiệm các Khoa, Ban chủ nhiệm các Bộ môn, Giáo viên chủ nhiệm và Phòng Công tác Chính trị - Sinh viên thông báo cho sinh viên thuộc đơn vị mình quản lý thực hiện nghiêm túc thông báo này./.', '2025-05-21 16:07:59'),
(6, 'Thông báo về việc nghỉ học ngày lễ Giỗ tổ Hùng Vương năm 2025', 'Nhân dịp Lễ ngày Giỗ tổ Hùng Vương 10/3 (âm lịch), thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học ngày 07/4/2025 (thứ Hai).\r\n<br><br>\r\nĐề nghị BCN các khoa và bộ môn, giáo viên chủ nhiệm thông báo cho các lớp sinh viên thuộc đơn vị mình quản lý biết để thực hiện.', '2025-05-20 14:05:49'),
(7, 'Đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025', 'Thực hiện Kế hoạch năm học, để triển khai đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025 cho sinh viên hệ tín chỉ, Thừa lệnh Hiệu trưởng Phòng Đào tạo Đại học tổ chức cho sinh viên đăng ký trực tuyến các học phần (đăng ký nguyện vọng các môn cần học) như sau:\r\n<br><br>\r\n            Từ ngày 12/5/2025 đến hết 12h00 ngày 15/5/2025: Sinh viên đăng nhập vào trang: daotao.humg.edu.vn để đăng ký các học phần mong muốn học (đăng ký nguyện vọng các môn cần học) trong học kỳ phụ để: hoàn thành chương trình, kế hoạch đào tạo; cải thiện kết quả học tập (tối đa 05 học phần).\r\n<br><br>\r\n* Lưu ý: Phòng Đào tạo Đại học sẽ căn cứ vào nguyện vọng đăng ký này để mở lớp học phần và đăng ký cho sinh viên. Sinh viên có thể hiệu chỉnh kết quả đăng ký trong thời gian đăng ký chính thức.\r\n<br><br>\r\n            Đề nghị Ban chủ nhiệm các Khoa, Ban chủ nhiệm các Bộ môn, Giáo viên chủ nhiệm và Phòng Công tác Chính trị - Sinh viên thông báo cho sinh viên thuộc đơn vị mình quản lý thực hiện nghiêm túc thông báo này./.', '2025-05-20 00:00:00'),
(8, 'Thông báo về việc nghỉ học ngày lễ Giỗ tổ Hùng Vương năm 2025', 'Nhân dịp Lễ ngày Giỗ tổ Hùng Vương 10/3 (âm lịch), thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học ngày 07/4/2025 (thứ Hai).\r\n<br><br>\r\nĐề nghị BCN các khoa và bộ môn, giáo viên chủ nhiệm thông báo cho các lớp sinh viên thuộc đơn vị mình quản lý biết để thực hiện.', '2025-05-20 14:05:49'),
(9, 'Đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025', 'Thực hiện Kế hoạch năm học, để triển khai đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025 cho sinh viên hệ tín chỉ, Thừa lệnh Hiệu trưởng Phòng Đào tạo Đại học tổ chức cho sinh viên đăng ký trực tuyến các học phần (đăng ký nguyện vọng các môn cần học) như sau:\r\n<br><br>\r\n            Từ ngày 12/5/2025 đến hết 12h00 ngày 15/5/2025: Sinh viên đăng nhập vào trang: daotao.humg.edu.vn để đăng ký các học phần mong muốn học (đăng ký nguyện vọng các môn cần học) trong học kỳ phụ để: hoàn thành chương trình, kế hoạch đào tạo; cải thiện kết quả học tập (tối đa 05 học phần).\r\n<br><br>\r\n* Lưu ý: Phòng Đào tạo Đại học sẽ căn cứ vào nguyện vọng đăng ký này để mở lớp học phần và đăng ký cho sinh viên. Sinh viên có thể hiệu chỉnh kết quả đăng ký trong thời gian đăng ký chính thức.\r\n<br><br>\r\n            Đề nghị Ban chủ nhiệm các Khoa, Ban chủ nhiệm các Bộ môn, Giáo viên chủ nhiệm và Phòng Công tác Chính trị - Sinh viên thông báo cho sinh viên thuộc đơn vị mình quản lý thực hiện nghiêm túc thông báo này./.', '2025-05-21 16:08:09'),
(10, 'Thông báo về việc nghỉ học ngày lễ Giỗ tổ Hùng Vương năm 2025', 'Nhân dịp Lễ ngày Giỗ tổ Hùng Vương 10/3 (âm lịch), thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học ngày 07/4/2025 (thứ Hai).\r\n<br><br>\r\nĐề nghị BCN các khoa và bộ môn, giáo viên chủ nhiệm thông báo cho các lớp sinh viên thuộc đơn vị mình quản lý biết để thực hiện.', '2025-05-20 14:05:49'),
(11, 'Về việc nghỉ học', 'Nhân dịp Lễ kỷ niệm ngày Giải phóng miền Nam 30/4 và ngày Quốc tế lao động 01/5, thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học từ ngày 30/4/2025 đến hết ngày 04/5/2025;\r\n<br><br>\r\n- Giáo viên lên kế hoạch dạy bù vào tuần dự trữ.', '2025-05-21 16:13:35'),
(12, 'Đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025', 'Thực hiện Kế hoạch năm học, để triển khai đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025 cho sinh viên hệ tín chỉ, Thừa lệnh Hiệu trưởng Phòng Đào tạo Đại học tổ chức cho sinh viên đăng ký trực tuyến các học phần (đăng ký nguyện vọng các môn cần học) như sau:\r\n<br><br>\r\n            Từ ngày 12/5/2025 đến hết 12h00 ngày 15/5/2025: Sinh viên đăng nhập vào trang: daotao.humg.edu.vn để đăng ký các học phần mong muốn học (đăng ký nguyện vọng các môn cần học) trong học kỳ phụ để: hoàn thành chương trình, kế hoạch đào tạo; cải thiện kết quả học tập (tối đa 05 học phần).\r\n<br><br>\r\n* Lưu ý: Phòng Đào tạo Đại học sẽ căn cứ vào nguyện vọng đăng ký này để mở lớp học phần và đăng ký cho sinh viên. Sinh viên có thể hiệu chỉnh kết quả đăng ký trong thời gian đăng ký chính thức.\r\n<br><br>\r\n            Đề nghị Ban chủ nhiệm các Khoa, Ban chủ nhiệm các Bộ môn, Giáo viên chủ nhiệm và Phòng Công tác Chính trị - Sinh viên thông báo cho sinh viên thuộc đơn vị mình quản lý thực hiện nghiêm túc thông báo này./.', '2025-05-21 16:13:35'),
(13, 'Thông báo về việc nghỉ học ngày lễ Giỗ tổ Hùng Vương năm 2025', 'Nhân dịp Lễ ngày Giỗ tổ Hùng Vương 10/3 (âm lịch), thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học ngày 07/4/2025 (thứ Hai).\r\n<br><br>\r\nĐề nghị BCN các khoa và bộ môn, giáo viên chủ nhiệm thông báo cho các lớp sinh viên thuộc đơn vị mình quản lý biết để thực hiện.', '2025-05-21 16:13:35'),
(14, 'Đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025', 'Thực hiện Kế hoạch năm học, để triển khai đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025 cho sinh viên hệ tín chỉ, Thừa lệnh Hiệu trưởng Phòng Đào tạo Đại học tổ chức cho sinh viên đăng ký trực tuyến các học phần (đăng ký nguyện vọng các môn cần học) như sau:\r\n<br><br>\r\n            Từ ngày 12/5/2025 đến hết 12h00 ngày 15/5/2025: Sinh viên đăng nhập vào trang: daotao.humg.edu.vn để đăng ký các học phần mong muốn học (đăng ký nguyện vọng các môn cần học) trong học kỳ phụ để: hoàn thành chương trình, kế hoạch đào tạo; cải thiện kết quả học tập (tối đa 05 học phần).\r\n<br><br>\r\n* Lưu ý: Phòng Đào tạo Đại học sẽ căn cứ vào nguyện vọng đăng ký này để mở lớp học phần và đăng ký cho sinh viên. Sinh viên có thể hiệu chỉnh kết quả đăng ký trong thời gian đăng ký chính thức.\r\n<br><br>\r\n            Đề nghị Ban chủ nhiệm các Khoa, Ban chủ nhiệm các Bộ môn, Giáo viên chủ nhiệm và Phòng Công tác Chính trị - Sinh viên thông báo cho sinh viên thuộc đơn vị mình quản lý thực hiện nghiêm túc thông báo này./.', '2025-05-21 16:13:35'),
(15, 'Thông báo về việc nghỉ học ngày lễ Giỗ tổ Hùng Vương năm 2025', 'Nhân dịp Lễ ngày Giỗ tổ Hùng Vương 10/3 (âm lịch), thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học ngày 07/4/2025 (thứ Hai).\r\n<br><br>\r\nĐề nghị BCN các khoa và bộ môn, giáo viên chủ nhiệm thông báo cho các lớp sinh viên thuộc đơn vị mình quản lý biết để thực hiện.', '2025-05-21 16:13:35'),
(16, 'Đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025', 'Thực hiện Kế hoạch năm học, để triển khai đăng ký khối lượng học tập học kỳ phụ năm học 2024-2025 cho sinh viên hệ tín chỉ, Thừa lệnh Hiệu trưởng Phòng Đào tạo Đại học tổ chức cho sinh viên đăng ký trực tuyến các học phần (đăng ký nguyện vọng các môn cần học) như sau:\r\n<br><br>\r\n            Từ ngày 12/5/2025 đến hết 12h00 ngày 15/5/2025: Sinh viên đăng nhập vào trang: daotao.humg.edu.vn để đăng ký các học phần mong muốn học (đăng ký nguyện vọng các môn cần học) trong học kỳ phụ để: hoàn thành chương trình, kế hoạch đào tạo; cải thiện kết quả học tập (tối đa 05 học phần).\r\n<br><br>\r\n* Lưu ý: Phòng Đào tạo Đại học sẽ căn cứ vào nguyện vọng đăng ký này để mở lớp học phần và đăng ký cho sinh viên. Sinh viên có thể hiệu chỉnh kết quả đăng ký trong thời gian đăng ký chính thức.\r\n<br><br>\r\n            Đề nghị Ban chủ nhiệm các Khoa, Ban chủ nhiệm các Bộ môn, Giáo viên chủ nhiệm và Phòng Công tác Chính trị - Sinh viên thông báo cho sinh viên thuộc đơn vị mình quản lý thực hiện nghiêm túc thông báo này./.', '2025-05-21 16:13:35'),
(17, 'Thông báo về việc nghỉ học ngày lễ Giỗ tổ Hùng Vương năm 2025', 'Nhân dịp Lễ ngày Giỗ tổ Hùng Vương 10/3 (âm lịch), thừa lệnh Hiệu trưởng, phòng Đào tạo Đại học thông báo:\r\n<br><br>\r\n- Sinh viên toàn trường nghỉ học ngày 07/4/2025 (thứ Hai).\r\n<br><br>\r\nĐề nghị BCN các khoa và bộ môn, giáo viên chủ nhiệm thông báo cho các lớp sinh viên thuộc đơn vị mình quản lý biết để thực hiện.', '2025-05-21 16:13:35'),
(18, 'Hướng dẫn quy trình Thực tập, Đồ án (từ Học kỳ 2 năm học 2023-2024)', 'Lưu ý: \r\n<br><br>\r\nSinh viên không làm các Thủ tục 14, 15, 16, 17 tại Bộ phận Một cửa. Sinh viên đăng ký với Bộ môn theo hướng dẫn ở trên.\r\nNhà trường triển khai 4 đợt Thực tập, Tốt nghiệp vào đầu các Giai đoạn 1A, 1B, 2A, 2B (giai đoạn Học kỳ phụ có thể được bổ sung tùy điều kiện)', '2025-05-21 19:42:28'),
(19, 'Hướng dẫn đăng ký khối lượng học tập tại trang web daotaodaihoc.humg.edu.vn', 'Bước 1: Đăng nhập vào tài khoản tại trang web daotaodaihoc.humg.edu.vn\r\n<br><br>\r\nBước 2: Chọn chức năng đăng ký chính thức môn học\r\n<br><br>\r\nBước 3: Lọc môn học cần đăng ký (Theo mã môn học để đảm bảo không bị đăng ký nhầm)\r\n<br><br>\r\nBước 4: Lựa chọn nhóm học có thời khóa biểu phù hợp với nhu cầu (Lưu ý quan sát thời khóa biểu, Số lượng còn lại của Nhóm trước khi tích chọn nhóm phù hợp)\r\n<br><br>\r\nBước 5:  Kiểm tra kết quả đã được lựa chọn ở phần danh sách môn học đã đăng ký ( gần cuối trang)\r\n<br><br>\r\nLưu ý tại bước này sinh viên có thể hủy nhóm không mong muốn bằng cách click chuột vào dòng môn tương ứng tại cột xóa bên trái màn hình.\r\n<br><br>\r\nCuối cùng xuất phiếu đăng ký và kiểm tra thời khóa biểu ( Thời khóa biểu học kỳ) để kiểm tra lại toàn bộ khối lượng đã đăng ký', '2025-05-21 19:45:41'),
(20, 'Hướng dẫn lấy lại mật khẩu trang web daotaodaihoc.humg.edu.vn', 'Để lấy lại mật khẩu trang web đào tạo bạn làm như sau:\r\n<br><br>\r\n1. Truy cập địa chỉ: daotaodaihoc.humg.edu.vn\r\n<br><br>\r\n2. Bấm vào nút “Quên mật khẩu”\r\n<br><br>\r\n3. Nhập thông tin tài khoản: Mã sinh viên và địa chỉ e-mail để nhận mật khẩu tạm thời (Lưu ý: Mặc định là email do nhà trường cấp có dạng msv@student.humg.edu.vn . Nếu bạn đã đổi sang e-mail khác, vui lòng nhập e-mail đó)\r\n<br><br>\r\nNhập xong thông tin ở trên chọn nút “Gửi”\r\n<br><br>\r\n4. Truy cập vào e-mail đã nhập ở trên để lấy mật khẩu tạm thời (LƯU Ý: nếu không nhận được e-mail trong Inbox, vui lòng kiểm tra trong Spam - mục thư rác)\r\n<br><br>\r\n5. Đăng nhập lại vào trang daotaodaihoc.humg.edu.vn với thông tin tài khoản và mật khẩu tạm thời. Bạn nên đổi lại mật khẩu theo ý mình!', '2025-05-21 19:46:45'),
(21, 'Hướng dẫn lấy lại mật khẩu e-mail HUMG', 'Vui lòng click chuột vào link bên dưới để xem hướng dẫn:\r\n<br><br>\r\nClick để xem tại đây: File PDF hướng dẫn', '2025-05-21 19:47:20'),
(22, 'Hướng dẫn kiểm tra, tra cứu trực tuyến thông tin về bằng tốt nghiệp của trường Đại học Mỏ - Địa chất', 'Vui lòng click chuột vào link bên dưới để xem hướng dẫn:\r\n<br><br>\r\nHướng dẫn kiểm tra thông tin trên bằng tốt nghiệp', '2025-05-21 19:47:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tohop`
--

CREATE TABLE `tohop` (
  `IDTo_Hop` int(10) NOT NULL,
  `Ma_To_Hop` char(3) NOT NULL,
  `Ten_To_Hop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `truong`
--

CREATE TABLE `truong` (
  `MaTruong` int(10) NOT NULL,
  `TenTruong` varchar(255) NOT NULL,
  `MaNganh` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `adviser`
--
ALTER TABLE `adviser`
  ADD PRIMARY KEY (`AdminID`);

--
-- Chỉ mục cho bảng `dangkynganhhoc`
--
ALTER TABLE `dangkynganhhoc`
  ADD PRIMARY KEY (`DangKyID`),
  ADD KEY `MaTruong` (`MaTruong`),
  ADD KEY `tohop` (`IDTo_Hop`),
  ADD KEY `cccd` (`CCCD`),
  ADD KEY `manganh` (`MaNganh`);

--
-- Chỉ mục cho bảng `ketqua`
--
ALTER TABLE `ketqua`
  ADD PRIMARY KEY (`NotificationID`);

--
-- Chỉ mục cho bảng `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `email` (`Email`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `nganhhoc`
--
ALTER TABLE `nganhhoc`
  ADD PRIMARY KEY (`MaNganh`);

--
-- Chỉ mục cho bảng `scoreprofile`
--
ALTER TABLE `scoreprofile`
  ADD PRIMARY KEY (`ScoreID`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_ID`),
  ADD KEY `id` (`CCCD`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`NewsID`);

--
-- Chỉ mục cho bảng `tohop`
--
ALTER TABLE `tohop`
  ADD PRIMARY KEY (`IDTo_Hop`);

--
-- Chỉ mục cho bảng `truong`
--
ALTER TABLE `truong`
  ADD PRIMARY KEY (`MaTruong`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `student`
--
ALTER TABLE `student`
  MODIFY `student_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `NewsID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dangkynganhhoc`
--
ALTER TABLE `dangkynganhhoc`
  ADD CONSTRAINT `MaTruong` FOREIGN KEY (`MaTruong`) REFERENCES `truong` (`MaTruong`),
  ADD CONSTRAINT `cccd` FOREIGN KEY (`CCCD`) REFERENCES `login` (`UserID`),
  ADD CONSTRAINT `manganh` FOREIGN KEY (`MaNganh`) REFERENCES `nganhhoc` (`MaNganh`),
  ADD CONSTRAINT `tohop` FOREIGN KEY (`IDTo_Hop`) REFERENCES `tohop` (`IDTo_Hop`);

--
-- Các ràng buộc cho bảng `scoreprofile`
--
ALTER TABLE `scoreprofile`
  ADD CONSTRAINT `Diemso` FOREIGN KEY (`ScoreID`) REFERENCES `student` (`CCCD`);

--
-- Các ràng buộc cho bảng `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `id` FOREIGN KEY (`CCCD`) REFERENCES `login` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
