-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 06:07 AM
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
  `MaNganh` int(10) NOT NULL,
  `Ten_Nganh` varchar(255) NOT NULL,
  `Ma_Nganh` int(10) NOT NULL,
  `Chi_Tieu` int(4) NOT NULL,
  `Ma_To_Hop` char(3) NOT NULL,
  `Diem_Chuan` float NOT NULL
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
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

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
  ADD PRIMARY KEY (`MaNganh`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
