-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2020 at 02:26 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id11828412_sale_15`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `stt` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`stt`, `username`, `password`, `name`) VALUES
(1, 'admin@gmail.com', '123456', 'Nguyễn Văn A');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `stt_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `commenter_id` int(11) UNSIGNED NOT NULL,
  `reply_comment_id` int(11) UNSIGNED DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`stt_id`, `product_id`, `commenter_id`, `reply_comment_id`, `content`, `timestamp`) VALUES
(59, 64, 14, 0, 'hi', 1592903143),
(60, 64, 14, 0, 'my name is Tung<br>', 1592903155),
(61, 64, 14, 60, '1', 1592904521),
(62, 64, 14, 59, '2', 1592904527),
(63, 64, 14, 59, '3<br>', 1592904534),
(64, 64, 14, 60, '4', 1592904544),
(65, 64, 14, 0, 'chat nao<br>', 1592904560),
(66, 64, 14, 65, '6', 1592904566),
(67, 64, 14, 65, '78', 1592904574),
(68, 64, 14, 65, '9', 1592904584),
(69, 64, 6, 65, '10', 1592905172),
(70, 64, 6, 65, '11<br>12', 1592905188),
(71, 64, 14, 0, 'hi', 1592905825),
(72, 64, 14, 71, '16<br>17<br>18<br>', 1592905839),
(73, 87, 14, 0, 'Hi<br>', 1594992641),
(74, 87, 14, 0, 'T D T<br>', 1594992648),
(75, 87, 14, 0, 'A <br>L<br>o<br>', 1594992655),
(76, 87, 14, 75, 'a1<br>', 1594992665),
(77, 87, 6, 75, 'hey', 1594993040),
(78, 87, 14, 75, 'halo', 1594993061),
(79, 87, 6, 73, 'H3<div><br></div>', 1594993096);

-- --------------------------------------------------------

--
-- Table structure for table `ddt_money`
--

CREATE TABLE `ddt_money` (
  `username_id` int(11) UNSIGNED NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ddt_money`
--

INSERT INTO `ddt_money` (`username_id`, `price`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 25236000),
(6, 36211100),
(7, 11845000),
(8, 0),
(9, 39600000),
(10, 27358000),
(11, 0),
(12, 0),
(13, 169000000),
(14, 99551000),
(15, 1150000),
(17, 22308900),
(20, 23000000);

-- --------------------------------------------------------

--
-- Table structure for table `ddt_money_out`
--

CREATE TABLE `ddt_money_out` (
  `username_id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `money_value` bigint(30) UNSIGNED NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `stt_id` int(5) UNSIGNED NOT NULL,
  `provincesName` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `districtsName` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`stt_id`, `provincesName`, `districtsName`) VALUES
(1, 'Bình Dương', 'tp Thủ Dầu Một'),
(2, 'Bình Dương', 'thị xã Bến Cát'),
(3, 'Bình Dương', 'thị xã Tân Uyên'),
(4, 'Bình Dương', 'thị xã Dĩ An'),
(5, 'Bình Dương', 'thị xã Thuận An'),
(6, 'Bình Dương', 'huyện Bắc Tân Uyên'),
(7, 'Bình Dương', 'huyện Bắc Dầu Tiếng'),
(8, 'Bình Dương', 'huyện Phú Giáo'),
(9, 'Bình Dương', 'huyện Bầu Bàng'),
(10, 'TP Hồ Chí Minh', 'quận 1'),
(11, 'TP Hồ Chí Minh', 'quận 2'),
(12, 'TP Hồ Chí Minh', 'quận 3'),
(13, 'TP Hồ Chí Minh', 'quận 5'),
(14, 'TP Hồ Chí Minh', 'quận 6'),
(15, 'TP Hồ Chí Minh', 'quận 7'),
(16, 'TP Hồ Chí Minh', 'quận 9'),
(17, 'TP Hồ Chí Minh', 'quận 8'),
(18, 'TP Hồ Chí Minh', 'quận 12'),
(19, 'Hà Nội', 'quận Ba Đình'),
(20, 'Hà Nội', 'quận Hoàn Kiếm'),
(21, 'Hà Nội', 'quận Tây Hồ'),
(22, 'Hà Nội', 'quận Long Biên'),
(23, 'Hà Nội', 'quận Cầu Giấy'),
(24, 'Hà Nội', 'quận Đống Đa'),
(25, 'Hà Nội', 'quận Hai Bà Trưng'),
(26, 'Hà Nội', 'quận Hoàng Mai'),
(27, 'Đà Nẵng', 'quận Hải Châu'),
(28, 'Đà Nẵng', 'quận Cẩm Lệ'),
(29, 'Đà Nẵng', 'quận Thanh Khê'),
(30, 'Đà Nẵng', 'Quận Liên Chiểu'),
(31, 'Đà Nẵng', 'Quận Ngũ Hành Sơn'),
(32, 'Đà Nẵng', 'Quận Sơn Trà'),
(33, 'Đà Nẵng', 'Huyện Hòa Vang'),
(34, 'Đà Nẵng', 'Huyện Hoàng Sa'),
(36, 'Khánh Hòa', 'Huyện Vạn Ninh');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `stt_id` int(8) UNSIGNED NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `username_id_1` int(11) UNSIGNED NOT NULL,
  `username_id_2` int(11) UNSIGNED NOT NULL,
  `timestamp` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`stt_id`, `text`, `username_id_1`, `username_id_2`, `timestamp`) VALUES
(143, 'xin chào', 10, 14, 1594490891),
(144, 'hello', 10, 14, 1594492268),
(145, 'donde', 10, 14, 1594492278),
(146, 'i nsnsnsj', 10, 14, 1594492292),
(147, 'dhdjnđj', 10, 14, 1594492297),
(148, 'hdbdndn', 10, 14, 1594492305),
(149, 'djjdhdhd', 10, 14, 1594492312),
(150, 'dhbxxb', 10, 14, 1594492323),
(151, 'xin chào', 6, 14, 1594548960),
(152, 'hi', 6, 14, 1594549078),
(153, 'he', 6, 14, 1594549225),
(154, 'hell', 6, 14, 1594549272),
(155, 'xin chào', 9, 10, 1594562455),
(156, 'hello toan', 9, 10, 1594562466),
(157, 'chi a', 10, 9, 1594563256),
(158, 'chi\n', 10, 9, 1594563283),
(159, '29031998', 10, 9, 1594563295),
(160, '??', 9, 10, 1594563320),
(161, '99', 10, 9, 1594563331);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `product_id` int(11) NOT NULL,
  `sold_by` varchar(40) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `register_to` varchar(40) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` varchar(10) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `timestamp` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`product_id`, `sold_by`, `register_to`, `status`, `address`, `timestamp`) VALUES
(89, 'Thong@gmail.com', 'Tung@gmail.com', '3', 'Bình dương', 1594608974);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `txn_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payer_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `payer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payer_country` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `txn_id`, `payment_gross`, `currency_code`, `payer_id`, `payer_name`, `payer_email`, `payer_country`, `payment_status`, `created`) VALUES
(7, 14, 'PAYID-L3RESTY4MC85145TK235743W', 99.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1591888269),
(8, 14, 'PAYID-L3RE6OQ5RB584372G339702X', 52.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1591889781),
(9, 6, 'PAYID-L3RGNZA2MJ40725ME286140D', 20.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1591895803),
(10, 6, 'PAYID-L3RGQGQ8PA7292660421531A', 50.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1591896109),
(11, 15, 'PAYID-L3RGUHI3D744384BL665305S', 50.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1591896632),
(12, 10, 'PAYID-L3RGWSQ9DS96781T13839939', 96.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1591896938),
(13, 5, 'PAYID-L3SPARQ3XA13841NK581500G', 32.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592062094),
(14, 14, 'PAYID-L3SPDCA5YL96787HA088884D', 100.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592062606),
(15, 14, 'PAYID-L3SPFVA9N689730PU6421536', 55.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592062704),
(16, 9, 'PAYID-L3S72BA4N775536UR859845N', 100.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592130865),
(17, 9, 'PAYID-L3TUYCA3SA01648JX5321541', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592216614),
(18, 9, 'PAYID-L3TUY7I5J566287LC793444P', 900.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592216719),
(19, 14, 'PAYID-L3U4AAY2MH61448E5888573V', 50.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592377369),
(20, 14, 'PAYID-L3U7O6Q7T13892188014241M', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592391566),
(21, 14, 'PAYID-L3WOXUY9DV92223P5052120M', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592585187),
(22, 14, 'PAYID-L3WO2DI7TC39918G3706482S', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592585504),
(23, 14, 'PAYID-L3WO4IQ3JH11173A3167363S', 50.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1592585774),
(24, 14, 'PAYID-L32FPIA36956787HX543684S', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1593071553),
(25, 10, 'PAYID-L34GN3A6F340254V61495124', 50.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1593337606),
(26, 17, 'PAYID-L36IB3I8PD7606185501903X', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1593606410),
(27, 10, 'PAYID-L4FALWI4WU587313K826693J', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1594492401),
(28, 6, 'PAYID-L4FOJAI7A361676FE7722415', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1594549411),
(29, 14, 'PAYID-L4F4TCA0U708004B7881393J', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'John Doe', 'sb-ex6kj2239086@personal.example.com', 'US', 'approved', 1594608037),
(30, 14, 'PAYID-L4GZX6A3FW70514H1263391J', 1000.00, 'USD', 'NJG5WWM69P6UU', 'Trung Tran', 'Trung@personal.example.com', 'US', 'approved', 1594727526),
(31, 14, 'PAYID-L4GZ3TI4TE23385A44782105', 900.00, 'USD', 'NJG5WWM69P6UU', 'Trung Tran', 'Trung@personal.example.com', 'US', 'approved', 1594727956),
(32, 13, 'PAYID-L4G3FBQ8BL79274R9220831H', 1000.00, 'USD', 'AWWWSTKWDKVVE', 'Chau Tuan', 'Tuan@personal.example.com', 'US', 'approved', 1594733346),
(33, 13, 'PAYID-L4G3IDQ1AT68518G4620150C', 1000.00, 'USD', 'NJG5WWM69P6UU', 'Trung Tran', 'Trung@personal.example.com', 'US', 'approved', 1594733686),
(34, 13, 'PAYID-L4G3KBY3X8539473X1971156', 1000.00, 'USD', 'NJG5WWM69P6UU', 'Trung Tran', 'Trung@personal.example.com', 'US', 'approved', 1594733852),
(35, 20, 'PAYID-L4G7J5A9J519405PL064123C', 1000.00, 'USD', 'NJG5WWM69P6UU', 'Trung Tran', 'Trung@personal.example.com', 'US', 'approved', 1594750233),
(36, 7, 'PAYID-L4HIZYI4J783396GB520153U', 500.00, 'USD', 'AWWWSTKWDKVVE', 'Chau Tuan', 'Tuan@personal.example.com', 'US', 'approved', 1594789145),
(37, 7, 'PAYID-L4HI56I17H95553586430441', 15.00, 'USD', 'AWWWSTKWDKVVE', 'Chau Tuan', 'Tuan@personal.example.com', 'US', 'approved', 1594789990);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `Productname` varchar(20) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `Typename` varchar(20) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `Title` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Username` varchar(40) NOT NULL,
  `Price` int(12) NOT NULL,
  `Manufacturer` varchar(12) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `Moreinfor` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `Status` varchar(25) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `Timestart` varchar(20) NOT NULL,
  `picture_path` varchar(5000) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `status_2` tinyint(1) NOT NULL DEFAULT 1,
  `district` varchar(25) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `province` varchar(25) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `address_detail` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Productname`, `Typename`, `Title`, `Username`, `Price`, `Manufacturer`, `Moreinfor`, `Status`, `Timestart`, `picture_path`, `status_2`, `district`, `province`, `address_detail`) VALUES
(77, 'OPPO R7', 'OPPO', 'Điện thoại OPPO R7 Lite', 'Quan@gmail.com', 3200000, 'Trung Quốc', '<ul class=\"parameter \"><li class=\"p71866 g6459_79_77\"><span>Màn hình:</span><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-amoled-la-gi-905766\" target=\"_blank\"> AMOLED</a>, 5\", <a href=\"https://www.thegioididong.com/tin-tuc/loai-man-hinh-tft-lcd-amoled-la-gi--592346#amoled\" target=\"_blank\">AMOLED 16 triệu màu</a></li><li class=\"p71866 g72\"><span>Hệ điều hành:</span><a href=\"https://www.thegioididong.com/hoi-dap/android-51-co-thay-doi-gi-moi-658189\" target=\"_blank\"> Android 5.1 (Lollipop)</a><span></span></li></ul>', 'Chưa sử dụng', '1594552312', '../Images/Products/77_oppo-r7.png', 1, 'tp Thủ Dầu Một', 'Bình Dương', NULL),
(78, 'OPPO R9', 'OPPO', 'Điện thoại Oppo R9', 'Quan@gmail.com', 8000000, 'Trung Quốc', '<ul class=\"parameter \"><li class=\"p75342 g6459_79_77\"><span>Màn hình:</span><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-amoled-la-gi-905766\" target=\"_blank\">AMOLED</a>, 5.5\", <a href=\"https://www.thegioididong.com/tin-tuc/do-phan-giai-man-hinh-qhd-hd-fullhd-2k-4k-la-gi--592178#fullhd\" target=\"_blank\">Full HD</a></li><li class=\"p75342 g72\"><span>Hệ điều hành:</span><a href=\"https://www.thegioididong.com/hoi-dap/android-51-co-thay-doi-gi-moi-658189\" target=\"_blank\">Android 5.1 (Lollipop)</a></li><li class=\"p75342 g27\"><span>Camera sau:</span>13 MP</li><li class=\"p75342 g29\"><span>Camera trước:</span>16 MP<span></span></li></ul>', 'Chưa sử dụng', '1594555690', '../Images/Products/78_oppo-r9.png', 1, 'Quận Liên Chiểu', 'Đà Nẵng', NULL),
(79, 'OPPO R11', 'OPPO', 'Điện thoại OPPO R11', 'Quan@gmail.com', 3500000, 'Trung Quốc', '<ul class=\"parameter \"><li class=\"p104759 g6459_79_77\"><span>Màn hình:</span><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-super-amoled-la-gi-905770\" target=\"_blank\">Super AMOLED</a>, 5.5\", <a href=\"https://www.thegioididong.com/tin-tuc/do-phan-giai-man-hinh-qhd-hd-fullhd-2k-4k-la-gi--592178#fullhd\" target=\"_blank\">Full HD</a><span></span></li><li class=\"p104759 g72\"><span>Hệ điều hành:</span><a href=\"https://www.thegioididong.com/hoi-dap/nhung-diem-moi-tren-android-7-nougat-896909\" target=\"_blank\">Android 7.1 (Nougat)</a><span></span></li><li class=\"p104759 g6059\"><span>CPU:</span><a href=\"https://www.thegioididong.com/hoi-dap/hoi-dap-tim-hieu-chip-qualcomm-snapdragon-660-1-1171994\" target=\"_blank\">Snapdragon 660 8 nhân</a><span></span></li><li class=\"p104759 g50\"><span>RAM:</span>4 GB<span></span></li><li class=\"p104759 g49\"><span>Bộ nhớ trong:</span>64 GB<span></span></li></ul>', 'Chưa sử dụng', '1594556114', '../Images/Products/79_oppo-r11.png', 1, 'Huyện Vạn Ninh', 'Khánh Hòa', NULL),
(80, 'XIAOMI Redmi Note', 'XIAOMI', 'Xiaomi Redmi 9 (3GB|32GB) (CTY - DGW)', 'Sam@gmail.com', 35000000, 'Trung Quốc', 'Tặng <span data-sheets-value=\"{&quot;1&quot;:2,&quot;2&quot;:&quot;Mua tai nghe JBL CS150 giá 200K ( Giá gốc 350K)\nMua Pin dự phòng Innostyle Powergo 10.000 mAh giá 250K ( Giá gốc 450K)&quot;}\" data-sheets-userformat=\"{&quot;2&quot;:15293,&quot;3&quot;:{&quot;1&quot;:0},&quot;5&quot;:{&quot;1&quot;:[{&quot;1&quot;:2,&quot;2&quot;:0,&quot;5&quot;:[null,2,0]},{&quot;1&quot;:0,&quot;2&quot;:0,&quot;3&quot;:3},{&quot;1&quot;:1,&quot;2&quot;:0,&quot;4&quot;:1}]},&quot;6&quot;:{&quot;1&quot;:[{&quot;1&quot;:2,&quot;2&quot;:0,&quot;5&quot;:[null,2,0]},{&quot;1&quot;:0,&quot;2&quot;:0,&quot;3&quot;:3},{&quot;1&quot;:1,&quot;2&quot;:0,&quot;4&quot;:1}]},&quot;7&quot;:{&quot;1&quot;:[{&quot;1&quot;:2,&quot;2&quot;:0,&quot;5&quot;:[null,2,0]},{&quot;1&quot;:0,&quot;2&quot;:0,&quot;3&quot;:3},{&quot;1&quot;:1,&quot;2&quot;:0,&quot;4&quot;:1}]},&quot;8&quot;:{&quot;1&quot;:[{&quot;1&quot;:2,&quot;2&quot;:0,&quot;5&quot;:[null,2,0]},{&quot;1&quot;:0,&quot;2&quot;:0,&quot;3&quot;:3},{&quot;1&quot;:1,&quot;2&quot;:0,&quot;4&quot;:1}]},&quot;10&quot;:2,&quot;11&quot;:4,&quot;12&quot;:0,&quot;14&quot;:[null,2,0],&quot;15&quot;:&quot;Arial&quot;,&quot;16&quot;:10}\"><a href=\"https://didongviet.vn/tai-nghe-jbl-cs150\" target=\"_blank\">Tai nghe JBL CS150</a> giá<strong> 200.00đ</strong><span style=\"color: #ff0000;\"><strong></strong></span><strong><span style=\"color: #ff0000;\"></span></strong></span>', 'Chưa sử dụng', '1594557737', '../Images/Products/80_Xiaomi-redmi-note.jpg', 1, 'quận 5', 'TP Hồ Chí Minh', NULL),
(81, 'XIAOMI Mi', 'XIAOMI', 'Điện thoại Xiaomi Mi Note 10 Pro', 'Sam@gmail.com', 13000000, 'Trung Quốc', '<strong data-count=\"2\">Khuyến mãi</strong>\r\n    <div class=\"infopr\">\r\n                    <span class=\"pro578750 \" data-g=\"Tặng\" data-date=\"7/31/2020 11:00:00 PM\" data-return=\"\" data-fromvalue=\"0\" data-tovalue=\"1000000\">\r\n                        -Giảm ngay 1 triệu (đã trừ vào giá)\r\n                        \r\n                    </span>\r\n                    <span class=\"pro579919 \" data-g=\"WebNote\" data-date=\"7/31/2020 11:00:00 PM\" data-return=\"\" data-fromvalue=\"0\" data-tovalue=\"10\">\r\n                        Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác)\r\n                        \r\n                    </span>\r\n    </div>', 'Chưa sử dụng', '1594558015', '../Images/Products/81_Xiaomi-mi.jpg', 1, 'quận Thanh Khê', 'Đà Nẵng', NULL),
(82, 'IPHONE 4S', 'IPHONE', 'Điện thoại iPhone 5 16GB', 'Quyen@gmail.com', 1500000, 'Việt Nam', '<ul class=\"parameter \"><li class=\"p57240 g6459_79_77\"><span>Màn hình:</span><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-ledbacklit-ips-lcd-la-gi-905757\" target=\"_blank\"> LED-backlit IPS LCD</a>, 4\", <a href=\"https://www.thegioididong.com/tin-tuc/do-phan-giai-man-hinh-qhd-hd-fullhd-2k-4k-la-gi--592178#dvga\" target=\"_blank\">DVGA</a><span></span></li><li class=\"p57240 g72\"><span>Hệ điều hành:</span><a href=\"https://www.thegioididong.com/tin-tuc/he-dieu-hanh-ios-la-gi--592559#ios6x\" target=\"_blank\"> iOS 6</a><span></span></li><li class=\"p57240 g27\"><span>Camera sau:</span> 8 MP<span></span></li><li class=\"p57240 g29\"><span>Camera trước:</span> 1.2 MP<span></span></li><li class=\"p57240 g6059\"><span>CPU:</span> <a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-ve-chip-xu-ly-danh-cho-di-dong-cua-apple-592848#applea6\" target=\"_blank\">Apple A6 2 nhân</a><span></span></li></ul>', 'Chưa sử dụng', '1594558222', '../Images/Products/82_iphone-5.jpg', 1, 'thị xã Thuận An', 'Bình Dương', NULL),
(83, 'IPHONE 4S', 'IPHONE', 'Điện thoại iPhone 4S 16GB', 'Quyen@gmail.com', 1000000, 'Việt Nam', '<ul class=\"parameter \"><li class=\"p50920 g72\"><span>Hệ điều hành:</span><a href=\"https://www.thegioididong.com/tin-tuc/he-dieu-hanh-ios-la-gi--592559#ios7x\" target=\"_blank\"> iOS 7.2</a><span></span></li><li class=\"p50920 g72\"><span>Camera sau:</span> 8 MP</li><li class=\"p50920 g29\"><span>Camera trước:</span> VGA (0.3 MP)<span></span></li></ul>', 'Đã sử dụng(chưa sữa chữa)', '1594558693', '../Images/Products/83_iphone4s.png', 1, 'quận 2', 'TP Hồ Chí Minh', NULL),
(84, 'SAMSUNG GALAXY S', 'SAMSUNG', 'Điện Thoại Samsung Galaxy S9 Plus 64Gb', 'Quan@gmail.com', 8000000, 'Hàn Quốc', '<ul><li>Màn hình: Super AMOLED, 6.2″, Quad HD+ (2K+)</li><li>Camera sau: Chính 12 MP &amp; Phụ 12 MP</li><li>Camera trước: 8 MP</li><li>CPU: Exynos 9810 8 nhân 64-bit</li><li>RAM: 6 GB</li><li>Bộ nhớ trong: 64 GB</li><li>Thẻ nhớ: MicroSD, hỗ trợ tối đa 400 GB</li><li>Thẻ SIM: 2 SIM Nano (SIM 2 chung khe thẻ nhớ), Hỗ trợ 4G</li><li>Dung lượng pin: 3500 mAh, có sạc nhanh</li></ul>', 'Chưa sử dụng', '1594561113', '../Images/Products/84_SAMSUNGGALAXYS.jpg', 1, 'thị xã Dĩ An', 'Bình Dương', NULL),
(85, 'SAMSUNG NOTE', 'SAMSUNG', 'Samsung Galaxy Note 10 Lite', 'Quan@gmail.com', 5000000, 'Hàn Quốc', '<span class=\"woocommerce-Price-amount amount\"></span>\r\n\r\n<div class=\"product-short-description\">\r\n	<ul><li><img class=\"alignnone wp-image-2520\" src=\"https://chototviet.net/wp-content/uploads/2020/05/icon.png\" alt=\"\" width=\"14\" height=\"17\"> Bảo hành 12 tháng</li><li><img class=\"alignnone wp-image-2520\" src=\"https://chototviet.net/wp-content/uploads/2020/05/icon.png\" alt=\"\" width=\"14\" height=\"17\"> Miễn phí giao hàng toàn quốc</li><li><img class=\"alignnone wp-image-2520\" src=\"https://chototviet.net/wp-content/uploads/2020/05/icon.png\" alt=\"\" width=\"14\" height=\"17\"> Nhận hàng kiểm tra hàng thanh toán tại nhà</li><li><img class=\"alignnone wp-image-2520\" src=\"https://chototviet.net/wp-content/uploads/2020/05/icon.png\" alt=\"\" width=\"14\" height=\"17\"> Hỗ trợ đổi mới miễn phí 30 ngày đầu</li></ul>\r\n</div>', 'Đã sử dụng(chưa sữa chữa)', '1594561252', '../Images/Products/85_SAMSUNGGALAXYNOTE.jpg', 1, 'quận Tây Hồ', 'Hà Nội', NULL),
(86, 'HTC Desire 820', 'HTC', 'Điện thoại HTC Desire 820', 'Toan@gmail.com', 35000000, 'Nhật Bản', '<ul class=\"parameter \"><li class=\"p69716 g6459_79_77\"><span>Màn hình:</span> LCD, 5.5\", LCD, 16 triệu màu<span></span></li></ul>', 'Chưa sử dụng', '1594561511', '../Images/Products/86_htc-desire-820.jpg', 1, 'thị xã Bến Cát', 'Bình Dương', NULL),
(87, 'HTC 10', 'HTC', 'Điện thoại HTC 10', 'Toan@gmail.com', 1000000, 'Nhật Bản', '<ul class=\"parameter \"><li class=\"p75874 g6459_79_77\"><span>Màn hình:</span><span class=\"_mh6 _wsc\" id=\"cch_f35e3864fa0c122\"><span data-offset-key=\"d2o42-0-0\"><span data-text=\"true\">Super LCD 5, 5.2\", Quad HD (2K)</span></span></span><span></span></li><li class=\"p75874 g72\"><span>Hệ điều hành:</span><span class=\"_mh6 _wsc\" id=\"cch_f35e3864fa0c122\"><span data-offset-key=\"d2o42-0-0\"><span data-text=\"true\">Android 6.0 (Marshmallow)</span></span></span><span></span></li><li class=\"p75874 g27\"><span>Camera sau:</span>12 MP<span></span></li><li class=\"p75874 g29\"><span>Camera trước:</span>5 MP<span></span></li><li class=\"p75874 g6059\"><span>CPU:</span><span class=\"_mh6 _wsc\" id=\"cch_f35e3864fa0c122\"><span data-offset-key=\"d2o42-0-0\"><span data-text=\"true\">Snapdragon 652 8 nhân</span></span></span><span></span></li><li class=\"p75874 g50\"><span>RAM:</span>3 GB<span></span></li><li class=\"p75874 g49\"><span>Bộ nhớ trong:</span>32 GB<span></span></li></ul>', 'Chưa sử dụng', '1594561689', '../Images/Products/87_index1.jpg', 1, 'quận 3', 'TP Hồ Chí Minh', NULL),
(89, 'LG E900 Optimus 7', 'LG', 'Điện thoại LG E900 Optimus 7', 'Thong@gmail.com', 500000, 'Nhật Bản', '<div>Camera : 5mp</div><div>Ram: 2gb<br></div>', 'Chưa sử dụng', '1594562381', '../Images/Products/89_LGE900Optimus7.jpg', 3, 'thị xã Dĩ An', 'Bình Dương', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `stt_id` int(5) NOT NULL,
  `productType` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `productName` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`stt_id`, `productType`, `productName`) VALUES
(1, 'OPPO', 'OPPO Finder'),
(2, 'OPPO', 'OPPO N1'),
(3, 'OPPO', 'OPPO Find7'),
(4, 'OPPO', 'OPPO R7'),
(5, 'OPPO', 'OPPO R9'),
(6, 'OPPO', 'OPPO R11'),
(7, 'OPPO', 'OPPO FindX'),
(8, 'XIAOMI', 'XIAOMI Redmi'),
(9, 'XIAOMI', 'XIAOMI Redmi Note'),
(10, 'XIAOMI', 'XIAOMI Mi'),
(11, 'XIAOMI', 'XIAOMI Mi Note'),
(12, 'SAMSUNG', 'SAMSUNG GALAXY S'),
(13, 'SAMSUNG', 'SAMSUNG NOTE'),
(15, 'SONY', 'SONY Xperia X10'),
(16, 'SONY', 'SONY Xperia Arc'),
(17, 'SONY', 'SONY XPeria Play'),
(18, 'SONY', 'SONY Xperia SP'),
(19, 'VSMART', 'VSMART Joy 1'),
(20, 'VSMART', 'VSMART Joy 3'),
(21, 'VSMART', 'VSMART Bee'),
(22, 'IPHONE', 'IPHONE 3'),
(23, 'IPHONE', 'IPHONE 4'),
(27, 'LG', 'LG E900 Optimus 7'),
(28, 'LG', 'LG Optimus 2X'),
(29, 'LG', 'LG Optimus 4X HD'),
(31, 'HTC', 'HTC Desire 820'),
(55, 'SONY', 'SoundMax'),
(56, 'Phụ kiện', 'Tai nghe có dây'),
(57, 'Phụ kiện', 'Tai nghe'),
(58, 'Phụ kiện', 'Loa'),
(59, 'Phụ kiện', 'Sạc dự phòng'),
(60, 'XIAOMI', 'XIAOMI Mi Mix'),
(61, 'IPHONE', 'IPHONE 4S'),
(62, 'IPHONE', 'IPHONE 5'),
(63, 'LG', 'LG Nesus 4'),
(64, 'HTC', 'HTC 10');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id_rate` int(11) UNSIGNED NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `five_star_count` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `four_star_count` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `three_star_count` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `two_star_count` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `one_star_count` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id_rate`, `productId`, `five_star_count`, `four_star_count`, `three_star_count`, `two_star_count`, `one_star_count`) VALUES
(18, 5, '', '', '', '', ''),
(19, 19, '', '', '', '', ''),
(20, 22, '10 14 ', '', '', '', ''),
(21, 23, '', '', '', '', ''),
(23, 26, '', '', '', '', ''),
(24, 27, '', '', '14 ', '', ''),
(26, 29, '', '', '', '', ''),
(27, 30, '', '', '', '', ''),
(28, 43, '', '', '', '', ''),
(29, 54, '6 14 ', '', '', '', ''),
(30, 58, '', '', '14 ', '', ''),
(31, 60, '14 ', '', '', '', ''),
(32, 63, '', '10 ', '14 ', '', ''),
(33, 64, '', '9 6 ', '14 ', '', ''),
(34, 68, '10 14 ', '9 ', '5 ', '', ''),
(38, 72, '6 14 10 17 ', '', '', '', ''),
(39, 73, '14 ', '10 ', '5 ', '', ''),
(40, 74, '17 ', '', '', '', ''),
(43, 77, '', '', '', '', ''),
(44, 78, '', '', '', '', ''),
(45, 79, '', '', '', '', ''),
(46, 80, '', '', '', '', ''),
(47, 81, '', '', '', '', ''),
(48, 82, '', '7 ', '', '', ''),
(49, 83, '6 ', '', '', '', ''),
(50, 84, '9 ', '', '', '', ''),
(51, 85, '6 ', '', '9 ', '', ''),
(52, 86, '', '', '', '', ''),
(53, 87, '14 6 ', '9 ', '', '', ''),
(55, 89, '9 10 14 ', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `statistic`
--

CREATE TABLE `statistic` (
  `dateTime` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginCount` int(11) UNSIGNED NOT NULL,
  `productCount` int(11) UNSIGNED NOT NULL,
  `soldCount` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statistic`
--

INSERT INTO `statistic` (`dateTime`, `loginCount`, `productCount`, `soldCount`) VALUES
('18372', 1, 0, 0),
('18373', 3, 0, 0),
('18374', 3, 0, 0),
('18371', 1, 0, 0),
('18370', 3, 0, 0),
('18369', 5, 0, 0),
('18368', 7, 0, 0),
('18367', 9, 0, 0),
('18366', 8, 0, 0),
('18365', 6, 0, 0),
('18375', 2, 1, 0),
('18376', 2, 3, 0),
('18377', 1, 2, 0),
('18378', 0, 0, 0),
('18379', 1, 0, 0),
('18380', 1, 0, 0),
('18381', 1, 0, 0),
('18382', 1, 0, 0),
('18383', 2, 0, 0),
('18384', 1, 0, 0),
('18385', 0, 0, 0),
('18386', 1, 0, 0),
('18387', 1, 0, 0),
('18388', 2, 0, 0),
('18389', 0, 0, 0),
('18390', 0, 0, 0),
('18391', 3, 0, 0),
('18392', 3, 3, 0),
('18393', 1, 0, 0),
('18394', 0, 0, 0),
('18395', 1, 0, 0),
('18396', 4, 0, 0),
('18397', 1, 0, 0),
('18398', 1, 0, 0),
('18399', 0, 0, 0),
('18400', 0, 0, 0),
('18401', 3, 4, 0),
('18402', 3, 1, 0),
('18403', 0, 0, 0),
('18404', 0, 0, 0),
('18405', 0, 0, 0),
('18406', 2, 0, 0),
('18407', 1, 0, 0),
('18408', 2, 0, 0),
('18409', 0, 0, 0),
('18410', 0, 0, 0),
('18411', 0, 0, 0),
('18412', 0, 0, 0),
('18413', 1, 0, 0),
('18414', 1, 0, 0),
('18415', 2, 0, 2),
('18416', 0, 2, 5),
('18417', 0, 10, 3),
('18418', 1, 3, 5),
('18419', 0, 2, 5),
('18420', 0, 3, 2),
('18421', 3, 2, 6),
('18422', 2, 1, 8),
('18423', 1, 2, 9),
('18424', 2, 3, 2),
('18425', 6, 1, 4),
('18426', 3, 3, 2),
('18427', 2, 2, 3),
('18428', 1, 10, 9),
('18429', 1, 8, 8),
('18430', 2, 2, 6),
('18431', 0, 0, 6),
('18432', 1, 3, 12),
('18433', 2, 7, 2),
('18434', 2, 5, 1),
('18435', 2, 1, 1),
('18436', 2, 0, 3),
('18437', 1, 0, 1),
('18438', 2, 0, 4),
('18439', 0, 0, 0),
('18440', 1, 0, 0),
('18441', 3, 0, 9),
('18442', 2, 0, 1),
('18443', 0, 0, 0),
('18444', 3, 1, 2),
('18445', 0, 0, 0),
('18446', 0, 0, 0),
('18447', 1, 0, 0),
('18448', 1, 0, 0),
('18449', 1, 0, 0),
('18450', 1, 0, 0),
('18451', 0, 0, 0),
('18452', 1, 0, 0),
('18453', 2, 0, 0),
('18454', 1, 1, 0),
('18455', 7, 12, 4),
('18456', 3, 2, 1),
('18457', 2, 0, 0),
('18458', 4, 0, 0),
('18459', 2, 0, 0),
('18460', 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` tinyint(1) NOT NULL,
  `status_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'đang bán'),
(2, 'đang giao'),
(3, 'đã giao');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `stt_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `role` int(1) NOT NULL,
  `Cell` varchar(12) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `Address` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `TimeCreateAccount` varchar(20) NOT NULL,
  `avatarImgPath` varchar(100) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`stt_id`, `username`, `password`, `name`, `role`, `Cell`, `Address`, `TimeCreateAccount`, `avatarImgPath`) VALUES
(1, 'google@gmail.com', '123456', 'Cô giáo Google', 0, '0112345612', 'Thủ Đức,Hồ Chí Minh', '', ''),
(2, 'hai12@gmail.com', '123456', 'Nguyen Hải', 0, '02134545489', 'Binh Duong', '', ''),
(3, 'Hoang@gmail.com', '123456', 'Mai Hoàng', 0, '0974585858', 'Bình Dương', '', ''),
(4, 'Kiet@gmail.com', '123456', 'Lê Trung Kiệt', 0, '012312325', 'Bình Dương', '', ''),
(5, 'Linh@gmail.com', '123456', 'Nguyen Ngoc Linh', 0, '012566662133', 'Binh Duong', '1589942108', '../Images/Avatars/avt_Linh@gmail.com_logo2.png'),
(6, 'Quan@gmail.com', '123456', 'Lý Anh Quân', 0, '0152555833', 'Tp Hồ Chí Minh', '1589429318', '../Images/Avatars/avt_Quan@gmail.com_1220215025051515211521____666565.jpg'),
(7, 'Quyen@gmail.com', '123456', 'Vương Dĩ Quyền', 0, '0541215514', 'Binh Duong', '1589393506', '../Images/Avatars/avt_Quyen@gmail.com_tmp.jpg'),
(8, 'Thang@gmail.com', '123456', 'Nguyễn Hữu Thắng', 0, '0156525855', 'Dĩ An Bình Dương', '1589393506', ''),
(9, 'Thong@gmail.com', '123456', 'Võ Thông', 0, '040242155', 'Bình Dương', '', ''),
(10, 'Toan@gmail.com', '123456', 'Nguyễn Văn Toàn', 0, '0979977799', 'Dĩ An,Bình Dương', '', ''),
(11, 'Trung@gmail.com', '123456', 'Trần Thành Trung', 0, '0974582675', 'An Tây,Bình Dương', '', ''),
(12, 'TrungPham@gmail.com', '123456', 'Phạm Văn Trung', 0, '0123456545', 'Phú An Bình dương', '', ''),
(13, 'Tuan@gmail.com', '123456', 'Châu Quốc Tuấn', 0, '0969993339', 'Dĩ An,Bình Dương', '', ''),
(14, 'Tung@gmail.com', '123456', 'Nguyễn Thanh Tùng', 0, '0969996669', 'Bến Cát,Bình Dương', '', ''),
(15, 'Van@gmail.com', '123456', 'Nguyễn Vân', 0, '01255235322', 'Hà Nội', '1591890839', '../Images/Avatars/avt_Van@gmail.com_cha-biet-b.jpg'),
(17, 'Sam@gmail.com', '123456', 'Ngoc Sam', 0, '0152588464', 'Binh Duong', '1593605974', '../Images/Avatars/avt_Sam@gmail.com_eeehmv4wsaeix746.png'),
(20, 'temp@gmail.com', 'SBiH5M6tqe9crq5', 'One Punch Man', 0, '0123456789', 'Mars', '1594749888', '../Images/Avatars/avt_temp@gmail.com_WIN_20200626_11_11_06_Pro.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`stt`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`stt_id`);

--
-- Indexes for table `ddt_money`
--
ALTER TABLE `ddt_money`
  ADD PRIMARY KEY (`username_id`),
  ADD UNIQUE KEY `username_id` (`username_id`);

--
-- Indexes for table `ddt_money_out`
--
ALTER TABLE `ddt_money_out`
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`stt_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`stt_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `txn_id` (`txn_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`stt_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id_rate`);

--
-- Indexes for table `statistic`
--
ALTER TABLE `statistic`
  ADD UNIQUE KEY `dateTime` (`dateTime`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`stt_id`),
  ADD UNIQUE KEY `email` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `stt_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `stt_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `stt_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `stt_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id_rate` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `stt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
