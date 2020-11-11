-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 08, 2020 lúc 11:29 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB-1:10.4.14+maria~bionic
-- Phiên bản PHP: 7.2.34-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_user`
--

CREATE TABLE `admin_user` (
  `admin_id` int(10) NOT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `pass word` varchar(255) NOT NULL,
  `is_active` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `user_name` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute`
--

CREATE TABLE `attribute` (
  `attribute_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `attribute`
--

INSERT INTO `attribute` (`attribute_id`, `name`) VALUES
(1, 'color'),
(2, 'size');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_value`
--

CREATE TABLE `attribute_value` (
  `attribute_value_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `attribute_value`
--

INSERT INTO `attribute_value` (`attribute_value_id`, `attribute_id`, `value`) VALUES
(5, 1, 'Đỏ'),
(6, 1, 'Vàng'),
(7, 1, 'Cam'),
(8, 1, 'Trắng'),
(13, 2, 'XL'),
(14, 2, 'XXL'),
(15, 2, 'X'),
(16, 2, 'XS');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` smallint(6) NOT NULL DEFAULT 1,
  `items_qty` int(10) NOT NULL,
  `items_count` int(10) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_first_name` varchar(32) DEFAULT NULL,
  `customer_last_name` varchar(32) DEFAULT NULL,
  `total` decimal(20,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_address`
--

CREATE TABLE `cart_address` (
  `address_id` int(10) NOT NULL,
  `cart_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_iems`
--

CREATE TABLE `cart_iems` (
  `item_id` int(10) NOT NULL,
  `cart_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `description` int(11) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `price` decimal(20,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parentId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `name`, `parentId`) VALUES
(1, 'Xe cộ', 0),
(2, 'Quần áo', 0),
(3, 'Đồ điện tử', 0),
(4, 'Thực Phẩm', 0),
(5, 'Xe Đạp', 1),
(6, 'Xe Máy', 1),
(7, 'Xe Oto', 1),
(8, 'Xe Đạp Thường', 5),
(9, 'Xe Đạp Điện', 5),
(10, 'Nhập Khẩu', 7),
(11, 'Nội Địa', 7),
(12, 'Men', 2),
(13, 'Woman', 2),
(14, 'Shirts', 12),
(15, 'Jeans', 12),
(16, 'Accessories(phụ kiện)', 13),
(17, 'Jeans', 13),
(18, 'Máy tính', 3),
(19, 'Điện thoại', 3),
(20, 'Đồ Ăn Nhanh ', 4),
(21, 'Đồ Uống', 4),
(22, 'Nhập Khẩu', 6),
(23, 'Nội Địa', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `is_active` smallint(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `city` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `phone` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(20,4) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `name`, `price`, `image`, `description`) VALUES
(1, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(2, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(3, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(4, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(5, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(6, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(7, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(8, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(9, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(10, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(11, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(12, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(13, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(14, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(15, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(16, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(17, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(18, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(19, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(20, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(21, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(22, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(23, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(24, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(25, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(26, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(27, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(28, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(29, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(30, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(31, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(32, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(33, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(34, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(35, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(36, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(37, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(38, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(39, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(40, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(41, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(42, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(43, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(44, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(45, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(46, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(47, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(48, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(49, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(57, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(58, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(59, 'iPhone 2G (20)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(60, 'iPhone 2G (0000)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào'),
(80, 'iPhone 2G (0000)', '4.0000', 'cac-doi-iphone-tung-ra-mat-1.jpg', 'Không có mô tả nào');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attribute_value`
--

CREATE TABLE `product_attribute_value` (
  `product_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product_attribute_value`
--

INSERT INTO `product_attribute_value` (`product_id`, `attribute_value_id`) VALUES
(1, 5),
(1, 7),
(1, 8),
(2, 5),
(2, 8),
(3, 5),
(3, 8),
(4, 6),
(4, 7),
(4, 8),
(5, 6),
(5, 8),
(6, 6),
(6, 8),
(7, 5),
(7, 7),
(7, 8),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(9, 8),
(10, 6),
(10, 7),
(11, 8),
(12, 6),
(12, 7),
(13, 5),
(13, 7),
(14, 5),
(14, 6),
(14, 7),
(14, 8),
(15, 5),
(15, 7),
(15, 8),
(16, 6),
(17, 5),
(17, 7),
(18, 6),
(18, 7),
(19, 5),
(19, 7),
(19, 8),
(20, 5),
(20, 6),
(21, 5),
(21, 7),
(21, 8),
(22, 7),
(23, 6),
(23, 8),
(24, 5),
(24, 6),
(24, 8),
(25, 5),
(25, 7),
(26, 5),
(26, 6),
(26, 8),
(27, 8),
(28, 6),
(28, 8),
(29, 5),
(30, 7),
(31, 5),
(31, 8),
(32, 5),
(32, 6),
(32, 8),
(32, 13),
(33, 5),
(33, 7),
(33, 14),
(34, 6),
(34, 8),
(34, 15),
(35, 5),
(35, 6),
(35, 8),
(35, 13),
(35, 14),
(35, 15),
(35, 16),
(36, 7),
(36, 8),
(36, 13),
(36, 15),
(37, 5),
(37, 6),
(37, 13),
(37, 14),
(37, 16),
(38, 6),
(38, 8),
(38, 15),
(38, 16),
(39, 6),
(39, 8),
(39, 13),
(39, 15),
(40, 5),
(40, 6),
(40, 8),
(40, 13),
(40, 15),
(40, 16),
(41, 5),
(41, 6),
(41, 13),
(41, 14),
(41, 15),
(41, 16),
(42, 6),
(42, 8),
(42, 15),
(43, 5),
(43, 7),
(43, 14),
(44, 5),
(44, 8),
(44, 14),
(44, 16),
(45, 5),
(45, 6),
(45, 13),
(46, 7),
(46, 13),
(46, 15),
(46, 16),
(47, 8),
(47, 15),
(48, 7),
(48, 8),
(48, 13),
(49, 5),
(49, 6),
(49, 7),
(49, 13),
(49, 15),
(57, 5),
(57, 6),
(57, 13),
(57, 14),
(58, 5),
(58, 6),
(58, 13),
(58, 14),
(59, 6),
(59, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(1, 8),
(2, 8),
(3, 8),
(4, 8),
(4, 18),
(5, 9),
(6, 9),
(7, 9),
(8, 9),
(9, 23),
(10, 23),
(11, 23),
(12, 23),
(13, 23),
(19, 22),
(20, 22),
(21, 22),
(22, 22),
(23, 22),
(24, 10),
(25, 10),
(26, 10),
(27, 10),
(28, 10),
(29, 11),
(30, 11),
(30, 18),
(31, 11),
(32, 18),
(35, 18),
(36, 18),
(37, 18),
(38, 18),
(39, 19),
(40, 19),
(41, 19),
(42, 19),
(43, 19),
(44, 19),
(45, 19),
(46, 19),
(47, 19),
(48, 19),
(49, 19),
(57, 21),
(58, 5),
(59, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL COMMENT 'review detail id',
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` int(11) DEFAULT current_timestamp(),
  `nickname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Chỉ mục cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`attribute_value_id`),
  ADD KEY `attribute_value_ibfk_1` (`attribute_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `cart_iems`
--
ALTER TABLE `cart_iems`
  ADD PRIMARY KEY (`item_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD PRIMARY KEY (`product_id`,`attribute_value_id`);

--
-- Chỉ mục cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `attribute_value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cart_iems`
--
ALTER TABLE `cart_iems`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT cho bảng `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'review detail id';

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD CONSTRAINT `attribute_value_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
