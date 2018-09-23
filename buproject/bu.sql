-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 مارس 2018 الساعة 14:34
-- إصدار الخادم: 10.1.30-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bu`
--

-- --------------------------------------------------------

--
-- بنية الجدول `bu`
--

CREATE TABLE `bu` (
  `id` int(11) NOT NULL,
  `bu_name` varchar(100) NOT NULL,
  `bu_price` float NOT NULL,
  `bu_room` int(11) NOT NULL,
  `bu_rent` tinyint(1) NOT NULL,
  `bu_square` varchar(10) NOT NULL,
  `bu_type` tinyint(1) NOT NULL,
  `bu_small_dis` varchar(160) NOT NULL,
  `bu_meta` varchar(200) NOT NULL,
  `bu_langtuide` varchar(50) NOT NULL,
  `bu_laltitude` varchar(50) NOT NULL,
  `bu_large_dis` longtext NOT NULL,
  `bu_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL,
  `bu_place` varchar(10) NOT NULL,
  `image` varchar(300) NOT NULL,
  `month` varchar(3) NOT NULL,
  `year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `bu`
--

INSERT INTO `bu` (`id`, `bu_name`, `bu_price`, `bu_room`, `bu_rent`, `bu_square`, `bu_type`, `bu_small_dis`, `bu_meta`, `bu_langtuide`, `bu_laltitude`, `bu_large_dis`, `bu_status`, `created_at`, `updated_at`, `user_id`, `bu_place`, `image`, `month`, `year`) VALUES
(2, 'فيلا العادى الجديدة', 100000, 30, 0, '700', 1, 'فيلا,المعادى,الجديدة فيلا,المعادى,الجديدة جميل رائع', 'فيلا,المعادى,الجديدة', '123456', '123456', 'فيلا,المعادى,الجديدة فيلا,المعادى,الجديدة فيلا,المعادى,الجديدة', 1, '2018-03-24 16:38:13', '2018-03-22 20:48:22', 1, '0', '3.jpg', '02', '2018'),
(3, 'فيلا المعادى الجديدة', 5000000, 30, 1, '200', 1, 'فيلا العادى الجديدة رائع جميل', 'فيلا,المعادىوالجديدة', '12354', '54777', 'فيلا المعادى الجديدة', 1, '2018-03-24 14:41:08', '2018-03-18 14:36:28', 2, '0', '777.jpg', '05', '2019'),
(4, 'شقة بالشروق', 1000000, 10, 0, '100', 0, 'الشروق,مدينة نصر رائع جميل جدا شقة ولا أروع', 'الشروق,مدينة نصر', '12364', '254545', 'الشروق,مدينة نصر رائع جميل جدا شقة ولا أروع', 1, '2018-03-24 14:43:13', '2018-03-18 14:15:33', 1, '0', '88888.jpg', '02', '2018'),
(5, 'شقة مصر الجديدة الجديدة', 5000000, 12, 1, '200', 0, 'مصر الجديدة , القاهرة مصر الجديدة , القاهرة مصر الجديدة , القاهرة مصر الجديدة , القاهرة', 'مصر الجديدة , القاهرة', '1235456', '3665656', 'مصر الجديدة , القاهرة مصر الجديدة , القاهرة مصر الجديدة , القاهرة مصر الجديدة , القاهرة', 0, '2018-03-24 17:16:27', '2018-03-22 20:51:09', 2, '0', 'maxresdefault.jpg', '03', '2019'),
(6, 'شاليه مارينا', 2000000, 12, 0, '500', 2, 'شالية,مارينا,الساحل الشمالىشالية,مارينا,الساحل الشمالىشالية,مارينا,الساحل الشمالىشالية,مارينا,الساحل الشمالىشالية', 'شالية,مارينا,الساحل الشمالى', '56456', '56546', 'شالية,مارينا,الساحل الشمالىشالية,مارينا,الساحل الشمالىشالية,مارينا,الساحل الشمالىشالية,مارينا,الساحل الشمالى', 1, '2018-03-24 16:43:15', '2018-03-18 12:58:33', 1, '0', '666.jpg', '03', '2018'),
(7, 'فيلا 6 أكتوبر', 400000, 23, 0, '600', 1, 'فيلا,6أكتوبر,الجيزةفيلا,6أكتوبر,الجيزة', 'فيلا,6أكتوبر,الجيزة', '456474', '54974', 'فيلا,6أكتوبر,الجيزةفيلا,6أكتوبر,الجيزةفيلا,6أكتوبر,الجيزةفيلا,6أكتوبر,الجيزةفيلا,', 1, '2018-03-24 17:01:02', '2018-03-18 11:24:36', 1, '1', '4.jpg', '02', '2018'),
(8, 'ِشقة ستانلى', 2000000, 10, 0, '700', 0, 'اسكندرية,ستانلىاسكندر', 'اسكندرية,ستانلى', '51.508742', '-0.120850', 'اسكندرية رائع جميل <br>\r\nجميل جدا', 1, '2018-03-24 14:40:46', '2018-03-18 11:24:07', 1, '57', '3.jpg', '03', '2019'),
(9, 'العقار الأول', 1000000, 20, 0, '500', 1, 'الجيزة,الأهرامالجيزة,الأهرام', 'الجيزة,الأهرام', '4645674', '4574587', 'رائع جميل', 1, '2018-03-24 14:40:50', '2018-03-18 11:23:36', 1, '16', '2.jpg', '03', '2019'),
(10, 'فيلا مدينة نصر', 5000000, 30, 0, '800', 1, 'رائع جميل', 'مدينة نصر', '4674796', '5787', 'رائع جميل جميل جدا', 1, '2018-03-24 14:40:54', '2018-03-18 12:17:54', 1, '4', '3.jpg', '03', '2019'),
(11, 'شقة المنتزه', 600000, 9, 0, '500', 0, 'رائع جميل جدا', 'المنتزه', '547997', '5698978', 'رائع جميل جدا', 1, '2018-03-24 14:40:58', '2018-03-20 07:46:07', 1, '71', '666.jpg', '04', '2019'),
(12, 'ljnkhih', 15000000, 15, 0, '500', 0, 'نمتخا', 'شقةوبتخعتابخ', '69', '5645', 'نمتخا', 1, '2018-03-24 14:41:01', '2018-03-20 08:36:45', 1, '0', '', '04', '2019'),
(13, 'شقة حلوان', 500000, 40, 0, '600', 0, 'رائع جميل جدا رائع', 'حلوان,القاهرة', '5555', '6666', 'رائع جميل جدا رائع', 0, '2018-03-24 14:41:04', '2018-03-22 20:52:27', 2, '18', '', '05', '2019'),
(14, 'شقة مصر الجديدة', 4000000, 12, 1, '100', 0, 'مصر الجديدة , القاهرة مصر الجديدة , القاهرة مصر الجديدة , القاهرة مصر الجديدة , القاهرة', 'مصر الجديدة , القاهرة', '1235456', '3665656', 'مصر الجديدة , القاهرة مصر الجديدة , القاهرة مصر الجديدة , القاهرة مصر الجديدة , القاهرة', 0, '2018-03-24 14:41:16', '2018-03-22 20:51:19', 2, '0', 'cms-image-000065905.jpg', '06', '2019');

-- --------------------------------------------------------

--
-- بنية الجدول `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_subject` varchar(100) DEFAULT NULL,
  `contact_message` text NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '0',
  `contact_type` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `contact`
--

INSERT INTO `contact` (`id`, `contact_name`, `contact_email`, `contact_subject`, `contact_message`, `view`, `contact_type`, `created_at`, `updated_at`) VALUES
(2, 'أحمد محمود', 'ah_se2016@yahoo.com', NULL, 'جميل جدا جميل', 1, 1, '2018-03-20 06:59:26', '2018-03-20 04:59:26'),
(3, 'أحمد رضوان', 'mitomahmoud2002@gmail.com', NULL, 'انشاء صفحة جديدة', 1, 3, '2018-03-20 09:54:54', '2018-03-20 07:54:54'),
(4, 'خالد محمود', 'kh_se2020@gmail.com', NULL, 'رائع جميل جميل جدا', 1, 1, '2018-03-24 22:12:46', '2018-03-24 20:12:46');

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `sitesetting`
--

CREATE TABLE `sitesetting` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `namesetting` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `sitesetting`
--

INSERT INTO `sitesetting` (`id`, `slug`, `namesetting`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'اسم الموقع', 'sitename', 'موقع عقارات الأول فى الشرق الأوسط', 0, '2018-03-09 21:50:18', '2018-03-09 19:50:18'),
(2, 'الموبيل', 'mobile', '01004171033', 0, '2018-03-09 18:33:14', '0000-00-00 00:00:00'),
(3, 'الفيس بوك', 'facebook', 'facebook', 0, '2018-03-09 20:25:30', '2018-03-09 18:25:30'),
(4, 'التويتر', 'twitter', 'twitter', 0, '2018-03-09 20:25:30', '2018-03-09 18:25:30'),
(5, 'اليوتيوب', 'youtube', 'youtube', 0, '2018-03-09 20:25:30', '2018-03-09 18:25:30'),
(6, 'العنوان', 'adresse', '2 شارع النزهة مصر الجديدة القاهرة مصر', 0, '2018-03-18 21:05:50', '2018-03-18 19:05:50'),
(7, 'الكلمات الدلالية', 'keywords', 'ahmed', 1, '2018-03-09 20:25:31', '2018-03-09 18:25:31'),
(8, 'وصف الموقع', 'dis', 'beautiful', 1, '2018-03-09 20:25:31', '2018-03-09 18:25:31'),
(9, 'صورة بديلة', 'no_image', 'https://tablet4u.co.uk/img/no-image.jpg', 0, '2018-03-17 11:51:19', '2018-03-16 12:13:28'),
(10, 'صورة السليدر الرئيسيى فى الصفحة الرئيسية', 'main_slider', 'banner.jpg', 3, '2018-03-20 19:10:32', '2018-03-20 17:10:32'),
(11, 'الايميل', 'email', 'admin@gmail.com', 0, '2018-03-18 21:01:21', '0000-00-00 00:00:00'),
(12, 'حقوق الموقع', 'footer', 'برمجة Ahmed Mahmoud', 0, '2018-03-24 17:54:37', '2018-03-24 15:54:37');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mitomahmoud', 'mitomahmoud2022@gmail.com', '$2y$10$9rcLFtu.H3WMcAmATU7wy.so5T4/wIHWuiyxCUHJaZ7OHqA0LlS5.', 1, '9Ql4Z4PjmdkwXSlyakhS121wSPUTcUcoZyxzeFzDQHPomkCRnJOwj2wbldXq', '2018-03-05 20:48:04', '2018-03-21 11:37:29'),
(2, 'khaleed', 'khaleed@gmail.com', '$2y$10$daN43E7kwoM5SacNqV5lcuo/1au3lYsAC0hQU5kHpN4Tc/4H00.qu', 0, 'KQEadtKL6iBuN47b0hnuyBgRtG8v6MZQKlRe1iZti9lXUhEjfggJdcske2a0', '2018-03-07 17:58:56', '2018-03-09 15:19:10'),
(6, 'zizoahmed', 'zizo@gmail.com', '$2y$10$F1UGimY8Bw..nkF8Ivp3Z.Q.J3WOT31S7cdbtM724.TF0ZcqvcuZ6', 0, NULL, '2018-03-09 14:56:10', '2018-03-11 18:57:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bu`
--
ALTER TABLE `bu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sitesetting`
--
ALTER TABLE `sitesetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bu`
--
ALTER TABLE `bu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sitesetting`
--
ALTER TABLE `sitesetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
