-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2017 at 01:39 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `login-ajax`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_img` varchar(100) NOT NULL,
  `cat_slug` varchar(50) NOT NULL,
  `cat_font_awesome` varchar(200) NOT NULL,
  `cat_keyword` varchar(100) NOT NULL,
  `cat_description` varchar(200) NOT NULL,
  `cat_parent` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_img`, `cat_slug`, `cat_font_awesome`, `cat_keyword`, `cat_description`, `cat_parent`) VALUES
(2, 'Điện thoại', 'dienthoai.jpg', 'dien-thoai', 'fa-phone', 'điện thoại', 'điện thoại cũ mới các loại', 0),
(3, 'Máy tính, Linh kiện', 'maytinh-jpg', 'may-tinh', 'fa-desktop', 'máy tính', 'máy tính giá bèo', 0),
(4, 'Hãng điện thoại', 'hang-dien-thoai.jpg', 'hang-dien-thoai', 'fa-phone', 'hãng điện thoại', 'hãng điện thoại chính cmn hãng', 2),
(5, 'Apple', 'apple.jpg', 'apple', 'fa-apple', 'apple', 'apple', 4),
(6, 'Samsung', 'samsung.jpg', 'samsung', 'fa-samsung', 'samsung', 'samsung', 4),
(7, 'Asus', 'asus.jpg', 'asus', 'fa-asus', 'asus', 'asus', 4),
(9, 'Laptop', 'laptop.jpgx', 'laptop', 'fa-laptop', 'laptop', 'laptop', 3),
(10, 'Apple', 'laptop-apple', 'apple', 'fa-apple', 'Apple', 'Apple', 9),
(11, 'Asus', 'laptop-asus', 'asus', 'fa-asus', 'asus', 'asus', 9),
(12, 'Dell', 'laptop-dell', 'dell', 'fa-dell', 'dell', 'dell', 9),
(13, 'HP', 'laptop-hp', 'laptop-hp', 'laptop-hp', 'laptop-hp', 'laptop-hp', 9),
(14, 'Sony', 'laptop-sony', 'laptop-sony', '', 'laptop-sony', 'laptop-sony', 9),
(15, 'Acer', 'laptop-acer', 'laptop-acer', '', 'laptop-acer', 'laptop-acer', 9),
(16, 'Lenovo', 'laptop-lenovo', 'laptop-lenovo', '', 'laptop-lenovo', 'laptop-lenovo', 9),
(17, 'Máy bộ PC', 'may-bo-pc', 'may-bo-pc', '', 'may-bo-pc', 'may-bo-pc', 3),
(18, 'Máy văn phòng', 'may-van-phong', 'may-van-phong', '', 'may-van-phong', 'may-van-phong', 17),
(19, 'Máy chơi game', 'may-choi-game', 'may-choi-game', '', 'may-choi-game', 'may-choi-game', 17),
(20, 'DestNote', 'DestNote', 'destnote', '', 'destnote', 'destnote', 17),
(21, 'Phụ kiện máy tính', 'phu-kien-may-tinh', 'phu-kien-may-tinh', '', 'phu-kien-may-tinh', 'phu-kien-may-tinh', 3),
(22, 'Chuột máy tính', 'chuot-may-tinh', 'chuot-may-tinh', '', 'chuot-may-tinh', 'chuot-may-tinh', 21),
(23, 'Bàn phím', 'ban-phim', 'ban-phim', '', 'ban-phim', 'ban-phim', 21),
(24, 'Loa máy tính', 'loa-may-tinh', 'loa-may-tinh', '', 'loa-may-tinh', 'loa-may-tinh', 21),
(25, 'USB', 'usb', 'usb', '', 'usb', 'usb', 21),
(26, 'Bàn ghế', 'ban-ghe-may-tinh', 'ban-ghe-may-tinh', '', 'ban-ghe-may-tinh', 'ban-ghe-may-tinh', 21),
(27, 'Webcam - Headphone', 'webcam-headphone', 'webcam-headphone', '', 'webcam-headphone', 'webcam-headphone', 21),
(28, 'Dụng cụ vệ sinh', 'dung-cu-ve-sinh', 'dung-cu-ve-sinh', '', 'dung-cu-ve-sinh', 'dung-cu-ve-sinh', 21),
(29, 'Linh kiện máy tính', 'linh-kien-may-tinh', 'linh-kien-may-tinh', '', 'linh-kien-may-tinh', 'linh-kien-may-tinh', 3),
(30, 'VGA', 'vga', 'vga', '', 'vga', 'vga', 29),
(31, 'MAINBOARD', 'mainboard', 'mainboard', '', 'mainboard', 'mainboard', 29),
(32, 'CPU', 'cpu', 'cpu', '', 'cpu', 'cpu', 29),
(33, 'RAM', 'ram', 'ram', '', 'ram', 'ram', 29),
(34, 'Nguồn máy tính', 'nguon-may-tinh', 'nguon-may-tinh', '', 'nguon-may-tinh', 'nguon-may-tinh', 29),
(35, 'Tản nhiệt', 'tan-nhiet', 'tan-nhiet', '', 'tan-nhiet', 'tan-nhiet', 29),
(36, 'HDD - SSD', 'hdd-ssd', 'hdd-ssd', '', 'hdd-ssd', 'hdd-ssd', 29),
(37, 'Case - Vỏ máy', 'case-vo-may', 'case-vo-may', '', 'case-vo-may', 'case-vo-may', 29),
(38, 'ODD (DVD)', 'odd-dvd', 'odd-dvd', '', 'odd-dvd', 'odd-dvd', 29),
(39, 'Màn hình LED', 'man-hinh-led', 'man-hinh-led', '', 'man-hinh-led', 'man-hinh-led', 29),
(40, 'HTC', 'htc', 'htc', '', 'htc', 'htc', 4),
(41, 'Oppo', 'oppo', 'oppo', '', 'oppo', 'oppo', 4),
(42, 'Nokia', 'nokia', 'nokia', '', 'nokia', 'nokia', 4),
(43, 'Lenovo', 'dien-thoai-lenovo', 'dien-thoai-lenovo', '', 'dien-thoai-lenovo', 'dien-thoai-lenovo', 4),
(44, 'BlackBerry', 'dien-thoai-blackberry', 'dien-thoai-blackberry', '', 'dien-thoai-blackberry', 'dien-thoai-blackberry', 4),
(45, 'Phụ kiện điện thoại', 'phu-kien-dien-thoai', 'phu-kien-dien-thoai', '', 'phu-kien-dien-thoai', 'phu-kien-dien-thoai', 2),
(46, 'Ốp lưng - Bao da', 'op-lung-bao-da', 'op-lung-bao-da', '', 'op-lung-bao-da', 'op-lung-bao-da', 45),
(47, 'Miếng dán màn hình', 'mieng-dan-man-hinh', 'mieng-dan-man-hinh', '', 'mieng-dan-man-hinh', 'mieng-dan-man-hinh', 45),
(48, 'Gậy Selfie', 'gay-selfie', 'gay-selfie', '', 'gay-selfie', 'gay-selfie', 45),
(49, 'Pin - Pin dự phòng', 'pin-pin-du-phong', 'pin-pin-du-phong', '', 'pin-pin-du-phong', 'pin-pin-du-phong', 45),
(50, 'Củ sạc - Dây cáp', 'cu-sac-day-cap', 'cu-sac-day-cap', '', 'cu-sac-day-cap', 'cu-sac-day-cap', 45),
(51, 'Thẻ nhớ', 'the-nho', 'the-nho', '', 'the-nho', 'the-nho', 45),
(52, 'Sạc không dây', 'sac-khong-day', 'sac-khong-day', '', 'sac-khong-day', 'sac-khong-day', 45),
(53, 'Loại khác', 'dien-thoai-loai-khac', 'dien-thoai-loai-khac', '', 'dien-thoai-loai-khac', 'dien-thoai-loai-khac', 2),
(54, 'Điện thoại chữa cháy', 'dien-thoai-chua-chay', 'dien-thoai-chua-chay', '', 'dien-thoai-chua-chay', 'dien-thoai-chua-chay', 53),
(55, 'Điện thoại trả góp', 'dien-thoai-tra-gop', 'dien-thoai-tra-gop', '', 'dien-thoai-tra-gop', 'dien-thoai-tra-gop', 53),
(56, 'Điện thoại thanh lý', 'dien-thoai-thanh-ly', 'dien-thoai-thanh-ly', '', 'dien-thoai-thanh-ly', 'dien-thoai-thanh-ly', 53);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `created`) VALUES
(11, 'Chrysanthemum.jpg', '2016-12-15 05:57:45'),
(12, 'Desert.jpg', '2016-12-15 05:59:04'),
(13, 'Hydrangeas.jpg', '2016-12-15 06:07:35'),
(14, 'Hydrangeas1.jpg', '2016-12-15 06:08:15'),
(15, 'Desert1.jpg', '2016-12-15 06:20:39'),
(16, 'Koala.jpg', '2016-12-15 06:27:35'),
(17, 'Lighthouse.jpg', '2016-12-15 06:27:35'),
(18, 'Penguins.jpg', '2016-12-15 06:27:35'),
(19, 'Tulips.jpg', '2016-12-15 06:27:35'),
(20, 'Lighthouse1.jpg', '2016-12-15 06:33:18'),
(21, 'Chrysanthemum1.jpg', '2016-12-15 06:47:41'),
(22, 'Koala1.jpg', '2016-12-15 06:48:26'),
(23, 'Chrysanthemum2.jpg', '2016-12-15 06:49:08'),
(24, 'Desert2.jpg', '2016-12-15 06:49:08'),
(25, 'Koala2.jpg', '2016-12-15 06:49:08'),
(26, 'Lighthouse2.jpg', '2016-12-15 06:49:08'),
(27, 'Penguins1.jpg', '2016-12-15 06:49:16'),
(28, 'Tulips1.jpg', '2016-12-15 06:49:16'),
(29, 'Desert.jpg', '2016-12-15 06:51:44'),
(30, 'Chrysanthemum.jpg', '2016-12-15 06:51:46'),
(31, 'Desert1.jpg', '2016-12-15 06:51:47'),
(32, 'Lighthouse.jpg', '2016-12-15 06:51:48'),
(33, 'Lighthouse1.jpg', '2016-12-15 06:51:50'),
(34, 'Koala.jpg', '2016-12-15 06:51:51'),
(35, 'Koala.jpg', '2016-12-15 06:57:35'),
(36, 'Chrysanthemum.jpg', '2016-12-15 06:57:37'),
(37, 'Koala1.jpg', '2016-12-15 06:57:39'),
(38, 'Penguins.jpg', '2016-12-15 06:57:42'),
(39, 'Lighthouse.jpg', '2016-12-15 06:57:44'),
(40, 'Koala2.jpg', '2016-12-15 06:57:56'),
(41, 'Lighthouse1.jpg', '2016-12-15 06:57:56'),
(42, 'Chrysanthemum1.jpg', '2016-12-15 06:58:45'),
(43, 'Chrysanthemum2.jpg', '2016-12-15 06:58:49'),
(44, 'Desert.jpg', '2016-12-15 06:58:49'),
(45, 'Koala3.jpg', '2016-12-15 06:58:49'),
(46, 'Lighthouse2.jpg', '2016-12-15 06:58:49'),
(47, 'Lighthouse3.jpg', '2016-12-15 06:58:52'),
(48, 'Chrysanthemum3.jpg', '2016-12-15 06:58:56'),
(49, 'Desert1.jpg', '2016-12-15 06:58:56'),
(50, 'Hydrangeas.jpg', '2016-12-15 06:58:56'),
(51, 'Koala4.jpg', '2016-12-15 06:58:56'),
(52, 'Lighthouse4.jpg', '2016-12-15 06:58:56'),
(53, 'Penguins1.jpg', '2016-12-15 06:58:56'),
(54, 'Chrysanthemum4.jpg', '2016-12-15 07:01:17'),
(55, 'Koala5.jpg', '2016-12-15 07:01:28'),
(56, 'Chrysanthemum.jpg', '2016-12-15 07:01:42'),
(57, 'Chrysanthemum1.jpg', '2016-12-15 07:02:09'),
(58, 'Desert.jpg', '2016-12-15 07:02:09'),
(59, 'Koala.jpg', '2016-12-15 07:02:09'),
(60, 'Lighthouse.jpg', '2016-12-15 07:02:09'),
(61, 'Koala1.jpg', '2016-12-15 07:02:21'),
(62, 'Lighthouse1.jpg', '2016-12-15 07:02:21'),
(63, 'Desert1.jpg', '2016-12-15 07:04:40'),
(64, 'Lighthouse2.jpg', '2016-12-15 07:04:43'),
(65, 'Koala2.jpg', '2016-12-15 07:04:45'),
(66, 'Penguins.jpg', '2016-12-15 07:04:54'),
(67, 'Tulips.jpg', '2016-12-15 07:04:56'),
(68, 'Hydrangeas.jpg', '2016-12-15 07:04:58'),
(69, 'Chrysanthemum2.jpg', '2016-12-15 07:06:43'),
(70, 'Koala3.jpg', '2016-12-15 07:06:52'),
(71, 'Chrysanthemum3.jpg', '2016-12-15 07:06:59'),
(72, 'Koala4.jpg', '2016-12-15 07:07:00'),
(73, 'Lighthouse3.jpg', '2016-12-15 07:07:02'),
(74, 'Hydrangeas1.jpg', '2016-12-15 07:07:04'),
(75, 'Koala5.jpg', '2016-12-15 07:07:06'),
(76, 'Penguins1.jpg', '2016-12-15 07:07:13'),
(77, 'Lighthouse4.jpg', '2016-12-15 07:07:17'),
(78, 'Tulips1.jpg', '2016-12-15 07:07:20'),
(79, 'Chrysanthemum.jpg', '2016-12-15 07:08:24'),
(80, 'Desert.jpg', '2016-12-15 07:08:25'),
(81, 'Hydrangeas.jpg', '2016-12-15 07:08:27'),
(82, 'Koala.jpg', '2016-12-15 07:08:28'),
(83, 'Lighthouse.jpg', '2016-12-15 07:08:29'),
(84, 'Lighthouse1.jpg', '2016-12-15 07:08:31'),
(85, 'Koala1.jpg', '2016-12-15 07:08:32'),
(86, 'Chrysanthemum1.jpg', '2016-12-15 07:10:34'),
(87, 'Chrysanthemum2.jpg', '2016-12-15 07:11:36'),
(88, 'Chrysanthemum3.jpg', '2016-12-15 07:12:00'),
(89, 'Chrysanthemum4.jpg', '2016-12-15 07:12:45'),
(90, 'Desert1.jpg', '2016-12-15 07:12:48'),
(91, 'Chrysanthemum5.jpg', '2016-12-15 07:12:50'),
(92, 'Chrysanthemum6.jpg', '2016-12-15 07:12:51'),
(93, 'Desert2.jpg', '2016-12-15 07:12:57'),
(94, 'Chrysanthemum7.jpg', '2016-12-15 07:15:36'),
(95, 'Desert3.jpg', '2016-12-15 07:15:36'),
(96, 'Koala2.jpg', '2016-12-15 07:15:36'),
(97, 'Lighthouse2.jpg', '2016-12-15 07:15:36'),
(98, 'Desert4.jpg', '2016-12-15 07:15:38'),
(99, 'Lighthouse3.jpg', '2016-12-15 14:07:16'),
(100, 'Desert5.jpg', '2016-12-15 14:24:37'),
(101, 'Chrysanthemum8.jpg', '2016-12-15 14:27:04'),
(102, 'Koala3.jpg', '2016-12-15 14:27:57'),
(103, 'Chrysanthemum9.jpg', '2016-12-15 14:32:18'),
(104, 'Hydrangeas1.jpg', '2016-12-15 14:46:07'),
(105, 'Jellyfish.jpg', '2016-12-15 14:46:07'),
(106, 'Penguins.jpg', '2016-12-15 14:46:07'),
(107, 'Tulips.jpg', '2016-12-15 14:46:07'),
(108, 'Desert6.jpg', '2016-12-15 14:46:11'),
(109, 'Chrysanthemum10.jpg', '2016-12-15 14:50:28'),
(110, 'Desert7.jpg', '2016-12-15 14:50:28'),
(111, 'Koala4.jpg', '2016-12-15 14:50:28'),
(112, 'Lighthouse4.jpg', '2016-12-15 14:50:28'),
(113, 'Penguins1.jpg', '2016-12-15 14:50:28'),
(114, 'Hydrangeas2.jpg', '2016-12-15 14:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE IF NOT EXISTS `menu_item` (
  `id` int(11) NOT NULL,
  `title` varchar(75) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`id`, `title`, `link`, `parent_id`, `position`) VALUES
(1, '1', '1.html', 0, 1),
(2, '2', '2.html', 0, 2),
(3, '11', '11.html', 1, 1),
(4, '12', '12.html', 1, 2),
(5, '21', '21.html', 2, 1),
(6, '22', '22.html', 2, 2),
(7, '3', '3.html', 0, 3),
(8, 'sub 3', '#', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`p_id` int(11) NOT NULL,
  `p_cat` int(11) NOT NULL,
  `p_region` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_val` int(2) NOT NULL,
  `discount` tinyint(1) NOT NULL,
  `discount_val` int(2) NOT NULL,
  `poster` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `activator` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `transport` varchar(255) NOT NULL,
  `ranks` int(11) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_cat`, `p_region`, `name`, `slug`, `price`, `qty`, `status`, `status_val`, `discount`, `discount_val`, `poster`, `is_active`, `activator`, `create_date`, `keyword`, `tag`, `description`, `transport`, `ranks`, `views`) VALUES
(4, 5, 1, 'Iphone 6 Plus World', 'iphone-6-plus-world-80', 8000000, 1, 1, 99, 1, 10, 1, 1, 1, '2016-12-18 18:14:28', 'Iphone 6 Plus World', ' Iphone 6 Plus World', ' <p>Iphone 6 Plus World</p>\r\n', '', 0, 0),
(5, 10, 1, 'Macbook air 11" i5 ram4 128ssd', 'macbook-air-11-i5-ram4-128ssd', 10500000, 1, 1, 99, 0, 0, 1, 1, 1, '2016-12-19 20:12:42', 'Macbook air 11" i5 ram4 128ssd', ' Macbook air ', ' <h1><strong>Macbook air 11&quot; i5 ram4 128ssd pin 5000 sạc 2 lần mới 99% ko xước ko m&oacute;p c&agrave;i sẵn 2 win 10 - mac</strong></h1><p>M&aacute;y mới ko m&oacute;p xước . Pin 5000 sạc đ&uacute;ng 2 lần , m&aacute;y đứa e n&oacute; ko d&ugrave;ng n&ecirc;n giờ b&aacute;n mua m&aacute;y kh&aacute;c . Đ&atilde; c&agrave;i sẵn cả win 10- office skype unikey.... đẩy đủ hết win + office đ&atilde; được k&iacute;ch hoạt &quot; .....&quot; , chạy song song 2 hệ điều h&agrave;nh</p>', '', 0, 0),
(6, 6, 1, 'Samsung Note 5', 'samsung-note-5', 10000000, 1, 1, 99, 0, 0, 1, 1, 1, '2016-12-23 15:10:17', 'Samsung Note 5', 'Samsung Note 5', ' <p>Samsung Note 5</p>\r\n', '', 0, 2),
(7, 6, 1, 'Samsung Galaxy S7 EDGE', 'galaxy-s7-edge', 15000000, 1, 0, 100, 0, 0, 4, 1, 0, '2016-12-27 16:53:53', 's7edge cũ tại bmt', ' s7edge', ' <ul>\r\n	<li>- Sản phẩm được bảo h&agrave;nh 1 đổi 1 trong v&ograve;ng 10 ng&agrave;y nếu c&oacute; lỗi do nh&agrave; sản xuất</li>\r\n	<li>- Nguy&ecirc;n hộp bao gồm: Hộp m&aacute;y, th&acirc;n m&aacute;y, pin, sạc, c&aacute;p, tai nghe, s&aacute;ch hướng dẫn&nbsp;</li>\r\n</ul>\r\n', ' Miễn phí trong thành phố\r\n30k nếu ở ngoại thành', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
`pi_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`pi_id`, `p_id`, `name`, `alt`, `title`) VALUES
(1, 4, 'Chrysanthemum.jpg', ' null ', ' null '),
(2, 4, 'Desert.jpg', ' null ', ' null '),
(3, 4, 'Hydrangeas.jpg', ' null ', ' null '),
(4, 4, 'Koala.jpg', ' null ', ' null '),
(5, 4, 'Lighthouse.jpg', ' null ', ' null '),
(6, 4, 'Penguins.jpg', ' null ', ' null '),
(7, 5, 'macbook-1.jpg', ' null ', ' null '),
(8, 5, 'macbook-2.jpg', ' null ', ' null '),
(9, 5, 'macbook-3.jpg', ' null ', ' null '),
(10, 5, 'macbook-4.jpg', ' null ', ' null '),
(11, 5, 'macbook-5.jpg', ' null ', ' null '),
(12, 5, 'macbook-6.jpg', ' null ', ' null '),
(13, 6, '37_oxW9qYHDTB.jpg', ' null ', ' null '),
(14, 6, 'IMG_9150.JPG', ' null ', ' null '),
(15, 6, 'note-5-3.jpg', ' null ', ' null '),
(16, 6, 'samsung-galaxy-note-5-cu-2.jpg', ' null ', ' null '),
(17, 6, 'samsung-galaxy-note-5-cu-thiet-ke.jpg', ' null ', ' null '),
(18, 6, 'Samsung-Galaxy-Note5-xach-tay-Han-Quoc-2.JPG', ' null ', ' null '),
(19, 7, 'samsung-galaxy-s7-edge_1_.jpg', ' ', ' '),
(20, 7, 'samsung-galaxy-s7-edge_14_.jpg', ' ', ' '),
(21, 7, 'samsung-galaxy-s7-edge_15_.jpg', ' ', ' '),
(22, 7, 'samsung-galaxy-s7-edge_25_.jpg', ' ', ' '),
(23, 7, 'samsung-galaxy-s7-edge_28_.jpg', ' ', ' '),
(24, 7, 'samsung-galaxy-s7-edge_29_.jpg', ' ', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
`id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `acronym` varchar(20) NOT NULL,
  `slug` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `acronym`, `slug`) VALUES
(1, 'Buôn Ma Thuột', 'BMT', 'bmt'),
(2, 'Huyện Buôn Đôn', 'Buôn Đôn', 'buon-don'),
(3, 'Toàn Quốc', 'Toàn Quốc', 'toan-quoc');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
`shop_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `vip` tinyint(1) NOT NULL,
  `vote` int(11) NOT NULL,
  `vote_point` int(11) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `p_id`, `name`, `phone`, `address`, `email`, `keyword`, `description`, `vip`, `vote`, `vote_point`, `views`) VALUES
(1, 1, 'Ánh Angel''s Fashion & Cosmetics MakeUp', 1634669294, '186 Phan Bội Châu, P.Thành Công, Tp.Buôn Ma Thuột, DakLak', 'trinhngocanh.angel@gmail.com', 'mỹ phẩm, quần áo thời trang', 'shop ánh angel giá rẻ phù hợp với tất cả mọi người và mọi lứa tuổi', 1, 2, 8, 5),
(3, 3, 'Trịnh Ngọc Ánh', 0, '', '', '', '', 0, 0, 0, 0),
(4, 4, 'Nguyễn Ngọc Hải', 0, '', '', '', '', 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shop_images`
--

CREATE TABLE IF NOT EXISTS `shop_images` (
`id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_posts`
--

CREATE TABLE IF NOT EXISTS `shop_posts` (
`id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `content` text NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `shop_posts`
--

INSERT INTO `shop_posts` (`id`, `shop_id`, `title`, `slug`, `create_date`, `content`, `type`) VALUES
(1, 1, 'Giới thiệu', 'gioithieu', '0000-00-00 00:00:00', '', 0),
(2, 1, 'Chính sách', 'chinhsach', '0000-00-00 00:00:00', '', 0),
(3, 1, 'Liên hệ', 'lienhe', '0000-00-00 00:00:00', '', 0),
(4, 3, 'Giới thiệu', 'gioithieu', '2016-12-26 13:36:24', '', 0),
(5, 3, 'Chính sách', 'chinhsach', '2016-12-26 13:36:24', '', 0),
(6, 3, 'Liên hệ', 'lienhe', '2016-12-26 13:36:24', '', 0),
(7, 4, 'Giới thiệu', 'gioithieu', '2016-12-26 16:57:20', '', 0),
(8, 4, 'Chính sách', 'chinhsach', '2016-12-26 16:57:20', '', 0),
(9, 4, 'Liên hệ', 'lienhe', '2016-12-26 16:57:20', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ta_roles`
--

CREATE TABLE IF NOT EXISTS `ta_roles` (
`r_id` int(11) NOT NULL,
  `r_name` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ta_roles`
--

INSERT INTO `ta_roles` (`r_id`, `r_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `ta_users`
--

CREATE TABLE IF NOT EXISTS `ta_users` (
`u_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `u_fullname` varchar(100) NOT NULL,
  `u_username` varchar(20) NOT NULL,
  `u_password` varchar(40) NOT NULL,
  `u_gender` tinyint(1) NOT NULL,
  `u_email` varchar(60) NOT NULL,
  `u_createdate` datetime NOT NULL,
  `u_image` varchar(200) NOT NULL,
  `u_point` int(10) NOT NULL,
  `u_status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ta_users`
--

INSERT INTO `ta_users` (`u_id`, `r_id`, `u_fullname`, `u_username`, `u_password`, `u_gender`, `u_email`, `u_createdate`, `u_image`, `u_point`, `u_status`) VALUES
(1, 1, 'Admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'admin@chosalebmt.com', '2016-10-10 00:00:00', '', 0, 2),
(3, 2, 'Trịnh Ngọc Ánh', 'trinhngocanh', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'trinhngocanh.angel@gmail.com', '2016-12-26 13:36:24', ' ', 0, 1),
(4, 2, 'Nguyễn Ngọc Hải', 'nguyenngochai', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'nguyenngochai.bmt@gmail.com', '2016-12-26 16:57:20', ' ', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
`ud_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `ud_avatar` varchar(255) NOT NULL,
  `ud_phone` varchar(11) DEFAULT NULL,
  `ud_dob` date DEFAULT NULL,
  `ud_address` varchar(255) DEFAULT NULL,
  `ud_pincode` int(40) NOT NULL,
  `ud_last_login` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`ud_id`, `u_id`, `ud_avatar`, `ud_phone`, `ud_dob`, `ud_address`, `ud_pincode`, `ud_last_login`) VALUES
(1, 1, '', '01634669294', '1994-02-09', '187 Phan Bội Châu, BMT, DakLak', 921994, '2016-12-17 06:34:48'),
(3, 3, 'avatar.jpg', '01634669294', '1994-02-09', '187 Phan Bội Châu, Tp.Buôn Ma Thuột', 6072, '0000-00-00 00:00:00'),
(4, 4, 'Beauty-Sexy-Wallpaper-Game_zps2acba520.jpg', '0985385878', '1994-05-04', '43 Trương Công Đinh, Tp.BMT', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
 ADD PRIMARY KEY (`pi_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
 ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `shop_images`
--
ALTER TABLE `shop_images`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_posts`
--
ALTER TABLE `shop_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_roles`
--
ALTER TABLE `ta_roles`
 ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `ta_users`
--
ALTER TABLE `ta_users`
 ADD PRIMARY KEY (`u_id`), ADD KEY `r_id` (`r_id`), ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
 ADD PRIMARY KEY (`ud_id`), ADD KEY `ud_id` (`ud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `shop_images`
--
ALTER TABLE `shop_images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_posts`
--
ALTER TABLE `shop_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ta_roles`
--
ALTER TABLE `ta_roles`
MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ta_users`
--
ALTER TABLE `ta_users`
MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
MODIFY `ud_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ta_users`
--
ALTER TABLE `ta_users`
ADD CONSTRAINT `role_user_fix` FOREIGN KEY (`r_id`) REFERENCES `ta_roles` (`r_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
