-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2022 at 07:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `du_an_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `kind_of_room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_comment` varchar(255) NOT NULL,
  `date_created_comment` date NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `kind_of_room_id`, `user_id`, `content_comment`, `date_created_comment`, `status`) VALUES
(18, 4, 16, 'abc', '2022-12-08', 'Đã Duyệt'),
(19, 21, 14, 'Nguyen Dinh Dang', '2022-12-08', 'Đã Duyệt');

-- --------------------------------------------------------

--
-- Table structure for table `kindroom`
--

CREATE TABLE `kindroom` (
  `kind_of_room_id` int(11) NOT NULL,
  `kind_of_room` varchar(64) NOT NULL,
  `price` float NOT NULL,
  `describe` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kindroom`
--

INSERT INTO `kindroom` (`kind_of_room_id`, `kind_of_room`, `price`, `describe`, `image`, `quantity_max`) VALUES
(1, 'Phòng Đơn', 300000, 'Rio Deal Guest House is only 200 metres from Rio de Janeiro’s Copacabana Beach, offering private accommodation as well as free WiFi and communal lounge areas.', 'uploads/khachsan1.jpg', 1),
(2, 'Phòng Đôi', 500000, 'Nhưng trên sân bóng, 90 phút trước Ecuador giúp đội chủ nhà \"tỉnh mộng\". Đội tuyển Qatar lộ rõ sự bỡ ngỡ ở lần đầu đặt chân ra biển lớn với thất bại toàn diện. Các cổ động viên bỏ về sớm trong khi HLV trưởng Felix Sanchez bên ngoài sân trưng ra bộ mặt thất thần như khi dẫn dắt chính những học trò này thua U23 Việt Nam ở Thường Châu.\r\n\r\n', 'uploads/khachSan2.jpg', 2),
(3, 'Phòng Gia Đình', 800000, 'Rio Deal Guest House is only 200 metres from Rio de Janeiro’s Copacabana Beach, offering private accommodation as well as free WiFi and communal lounge areas.', 'uploads/khachSan3.jpg', 3),
(4, 'Phòng Tổng Thống', 1000000, 'Rio Deal Guest House is only 200 metres from Rio de Janeiro’s Copacabana Beach, offering private accommodation as well as free WiFi and communal lounge areas.', 'uploads/khachSan4.jpg', 4),
(5, 'Phòng Thủ Tướng', 100000, 'Situated in Rio de Janeiro, 400 metres from Copacabana Beach, Chegou o Pé na Areia em Plena Praia de Copacabana, incrível apto de 2 e 3 Quartos, tudo novo e decorado, 50m da Praia, com cozinha e...', 'uploads/khachSan7.jpg', 5),
(21, 'Phòng Nhóm 2', 2000000, 'Situated in Rio de Janeiro, 400 metres from Copacabana Beach, Chegou o Pé na Areia em Plena Praia de Copacabana, incrível apto de 2 e 3 Quartos, tudo novo e decorado, 50m da Praia, com cozinha e...', 'uploads/nhom2.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `order_detailed`
--

CREATE TABLE `order_detailed` (
  `id_order_detailed` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `rombooked_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_status` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `order_detailed`
--

INSERT INTO `order_detailed` (`id_order_detailed`, `room_id`, `rombooked_id`, `amount`, `order_status`) VALUES
(148, 83, 96, 1, 'Đang Sử Dụng'),
(149, 97, 96, 1, 'Đang Sử Dụng'),
(150, 86, 97, 2, 'Đã Trả Phòng'),
(151, 96, 97, 2, 'Đã Trả Phòng');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `name_room` varchar(64) NOT NULL,
  `kind_of_room_id` int(11) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `name_room`, `kind_of_room_id`, `status`) VALUES
(83, 'Phòng 101', 1, 'Bảo trì'),
(86, 'Phòng 202', 2, 'Có thể sử dụng'),
(87, 'Phòng 301', 3, 'Có thể sử dụng'),
(90, 'Phòng 502', 4, 'Có thể sử dụng'),
(91, 'Phòng 601', 5, 'Có thể sử dụng'),
(92, 'Phòng 1000', 21, 'Có thể sử dụng'),
(95, 'Phòng 203', 2, 'Có thể sử dụng'),
(96, 'Phòng 204', 2, 'Có thể sử dụng'),
(97, 'phòng 102', 1, 'Bảo trì'),
(98, 'phòng 103', 1, 'Có thể sử dụng'),
(103, 'Phòng 201', 2, 'Có thể sử dụng'),
(107, 'Phòng 302', 3, 'Có thể sử dụng'),
(108, 'Phòng 303', 3, 'Có thể sử dụng');

-- --------------------------------------------------------

--
-- Table structure for table `roombooked`
--

CREATE TABLE `roombooked` (
  `rombooked_id` int(11) NOT NULL,
  `kind_of_room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `amount` int(11) NOT NULL,
  `total_money` float NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roombooked`
--

INSERT INTO `roombooked` (`rombooked_id`, `kind_of_room_id`, `user_id`, `start_time`, `end_time`, `amount`, `total_money`, `status`, `created_time`) VALUES
(96, 1, 14, '2022-12-09', '2022-12-10', 1, 300000, 'Đã Duyệt', '2022-12-09 12:53:29'),
(97, 2, 15, '2022-12-06', '2022-12-09', 2, 1500000, 'Đã Duyệt', '2022-12-09 12:53:50'),
(98, 1, 16, '2022-12-09', '2022-12-10', 6, 300000, 'Đã hết phòng', '2022-12-09 12:54:46'),
(99, 2, 16, '2022-12-09', '2022-12-10', 4, 500000, 'Chưa Duyệt', '2022-12-09 12:56:02'),
(100, 2, 16, '2022-12-09', '2022-12-09', 1, 0, 'Đã hết phòng', '2022-12-09 12:56:13'),
(101, 2, 16, '2022-12-09', '2022-12-09', 1, 0, 'Đã hết phòng', '2022-12-09 12:56:20'),
(102, 2, 16, '2022-12-09', '2022-12-09', 3, 0, 'Đã hết phòng', '2022-12-09 12:56:27'),
(103, 2, 16, '2022-12-09', '2022-12-09', 1, 0, 'Đã hết phòng', '2022-12-09 12:56:35'),
(104, 2, 16, '2022-12-09', '2022-12-09', 1, 0, 'Đã hết phòng', '2022-12-09 12:56:56'),
(105, 2, 16, '2022-12-09', '2022-12-09', 1, 0, 'Đã hết phòng', '2022-12-09 12:57:01'),
(106, 2, 16, '2022-12-09', '2022-12-09', 1, 0, 'Chưa Duyệt', '2022-12-09 12:57:07'),
(107, 2, 16, '2022-12-09', '2022-12-09', 1, 0, 'Chưa Duyệt', '2022-12-09 12:57:13'),
(108, 2, 16, '2022-12-09', '2022-12-09', 1, 0, 'Chưa Duyệt', '2022-12-09 12:57:20'),
(109, 2, 16, '2022-12-09', '2022-12-09', 3, 0, 'Chưa Duyệt', '2022-12-09 12:57:35'),
(110, 2, 16, '2022-12-09', '2022-12-09', 3, 0, 'Chưa Duyệt', '2022-12-09 12:57:43'),
(111, 2, 16, '2022-12-09', '2022-12-09', 4, 0, 'Đã hết phòng', '2022-12-09 12:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `roomimage`
--

CREATE TABLE `roomimage` (
  `room_image_id` int(11) NOT NULL,
  `kind_of_room_id` int(11) NOT NULL,
  `image_room` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roomimage`
--

INSERT INTO `roomimage` (`room_image_id`, `kind_of_room_id`, `image_room`) VALUES
(18, 2, 'uploads/khachsan1.jpg'),
(19, 2, 'uploads/khachSan2.jpg'),
(94, 1, 'uploads/khachSan3.jpg'),
(95, 1, 'uploads/khachSan4.jpg'),
(96, 3, 'uploads/khachSan4.jpg'),
(97, 3, 'uploads/khachSan5.jpg'),
(98, 4, 'uploads/khachSan5.jpg'),
(99, 4, 'uploads/khachSan5.jpg'),
(100, 19, 'uploads/khachSan8.jpg'),
(101, 19, 'uploads/khachSan9.jpg'),
(102, 21, 'uploads/khachSan4.jpg'),
(103, 21, 'uploads/khachSan2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name_user` varchar(64) NOT NULL,
  `phone_number_user` varchar(255) NOT NULL,
  `password_user` varchar(64) NOT NULL,
  `status` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `mail_user` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name_user`, `phone_number_user`, `password_user`, `status`, `id_role`, `mail_user`) VALUES
(13, 'userA', '0123456789', 'af8f9dffa5d420fbc249141645b962ee', 1, 1, 'al@gamil.com'),
(14, 'userB', '0398123452', '8989e805956d8fdeeeaf0007ac273217', 1, 2, 'b@gmail.com'),
(15, 'userC', '0398567251', '3e19b5009c3f24642936caa810c1d4ba', 1, 2, 'c@gmail.com'),
(16, 'userD', '0398263456', '4d335a189a740b71d8814777c8aa8df4', 1, 2, 'd@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `ik_comment` (`kind_of_room_id`),
  ADD KEY `ik_comment_user` (`user_id`);

--
-- Indexes for table `kindroom`
--
ALTER TABLE `kindroom`
  ADD PRIMARY KEY (`kind_of_room_id`);

--
-- Indexes for table `order_detailed`
--
ALTER TABLE `order_detailed`
  ADD PRIMARY KEY (`id_order_detailed`),
  ADD KEY `lk room` (`room_id`),
  ADD KEY `lk_room_booked` (`rombooked_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `lk_kindroom` (`kind_of_room_id`);

--
-- Indexes for table `roombooked`
--
ALTER TABLE `roombooked`
  ADD PRIMARY KEY (`rombooked_id`),
  ADD KEY `ik_booked` (`kind_of_room_id`),
  ADD KEY `ik_user_id` (`user_id`);

--
-- Indexes for table `roomimage`
--
ALTER TABLE `roomimage`
  ADD PRIMARY KEY (`room_image_id`),
  ADD KEY `ik_room_image` (`kind_of_room_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `ik_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kindroom`
--
ALTER TABLE `kindroom`
  MODIFY `kind_of_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `order_detailed`
--
ALTER TABLE `order_detailed`
  MODIFY `id_order_detailed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `roombooked`
--
ALTER TABLE `roombooked`
  MODIFY `rombooked_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `roomimage`
--
ALTER TABLE `roomimage`
  MODIFY `room_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `ik_comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `ik_kindRoom_coment` FOREIGN KEY (`kind_of_room_id`) REFERENCES `kindroom` (`kind_of_room_id`);

--
-- Constraints for table `order_detailed`
--
ALTER TABLE `order_detailed`
  ADD CONSTRAINT `lk_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `lk_room_booked` FOREIGN KEY (`rombooked_id`) REFERENCES `roombooked` (`rombooked_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `lk_kindroom` FOREIGN KEY (`kind_of_room_id`) REFERENCES `kindroom` (`kind_of_room_id`);

--
-- Constraints for table `roombooked`
--
ALTER TABLE `roombooked`
  ADD CONSTRAINT `ik_kind_of_room_id` FOREIGN KEY (`kind_of_room_id`) REFERENCES `kindroom` (`kind_of_room_id`),
  ADD CONSTRAINT `ik_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `ik_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
