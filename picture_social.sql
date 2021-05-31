-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 31, 2021 lúc 11:37 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `picture_social`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `link` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `avatar`
--

INSERT INTO `avatar` (`id`, `id_user`, `link`) VALUES
(1, 'hatq', '../Avatar/ava1.png'),
(2, 'a', '../Avatar/ava2.png'),
(3, 'xxx', '../Avatar/ava3.png'),
(4, 'abc', '../Avatar/socute.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_post` int(11) NOT NULL,
  `content` varchar(4000) CHARACTER SET utf8 NOT NULL,
  `publish` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `id_user`, `id_post`, `content`, `publish`) VALUES
(2, 'hatq', 4, 'Thank you', '2021-04-20 07:10:10'),
(3, 'a', 1, 'Hello', '2021-03-20 15:00:00'),
(5, 'a', 3, 'Hello', '2021-05-05 19:44:36'),
(8, 'a', 3, 'hello', '2021-05-18 10:10:31'),
(11, 'hatq', 3, 'Goodnight lady', '2021-05-26 20:31:17'),
(12, 'hatq', 2, 'Wow', '2021-05-26 20:57:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `id_follow` varchar(50) NOT NULL,
  `id_followed` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `follow`
--

INSERT INTO `follow` (`id`, `id_follow`, `id_followed`) VALUES
(1, 'hatq', 'a'),
(2, 'hatq', 'xxx'),
(7, 'a', 'hatq'),
(9, '', 'a');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `sex` varchar(50) NOT NULL,
  `hobby` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `info_introduce` varchar(4000) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `info`
--

INSERT INTO `info` (`id`, `id_user`, `date_of_birth`, `sex`, `hobby`, `info_introduce`) VALUES
(4, 'a', '2000-02-23', 'Nữ', 'Xem phim@Nghe nhạc@Đọc sách', 'Love all'),
(5, 'abc', '2000-02-23', 'Nữ', 'Xem phim@Nghe nhạc@Đọc sách', 'Love all'),
(6, 'hatq', '2000-08-31', 'Nam', 'Xem phim@Nghe nhạc@Đọc sách', 'Please open the door!\r\nThe love is waiting!!!! ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nofitication`
--

CREATE TABLE `nofitication` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `content` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `id_user_no` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nofitication`
--

INSERT INTO `nofitication` (`id`, `id_user`, `status`, `content`, `link`, `id_user_no`, `date`) VALUES
(2, 'hatq', 0, 'likes your post', 'Featured_photo.php?id=14', 'a', '2021-05-29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `link` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `picture`
--

INSERT INTO `picture` (`id`, `id_post`, `id_user`, `link`) VALUES
(1, 1, 'hatq', '../UploadPicture/taha1.png'),
(2, 2, 'hatq', '../UploadPicture/taha2.jpg'),
(3, 3, 'a', '../UploadPicture/huta1.jpg'),
(4, 4, 'a', '../UploadPicture/huta2.jpg'),
(5, 5, 'a', '../UploadPicture/huta3.jpg'),
(10, 14, 'a', '../UploadPicture/socute.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `caption` varchar(4000) CHARACTER SET utf8 NOT NULL,
  `vote` int(11) NOT NULL,
  `publish_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `id_user`, `caption`, `vote`, `publish_time`) VALUES
(1, 'hatq', 'hello', 3, '2021-03-20 12:12:12'),
(2, 'hatq', 'Hello my love', 0, '2021-04-10 05:06:10'),
(3, 'a', 'Goodnight', 3, '2021-04-15 23:10:20'),
(4, 'a', 'Have a good day', 2, '2021-04-20 06:15:30'),
(5, 'a', 'So beautiful', 1, '2021-03-30 15:40:10'),
(14, 'a', 'a', 1, '2021-05-05 20:29:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `number_of_picture` int(11) DEFAULT NULL,
  `number_of_follow` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `verificode` varchar(500) DEFAULT NULL,
  `verify` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `number_of_picture`, `number_of_follow`, `email`, `verificode`, `verify`) VALUES
('a', 'a', 'Huta', 3, 1, NULL, NULL, NULL),
('abc', 'abc', 'Hihi', 4, 0, NULL, NULL, NULL),
('hatq', '1234', 'TaHa', 2, 2, NULL, NULL, NULL),
('xxx', 'xxx', 'Huta', 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `vote`
--

INSERT INTO `vote` (`id`, `id_post`, `id_user`) VALUES
(4, 14, 'hatq');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `k_a_u` (`id_user`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `k_c_u` (`id_user`),
  ADD KEY `k_c_p` (`id_post`);

--
-- Chỉ mục cho bảng `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `k_info_u` (`id_user`);

--
-- Chỉ mục cho bảng `nofitication`
--
ALTER TABLE `nofitication`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `k_p_u` (`id_user`),
  ADD KEY `k_p_pst` (`id_post`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `k_u_p` (`id_user`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `k_v_p` (`id_post`),
  ADD KEY `k_v_u` (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nofitication`
--
ALTER TABLE `nofitication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `avatar`
--
ALTER TABLE `avatar`
  ADD CONSTRAINT `k_a_u` FOREIGN KEY (`id_user`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `k_c_p` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `k_c_u` FOREIGN KEY (`id_user`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `k_info_u` FOREIGN KEY (`id_user`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `k_p_pst` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `k_p_u` FOREIGN KEY (`id_user`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `k_u_p` FOREIGN KEY (`id_user`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `k_v_p` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `k_v_u` FOREIGN KEY (`id_user`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
