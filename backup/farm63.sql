-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 18, 2022 at 04:56 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farm63`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `houseno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Benefits', '2022-05-18 01:56:09', '2022-05-18 01:56:09'),
(2, 'Storage and Uses', '2022-05-18 01:56:15', '2022-05-18 01:56:15'),
(3, 'Other Product Info', '2022-05-18 01:56:21', '2022-05-18 01:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optsel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `desc`, `linkt`, `optsel`, `link`, `loc`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '1', '0', '/hotdeals', 'storage/banner/uBSKWrmoR6Djx45c.jpg', 1, '2022-05-18 02:47:15', '2022-05-18 02:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homebanner` tinyint(1) NOT NULL DEFAULT 0,
  `seo_title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `uid`, `pid`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 1, '2022-05-18 02:47:57', '2022-05-18 02:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homebanner` tinyint(1) NOT NULL DEFAULT 0,
  `seo_title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `loc`, `banner`, `desc`, `homebanner`, `seo_title`, `seo_desc`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fresh Fruits', 'storage/category/y1fOLcfHG3UXgWfX.webp', 'storage/category/MxrWvIGSm9bs9hcA.webp', NULL, 1, NULL, NULL, 1, '2022-05-18 01:52:56', '2022-05-18 01:54:38'),
(2, 'Vegetables', 'storage/category/5dJb7MMoFWPbFiF1.webp', 'storage/category/qn5lyux5DuJk1G2K.webp', NULL, 1, NULL, NULL, 1, '2022-05-18 01:52:56', '2022-05-18 01:55:16'),
(3, 'Cuts & Sprouts', 'storage/category/qywuFbfSxG8xn0O3.webp', 'storage/category/A8rP3JtnSb7Y1XjX.webp', NULL, 0, NULL, NULL, 1, '2022-05-18 01:52:56', '2022-05-18 01:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_interactions`
--

CREATE TABLE `customer_interactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_interactions`
--

INSERT INTO `customer_interactions` (`id`, `type`, `uid`, `data`, `created_at`, `updated_at`) VALUES
(1, 'prodview', 1, '4', '2022-05-18 02:47:27', '2022-05-18 02:47:27'),
(2, 'prodview', 1, '5', '2022-05-18 02:47:27', '2022-05-18 02:47:27'),
(3, 'prodview', 1, '6', '2022-05-18 02:47:27', '2022-05-18 02:47:27'),
(4, 'prodview', 1, '11', '2022-05-18 02:47:28', '2022-05-18 02:47:28'),
(5, 'prodview', 1, '12', '2022-05-18 02:47:29', '2022-05-18 02:47:29'),
(6, 'prodview', 1, '9', '2022-05-18 02:47:31', '2022-05-18 02:47:31'),
(7, 'prodview', 1, '9', '2022-05-18 02:47:31', '2022-05-18 02:47:31'),
(8, 'prodview', 1, '10', '2022-05-18 02:47:31', '2022-05-18 02:47:31'),
(9, 'prodview', 1, '13', '2022-05-18 02:47:34', '2022-05-18 02:47:34'),
(10, 'prodview', 1, '1', '2022-05-18 02:47:45', '2022-05-18 02:47:45'),
(11, 'prodview', 1, '2', '2022-05-18 02:47:46', '2022-05-18 02:47:46'),
(12, 'prodview', 1, '3', '2022-05-18 02:47:46', '2022-05-18 02:47:46'),
(13, 'prodview', 1, '4', '2022-05-18 02:47:47', '2022-05-18 02:47:47'),
(14, 'prodview', 1, '5', '2022-05-18 02:47:47', '2022-05-18 02:47:47'),
(15, 'prodview', 1, '6', '2022-05-18 02:47:48', '2022-05-18 02:47:48'),
(16, 'prodview', 1, '9', '2022-05-18 02:47:54', '2022-05-18 02:47:54'),
(17, 'prodview', 1, '10', '2022-05-18 02:47:54', '2022-05-18 02:47:54'),
(18, 'prodview', 1, '11', '2022-05-18 02:47:55', '2022-05-18 02:47:55'),
(19, 'prodview', 1, '12', '2022-05-18 02:47:55', '2022-05-18 02:47:55'),
(20, 'prodview', 1, '13', '2022-05-18 02:47:55', '2022-05-18 02:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `customer_product_views`
--

CREATE TABLE `customer_product_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_m_s`
--

CREATE TABLE `c_m_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `c_m_s`
--

INSERT INTO `c_m_s` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'footer', 'Footer', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(2, 'tandc', 'Terms And Condition', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(3, 'shipping', 'Shipping Policy', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(4, 'refund', 'Refund Policy', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(5, 'privacy', 'Privacy policy', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(6, 'aboutus', 'About Us', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(7, 'faq', 'FAQ', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(8, 'return', 'Return Policy', '2022-05-18 01:50:37', '2022-05-18 01:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discounttype` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appliesfor` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `appliesfordata` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optid` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minreqtype` smallint(6) NOT NULL DEFAULT 0,
  `minreqvalue` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minreqdata` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enddate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loggers`
--

CREATE TABLE `loggers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modid` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `uid` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `type` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `page` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newdata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`newdata`)),
  `olddata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`olddata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loggers`
--

INSERT INTO `loggers` (`id`, `modid`, `uid`, `type`, `page`, `newdata`, `olddata`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 'Category', '{\"loc\":\"storage\\/category\\/y1fOLcfHG3UXgWfX.webp\",\"banner\":\"storage\\/category\\/MxrWvIGSm9bs9hcA.webp\",\"homebanner\":\"1\",\"status\":1,\"updated_at\":\"2022-05-18 07:24:38\"}', '{\"id\":1,\"name\":\"Fresh Fruits\",\"loc\":\"storage\\/category\\/y1fOLcfHG3UXgWfX.webp\",\"banner\":\"storage\\/category\\/MxrWvIGSm9bs9hcA.webp\",\"desc\":null,\"homebanner\":\"1\",\"seo_title\":null,\"seo_desc\":null,\"status\":1,\"created_at\":\"2022-05-18T01:52:56.000000Z\",\"updated_at\":\"2022-05-18T01:54:38.000000Z\"}', '2022-05-18 01:54:38', '2022-05-18 01:54:38'),
(2, 0, 1, 1, 'Category', '{\"loc\":\"storage\\/category\\/5dJb7MMoFWPbFiF1.webp\",\"banner\":\"storage\\/category\\/qn5lyux5DuJk1G2K.webp\",\"homebanner\":\"1\",\"status\":1,\"updated_at\":\"2022-05-18 07:25:16\"}', '{\"id\":2,\"name\":\"Vegetables\",\"loc\":\"storage\\/category\\/5dJb7MMoFWPbFiF1.webp\",\"banner\":\"storage\\/category\\/qn5lyux5DuJk1G2K.webp\",\"desc\":null,\"homebanner\":\"1\",\"seo_title\":null,\"seo_desc\":null,\"status\":1,\"created_at\":\"2022-05-18T01:52:56.000000Z\",\"updated_at\":\"2022-05-18T01:55:16.000000Z\"}', '2022-05-18 01:55:16', '2022-05-18 01:55:16'),
(3, 0, 1, 1, 'Category', '{\"loc\":\"storage\\/category\\/qywuFbfSxG8xn0O3.webp\",\"banner\":\"storage\\/category\\/A8rP3JtnSb7Y1XjX.webp\",\"status\":1,\"updated_at\":\"2022-05-18 07:25:50\"}', '{\"id\":3,\"name\":\"Cuts & Sprouts\",\"loc\":\"storage\\/category\\/qywuFbfSxG8xn0O3.webp\",\"banner\":\"storage\\/category\\/A8rP3JtnSb7Y1XjX.webp\",\"desc\":null,\"homebanner\":0,\"seo_title\":null,\"seo_desc\":null,\"status\":1,\"created_at\":\"2022-05-18T01:52:56.000000Z\",\"updated_at\":\"2022-05-18T01:55:50.000000Z\"}', '2022-05-18 01:55:50', '2022-05-18 01:55:50'),
(4, 0, 1, 0, 'Attribute', '{\"name\":\"Benefits\",\"updated_at\":\"2022-05-18T01:56:09.000000Z\",\"created_at\":\"2022-05-18T01:56:09.000000Z\",\"id\":1}', NULL, '2022-05-18 01:56:09', '2022-05-18 01:56:09'),
(5, 0, 1, 0, 'Attribute', '{\"name\":\"Storage and Uses\",\"updated_at\":\"2022-05-18T01:56:15.000000Z\",\"created_at\":\"2022-05-18T01:56:15.000000Z\",\"id\":2}', NULL, '2022-05-18 01:56:16', '2022-05-18 01:56:16'),
(6, 0, 1, 0, 'Attribute', '{\"name\":\"Other Product Info\",\"updated_at\":\"2022-05-18T01:56:21.000000Z\",\"created_at\":\"2022-05-18T01:56:21.000000Z\",\"id\":3}', NULL, '2022-05-18 01:56:21', '2022-05-18 01:56:21'),
(7, 0, 1, 1, 'Products', '{\"urlslug\":\"Pumpkin-Green-Cut-500-g\",\"attribute\":\"[]\",\"tags\":\"[\\\"Vegetable\\\"]\",\"fprice\":\"63.49\",\"margin\":\"5.5\",\"profit\":\"3.490000000000002\",\"disid\":-1,\"disp\":\"10\",\"disa\":\"6.35\",\"taxa\":\"2.86\",\"actualprice\":\"60\",\"fpricebefdis\":\"63.49\",\"fpricewtas\":\"60\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:33:57\"}', '{\"id\":1,\"bid\":\"0\",\"cid\":\"3\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Pumpkin Green Cut 500 g\",\"urlslug\":\"Pumpkin-Green-Cut-500-g\",\"shortdesc\":\"<ul><li>Fresho brings to you cut pumpkin green with creamish to yellow flesh and flat, edible seeds ( pepitas) inside that are tender and mildly sweet.<\\/li><\\/ul>\",\"desc\":\"<ul><li>Pumpkins are rich in fiber. So, it keeps the tummy full and causes less apetite.<\\/li><li>Pumpkin seeds contain seratonin, that helps to relax and promote better sleep.<\\/li><li>They are good for male sexual health.<\\/li><li>A cup of cubed pumpkin has twice the daily vitamin A requirement which is essential for good vision.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"Vegetable\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"60\",\"fprice\":\"63.49\",\"margin\":\"5.5\",\"profit\":\"3.490000000000002\",\"disid\":-1,\"disp\":\"10\",\"disa\":\"6.35\",\"taxp\":\"5\",\"taxa\":\"2.86\",\"actualprice\":\"60\",\"fpricebefdis\":\"63.49\",\"fpricewtas\":\"60\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:03:57.000000Z\"}', '2022-05-18 02:03:57', '2022-05-18 02:03:57'),
(8, 0, 1, 1, 'Products', '{\"urlslug\":\"Ash-Gourd-Cut-250-g\",\"attribute\":\"[]\",\"tags\":\"[\\\"\\\",\\\"Vegetable\\\"]\",\"fprice\":\"38.1\",\"margin\":\"-5\",\"profit\":\"-1.8999999999999986\",\"taxa\":\"1.91\",\"actualprice\":\"40\",\"fpricebefdis\":\"38.1\",\"fpricewtas\":\"40\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:34:39\"}', '{\"id\":2,\"bid\":\"0\",\"cid\":\"3\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Ash Gourd Cut 250 g\",\"urlslug\":\"Ash-Gourd-Cut-250-g\",\"shortdesc\":\"<ul><li>Our uniformly and perfectly cut fresh ash gourds comes with a mild and soft texture.<\\/li><li>No more messy hands!<\\/li><\\/ul><p><br><\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\",\"Vegetable\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"40\",\"fprice\":\"38.1\",\"margin\":\"-5\",\"profit\":\"-1.8999999999999986\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"5\",\"taxa\":\"1.91\",\"actualprice\":\"40\",\"fpricebefdis\":\"38.1\",\"fpricewtas\":\"40\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:04:39.000000Z\"}', '2022-05-18 02:04:39', '2022-05-18 02:04:39'),
(9, 0, 1, 1, 'Products', '{\"urlslug\":\"Yam-Cut-250g\",\"attribute\":\"[]\",\"fprice\":\"23.64\",\"margin\":\"-18.4\",\"profit\":\"-4.359999999999999\",\"taxa\":\"2.36\",\"actualprice\":\"26\",\"fpricebefdis\":\"23.64\",\"fpricewtas\":\"26\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:35:29\"}', '{\"id\":3,\"bid\":\"0\",\"cid\":\"3\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Yam Cut 250g\",\"urlslug\":\"Yam-Cut-250g\",\"shortdesc\":\"<p><br><\\/p><ul><li>Now, cooking is easy with cut Yams that have a starchy and crunchy texture. do not fret about messy hands and labour time anymore!<\\/li><li>Do not forget to check out our delicious recipe:-&nbsp;<a href=\\\"https:\\/\\/www.bigbasket.com\\/cookbook\\/recipes\\/1099\\/suran-koftas\\/\\/\\\" rel=\\\"noopener noreferrer\\\" target=\\\"_blank\\\" style=\\\"color: inherit;\\\"><strong>https:\\/\\/www.bigbasket.com\\/cookbook\\/recipes\\/1099\\/suran-koftas\\/<\\/strong><\\/a><\\/li><\\/ul><p><br><\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"28\",\"fprice\":\"23.64\",\"margin\":\"-18.4\",\"profit\":\"-4.359999999999999\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"10\",\"taxa\":\"2.36\",\"actualprice\":\"26\",\"fpricebefdis\":\"23.64\",\"fpricewtas\":\"26\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:05:29.000000Z\"}', '2022-05-18 02:05:29', '2022-05-18 02:05:29'),
(10, 0, 1, 1, 'Products', '{\"urlslug\":\"Green-Peas-500-g\",\"attribute\":\"[]\",\"fprice\":\"85.71\",\"margin\":\"47.5\",\"profit\":\"40.709999999999994\",\"taxa\":\"4.29\",\"actualprice\":\"90\",\"fpricebefdis\":\"85.71\",\"fpricewtas\":\"90\",\"updated_at\":\"2022-05-18 07:35:51\"}', '{\"id\":4,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Green Peas 500 g\",\"urlslug\":\"Green-Peas-500-g\",\"shortdesc\":\"<p>Green peas are small, spherical and greenish in colour with a crunchy texture and sweet flavour.<\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"45\",\"fprice\":\"85.71\",\"margin\":\"47.5\",\"profit\":\"40.709999999999994\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"5\",\"taxa\":\"4.29\",\"actualprice\":\"90\",\"fpricebefdis\":\"85.71\",\"fpricewtas\":\"90\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"0\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:05:51.000000Z\"}', '2022-05-18 02:05:51', '2022-05-18 02:05:51'),
(11, 0, 1, 1, 'Products', '{\"profit\":\"40.709999999999994\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:37:10\"}', '{\"id\":4,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Green Peas 500 g\",\"urlslug\":\"Green-Peas-500-g\",\"shortdesc\":\"<p>Green peas are small, spherical and greenish in colour with a crunchy texture and sweet flavour.<\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"45\",\"fprice\":\"85.71\",\"margin\":\"47.5\",\"profit\":\"40.709999999999994\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"5\",\"taxa\":\"4.29\",\"actualprice\":\"90\",\"fpricebefdis\":\"85.71\",\"fpricewtas\":\"90\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:07:10.000000Z\"}', '2022-05-18 02:07:10', '2022-05-18 02:07:10'),
(12, 0, 1, 1, 'Products', '{\"urlslug\":\"Potato-New-Crop-1-kg\",\"attribute\":\"[]\",\"fprice\":\"36.19\",\"margin\":\"-7.8\",\"profit\":\"-2.8100000000000023\",\"taxa\":\"1.81\",\"actualprice\":\"38\",\"fpricebefdis\":\"36.19\",\"fpricewtas\":\"38\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:37:39\"}', '{\"id\":5,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Potato New Crop 1 kg\",\"urlslug\":\"Potato-New-Crop-1-kg\",\"shortdesc\":null,\"desc\":\"<p>New Potatoes: If you are looking for soft, slightly sweet but creamy-textured potatoes. These are a special variant early harvest of potatoes (not to be confused with our regular Fresho Potato) and are easily distinguishable with their thin\\/ tender skin which makes them easy-to-peel off even it can be used without peeling. These freshly picked potatoes are a great choice for roasting or boiling. They give essential nutrients to your body along with high dietary fibre and carbohydrates. Combined with great taste and nutrients this vegetable is the most popular and loved amongst households. Fresho New potatoes are either Round or Oblong which is about 45mm-65 mm in diameter. Consume them within a few days of purchase. Click here for delicious vegetable recipes - https:\\/\\/www.bigbasket.com\\/flavors\\/collections\\/227\\/fresh-vegetables\\/<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"39\",\"fprice\":\"36.19\",\"margin\":\"-7.8\",\"profit\":\"-2.8100000000000023\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"5\",\"taxa\":\"1.81\",\"actualprice\":\"38\",\"fpricebefdis\":\"36.19\",\"fpricewtas\":\"38\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:07:39.000000Z\"}', '2022-05-18 02:07:39', '2022-05-18 02:07:39'),
(13, 0, 1, 1, 'Products', '{\"urlslug\":\"Cucumber-English-500-g\",\"attribute\":\"[]\",\"fprice\":\"19.05\",\"margin\":\"-5\",\"profit\":\"-0.9499999999999993\",\"taxa\":\"0.95\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.05\",\"fpricewtas\":\"20\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:38:11\"}', '{\"id\":6,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Cucumber English 500 g\",\"urlslug\":\"Cucumber-English-500-g\",\"shortdesc\":\"<p>English cucumber is a variety of seedless cucumber that is longer and slimmer than other varieties and have a higher water content. They do not have a layer of wax on them, and the skin is tender when ripe.<\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"20\",\"fprice\":\"19.05\",\"margin\":\"-5\",\"profit\":\"-0.9499999999999993\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"5\",\"taxa\":\"0.95\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.05\",\"fpricewtas\":\"20\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:08:11.000000Z\"}', '2022-05-18 02:08:11', '2022-05-18 02:08:11'),
(14, 0, 1, 1, 'Products', '{\"urlslug\":\"Sweet-Corn-2-pcs\",\"attribute\":\"[]\",\"fprice\":\"40\",\"margin\":\"0\",\"profit\":\"0\",\"taxa\":\"2\",\"actualprice\":\"42\",\"fpricebefdis\":\"40\",\"fpricewtas\":\"42\",\"updated_at\":\"2022-05-18 07:38:39\"}', '{\"id\":7,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Sweet Corn 2 pcs\",\"urlslug\":\"Sweet-Corn-2-pcs\",\"shortdesc\":\"<p>Wrapped in lime coloured husks with silk, sweet corn contains numerous yellow succulent kernels that have a starchy and doughy consistency. The skin pops out as you bite into it.<\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"40\",\"fprice\":\"40\",\"margin\":\"0\",\"profit\":\"0\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"5\",\"taxa\":\"2\",\"actualprice\":\"42\",\"fpricebefdis\":\"40\",\"fpricewtas\":\"42\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"0\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:08:39.000000Z\"}', '2022-05-18 02:08:39', '2022-05-18 02:08:39'),
(15, 0, 1, 1, 'Products', '{\"urlslug\":\"Banana-Red-500-g\",\"attribute\":\"[]\",\"tags\":\"[\\\"\\\",\\\"Fruit\\\"]\",\"fprice\":\"38.1\",\"margin\":\"-5\",\"profit\":\"-1.8999999999999986\",\"taxa\":\"1.91\",\"actualprice\":\"40\",\"fpricebefdis\":\"38.1\",\"fpricewtas\":\"40\",\"updated_at\":\"2022-05-18 07:41:02\"}', '{\"id\":8,\"bid\":\"0\",\"cid\":\"1\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Banana Red 500 g\",\"urlslug\":\"Banana-Red-500-g\",\"shortdesc\":\"<ul><li>Standing apart from the common varieties of yellow bananas, Red bananas are short, plump and reddish-purple in colour.<\\/li><li>Even the flesh is light pink and sweeter compared to other varieties. They are high in nutrients and are freshly procured from the farmers.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\",\"Fruit\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"40\",\"fprice\":\"38.1\",\"margin\":\"-5\",\"profit\":\"-1.8999999999999986\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"5\",\"taxa\":\"1.91\",\"actualprice\":\"40\",\"fpricebefdis\":\"38.1\",\"fpricewtas\":\"40\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"0\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:11:02.000000Z\"}', '2022-05-18 02:11:02', '2022-05-18 02:11:02'),
(16, 0, 1, 1, 'Products', '{\"urlslug\":\"Pomegranate-Small-1-kg\",\"attribute\":\"[]\",\"fprice\":\"184.4\",\"margin\":\"-19.3\",\"profit\":\"-35.599999999999994\",\"taxa\":\"16.6\",\"actualprice\":\"201\",\"fpricebefdis\":\"184.4\",\"fpricewtas\":\"201\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:41:30\"}', '{\"id\":9,\"bid\":\"0\",\"cid\":\"1\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Pomegranate Small 1 kg\",\"urlslug\":\"Pomegranate-Small-1-kg\",\"shortdesc\":\"<ul><li>With ruby color and an intense floral, sweet-tart flavor, the pomegranate delivers both taste and beauty.<\\/li><li>You can remove the skin and the membranes to get at the delicious fruit with nutty seeds.<\\/li><li>Fresho Pomegranates are finely sorted and graded to deliver the best tasting pomegranates to you.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"220\",\"fprice\":\"184.4\",\"margin\":\"-19.3\",\"profit\":\"-35.599999999999994\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"9\",\"taxa\":\"16.6\",\"actualprice\":\"201\",\"fpricebefdis\":\"184.4\",\"fpricewtas\":\"201\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:11:30.000000Z\"}', '2022-05-18 02:11:30', '2022-05-18 02:11:30'),
(17, 0, 1, 1, 'Products', '{\"urlslug\":\"Blueberry-125-g\",\"attribute\":\"[]\",\"fprice\":\"314.29\",\"margin\":\"-11.4\",\"profit\":\"-35.70999999999998\",\"taxa\":\"15.71\",\"actualprice\":\"330\",\"fpricebefdis\":\"314.29\",\"fpricewtas\":\"330\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:41:42\"}', '{\"id\":10,\"bid\":\"0\",\"cid\":\"1\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Blueberry 125 g\",\"urlslug\":\"Blueberry-125-g\",\"shortdesc\":\"<p>Plump, smooth-skinned and indigo coloured perfect little globes of juicy berries have mostly sweet and slightly tart flavour. We have imported this fine quality, delicious tasting variety of blueberries.<\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"350\",\"fprice\":\"314.29\",\"margin\":\"-11.4\",\"profit\":\"-35.70999999999998\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"5\",\"taxa\":\"15.71\",\"actualprice\":\"330\",\"fpricebefdis\":\"314.29\",\"fpricewtas\":\"330\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:11:42.000000Z\"}', '2022-05-18 02:11:42', '2022-05-18 02:11:42'),
(18, 0, 1, 1, 'Products', '{\"urlslug\":\"Combo---Fresh-Vegg\",\"attribute\":\"[]\",\"fprice\":\"416.5\",\"margin\":\"-6.8\",\"profit\":\"-28.5\",\"taxa\":\"12.5\",\"actualprice\":\"429\",\"fpricebefdis\":\"416.5\",\"fpricewtas\":\"429\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:41:54\"}', '{\"id\":11,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Combo - Fresh Vegg\",\"urlslug\":\"Combo---Fresh-Vegg\",\"shortdesc\":\"<p>Organic Food &amp; Fruit,&nbsp;<em>Vegetables<\\/em>&nbsp;\\u00b7 Drag &amp; Drop Sections ready \\u00b7 Mega Store for grocery and fresh&nbsp;<em>vegetables<\\/em>.<\\/p>\",\"desc\":\"<p>Eating vegetables&nbsp;<strong>provides health benefits<\\/strong>&nbsp;\\u2013 people who eat more vegetables and fruits as part of an overall healthy diet are likely to have a reduced risk of some chronic diseases. Vegetables provide nutrients vital for health and maintenance of your body. Most vegetables are naturally low in fat and calories.<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"445\",\"fprice\":\"416.5\",\"margin\":\"-6.8\",\"profit\":\"-28.5\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"3\",\"taxa\":\"12.5\",\"actualprice\":\"429\",\"fpricebefdis\":\"416.5\",\"fpricewtas\":\"429\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"-24\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:11:54.000000Z\"}', '2022-05-18 02:11:54', '2022-05-18 02:11:54'),
(19, 0, 1, 1, 'Products', '{\"urlslug\":\"Combo-Farm-Frozen\",\"attribute\":\"[]\",\"fprice\":\"411.76\",\"margin\":\"-6.9\",\"profit\":\"-28.24000000000001\",\"taxa\":\"8.24\",\"actualprice\":\"420\",\"fpricebefdis\":\"411.76\",\"fpricewtas\":\"420\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:42:03\"}', '{\"id\":12,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Combo Farm Frozen\",\"urlslug\":\"Combo-Farm-Frozen\",\"shortdesc\":\"<p>Buy&nbsp;<em>Frozen Foods<\\/em>&nbsp;online at best price from Farm63 Store. Choose&nbsp;<em>Frozen Food<\\/em>&nbsp;for best quality frozen products like frozen vegetables<\\/p>\",\"desc\":\"<p>Frozen vegetables are vegetables that have had their temperature reduced and maintained to below their freezing point for the purpose of storage and transportation until they are ready to be eaten. They may be commercially packaged or frozen at home. A wide range of frozen vegetables are sold in supermarkets<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"440\",\"fprice\":\"411.76\",\"margin\":\"-6.9\",\"profit\":\"-28.24000000000001\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"8.24\",\"actualprice\":\"420\",\"fpricebefdis\":\"411.76\",\"fpricewtas\":\"420\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"-1\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:12:03.000000Z\"}', '2022-05-18 02:12:03', '2022-05-18 02:12:03'),
(20, 0, 1, 1, 'Products', '{\"urlslug\":\"Combo-Farm-Fruity\",\"attribute\":\"[]\",\"tags\":\"[\\\"\\\",\\\"Vegetable\\\"]\",\"fprice\":\"245.1\",\"margin\":\"0.4\",\"profit\":\"1.0999999999999943\",\"taxa\":\"4.9\",\"actualprice\":\"250\",\"fpricebefdis\":\"245.1\",\"fpricewtas\":\"250\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:42:19\"}', '{\"id\":13,\"bid\":\"0\",\"cid\":\"1\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Combo Farm Fruity\",\"urlslug\":\"Combo-Farm-Fruity\",\"shortdesc\":\"<p>Buy farm&nbsp;<em>fresh fruits<\\/em>&nbsp;and vegetables online at the best prices. Order your favourite fruits and vegetables at bigbasket, the online Farm63 store<\\/p>\",\"desc\":\"<p>Fruits are&nbsp;<strong>an excellent source of essential vitamins and minerals, and they are high in fiber<\\/strong>. Fruits also provide a wide range of health-boosting antioxidants, including flavonoids. Eating a diet high in fruits and vegetables can reduce a person\'s risk of developing heart disease, cancer, inflammation, and diabetes.<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\",\"Vegetable\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":\"1\",\"oosc\":\"1\",\"da\":0,\"cpi\":\"244\",\"fprice\":\"245.1\",\"margin\":\"0.4\",\"profit\":\"1.0999999999999943\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"4.9\",\"actualprice\":\"250\",\"fpricebefdis\":\"245.1\",\"fpricewtas\":\"250\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"3\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:12:19.000000Z\"}', '2022-05-18 02:12:19', '2022-05-18 02:12:19'),
(21, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Sambar-Onion---Peeled-(Small-Onion),-500g\",\"attribute\":\"[]\",\"fprice\":\"39.22\",\"margin\":\"-2\",\"profit\":\"-0.7800000000000011\",\"taxa\":\"0.78\",\"actualprice\":\"40\",\"fpricebefdis\":\"39.22\",\"fpricewtas\":\"40\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:43:47\"}', '{\"id\":14,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Fresho Sambar Onion - Peeled (Small Onion), 500g\",\"urlslug\":\"Fresho-Sambar-Onion---Peeled-(Small-Onion),-500g\",\"shortdesc\":\"<ul><li>Also known as button onions, Sambar Onions are relatively smaller onions with mild flavour and slightly sweet taste.<\\/li><li>Fresho delivers at your doorstep freshly peeled sambar onions, making your preparations much easier and quicker because we value your time!<\\/li><\\/ul><p><br><\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"40\",\"fprice\":\"39.22\",\"margin\":\"-2\",\"profit\":\"-0.7800000000000011\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.78\",\"actualprice\":\"40\",\"fpricebefdis\":\"39.22\",\"fpricewtas\":\"40\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:13:47.000000Z\"}', '2022-05-18 02:13:47', '2022-05-18 02:13:47'),
(22, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Tomato-1-Kg\",\"attribute\":\"[]\",\"fprice\":\"68.63\",\"margin\":\"-2\",\"profit\":\"-1.3700000000000045\",\"taxa\":\"1.37\",\"actualprice\":\"70\",\"fpricebefdis\":\"68.63\",\"fpricewtas\":\"70\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:44:04\"}', '{\"id\":16,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Tomato 1 Kg\",\"urlslug\":\"Fresho-Tomato-1-Kg\",\"shortdesc\":\"<p>Tomato Hybrids are high-quality fruits compared to desi, local tomatoes. They contain numerous edible seeds and are red in colour due to lycopene, an anti-oxidant.<\\/p>\",\"desc\":\"<ul><li>Tomatoes contain Vitamin C,K. lycopene, an antioxidant that reduces the risk of cancer and heart-diseases. They protect the eyes from light induced damage.<\\/li><li>Essential for pregnant women as these tomatoes protect infants against neural tube defects.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"70\",\"fprice\":\"68.63\",\"margin\":\"-2\",\"profit\":\"-1.3700000000000045\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"1.37\",\"actualprice\":\"70\",\"fpricebefdis\":\"68.63\",\"fpricewtas\":\"70\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:14:04.000000Z\"}', '2022-05-18 02:14:04', '2022-05-18 02:14:04'),
(23, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Big-Onion,-1-kg\",\"attribute\":\"[]\",\"fprice\":\"19.61\",\"margin\":\"-2\",\"profit\":\"-0.39000000000000057\",\"taxa\":\"0.39\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.61\",\"fpricewtas\":\"20\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:45:08\"}', '{\"id\":15,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Big Onion, 1 kg\",\"urlslug\":\"Fresho-Big-Onion,-1-kg\",\"shortdesc\":\"<ul><li>Onions are known to be rich in biotin. Most of the flavonoids which are known as anti-oxidants are concentrated more in the outer layers, so when you peel off the layers, you should remove as little as possible.<\\/li><li>Onion can fill your kitchen with a thick spicy aroma. It is a common base vegetable in most Indian dishes, thanks to the wonderful flavor that it adds to any dish.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>If a piece of onion is inhaled, it can slow down or stop nose bleeding.<\\/li><li>Those who have sleeping disorders or insomnia can have a good night sleep if they have an onion every day.<\\/li><li>Onions are known to have antiseptic, antimicrobial and antibiotic properties which help you to get rid of infections.<\\/li><li>Onions are high in sulphur, vitamin B6 and B9. It has high quantities of water and naturally low in fat. It is high in phytochemical compounds.<\\/li><li>Onions are known to contain manganese, copper, Vitamin B6, Vitamin C, Folic acid, Amino acid and dietary fibers along with phosphorus, folate and copper<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"20\",\"fprice\":\"19.61\",\"margin\":\"-2\",\"profit\":\"-0.39000000000000057\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.39\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.61\",\"fpricewtas\":\"20\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:15:08.000000Z\"}', '2022-05-18 02:15:08', '2022-05-18 02:15:08'),
(24, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Potato,-1-kg\",\"attribute\":\"[]\",\"fprice\":\"43.14\",\"margin\":\"-2\",\"profit\":\"-0.8599999999999994\",\"taxa\":\"0.86\",\"actualprice\":\"44\",\"fpricebefdis\":\"43.14\",\"fpricewtas\":\"44\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:45:39\"}', '{\"id\":17,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Potato, 1 kg\",\"urlslug\":\"Fresho-Potato,-1-kg\",\"shortdesc\":\"<p>These small baby potatoes are a sweeter variety than normal ones and come with a creamy off white interior. Baby potato is a starchy vegetable that adds thickness to recipes and blends well with other vegetables.<\\/p>\",\"desc\":\"<ul><li>Potatoes should always be stored in a cool, dark and dry place that is preferably in your visibility.<\\/li><li>But if not attended to for a long time these potatoes will begin to sprout due to preferable envIronment conditions and end up loosing nutritional value.<\\/li><li>Refrigeration adversely affects the flavour of potatoes, therefore it is best to store them in paper bags.<\\/li><li>Remember, plastic bags promote moisture and speed decay process.<\\/li><li>Baby potatoes have almost all the uses of a normal potato but one advantage is that they can be peeled and put as a whole without the burden of cutting due to their small size.<\\/li><li>Can be roasted, boiled, stir-fried, sauteed, and put in various chilled salads, pastas and curries like dum aaloo.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"44\",\"fprice\":\"43.14\",\"margin\":\"-2\",\"profit\":\"-0.8599999999999994\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.86\",\"actualprice\":\"44\",\"fpricebefdis\":\"43.14\",\"fpricewtas\":\"44\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:15:39.000000Z\"}', '2022-05-18 02:15:39', '2022-05-18 02:15:39'),
(25, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Beetroot---Organically-Grown,-500-g\",\"attribute\":\"[]\",\"fprice\":\"14.71\",\"margin\":\"-2\",\"profit\":\"-0.28999999999999915\",\"actualprice\":\"15\",\"fpricebefdis\":\"14.71\",\"fpricewtas\":\"15\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:46:17\"}', '{\"id\":18,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Beetroot - Organically Grown, 500 g\",\"urlslug\":\"Fresho-Beetroot---Organically-Grown,-500-g\",\"shortdesc\":\"<p>Fresho Organic products are organically grown and handpicked by expert. <\\/p><p> Product image shown is for representation purpose only, the actually product may vary based on season, produce &amp; availability. <\\/p>\",\"desc\":\"<ul><li>Red beets lower blood pressure, promotes brain and heart health.<\\/li><li>It fights inflammation and boosts energy levels<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"15\",\"fprice\":\"14.71\",\"margin\":\"-2\",\"profit\":\"-0.28999999999999915\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.29\",\"actualprice\":\"15\",\"fpricebefdis\":\"14.71\",\"fpricewtas\":\"15\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:16:17.000000Z\"}', '2022-05-18 02:16:17', '2022-05-18 02:16:17'),
(26, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Beans---Organically-Grown,-1\\/2-g\",\"attribute\":\"[]\",\"fprice\":\"79.61\",\"margin\":\"-4.3\",\"profit\":\"-3.3900000000000006\",\"taxa\":\"2.39\",\"actualprice\":\"82\",\"fpricebefdis\":\"79.61\",\"fpricewtas\":\"82\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:47:06\"}', '{\"id\":19,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Beans - Organically Grown, 1\\/2 g\",\"urlslug\":\"Fresho-Beans---Organically-Grown,-1\\/2-g\",\"shortdesc\":\"<p> French beans&nbsp;are smaller than common&nbsp;green beans&nbsp;and have a soft, velvety pod. Quite fleshy for their size, only tiny seeds inhabit these delicate pods.&nbsp;French beans&nbsp;are sweet, tender and wonderfully crispy.&nbsp;Due to naturally growing methods, they are free from chemical residues. They are used in curries, soups, stir-fry with rice, noodles and salads.<\\/p>\",\"desc\":\"<ul><li>Haricot beans are great for metabolism and regulation of the sugar level of blood.<\\/li><li>They support the adrenal regulation function and provide an excellent source of protein and fibre.<\\/li><li>A good source of many nutrients and proves to be a healthy diet.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"83\",\"fprice\":\"79.61\",\"margin\":\"-4.3\",\"profit\":\"-3.3900000000000006\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"3\",\"taxa\":\"2.39\",\"actualprice\":\"82\",\"fpricebefdis\":\"79.61\",\"fpricewtas\":\"82\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:17:06.000000Z\"}', '2022-05-18 02:17:06', '2022-05-18 02:17:06'),
(27, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Ladies-Finger,-500-g\",\"attribute\":\"[]\",\"fprice\":\"17.65\",\"margin\":\"-2\",\"profit\":\"-0.3500000000000014\",\"actualprice\":\"18\",\"fpricebefdis\":\"17.65\",\"fpricewtas\":\"18\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:47:28\"}', '{\"id\":20,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Ladies Finger, 500 g\",\"urlslug\":\"Fresho-Ladies-Finger,-500-g\",\"shortdesc\":\"<ul><li>Ladies finger is a green vegetable with a tip at the end and a lighter green head, which is inedibe and to be thrown away.<\\/li><li>It tastes mild and slightly grassy.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Refrigerate them and do not wash them until they are ready to use.<\\/li><li>Ladies fingers are used in curries, sambhar and can be fried, stuffed and cooked.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"18\",\"fprice\":\"17.65\",\"margin\":\"-2\",\"profit\":\"-0.3500000000000014\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.35\",\"actualprice\":\"18\",\"fpricebefdis\":\"17.65\",\"fpricewtas\":\"18\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:17:28.000000Z\"}', '2022-05-18 02:17:28', '2022-05-18 02:17:28'),
(28, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Brinjal---1\\/2-Kg\",\"attribute\":\"[]\",\"fprice\":\"18.63\",\"margin\":\"-7.4\",\"profit\":\"-1.370000000000001\",\"taxa\":\"0.37\",\"actualprice\":\"19\",\"fpricebefdis\":\"18.63\",\"fpricewtas\":\"19\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:48:31\"}', '{\"id\":21,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Brinjal - 1\\/2 Kg\",\"urlslug\":\"Fresho-Brinjal---1\\/2-Kg\",\"shortdesc\":\"<p>Deep purple and oval shaped bottle brinjals are glossy skinned vegetables with a white and have a soft flesh.<\\/p>\",\"desc\":\"<ul><li>Bottle brinjals are a nutritionally rich food item. They are rich in dietery fibres, Vitamin C and K, phytonutrient compounds and anti-oxidants.<\\/li><li>They help in keeping cholesterol levels in check and helps in weight loss while being excellent for controlling blood sugar levels and are also known for preventing cancer and heart diseases.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"20\",\"fprice\":\"18.63\",\"margin\":\"-7.4\",\"profit\":\"-1.370000000000001\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.37\",\"actualprice\":\"19\",\"fpricebefdis\":\"18.63\",\"fpricewtas\":\"19\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:18:31.000000Z\"}', '2022-05-18 02:18:31', '2022-05-18 02:18:31'),
(29, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Drumstick---1\\/2-Kg\",\"attribute\":\"[]\",\"fprice\":\"39.22\",\"margin\":\"-2\",\"profit\":\"-0.7800000000000011\",\"taxa\":\"0.78\",\"actualprice\":\"40\",\"fpricebefdis\":\"39.22\",\"fpricewtas\":\"40\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:48:54\"}', '{\"id\":22,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Drumstick - 1\\/2 Kg\",\"urlslug\":\"Fresho-Drumstick---1\\/2-Kg\",\"shortdesc\":\"<p>Fresho brings you perfectly cut finger length pieces of drumsticks that can be cooked and added to sambhar and curries.<\\/p>\",\"desc\":\"<ul><li>Drumsticks are rich in antioxidants that reduce the risk of heart diseases and type 2 diabetes.<\\/li><li>It is very rich in vitamin B, C and iron.<\\/li><li>It reduces inflammation, good for skin, teeth and bones.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"40\",\"fprice\":\"39.22\",\"margin\":\"-2\",\"profit\":\"-0.7800000000000011\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.78\",\"actualprice\":\"40\",\"fpricebefdis\":\"39.22\",\"fpricewtas\":\"40\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:18:54.000000Z\"}', '2022-05-18 02:18:54', '2022-05-18 02:18:54'),
(30, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Carrot-1\\/2-Kg\",\"attribute\":\"[]\",\"fprice\":\"19.61\",\"margin\":\"-2\",\"profit\":\"-0.39000000000000057\",\"taxa\":\"0.39\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.61\",\"fpricewtas\":\"20\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:49:25\"}', '{\"id\":23,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Carrot 1\\/2 Kg\",\"urlslug\":\"Fresho-Carrot-1\\/2-Kg\",\"shortdesc\":\"<ul><li>A popular sweet-tasting root vegetable, Carrots are narrow and cone shaped.<\\/li><li>They have thick, fleshy, deeply colored root, which grows underground, and feathery green leaves that emerge above the ground.<\\/li><li>While these greens are fresh tasting and slightly bitter, the carrot roots are crunchy textured with a sweet and minty aromatic taste.<\\/li><li>Fresho brings you the flavour and richness of the finest crispy and juicy carrots that are locally grown and the best of the region.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Refrigerate carrots in a mesh bag. Alternatively to retain freshness and for more longevity, trim off the greens and put whole carrots in a container of water and refrigerate.<\\/li><li>With this method, they stay nice and crunchy. If the water starts to look cloudy, change it with fresh water.<\\/li><li>Stored this way, carrots can last for even a month with no ill effects and do not wilt easily.<\\/li><li>Carrots have a mild, pleasant flavour that is great by themselves or blended with other foods.<\\/li><li>They are even good for stuffings and in making sauces.<\\/li><li>Carrot juice is said to be one of the most healthiest drink.<\\/li><li>Carrot halwa is the most popular Indian sweet made out of this vegetable.<\\/li><li>Do look up carrot jam as well.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"20\",\"fprice\":\"19.61\",\"margin\":\"-2\",\"profit\":\"-0.39000000000000057\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.39\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.61\",\"fpricewtas\":\"20\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:19:25.000000Z\"}', '2022-05-18 02:19:25', '2022-05-18 02:19:25'),
(31, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Cabbage,-1\\/2-Kg\",\"attribute\":\"[]\",\"fprice\":\"21.57\",\"margin\":\"-2\",\"profit\":\"-0.4299999999999997\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:52:03\"}', '{\"id\":28,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Cabbage, 1\\/2 Kg\",\"urlslug\":\"Fresho-Cabbage,-1\\/2-Kg\",\"shortdesc\":\"<ul><li>Cabbage improves brain health and vision. Best for people who want to lose weight in a healthy way.<\\/li><li>It detoxifies the body and contains glutamine that reduces effects of inflammation, allergies, joint pain, irritation, fever.<\\/li><li>Cabbages also help prevent cancer.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Do not cut cabbages unless you are immediately consuming as it begins to lose vitamin C when cut.<\\/li><li>If you absolutely cannot immediately finish the remaining cabbage, wrap it tightly in plastic wrap and store it in the refrigerator for up to two days.<\\/li><li>Keeping them in the refrigerator retains the crispiness of the vegetable.<\\/li><li>Shredded cabbage can be directly added to any salad and sandwiches as they are most nutritious when eaten raw. Also used in pickles and flat breads.<\\/li><li>Stew fried cabbage, onion, garlic, bell pepper and green chilies mixed with steamed rice, and soya\\/chili\\/tomato sauce is a popular favorite (Chowmein) in China and other South East Asian regions.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"22\",\"fprice\":\"21.57\",\"margin\":\"-2\",\"profit\":\"-0.4299999999999997\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:22:03.000000Z\"}', '2022-05-18 02:22:03', '2022-05-18 02:22:03'),
(32, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Cauliflower,-1\\/2-Kg\",\"attribute\":\"[]\",\"fprice\":\"24.51\",\"margin\":\"-10.2\",\"profit\":\"-2.4899999999999984\",\"taxa\":\"0.49\",\"actualprice\":\"25\",\"fpricebefdis\":\"24.51\",\"fpricewtas\":\"25\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:52:21\"}', '{\"id\":27,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Cauliflower, 1\\/2 Kg\",\"urlslug\":\"Fresho-Cauliflower,-1\\/2-Kg\",\"shortdesc\":\"<ul><li>Cauliflower is made up of tightly bound clusters of soft, crumbly, sweet cauliflower florets that form a dense head.<\\/li><li>Resembling a classic tree, the florets are attached to a central edible white trunk which is firm and tender.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>One serving of cauliflower contains 77 percent of daily recommended value of vitamin C.<\\/li><li>Cauliflowers are rich in B complex vitamins, potassium and manganese.They protect from the risk of heart diseases and brain disorders.<\\/li><li>It also contains cancer fighting nutrient called sulforaphane.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"27\",\"fprice\":\"24.51\",\"margin\":\"-10.2\",\"profit\":\"-2.4899999999999984\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.49\",\"actualprice\":\"25\",\"fpricebefdis\":\"24.51\",\"fpricewtas\":\"25\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:22:21.000000Z\"}', '2022-05-18 02:22:21', '2022-05-18 02:22:21'),
(33, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Bitter-Gourd,-1\\/2-Kg\",\"attribute\":\"[]\",\"fprice\":\"24.51\",\"margin\":\"-2\",\"profit\":\"-0.48999999999999844\",\"taxa\":\"0.49\",\"actualprice\":\"25\",\"fpricebefdis\":\"24.51\",\"fpricewtas\":\"25\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:52:58\"}', '{\"id\":26,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Bitter Gourd, 1\\/2 Kg\",\"urlslug\":\"Fresho-Bitter-Gourd,-1\\/2-Kg\",\"shortdesc\":\"<ul><li>The most bitter among all fruits, bitter gourds come with a rough, bumpy and green skin.<\\/li><li>The off-white translucent flesh tastes crispy with the combination of the bitter seeds that are present inside.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Bitter gourd helps to overcome Type-2 Diabetes and heals liver problems.<\\/li><li>It clears acne, builds immunity, eases digestion, cures constipation and helps in weight loss.<\\/li><li>It prevents cancer cells from multiplying, purifies blood and has healing qualities.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"25\",\"fprice\":\"24.51\",\"margin\":\"-2\",\"profit\":\"-0.48999999999999844\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.49\",\"actualprice\":\"25\",\"fpricebefdis\":\"24.51\",\"fpricewtas\":\"25\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:22:58.000000Z\"}', '2022-05-18 02:22:58', '2022-05-18 02:22:58');
INSERT INTO `loggers` (`id`, `modid`, `uid`, `type`, `page`, `newdata`, `olddata`, `created_at`, `updated_at`) VALUES
(34, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Baby-Corn---Peeled,-200-g\",\"attribute\":\"[]\",\"fprice\":\"45.1\",\"margin\":\"-8.6\",\"profit\":\"-3.8999999999999986\",\"taxa\":\"0.9\",\"actualprice\":\"46\",\"fpricebefdis\":\"45.1\",\"fpricewtas\":\"46\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:53:25\"}', '{\"id\":25,\"bid\":\"0\",\"cid\":\"3\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Baby Corn - Peeled, 200 g\",\"urlslug\":\"Fresho-Baby-Corn---Peeled,-200-g\",\"shortdesc\":\"<ul><li>Baby corns are small in size and handpicked before they mature.<\\/li><li>We deliver them to you fresh and peeled, so no more postponing that corn dish you wanted to make because you didn\'t get the time.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Store baby corns in loose, plastic or paper bags in the refrigerator, but not for more than 2-3 days.<\\/li><li>Baby corns have a wide variety of uses. Toss them on your pastas, vegetable soups, stir fries, manchurian and stews.<\\/li><li>They can be eaten raw and the entire tiny ear of the corn is edible.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"49\",\"fprice\":\"45.1\",\"margin\":\"-8.6\",\"profit\":\"-3.8999999999999986\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.9\",\"actualprice\":\"46\",\"fpricebefdis\":\"45.1\",\"fpricewtas\":\"46\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:23:25.000000Z\"}', '2022-05-18 02:23:25', '2022-05-18 02:23:25'),
(35, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Capsicum-1\\/2-Kg\",\"attribute\":\"[]\",\"fprice\":\"34.31\",\"margin\":\"-2\",\"profit\":\"-0.6899999999999977\",\"taxa\":\"0.69\",\"actualprice\":\"35\",\"fpricebefdis\":\"34.31\",\"fpricewtas\":\"35\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:53:46\"}', '{\"id\":24,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Capsicum 1\\/2 Kg\",\"urlslug\":\"Fresho-Capsicum-1\\/2-Kg\",\"shortdesc\":\"<ul><li>Leaving a moderately pungent taste on the tongue, Green capsicums, also known as green peppers are bell shaped, medium-sized fruit pods.<\\/li><li>They have thick and shiny skin with a fleshy texture inside.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Store them in a cool, dry place away from direct sunlight. Keep capsicums dry as moisture makes them rot faster. Refrigerate the peppers unwashed, in a plastic bag and consume within a week. Resort to refrigeration only when they cannot be consumed immediately.<\\/li><li>Green bell peppers can be used for a wide variety of dishes due to its distinct flavour and scent. Can be grilled,roasted, baked and sauteed. Widely used in salads, pastas, pizzas, pepper sauce and even for flavouring curries.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"35\",\"fprice\":\"34.31\",\"margin\":\"-2\",\"profit\":\"-0.6899999999999977\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.69\",\"actualprice\":\"35\",\"fpricebefdis\":\"34.31\",\"fpricewtas\":\"35\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:13.000000Z\",\"updated_at\":\"2022-05-18T02:23:46.000000Z\"}', '2022-05-18 02:23:46', '2022-05-18 02:23:46'),
(36, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Coccinia,-250-g\",\"attribute\":\"[]\",\"fprice\":\"6.86\",\"margin\":\"27.1\",\"profit\":\"1.8600000000000003\",\"taxa\":\"0.14\",\"actualprice\":\"7\",\"fpricebefdis\":\"6.86\",\"fpricewtas\":\"7\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:54:23\"}', '{\"id\":40,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Coccinia, 250 g\",\"urlslug\":\"Fresho-Coccinia,-250-g\",\"shortdesc\":\"<p>The flesh of Coccinia is crunchy with a mild bitter after taste but the matured ones taste even sweeter. The translucent white flesh with seeds embedded turns red on ripening. They are oval to elongated with thick and light green skin.<\\/p>\",\"desc\":\"<ul><li>Coccinia protects the nervous system and prevents kidney stones.<\\/li><li>They improve metabolism and reduce fat. It acts as an anti bacterial agent.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"5\",\"fprice\":\"6.86\",\"margin\":\"27.1\",\"profit\":\"1.8600000000000003\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.14\",\"actualprice\":\"7\",\"fpricebefdis\":\"6.86\",\"fpricewtas\":\"7\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:24:23.000000Z\"}', '2022-05-18 02:24:23', '2022-05-18 02:24:23'),
(37, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Mushrooms---Button,-1-pack-(Approx-.180g---200-g)\",\"attribute\":\"[]\",\"fprice\":\"47.06\",\"margin\":\"4.4\",\"profit\":\"2.0600000000000023\",\"taxa\":\"0.94\",\"actualprice\":\"48\",\"fpricebefdis\":\"47.06\",\"fpricewtas\":\"48\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:54:43\"}', '{\"id\":39,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Mushrooms - Button, 1 pack (Approx .180g - 200 g)\",\"urlslug\":\"Fresho-Mushrooms---Button,-1-pack-(Approx-.180g---200-g)\",\"shortdesc\":\"<p>Buttom mushrooms are very small sized mushrooms with smooth round caps and short stems. They have a mild flavour with a good texture that becomes more fragrant and meaty when cooked.<\\/p>\",\"desc\":\"<ul><li>Button mushrooms boost our immune system.<\\/li><li>They have anti-cancer benefits.<\\/li><li>They contain good amounts of riboflavin which is necessary to maintain oral health.<\\/li><li>They are very low in calories and rich in fiber.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"45\",\"fprice\":\"47.06\",\"margin\":\"4.4\",\"profit\":\"2.0600000000000023\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.94\",\"actualprice\":\"48\",\"fpricebefdis\":\"47.06\",\"fpricewtas\":\"48\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:24:43.000000Z\"}', '2022-05-18 02:24:43', '2022-05-18 02:24:43'),
(38, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Broccoli---Florets,-500-g\",\"attribute\":\"[]\",\"fprice\":\"105.88\",\"margin\":\"5.6\",\"profit\":\"5.8799999999999955\",\"taxa\":\"2.12\",\"actualprice\":\"108\",\"fpricebefdis\":\"105.88\",\"fpricewtas\":\"108\",\"updated_at\":\"2022-05-18 07:55:06\"}', '{\"id\":38,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Broccoli - Florets, 500 g\",\"urlslug\":\"Fresho-Broccoli---Florets,-500-g\",\"shortdesc\":\"<ul><li>Fresho brings to you trimmed crowns of Broccoli that are ready to be chopped for your favorite dish.<\\/li><li>Just give them a quick rinse first and then they\'re ready to be steamed or boiled.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Broccoli prevents cancer and reduces cholesteroll.<\\/li><li>They maintain bone and heart health.<\\/li><li>Broccolis are good for skin, eyes, and acts as an anti ageing factor.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"100\",\"fprice\":\"105.88\",\"margin\":\"5.6\",\"profit\":\"5.8799999999999955\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"2.12\",\"actualprice\":\"108\",\"fpricebefdis\":\"105.88\",\"fpricewtas\":\"108\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"0\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:25:06.000000Z\"}', '2022-05-18 02:25:06', '2022-05-18 02:25:06'),
(39, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Curry-Leaves,-1-Bunch\",\"attribute\":\"[]\",\"fprice\":\"9.8\",\"margin\":\"-2\",\"profit\":\"-0.1999999999999993\",\"taxa\":\"0.2\",\"actualprice\":\"10\",\"fpricebefdis\":\"9.8\",\"fpricewtas\":\"10\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:55:31\"}', '{\"id\":37,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Fresho Curry Leaves, 1 Bunch\",\"urlslug\":\"Fresho-Curry-Leaves,-1-Bunch\",\"shortdesc\":\"<ul><li>Curry leaves are an essential element of Indian cooking style where numerous of the traditional and modern recipes are imperfect without curry leaves.<\\/li><li>These are used as tasting agent in food for its different taste.With dark green and glossy appearance, curry leaves have a strong flavour and release a tasty aroma when fried in hot oil.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Curry leaves are anti-diabetic and anti-carcinogenic.<\\/li><li>They help in the better functioning of the heart. they are a good remedy for diarrhea, nausea and indigestion.<\\/li><li>Curry leaves help improve eyesight and prevents cataract.<\\/li><li>Consume 4-5 raw curry leaves in the morning with an empty stomach to fight diabetes and grey hair.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"10\",\"fprice\":\"9.8\",\"margin\":\"-2\",\"profit\":\"-0.1999999999999993\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.2\",\"actualprice\":\"10\",\"fpricebefdis\":\"9.8\",\"fpricewtas\":\"10\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:25:31.000000Z\"}', '2022-05-18 02:25:31', '2022-05-18 02:25:31'),
(40, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Coriander-Leaves,-1-Bunch\",\"attribute\":\"[]\",\"fprice\":\"9.8\",\"margin\":\"-2\",\"profit\":\"-0.1999999999999993\",\"taxa\":\"0.2\",\"actualprice\":\"10\",\"fpricebefdis\":\"9.8\",\"fpricewtas\":\"10\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:55:58\"}', '{\"id\":36,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Fresho Coriander Leaves, 1 Bunch\",\"urlslug\":\"Fresho-Coriander-Leaves,-1-Bunch\",\"shortdesc\":\"<ul><li>Coriander leaves are green, fragile with a decorative appearance. They contain minimal aroma and have a spicy sweet taste.<\\/li><li>Now do not bother wasting time cutting off the roots as we value your money and time and provide you the freshest leafy edible parts .<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Coriander leaves fight food poisoning and lower blood sugar levels.<\\/li><li>They relieve urinary tract infections and help in maintaining a healthy menstrual cycle while preventing neurological inflammations and diseases.<\\/li><li>Tip - Add coriander leaves to boiling water. Let it cool down and then consume it. Drink this water every morning to cleanse the stomach.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"10\",\"fprice\":\"9.8\",\"margin\":\"-2\",\"profit\":\"-0.1999999999999993\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.2\",\"actualprice\":\"10\",\"fpricebefdis\":\"9.8\",\"fpricewtas\":\"10\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:25:58.000000Z\"}', '2022-05-18 02:25:58', '2022-05-18 02:25:58'),
(41, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Mint-Leaves---Cleaned,-without-roots,-1-Bunch\",\"attribute\":\"[]\",\"fprice\":\"9.8\",\"margin\":\"-2\",\"profit\":\"-0.1999999999999993\",\"taxa\":\"0.2\",\"actualprice\":\"10\",\"fpricebefdis\":\"9.8\",\"fpricewtas\":\"10\",\"updated_at\":\"2022-05-18 07:56:17\"}', '{\"id\":35,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"0\",\"packingid\":\"0\",\"name\":\"Fresho Mint Leaves - Cleaned, without roots, 1 Bunch\",\"urlslug\":\"Fresho-Mint-Leaves---Cleaned,-without-roots,-1-Bunch\",\"shortdesc\":\"<ul><li>Mint leaves are tender herbs with gentle stems and have a distinct pleasant aroma, pleasing taste, cool after-sensation, and medicinal qualities.<\\/li><li>They are best used raw or added at the end of cooking in order to maintain their delicate flavor and texture.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Mint is a remedy to manage ailments related to the digestive tract, oral, respiratory and skin disorders such as acne, insect bites &amp; burns.<\\/li><li>It is found to alleviate migraine pains, minor aches, muscle sprains and cramps.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"10\",\"fprice\":\"9.8\",\"margin\":\"-2\",\"profit\":\"-0.1999999999999993\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.2\",\"actualprice\":\"10\",\"fpricebefdis\":\"9.8\",\"fpricewtas\":\"10\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"0\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:26:17.000000Z\"}', '2022-05-18 02:26:17', '2022-05-18 02:26:17'),
(42, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Chilli---Green-200-g\",\"attribute\":\"[]\",\"fprice\":\"11.76\",\"margin\":\"-27.6\",\"profit\":\"-3.24\",\"taxa\":\"0.24\",\"actualprice\":\"12\",\"fpricebefdis\":\"11.76\",\"fpricewtas\":\"12\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:56:44\"}', '{\"id\":34,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Chilli - Green 200 g\",\"urlslug\":\"Fresho-Chilli---Green-200-g\",\"shortdesc\":\"<p>Green chillis are the best kitchen ingredient to bring a dash of spiciness to recipes. The fresh flavour and sharp bite make them a must in almost all Indian dishes. This particular green chilli variety is big.<\\/p>\",\"desc\":\"<p>Wash and dry them. Gently pull out the top stem. Throw out the spoilt ones as the famous saying goes- \\\"one rotten spoils the whole pack\\\", in this context quite literally. Keep them in a container and refrigerate. <\\/p><p> Chillies have a wide variety of uses since it is a popular spice and seasoning. Can even be powdered to flavour the food. Used to prepare chutneys and other snacks. <\\/p><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"15\",\"fprice\":\"11.76\",\"margin\":\"-27.6\",\"profit\":\"-3.24\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.24\",\"actualprice\":\"12\",\"fpricebefdis\":\"11.76\",\"fpricewtas\":\"12\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:26:44.000000Z\"}', '2022-05-18 02:26:44', '2022-05-18 02:26:44'),
(43, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Amla,-200-g\",\"attribute\":\"[]\",\"fprice\":\"19.61\",\"margin\":\"-2\",\"profit\":\"-0.39000000000000057\",\"taxa\":\"0.39\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.61\",\"fpricewtas\":\"20\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:57:19\"}', '{\"id\":33,\"bid\":\"0\",\"cid\":\"1\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Amla, 200 g\",\"urlslug\":\"Fresho-Amla,-200-g\",\"shortdesc\":\"<p>Fresho Amla or Indian gooseberry is a popular seller at bigbasket because it is full of nutrition and is quite tasty too. Used for centuries for ayurvedic benefits, the Amla is also a staple in various kinds of dips and chutneys. Being a versatile ingredient, it is used in more than one ways.<\\/p>\",\"desc\":\"<p>The nutritional benefits of Amla include being rich in vitamin C, A and other similar ingredients, which help boost eye sight. They also cleanse the stomach and provide you with antioxidant benefits that help to keep the skin younger for a longer time and fights illnesses like cancer.<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"20\",\"fprice\":\"19.61\",\"margin\":\"-2\",\"profit\":\"-0.39000000000000057\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.39\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.61\",\"fpricewtas\":\"20\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:27:19.000000Z\"}', '2022-05-18 02:27:19', '2022-05-18 02:27:19'),
(44, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Lemon,-200-g\",\"attribute\":\"[]\",\"fprice\":\"11.76\",\"margin\":\"15\",\"profit\":\"1.7599999999999998\",\"taxa\":\"0.24\",\"actualprice\":\"12\",\"fpricebefdis\":\"11.76\",\"fpricewtas\":\"12\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:57:43\"}', '{\"id\":32,\"bid\":\"0\",\"cid\":\"1\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Lemon, 200 g\",\"urlslug\":\"Fresho-Lemon,-200-g\",\"shortdesc\":\"<p>With a segmented flesh that has a unique pleasant aroma and a strong sour taste, lemons are round\\/oval and have a yellow, texturized external peel.<\\/p>\",\"desc\":\"<p>Refrigerate them in a sealed plastic bag.<\\/p><p>Fresh lemon juice is squeezed and added to many dishes like lemon rice, lemon tea and beverages like lemonades. The lemon peel is also edible and highly nutritious.<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"10\",\"fprice\":\"11.76\",\"margin\":\"15\",\"profit\":\"1.7599999999999998\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.24\",\"actualprice\":\"12\",\"fpricebefdis\":\"11.76\",\"fpricewtas\":\"12\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:27:43.000000Z\"}', '2022-05-18 02:27:43', '2022-05-18 02:27:43'),
(45, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Ginger---Organically-Grown,-150-G\",\"attribute\":\"[]\",\"fprice\":\"5.88\",\"margin\":\"15\",\"profit\":\"0.8799999999999999\",\"taxa\":\"0.12\",\"actualprice\":\"6\",\"fpricebefdis\":\"5.88\",\"fpricewtas\":\"6\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:58:37\"}', '{\"id\":31,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Ginger - Organically Grown, 150 G\",\"urlslug\":\"Fresho-Ginger---Organically-Grown,-150-G\",\"shortdesc\":\"<p>It Is Organically Grown And Handpicked From Farm <\\/p><p> Product image shown is for representation purpose only, the actually product may vary based on season, produce &amp; availability.<\\/p>\",\"desc\":\"<p> Firm and fibrous ginger roots are stretched with multiple fingers that have light to dark tan skin and rings on it and is aromatic, spicy and pungent. The flavour gets intensified when the ginger is dried and lessens when cooked.<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"5\",\"fprice\":\"5.88\",\"margin\":\"15\",\"profit\":\"0.8799999999999999\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.12\",\"actualprice\":\"6\",\"fpricebefdis\":\"5.88\",\"fpricewtas\":\"6\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:28:37.000000Z\"}', '2022-05-18 02:28:37', '2022-05-18 02:28:37'),
(46, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Radish---White-1\\/2-Kg\",\"attribute\":\"[]\",\"fprice\":\"31.37\",\"margin\":\"-2\",\"profit\":\"-0.629999999999999\",\"taxa\":\"0.63\",\"actualprice\":\"32\",\"fpricebefdis\":\"31.37\",\"fpricewtas\":\"32\",\"updated_at\":\"2022-05-18 07:58:54\"}', '{\"id\":30,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Radish - White 1\\/2 Kg\",\"urlslug\":\"Fresho-Radish---White-1\\/2-Kg\",\"shortdesc\":\"<p>Radishes are a root crop with a crunchy texture and a sharp, spicy, hot or sweet taste. They are juicy and sometimes have a pungent smell.<\\/p>\",\"desc\":\"<ul><li>Radishes are excellent source of vitamin C.<\\/li><li>It contains folate, fiber, riboflavin, and potassium, as well as good amounts of copper, vitamin B6.<\\/li><li>It is composed of high dietary fibre, which is very fine for digestive tract.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"32\",\"fprice\":\"31.37\",\"margin\":\"-2\",\"profit\":\"-0.629999999999999\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.63\",\"actualprice\":\"32\",\"fpricebefdis\":\"31.37\",\"fpricewtas\":\"32\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"0\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:28:54.000000Z\"}', '2022-05-18 02:28:54', '2022-05-18 02:28:54'),
(47, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Snake-Gourd,-1\\/2-Kg\",\"attribute\":\"[]\",\"fprice\":\"23.53\",\"margin\":\"-2\",\"profit\":\"-0.46999999999999886\",\"taxa\":\"0.47\",\"actualprice\":\"24\",\"fpricebefdis\":\"23.53\",\"fpricewtas\":\"24\",\"status\":\"1\",\"updated_at\":\"2022-05-18 07:59:14\"}', '{\"id\":29,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Snake Gourd, 1\\/2 Kg\",\"urlslug\":\"Fresho-Snake-Gourd,-1\\/2-Kg\",\"shortdesc\":\"<ul><li>Snake gourds are true to their name as they have a long, curved shape with light green speckles and a waxy green skin.<\\/li><li>Their firm flesh is embedded with seeds and they taste like cucumber and have a slightly bitter taste.<\\/li><li>The fruits are orange in colour when ripe and pulpy red after complete ripening.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Keep snake gourds in a plastic bag or in an air tight container and refrigerate.<\\/li><li>Snake Gourds are added to various Indian dishes like curries, dal and sambar, avial.<\\/li><li>They can be grilled and stuffed with other vegetables too.<\\/li><li>Also made into pickles and chutneys<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"24\",\"fprice\":\"23.53\",\"margin\":\"-2\",\"profit\":\"-0.46999999999999886\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.47\",\"actualprice\":\"24\",\"fpricebefdis\":\"23.53\",\"fpricewtas\":\"24\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:29:14.000000Z\"}', '2022-05-18 02:29:14', '2022-05-18 02:29:14'),
(48, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Thyme,-10-g\",\"attribute\":\"[]\",\"fprice\":\"31.37\",\"margin\":\"1.2\",\"profit\":\"0.370000000000001\",\"taxa\":\"0.63\",\"actualprice\":\"32\",\"fpricebefdis\":\"31.37\",\"fpricewtas\":\"32\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:00:28\"}', '{\"id\":56,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Thyme, 10 g\",\"urlslug\":\"Fresho-Thyme,-10-g\",\"shortdesc\":\"<p>With a savoury mint flavour, Thyme is a delicate herb with clusters of bright green, rounded leaves around woody stems.<\\/p>\",\"desc\":\"<ul><li>Thyme helps in easy digestion of fatty foods and helps treat diarrhea, arthritis and stomach ache.<\\/li><li>It gives relief from whooping cough and sore throat.<\\/li><li>It is a diuretic.<\\/li><li>It increases urination and reduces infections related to the urinary tract.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"31\",\"fprice\":\"31.37\",\"margin\":\"1.2\",\"profit\":\"0.370000000000001\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.63\",\"actualprice\":\"32\",\"fpricebefdis\":\"31.37\",\"fpricewtas\":\"32\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:30:28.000000Z\"}', '2022-05-18 02:30:28', '2022-05-18 02:30:28'),
(49, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Turnip,-1-kg\",\"attribute\":\"[]\",\"fprice\":\"98.04\",\"margin\":\"-2\",\"profit\":\"-1.9599999999999937\",\"taxa\":\"1.96\",\"actualprice\":\"100\",\"fpricebefdis\":\"98.04\",\"fpricewtas\":\"100\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:00:44\"}', '{\"id\":55,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Turnip, 1 kg\",\"urlslug\":\"Fresho-Turnip,-1-kg\",\"shortdesc\":\"<ul><li>With a white, firm and crunchy flesh, Turnips are made of edible roots, stem and leaves.<\\/li><li>They are starchy and succulent with a sweet and peppery flavour.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Turnip are good for the healthy functioning of heart, bone and lungs.<\\/li><li>They help in digestion and prevents body odour. Also helps cure asthma.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"100\",\"fprice\":\"98.04\",\"margin\":\"-2\",\"profit\":\"-1.9599999999999937\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"1.96\",\"actualprice\":\"100\",\"fpricebefdis\":\"98.04\",\"fpricewtas\":\"100\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:30:44.000000Z\"}', '2022-05-18 02:30:44', '2022-05-18 02:30:44'),
(50, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Leeks,-100-g\",\"attribute\":\"[]\",\"fprice\":\"21.57\",\"margin\":\"7.3\",\"profit\":\"1.5700000000000003\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:01:02\"}', '{\"id\":54,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Leeks, 100 g\",\"urlslug\":\"Fresho-Leeks,-100-g\",\"shortdesc\":\"<p>Leek is a long bundle of leaf sheaths with a mild, onion-like taste. In its raw state, the vegetable is crunchy and firm. The edible portions of the leek are the white base of the leaves (above the roots and stem base) and the light green parts.<\\/p>\",\"desc\":\"<ul><li>Leeks can help regulate intestinal function due to their high fiber content.<\\/li><li>Due to its anti-inflammatory and antiseptic properties, leek juice is a valuable aid for treating arthritis, gout and inflammation of the urinary tract.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"20\",\"fprice\":\"21.57\",\"margin\":\"7.3\",\"profit\":\"1.5700000000000003\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:31:02.000000Z\"}', '2022-05-18 02:31:02', '2022-05-18 02:31:02'),
(51, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Banana-Flower---Organically-Grown,-1-pc\",\"attribute\":\"[]\",\"fprice\":\"26.47\",\"margin\":\"1.8\",\"profit\":\"0.46999999999999886\",\"taxa\":\"0.53\",\"actualprice\":\"27\",\"fpricebefdis\":\"26.47\",\"fpricewtas\":\"27\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:01:23\"}', '{\"id\":53,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Banana Flower - Organically Grown, 1 pc\",\"urlslug\":\"Fresho-Banana-Flower---Organically-Grown,-1-pc\",\"shortdesc\":\"<p>Banana flower, also known as banana blossom, is a tear-shaped maroon or purplish flower hanging at the end of banana clusters grows on the end of the stem holding a cluster of bananas. The edible flower has a unique and excellent taste rich in nutrients. With every purple outer sheath removed it has anthers which are edible. We selectively pick organically grown banana flower from the best farms.<\\/p>\",\"desc\":\"<p>Banana blossoms are best used fresh. You can also cover it in zip lock bags, wrap in transparent plastic or freeze bags and store under refrigerated conditions. <\\/p><p> Banana blossoms can be eaten raw or cooked. Flowers are used to make delicious curries. They are also used to make vadas which makes them very crispy and tasty. Banana flowers added to fish curry is an excellent combination.<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"26\",\"fprice\":\"26.47\",\"margin\":\"1.8\",\"profit\":\"0.46999999999999886\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.53\",\"actualprice\":\"27\",\"fpricebefdis\":\"26.47\",\"fpricewtas\":\"27\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:31:23.000000Z\"}', '2022-05-18 02:31:23', '2022-05-18 02:31:23'),
(52, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Banana-Stem---Organically-Grown,-1-pc\",\"attribute\":\"[]\",\"fprice\":\"24.51\",\"margin\":\"6.2\",\"profit\":\"1.5100000000000016\",\"taxa\":\"0.49\",\"actualprice\":\"25\",\"fpricebefdis\":\"24.51\",\"fpricewtas\":\"25\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:01:49\"}', '{\"id\":52,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Banana Stem - Organically Grown, 1 pc\",\"urlslug\":\"Fresho-Banana-Stem---Organically-Grown,-1-pc\",\"shortdesc\":\"<p>Banana Stem is the fibrous stalk of the banana plant. It has high water content, fresh and crispy textured stalks with mild taste. Fresho stem grade bananas are offered in a pristine condition and are tasty and nutritious. We selectively pick stems of organically grown banana stem from the best farms.<\\/p>\",\"desc\":\"<p>Banana stem should be used fresh in a day or two to prevent spoilage. Used to make juice and curries.<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"23\",\"fprice\":\"24.51\",\"margin\":\"6.2\",\"profit\":\"1.5100000000000016\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.49\",\"actualprice\":\"25\",\"fpricebefdis\":\"24.51\",\"fpricewtas\":\"25\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:31:49.000000Z\"}', '2022-05-18 02:31:49', '2022-05-18 02:31:49'),
(53, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Arai-Keerai,-250-g\",\"attribute\":\"[]\",\"fprice\":\"14.71\",\"margin\":\"4.8\",\"profit\":\"0.7100000000000009\",\"taxa\":\"0.29\",\"actualprice\":\"15\",\"fpricebefdis\":\"14.71\",\"fpricewtas\":\"15\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:02:08\"}', '{\"id\":51,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Arai Keerai, 250 g\",\"urlslug\":\"Fresho-Arai-Keerai,-250-g\",\"shortdesc\":\"<p>\\\"Arai Keerai\\\" describes the amaranth leaves in its middles stages of growth. Arai keerai can be used to made vadai which is also a delicious evening snack that helps to boost growth and immunity. Arai keerai helps in hair growth and keeps hair problems like dandruff at bay. <\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"14\",\"fprice\":\"14.71\",\"margin\":\"4.8\",\"profit\":\"0.7100000000000009\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.29\",\"actualprice\":\"15\",\"fpricebefdis\":\"14.71\",\"fpricewtas\":\"15\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:32:08.000000Z\"}', '2022-05-18 02:32:08', '2022-05-18 02:32:08'),
(54, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Garlic---Organically-Grown,-100-g\",\"attribute\":\"[]\",\"fprice\":\"12.75\",\"margin\":\"5.9\",\"profit\":\"0.75\",\"taxa\":\"0.26\",\"actualprice\":\"13\",\"fpricebefdis\":\"12.75\",\"fpricewtas\":\"13\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:02:35\"}', '{\"id\":50,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Garlic - Organically Grown, 100 g\",\"urlslug\":\"Fresho-Garlic---Organically-Grown,-100-g\",\"shortdesc\":\"<p>Fresho Organic products are organically grown and handpicked by expert. <\\/p><p> Product image shown is for representation purpose only, the actually product may vary based on season, produce &amp; availability.<\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"12\",\"fprice\":\"12.75\",\"margin\":\"5.9\",\"profit\":\"0.75\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.26\",\"actualprice\":\"13\",\"fpricebefdis\":\"12.75\",\"fpricewtas\":\"13\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:32:35.000000Z\"}', '2022-05-18 02:32:35', '2022-05-18 02:32:35'),
(55, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Betel-Leaf,-5-pcs\",\"attribute\":\"[]\",\"fprice\":\"21.57\",\"margin\":\"7.3\",\"profit\":\"1.5700000000000003\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:02:58\"}', '{\"id\":49,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Betel Leaf, 5 pcs\",\"urlslug\":\"Fresho-Betel-Leaf,-5-pcs\",\"shortdesc\":\"<ul><li>Fresho brings to you fresh Betel Leaf. This is also called paan ka Patta.<\\/li><li>It has many curative and healing benefits.<\\/li><li>They are rich in vitamins like vitamin C, thiamine, niacin, riboflavin, and carotene and are a great source of calcium.<\\/li><li>These leaves used as a stimulant, an antiseptic, and a breath freshener.<\\/li><li>It can be batter-coated and deep-fried till absolutely crisp.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Betel leaf has vitamins such as vitamin C, riboflavin, niacin, thiamine and carotene.<\\/li><li>It is also a greater supply of calcium.<\\/li><li>The juice from the leaf is known to have diuretic properties and assists urination when taken with diluted milk.<\\/li><li>Local application of betel leaves relieves sore throat.<\\/li><li>Juice of betel leaves dropped in the ear relieves earaches.\\\"<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"20\",\"fprice\":\"21.57\",\"margin\":\"7.3\",\"profit\":\"1.5700000000000003\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:32:58.000000Z\"}', '2022-05-18 02:32:58', '2022-05-18 02:32:58'),
(56, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Knol-Khol,-1-kg\",\"attribute\":\"[]\",\"fprice\":\"44.12\",\"margin\":\"0.3\",\"profit\":\"0.11999999999999744\",\"taxa\":\"0.88\",\"actualprice\":\"45\",\"fpricebefdis\":\"44.12\",\"fpricewtas\":\"45\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:03:18\"}', '{\"id\":48,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Knol Khol, 1 kg\",\"urlslug\":\"Fresho-Knol-Khol,-1-kg\",\"shortdesc\":\"<p>Knol Khols are big, greenish white colored vegetables with long, green extrusions.They have a crispy texture and taste mildly sweet<\\/p>\",\"desc\":\"<p>Knol Khols have a long storage capacity. Avoid peeling them until consumption. They can be refrigerated for upto 5 days.<\\/p><p>Knol Khols are peeled or grated and added to salads and also used to prepare curries.<\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"44\",\"fprice\":\"44.12\",\"margin\":\"0.3\",\"profit\":\"0.11999999999999744\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.88\",\"actualprice\":\"45\",\"fpricebefdis\":\"44.12\",\"fpricewtas\":\"45\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:33:18.000000Z\"}', '2022-05-18 02:33:18', '2022-05-18 02:33:18'),
(57, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Papaya---Raw,-1-kg\",\"attribute\":\"[]\",\"fprice\":\"32.35\",\"margin\":\"7.3\",\"profit\":\"2.3500000000000014\",\"taxa\":\"0.65\",\"actualprice\":\"33\",\"fpricebefdis\":\"32.35\",\"fpricewtas\":\"33\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:03:46\"}', '{\"id\":47,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Papaya - Raw, 1 kg\",\"urlslug\":\"Fresho-Papaya---Raw,-1-kg\",\"shortdesc\":\"<ul><li>Fresho is our brand of fresh fruits and vegetables which are individually handpicked every day by our experienced and technically competent buyers.<\\/li><li>Our buying, storing, and packaging processes are tailored to ensure that only the fresh, nutrient-dense, healthy, and delicious produce reaches your doorstep.<\\/li><li>We guarantee the quality of all Fresho products.<\\/li><li>If you\'re not satisfied with the freshness of the items, you can hand them back to our Customer Experience Executive (CEE) for a full refund.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Papayas reduce the risk of macular degeneration, a disease that affects the eyes as people age.<\\/li><li>They prevent asthma and cancer.<\\/li><li>Mashed papayas help in wound healing and preventing infections.<\\/li><li>Papaya contain Folic acid, Vitamin C, Amino Acid, .Papaya helps in dig<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"30\",\"fprice\":\"32.35\",\"margin\":\"7.3\",\"profit\":\"2.3500000000000014\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.65\",\"actualprice\":\"33\",\"fpricebefdis\":\"32.35\",\"fpricewtas\":\"33\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:33:46.000000Z\"}', '2022-05-18 02:33:46', '2022-05-18 02:33:46'),
(58, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Basale-Leaf,-250-g\",\"attribute\":\"[]\",\"fprice\":\"15.69\",\"margin\":\"-2\",\"profit\":\"-0.3100000000000005\",\"actualprice\":\"16\",\"fpricebefdis\":\"15.69\",\"fpricewtas\":\"16\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:04:07\"}', '{\"id\":46,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Basale Leaf, 250 g\",\"urlslug\":\"Fresho-Basale-Leaf,-250-g\",\"shortdesc\":\"<ul><li>hick, semi-succulent, heart-shaped basal leaves are fresh green coloured spinach that grows fast with its soft-stemmed vine.<\\/li><li>Comes with a mild flavor and mucilaginous texture.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Basale leaf is rich in Vitamin A, C, Iron and Calcium.<\\/li><li>Low in calories per volume and high in protein per calorie.<\\/li><li>The succulent mucilage is a particularly rich source of soluble fiber.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"16\",\"fprice\":\"15.69\",\"margin\":\"-2\",\"profit\":\"-0.3100000000000005\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.31\",\"actualprice\":\"16\",\"fpricebefdis\":\"15.69\",\"fpricewtas\":\"16\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:34:07.000000Z\"}', '2022-05-18 02:34:07', '2022-05-18 02:34:07'),
(59, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Lettuce---Iceberg,-1-pc-(Approx.-250g-500g)\",\"attribute\":\"[]\",\"fprice\":\"56.86\",\"margin\":\"-17.8\",\"profit\":\"-10.14\",\"taxa\":\"1.14\",\"actualprice\":\"58\",\"fpricebefdis\":\"56.86\",\"fpricewtas\":\"58\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:04:26\"}', '{\"id\":45,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Lettuce - Iceberg, 1 pc (Approx. 250g-500g)\",\"urlslug\":\"Fresho-Lettuce---Iceberg,-1-pc-(Approx.-250g-500g)\",\"shortdesc\":\"<p>Iceberg lettuce is a variety of lettuce with crisp leaves which grows in a spherical head resembling a cabbage. The leaves on the outside tend to be green and the leaves in the center go from pale yellow to nearly whitish as you move closer and closer to the center of the head with the sweetest leaves in the center of the head.<\\/p>\",\"desc\":\"<ul><li>Lettuce provides significant amounts of vitamins A and K.<\\/li><li>They have a high water content, making it a refreshing choice during hot weather.<\\/li><li>They also provide calcium, potassium, vitamin C, and folate.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"67\",\"fprice\":\"56.86\",\"margin\":\"-17.8\",\"profit\":\"-10.14\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"1.14\",\"actualprice\":\"58\",\"fpricebefdis\":\"56.86\",\"fpricewtas\":\"58\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:34:26.000000Z\"}', '2022-05-18 02:34:26', '2022-05-18 02:34:26'),
(60, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Pumpkin---Organically-Grown,-1-pc\",\"attribute\":\"[]\",\"fprice\":\"53.92\",\"margin\":\"-2\",\"profit\":\"-1.0799999999999983\",\"taxa\":\"1.08\",\"actualprice\":\"55\",\"fpricebefdis\":\"53.92\",\"fpricewtas\":\"55\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:04:53\"}', '{\"id\":44,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Pumpkin - Organically Grown, 1 pc\",\"urlslug\":\"Fresho-Pumpkin---Organically-Grown,-1-pc\",\"shortdesc\":\"<p>It is organically grown and handpicked from farm <\\/p><p> Product image shown is for representation purpose only, the actually product may vary based on season, produce &amp; availability. <\\/p>\",\"desc\":null,\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"55\",\"fprice\":\"53.92\",\"margin\":\"-2\",\"profit\":\"-1.0799999999999983\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"1.08\",\"actualprice\":\"55\",\"fpricebefdis\":\"53.92\",\"fpricewtas\":\"55\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:34:53.000000Z\"}', '2022-05-18 02:34:53', '2022-05-18 02:34:53'),
(61, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Chow-Chow,-500-g\",\"attribute\":\"[]\",\"fprice\":\"21.57\",\"margin\":\"7.3\",\"profit\":\"1.5700000000000003\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:05:10\"}', '{\"id\":43,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Chow Chow, 500 g\",\"urlslug\":\"Fresho-Chow-Chow,-500-g\",\"shortdesc\":\"<p>Known wordlwide for its delicious seeds, roots, shoots, flowers, leaves and fruit, Chow chow also known as Chayote, is a roughly pear-shaped, mild flavoured and green vegetable<\\/p>\",\"desc\":\"<ul><li>Chow chow can be stored in the refrigerator. Lightly wrap it in a paper towel before placing it in a bag.<\\/li><li>Every part of this vegetable can be consumed.<\\/li><li>Chow Chow can be eaten raw, steamed, baked, stuffed, fried, marinated or boiled.<\\/li><li>Its soft flesh is often used for making baby food, juices, sauces as well as pasta dishes.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"20\",\"fprice\":\"21.57\",\"margin\":\"7.3\",\"profit\":\"1.5700000000000003\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:35:10.000000Z\"}', '2022-05-18 02:35:10', '2022-05-18 02:35:10');
INSERT INTO `loggers` (`id`, `modid`, `uid`, `type`, `page`, `newdata`, `olddata`, `created_at`, `updated_at`) VALUES
(62, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Sweet-Potato,-500-g\",\"attribute\":\"[]\",\"fprice\":\"21.57\",\"margin\":\"7.3\",\"profit\":\"1.5700000000000003\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"updated_at\":\"2022-05-18 08:05:27\"}', '{\"id\":42,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Sweet Potato, 500 g\",\"urlslug\":\"Fresho-Sweet-Potato,-500-g\",\"shortdesc\":\"<p>With flesh colours ranging from white, orange and yellow, sweet potatoes are ovate and cylindrical with golden brown or white-brown skin and a delicious sweet flavour. <\\/p><p> While the white fleshed are firm, orange fleshed are softer.<\\/p>\",\"desc\":\"<ul><li>Sweet potatoes prevent diabetes and reduce blood pressure. They influence fertility.<\\/li><li>They are advised to consume regularly during pregnancy and breast feeding.<\\/li><li>Good for healthy digestive system, healthy eyes, teeth and gums.<\\/li><li>Effective in reducing addiction to narcotics like cigarettes and liquor.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"20\",\"fprice\":\"21.57\",\"margin\":\"7.3\",\"profit\":\"1.5700000000000003\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.43\",\"actualprice\":\"22\",\"fpricebefdis\":\"21.57\",\"fpricewtas\":\"22\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"0\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:35:27.000000Z\"}', '2022-05-18 02:35:27', '2022-05-18 02:35:27'),
(63, 0, 1, 1, 'Products', '{\"urlslug\":\"Fresho-Spring-Onion---With-roots,-100-g\",\"attribute\":\"[]\",\"fprice\":\"19.61\",\"margin\":\"23.5\",\"profit\":\"4.609999999999999\",\"taxa\":\"0.39\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.61\",\"fpricewtas\":\"20\",\"status\":\"1\",\"updated_at\":\"2022-05-18 08:05:54\"}', '{\"id\":41,\"bid\":\"0\",\"cid\":\"2\",\"scid\":\"0\",\"uomid\":\"1\",\"packingid\":\"0\",\"name\":\"Fresho Spring Onion - With roots, 100 g\",\"urlslug\":\"Fresho-Spring-Onion---With-roots,-100-g\",\"shortdesc\":\"<ul><li>Spring onions come with a crisp texture and sweet flavor.<\\/li><li>They are moist with thin, white flesh and a green stem.<\\/li><li>The green stems are hollow, bitter, and pungent.<\\/li><\\/ul><p><br><\\/p>\",\"desc\":\"<ul><li>Spring onions are an excellent source of sulfur that reduces the risk of cancer and lowers blood sugar levels.<\\/li><li>They are rich in fiber and aid digestion.<\\/li><li>Rich in vitamin A that is needed for eyesight.<\\/li><li>They also help fight against cold and flu.<\\/li><\\/ul><p><br><\\/p>\",\"attribute\":\"[]\",\"tags\":[\"\"],\"sku\":\"0\",\"barcode\":\"0\",\"trackqty\":0,\"oosc\":0,\"da\":0,\"cpi\":\"15\",\"fprice\":\"19.61\",\"margin\":\"23.5\",\"profit\":\"4.609999999999999\",\"disid\":0,\"disp\":\"0\",\"disa\":\"0\",\"taxp\":\"2\",\"taxa\":\"0.39\",\"actualprice\":\"20\",\"fpricebefdis\":\"19.61\",\"fpricewtas\":\"20\",\"length\":\"0\",\"width\":\"0\",\"breadth\":\"0\",\"lunit\":\"0\",\"weight\":\"0\",\"wgunit\":\"0\",\"stock\":\"0\",\"minstock\":\"0\",\"seo_title\":null,\"seo_desc\":null,\"status\":\"1\",\"created_at\":\"2022-05-18T02:02:14.000000Z\",\"updated_at\":\"2022-05-18T02:35:54.000000Z\"}', '2022-05-18 02:35:54', '2022-05-18 02:35:54'),
(64, 0, 1, 0, 'Pincode', '{\"country\":\"India\",\"state\":\"Tamil Nadu\",\"city\":\"Chennai\",\"pincode\":\"600040\",\"status\":1,\"cost\":\"0\",\"deldays\":\"0\",\"store\":\"0\",\"generaldata\":[],\"updated_at\":\"2022-05-18T02:44:58.000000Z\",\"created_at\":\"2022-05-18T02:44:58.000000Z\",\"id\":1}', NULL, '2022-05-18 02:44:58', '2022-05-18 02:44:58'),
(65, 0, 1, 0, 'Pincode', '{\"country\":\"India\",\"state\":\"Tamil Nadu\",\"city\":\"Chennai\",\"pincode\":\"600026\",\"status\":\"1\",\"cost\":\"0\",\"deldays\":\"0\",\"store\":1,\"generaldata\":[],\"updated_at\":\"2022-05-18T02:45:31.000000Z\",\"created_at\":\"2022-05-18T02:45:31.000000Z\",\"id\":2}', NULL, '2022-05-18 02:45:31', '2022-05-18 02:45:31'),
(66, 0, 1, 0, 'Pincode', '{\"country\":\"India\",\"state\":\"Tamil Nadu\",\"city\":\"Chennai\",\"pincode\":\"600094\",\"status\":\"1\",\"cost\":\"0\",\"deldays\":\"0\",\"store\":1,\"generaldata\":[],\"updated_at\":\"2022-05-18T02:45:52.000000Z\",\"created_at\":\"2022-05-18T02:45:52.000000Z\",\"id\":3}', NULL, '2022-05-18 02:45:52', '2022-05-18 02:45:52'),
(67, 0, 1, 0, 'Pincode', '{\"country\":\"India\",\"state\":\"Tamil Nadu\",\"city\":\"Chennai\",\"pincode\":\"600034\",\"status\":\"1\",\"cost\":\"0\",\"deldays\":\"0\",\"store\":1,\"generaldata\":[],\"updated_at\":\"2022-05-18T02:46:10.000000Z\",\"created_at\":\"2022-05-18T02:46:10.000000Z\",\"id\":4}', NULL, '2022-05-18 02:46:10', '2022-05-18 02:46:10'),
(68, 0, 1, 0, 'Pincode', '{\"country\":\"India\",\"state\":\"Tamil Nadu\",\"city\":\"Chennai\",\"pincode\":\"600018\",\"status\":\"1\",\"cost\":\"0\",\"deldays\":\"0\",\"store\":2,\"generaldata\":[],\"updated_at\":\"2022-05-18T02:46:30.000000Z\",\"created_at\":\"2022-05-18T02:46:30.000000Z\",\"id\":5}', NULL, '2022-05-18 02:46:30', '2022-05-18 02:46:30'),
(69, 0, 1, 0, 'Banner', '{\"name\":null,\"desc\":null,\"linkt\":\"1\",\"optsel\":\"0\",\"link\":\"\\/hotdeals\",\"status\":1,\"loc\":\"storage\\/banner\\/uBSKWrmoR6Djx45c.jpg\",\"updated_at\":\"2022-05-18T02:47:15.000000Z\",\"created_at\":\"2022-05-18T02:47:15.000000Z\",\"id\":1}', NULL, '2022-05-18 02:47:15', '2022-05-18 02:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2021_12_20_032916_create_categories_table', 1),
(10, '2021_12_20_045645_create_sub_categories_table', 1),
(11, '2021_12_20_132112_create_brands_table', 1),
(12, '2021_12_24_043246_create_attributes_table', 1),
(13, '2021_12_24_141858_create_u_o_m_s_table', 1),
(14, '2021_12_24_144920_create_tags_table', 1),
(15, '2021_12_24_152407_create_banners_table', 1),
(16, '2021_12_24_181230_create_products_table', 1),
(17, '2021_12_24_194057_create_product_images_table', 1),
(18, '2021_12_27_131840_create_discounts_table', 1),
(19, '2021_12_29_120203_create_promo_codes_table', 1),
(20, '2021_12_29_141313_create_c_m_s_table', 1),
(21, '2021_12_30_044546_create_pin_codes_table', 1),
(22, '2021_12_30_120602_create_o_t_p_s_table', 1),
(23, '2021_12_31_024428_create_addresses_table', 1),
(24, '2022_01_02_001208_create_carts_table', 1),
(25, '2022_01_02_001217_create_wish_lists_table', 1),
(26, '2022_01_04_131230_create_orders_table', 1),
(27, '2022_01_04_131253_create_orders_subs_table', 1),
(28, '2022_01_07_130611_create_customer_product_views_table', 1),
(29, '2022_01_10_225156_create_settings_table', 1),
(30, '2022_01_10_225241_create_s_e_o_s_table', 1),
(31, '2022_01_16_125408_create_payment_statuses_table', 1),
(32, '2022_01_16_172740_create_ret_can_orders_table', 1),
(33, '2022_01_17_024300_create_permissions_table', 1),
(34, '2022_01_19_015420_create_contact_us_table', 1),
(35, '2022_01_27_111151_create_reviews_table', 1),
(36, '2022_01_28_075144_create_loggers_table', 1),
(37, '2022_02_01_115441_create_customer_interactions_table', 1),
(38, '2022_02_09_105346_create_packings_table', 1),
(39, '2022_02_28_090749_create_pages_collections_table', 1),
(40, '2022_03_07_144339_create_newsletters_table', 1),
(41, '2022_05_17_223331_create_stores_table', 1),
(42, '2022_05_18_021959_create_order_manages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` int(10) UNSIGNED DEFAULT 0,
  `type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`type`)),
  `members` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `sent` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `aid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pincodeid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `storeid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `invno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcost` double(12,2) NOT NULL DEFAULT 0.00,
  `discount` double(12,2) NOT NULL DEFAULT 0.00,
  `shipping` double(12,2) NOT NULL DEFAULT 0.00,
  `taxtotal` double(12,2) NOT NULL DEFAULT 0.00,
  `subtotal` double(12,2) NOT NULL DEFAULT 0.00,
  `promocodeval` double(12,2) NOT NULL DEFAULT 0.00,
  `total` double(12,2) NOT NULL DEFAULT 0.00,
  `weight` double(12,2) NOT NULL DEFAULT 0.00,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`address`)),
  `status` smallint(6) NOT NULL DEFAULT 0,
  `paytype` smallint(6) NOT NULL DEFAULT 0,
  `paystatus` smallint(6) NOT NULL DEFAULT 0,
  `statusdet` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paydet` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generaldata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`generaldata`)),
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_subs`
--

CREATE TABLE `orders_subs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `catid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `subcatid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `brandid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `disid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `disp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `taxp` double(12,2) NOT NULL DEFAULT 0.00,
  `disa` double(12,2) NOT NULL DEFAULT 0.00,
  `taxa` double(12,2) NOT NULL DEFAULT 0.00,
  `length` double(12,2) NOT NULL DEFAULT 0.00,
  `width` double(12,2) NOT NULL DEFAULT 0.00,
  `breadth` double(12,2) NOT NULL DEFAULT 0.00,
  `weight` double(12,2) NOT NULL DEFAULT 0.00,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `singlecost` double(12,2) NOT NULL DEFAULT 0.00,
  `subcost` double(12,2) NOT NULL DEFAULT 0.00,
  `qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `discount` double(12,2) NOT NULL DEFAULT 0.00,
  `tax` double(12,2) NOT NULL DEFAULT 0.00,
  `final` double(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_manages`
--

CREATE TABLE `order_manages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o_t_p_s`
--

CREATE TABLE `o_t_p_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `type` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expdate` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packings`
--

CREATE TABLE `packings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages_collections`
--

CREATE TABLE `pages_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorybanner` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brandbanner` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_statuses`
--

CREATE TABLE `payment_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oid` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `status` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `refundstatus` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `paytype` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `error` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderid` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpaymentid` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderAmount` double(15,2) NOT NULL DEFAULT 0.00,
  `amount_refunded` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `general` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`general`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `uid`, `general`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"category\":1,\"subcategory\":1,\"brand\":1,\"packing\":1,\"uom\":1,\"attribute\":1,\"tags\":1,\"banner\":1,\"cms\":1,\"seo\":1,\"pincode\":1,\"contactus\":1,\"newsletter\":1,\"productsadd\":1,\"productsedit\":1,\"productsview\":1,\"productsdel\":1,\"employeeadd\":1,\"employeeedit\":1,\"employeeview\":1,\"employeedel\":1,\"storeadd\":1,\"storeedit\":1,\"storeview\":1,\"storedel\":1,\"customeradd\":1,\"customeredit\":1,\"customerview\":1,\"customerdel\":1,\"orderedit\":1,\"orderview\":1,\"orderdel\":1,\"promocodeadd\":1,\"promocodeedit\":1,\"promocodeview\":1,\"promocodedel\":1,\"discountsadd\":1,\"discountsedit\":1,\"discountsview\":1,\"discountsdel\":1,\"reviewedit\":1,\"reviewdel\":1}', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(2, 2, '{\"category\":1,\"subcategory\":1,\"brand\":1,\"packing\":1,\"uom\":1,\"attribute\":1,\"tags\":1,\"banner\":1,\"cms\":1,\"seo\":1,\"pincode\":1,\"contactus\":1,\"newsletter\":1,\"productsadd\":1,\"productsedit\":1,\"productsview\":1,\"productsdel\":1,\"employeeadd\":1,\"employeeedit\":1,\"employeeview\":1,\"employeedel\":1,\"customeradd\":1,\"customeredit\":1,\"customerview\":1,\"customerdel\":1,\"orderedit\":1,\"orderview\":1,\"orderdel\":1,\"promocodeadd\":1,\"promocodeedit\":1,\"promocodeview\":1,\"promocodedel\":1,\"storeadd\":1,\"storeedit\":1,\"storeview\":1,\"storedel\":1,\"discountsadd\":1,\"discountsedit\":1,\"discountsview\":1,\"discountsdel\":1,\"reviewedit\":1,\"reviewdel\":1}', '2022-05-18 01:50:37', '2022-05-18 01:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `pin_codes`
--

CREATE TABLE `pin_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double(8,2) DEFAULT NULL,
  `deldays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `generaldata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`generaldata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pin_codes`
--

INSERT INTO `pin_codes` (`id`, `store`, `country`, `state`, `city`, `pincode`, `cost`, `deldays`, `status`, `generaldata`, `created_at`, `updated_at`) VALUES
(1, 0, 'India', 'Tamil Nadu', 'Chennai', '600040', 0.00, '0', 1, '[]', '2022-05-18 02:44:58', '2022-05-18 02:44:58'),
(2, 1, 'India', 'Tamil Nadu', 'Chennai', '600026', 0.00, '0', 1, '[]', '2022-05-18 02:45:31', '2022-05-18 02:45:31'),
(3, 1, 'India', 'Tamil Nadu', 'Chennai', '600094', 0.00, '0', 1, '[]', '2022-05-18 02:45:52', '2022-05-18 02:45:52'),
(4, 1, 'India', 'Tamil Nadu', 'Chennai', '600034', 0.00, '0', 1, '[]', '2022-05-18 02:46:10', '2022-05-18 02:46:10'),
(5, 2, 'India', 'Tamil Nadu', 'Chennai', '600018', 0.00, '0', 1, '[]', '2022-05-18 02:46:30', '2022-05-18 02:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bid` int(11) NOT NULL DEFAULT 0,
  `cid` int(11) NOT NULL DEFAULT 0,
  `scid` int(11) NOT NULL DEFAULT 0,
  `uomid` int(11) NOT NULL DEFAULT 0,
  `packingid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urlslug` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortdesc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `sku` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trackqty` tinyint(1) NOT NULL DEFAULT 0,
  `oosc` tinyint(1) NOT NULL DEFAULT 0,
  `da` tinyint(1) NOT NULL DEFAULT 0,
  `cpi` double(10,2) NOT NULL DEFAULT 0.00,
  `fprice` double(10,2) NOT NULL DEFAULT 0.00,
  `margin` double(10,2) NOT NULL DEFAULT 0.00,
  `profit` double(10,2) NOT NULL DEFAULT 0.00,
  `disid` int(11) NOT NULL DEFAULT 0,
  `disp` double NOT NULL DEFAULT 0,
  `disa` double(10,2) NOT NULL DEFAULT 0.00,
  `taxp` double NOT NULL DEFAULT 0,
  `taxa` double(10,2) NOT NULL DEFAULT 0.00,
  `actualprice` double(10,2) NOT NULL DEFAULT 0.00,
  `fpricebefdis` double(10,2) NOT NULL DEFAULT 0.00,
  `fpricewtas` double(10,2) NOT NULL DEFAULT 0.00,
  `length` double(10,2) NOT NULL DEFAULT 0.00,
  `width` double(10,2) NOT NULL DEFAULT 0.00,
  `breadth` double(10,2) NOT NULL DEFAULT 0.00,
  `lunit` int(11) NOT NULL DEFAULT 0,
  `weight` double(10,2) NOT NULL DEFAULT 0.00,
  `wgunit` int(11) NOT NULL DEFAULT 0,
  `stock` bigint(20) NOT NULL DEFAULT 0,
  `minstock` bigint(20) NOT NULL DEFAULT 0,
  `seo_title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `bid`, `cid`, `scid`, `uomid`, `packingid`, `name`, `urlslug`, `shortdesc`, `desc`, `attribute`, `tags`, `sku`, `barcode`, `trackqty`, `oosc`, `da`, `cpi`, `fprice`, `margin`, `profit`, `disid`, `disp`, `disa`, `taxp`, `taxa`, `actualprice`, `fpricebefdis`, `fpricewtas`, `length`, `width`, `breadth`, `lunit`, `weight`, `wgunit`, `stock`, `minstock`, `seo_title`, `seo_desc`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 3, 0, 0, 0, 'Pumpkin Green Cut 500 g', 'Pumpkin-Green-Cut-500-g', '<ul><li>Fresho brings to you cut pumpkin green with creamish to yellow flesh and flat, edible seeds ( pepitas) inside that are tender and mildly sweet.</li></ul>', '<ul><li>Pumpkins are rich in fiber. So, it keeps the tummy full and causes less apetite.</li><li>Pumpkin seeds contain seratonin, that helps to relax and promote better sleep.</li><li>They are good for male sexual health.</li><li>A cup of cubed pumpkin has twice the daily vitamin A requirement which is essential for good vision.</li></ul><p><br></p>', '[]', '[\"Vegetable\"]', '0', '0', 1, 1, 0, 60.00, 63.49, 5.50, 3.49, -1, 10, 6.35, 5, 2.86, 60.00, 63.49, 60.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:03:57'),
(2, 0, 3, 0, 0, 0, 'Ash Gourd Cut 250 g', 'Ash-Gourd-Cut-250-g', '<ul><li>Our uniformly and perfectly cut fresh ash gourds comes with a mild and soft texture.</li><li>No more messy hands!</li></ul><p><br></p>', NULL, '[]', '[\"\",\"Vegetable\"]', '0', '0', 1, 1, 0, 40.00, 38.10, -5.00, -1.90, 0, 0, 0.00, 5, 1.91, 40.00, 38.10, 40.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:04:39'),
(3, 0, 3, 0, 0, 0, 'Yam Cut 250g', 'Yam-Cut-250g', '<p><br></p><ul><li>Now, cooking is easy with cut Yams that have a starchy and crunchy texture. do not fret about messy hands and labour time anymore!</li><li>Do not forget to check out our delicious recipe:-&nbsp;<a href=\"https://www.bigbasket.com/cookbook/recipes/1099/suran-koftas//\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: inherit;\"><strong>https://www.bigbasket.com/cookbook/recipes/1099/suran-koftas/</strong></a></li></ul><p><br></p>', NULL, '[]', '[\"\"]', '0', '0', 1, 1, 0, 28.00, 23.64, -18.40, -4.36, 0, 0, 0.00, 10, 2.36, 26.00, 23.64, 26.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:05:29'),
(4, 0, 2, 0, 0, 0, 'Green Peas 500 g', 'Green-Peas-500-g', '<p>Green peas are small, spherical and greenish in colour with a crunchy texture and sweet flavour.</p>', NULL, '[]', '[\"\"]', '0', '0', 1, 1, 0, 45.00, 85.71, 47.50, 40.71, 0, 0, 0.00, 5, 4.29, 90.00, 85.71, 90.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:07:10'),
(5, 0, 2, 0, 0, 0, 'Potato New Crop 1 kg', 'Potato-New-Crop-1-kg', NULL, '<p>New Potatoes: If you are looking for soft, slightly sweet but creamy-textured potatoes. These are a special variant early harvest of potatoes (not to be confused with our regular Fresho Potato) and are easily distinguishable with their thin/ tender skin which makes them easy-to-peel off even it can be used without peeling. These freshly picked potatoes are a great choice for roasting or boiling. They give essential nutrients to your body along with high dietary fibre and carbohydrates. Combined with great taste and nutrients this vegetable is the most popular and loved amongst households. Fresho New potatoes are either Round or Oblong which is about 45mm-65 mm in diameter. Consume them within a few days of purchase. Click here for delicious vegetable recipes - https://www.bigbasket.com/flavors/collections/227/fresh-vegetables/</p>', '[]', '[\"\"]', '0', '0', 1, 1, 0, 39.00, 36.19, -7.80, -2.81, 0, 0, 0.00, 5, 1.81, 38.00, 36.19, 38.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:07:39'),
(6, 0, 2, 0, 0, 0, 'Cucumber English 500 g', 'Cucumber-English-500-g', '<p>English cucumber is a variety of seedless cucumber that is longer and slimmer than other varieties and have a higher water content. They do not have a layer of wax on them, and the skin is tender when ripe.</p>', NULL, '[]', '[\"\"]', '0', '0', 1, 1, 0, 20.00, 19.05, -5.00, -0.95, 0, 0, 0.00, 5, 0.95, 20.00, 19.05, 20.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:08:11'),
(7, 0, 2, 0, 0, 0, 'Sweet Corn 2 pcs', 'Sweet-Corn-2-pcs', '<p>Wrapped in lime coloured husks with silk, sweet corn contains numerous yellow succulent kernels that have a starchy and doughy consistency. The skin pops out as you bite into it.</p>', NULL, '[]', '[\"\"]', '0', '0', 1, 1, 0, 40.00, 40.00, 0.00, 0.00, 0, 0, 0.00, 5, 2.00, 42.00, 40.00, 42.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 0, '2022-05-18 02:02:13', '2022-05-18 02:08:39'),
(8, 0, 1, 0, 0, 0, 'Banana Red 500 g', 'Banana-Red-500-g', '<ul><li>Standing apart from the common varieties of yellow bananas, Red bananas are short, plump and reddish-purple in colour.</li><li>Even the flesh is light pink and sweeter compared to other varieties. They are high in nutrients and are freshly procured from the farmers.</li></ul><p><br></p>', NULL, '[]', '[\"\",\"Fruit\"]', '0', '0', 1, 1, 0, 40.00, 38.10, -5.00, -1.90, 0, 0, 0.00, 5, 1.91, 40.00, 38.10, 40.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 0, '2022-05-18 02:02:13', '2022-05-18 02:11:02'),
(9, 0, 1, 0, 0, 0, 'Pomegranate Small 1 kg', 'Pomegranate-Small-1-kg', '<ul><li>With ruby color and an intense floral, sweet-tart flavor, the pomegranate delivers both taste and beauty.</li><li>You can remove the skin and the membranes to get at the delicious fruit with nutty seeds.</li><li>Fresho Pomegranates are finely sorted and graded to deliver the best tasting pomegranates to you.</li></ul><p><br></p>', NULL, '[]', '[\"\"]', '0', '0', 1, 1, 0, 220.00, 184.40, -19.30, -35.60, 0, 0, 0.00, 9, 16.60, 201.00, 184.40, 201.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:11:30'),
(10, 0, 1, 0, 0, 0, 'Blueberry 125 g', 'Blueberry-125-g', '<p>Plump, smooth-skinned and indigo coloured perfect little globes of juicy berries have mostly sweet and slightly tart flavour. We have imported this fine quality, delicious tasting variety of blueberries.</p>', NULL, '[]', '[\"\"]', '0', '0', 1, 1, 0, 350.00, 314.29, -11.40, -35.71, 0, 0, 0.00, 5, 15.71, 330.00, 314.29, 330.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:11:42'),
(11, 0, 2, 0, 0, 0, 'Combo - Fresh Vegg', 'Combo---Fresh-Vegg', '<p>Organic Food &amp; Fruit,&nbsp;<em>Vegetables</em>&nbsp;· Drag &amp; Drop Sections ready · Mega Store for grocery and fresh&nbsp;<em>vegetables</em>.</p>', '<p>Eating vegetables&nbsp;<strong>provides health benefits</strong>&nbsp;– people who eat more vegetables and fruits as part of an overall healthy diet are likely to have a reduced risk of some chronic diseases. Vegetables provide nutrients vital for health and maintenance of your body. Most vegetables are naturally low in fat and calories.</p>', '[]', '[\"\"]', '0', '0', 1, 1, 0, 445.00, 416.50, -6.80, -28.50, 0, 0, 0.00, 3, 12.50, 429.00, 416.50, 429.00, 0.00, 0.00, 0.00, 0, 0.00, 0, -24, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:11:54'),
(12, 0, 2, 0, 0, 0, 'Combo Farm Frozen', 'Combo-Farm-Frozen', '<p>Buy&nbsp;<em>Frozen Foods</em>&nbsp;online at best price from Farm63 Store. Choose&nbsp;<em>Frozen Food</em>&nbsp;for best quality frozen products like frozen vegetables</p>', '<p>Frozen vegetables are vegetables that have had their temperature reduced and maintained to below their freezing point for the purpose of storage and transportation until they are ready to be eaten. They may be commercially packaged or frozen at home. A wide range of frozen vegetables are sold in supermarkets</p>', '[]', '[\"\"]', '0', '0', 1, 1, 0, 440.00, 411.76, -6.90, -28.24, 0, 0, 0.00, 2, 8.24, 420.00, 411.76, 420.00, 0.00, 0.00, 0.00, 0, 0.00, 0, -1, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:12:03'),
(13, 0, 1, 0, 0, 0, 'Combo Farm Fruity', 'Combo-Farm-Fruity', '<p>Buy farm&nbsp;<em>fresh fruits</em>&nbsp;and vegetables online at the best prices. Order your favourite fruits and vegetables at bigbasket, the online Farm63 store</p>', '<p>Fruits are&nbsp;<strong>an excellent source of essential vitamins and minerals, and they are high in fiber</strong>. Fruits also provide a wide range of health-boosting antioxidants, including flavonoids. Eating a diet high in fruits and vegetables can reduce a person\'s risk of developing heart disease, cancer, inflammation, and diabetes.</p>', '[]', '[\"\",\"Vegetable\"]', '0', '0', 1, 1, 0, 244.00, 245.10, 0.40, 1.10, 0, 0, 0.00, 2, 4.90, 250.00, 245.10, 250.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 3, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:12:19'),
(14, 0, 2, 0, 0, 0, 'Fresho Sambar Onion - Peeled (Small Onion), 500g', 'Fresho-Sambar-Onion---Peeled-(Small-Onion),-500g', '<ul><li>Also known as button onions, Sambar Onions are relatively smaller onions with mild flavour and slightly sweet taste.</li><li>Fresho delivers at your doorstep freshly peeled sambar onions, making your preparations much easier and quicker because we value your time!</li></ul><p><br></p>', NULL, '[]', '[\"\"]', '0', '0', 0, 0, 0, 40.00, 39.22, -2.00, -0.78, 0, 0, 0.00, 2, 0.78, 40.00, 39.22, 40.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:13:47'),
(15, 0, 2, 0, 1, 0, 'Fresho Big Onion, 1 kg', 'Fresho-Big-Onion,-1-kg', '<ul><li>Onions are known to be rich in biotin. Most of the flavonoids which are known as anti-oxidants are concentrated more in the outer layers, so when you peel off the layers, you should remove as little as possible.</li><li>Onion can fill your kitchen with a thick spicy aroma. It is a common base vegetable in most Indian dishes, thanks to the wonderful flavor that it adds to any dish.</li></ul><p><br></p>', '<ul><li>If a piece of onion is inhaled, it can slow down or stop nose bleeding.</li><li>Those who have sleeping disorders or insomnia can have a good night sleep if they have an onion every day.</li><li>Onions are known to have antiseptic, antimicrobial and antibiotic properties which help you to get rid of infections.</li><li>Onions are high in sulphur, vitamin B6 and B9. It has high quantities of water and naturally low in fat. It is high in phytochemical compounds.</li><li>Onions are known to contain manganese, copper, Vitamin B6, Vitamin C, Folic acid, Amino acid and dietary fibers along with phosphorus, folate and copper</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 20.00, 19.61, -2.00, -0.39, 0, 0, 0.00, 2, 0.39, 20.00, 19.61, 20.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:15:08'),
(16, 0, 2, 0, 1, 0, 'Fresho Tomato 1 Kg', 'Fresho-Tomato-1-Kg', '<p>Tomato Hybrids are high-quality fruits compared to desi, local tomatoes. They contain numerous edible seeds and are red in colour due to lycopene, an anti-oxidant.</p>', '<ul><li>Tomatoes contain Vitamin C,K. lycopene, an antioxidant that reduces the risk of cancer and heart-diseases. They protect the eyes from light induced damage.</li><li>Essential for pregnant women as these tomatoes protect infants against neural tube defects.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 70.00, 68.63, -2.00, -1.37, 0, 0, 0.00, 2, 1.37, 70.00, 68.63, 70.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:14:04'),
(17, 0, 2, 0, 1, 0, 'Fresho Potato, 1 kg', 'Fresho-Potato,-1-kg', '<p>These small baby potatoes are a sweeter variety than normal ones and come with a creamy off white interior. Baby potato is a starchy vegetable that adds thickness to recipes and blends well with other vegetables.</p>', '<ul><li>Potatoes should always be stored in a cool, dark and dry place that is preferably in your visibility.</li><li>But if not attended to for a long time these potatoes will begin to sprout due to preferable envIronment conditions and end up loosing nutritional value.</li><li>Refrigeration adversely affects the flavour of potatoes, therefore it is best to store them in paper bags.</li><li>Remember, plastic bags promote moisture and speed decay process.</li><li>Baby potatoes have almost all the uses of a normal potato but one advantage is that they can be peeled and put as a whole without the burden of cutting due to their small size.</li><li>Can be roasted, boiled, stir-fried, sauteed, and put in various chilled salads, pastas and curries like dum aaloo.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 44.00, 43.14, -2.00, -0.86, 0, 0, 0.00, 2, 0.86, 44.00, 43.14, 44.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:15:39'),
(18, 0, 2, 0, 1, 0, 'Fresho Beetroot - Organically Grown, 500 g', 'Fresho-Beetroot---Organically-Grown,-500-g', '<p>Fresho Organic products are organically grown and handpicked by expert. </p><p> Product image shown is for representation purpose only, the actually product may vary based on season, produce &amp; availability. </p>', '<ul><li>Red beets lower blood pressure, promotes brain and heart health.</li><li>It fights inflammation and boosts energy levels</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 15.00, 14.71, -2.00, -0.29, 0, 0, 0.00, 2, 0.29, 15.00, 14.71, 15.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:16:17'),
(19, 0, 2, 0, 1, 0, 'Fresho Beans - Organically Grown, 1/2 g', 'Fresho-Beans---Organically-Grown,-1/2-g', '<p> French beans&nbsp;are smaller than common&nbsp;green beans&nbsp;and have a soft, velvety pod. Quite fleshy for their size, only tiny seeds inhabit these delicate pods.&nbsp;French beans&nbsp;are sweet, tender and wonderfully crispy.&nbsp;Due to naturally growing methods, they are free from chemical residues. They are used in curries, soups, stir-fry with rice, noodles and salads.</p>', '<ul><li>Haricot beans are great for metabolism and regulation of the sugar level of blood.</li><li>They support the adrenal regulation function and provide an excellent source of protein and fibre.</li><li>A good source of many nutrients and proves to be a healthy diet.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 83.00, 79.61, -4.30, -3.39, 0, 0, 0.00, 3, 2.39, 82.00, 79.61, 82.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:17:06'),
(20, 0, 2, 0, 1, 0, 'Fresho Ladies Finger, 500 g', 'Fresho-Ladies-Finger,-500-g', '<ul><li>Ladies finger is a green vegetable with a tip at the end and a lighter green head, which is inedibe and to be thrown away.</li><li>It tastes mild and slightly grassy.</li></ul><p><br></p>', '<ul><li>Refrigerate them and do not wash them until they are ready to use.</li><li>Ladies fingers are used in curries, sambhar and can be fried, stuffed and cooked.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 18.00, 17.65, -2.00, -0.35, 0, 0, 0.00, 2, 0.35, 18.00, 17.65, 18.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:17:28'),
(21, 0, 2, 0, 1, 0, 'Fresho Brinjal - 1/2 Kg', 'Fresho-Brinjal---1/2-Kg', '<p>Deep purple and oval shaped bottle brinjals are glossy skinned vegetables with a white and have a soft flesh.</p>', '<ul><li>Bottle brinjals are a nutritionally rich food item. They are rich in dietery fibres, Vitamin C and K, phytonutrient compounds and anti-oxidants.</li><li>They help in keeping cholesterol levels in check and helps in weight loss while being excellent for controlling blood sugar levels and are also known for preventing cancer and heart diseases.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 20.00, 18.63, -7.40, -1.37, 0, 0, 0.00, 2, 0.37, 19.00, 18.63, 19.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:18:31'),
(22, 0, 2, 0, 1, 0, 'Fresho Drumstick - 1/2 Kg', 'Fresho-Drumstick---1/2-Kg', '<p>Fresho brings you perfectly cut finger length pieces of drumsticks that can be cooked and added to sambhar and curries.</p>', '<ul><li>Drumsticks are rich in antioxidants that reduce the risk of heart diseases and type 2 diabetes.</li><li>It is very rich in vitamin B, C and iron.</li><li>It reduces inflammation, good for skin, teeth and bones.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 40.00, 39.22, -2.00, -0.78, 0, 0, 0.00, 2, 0.78, 40.00, 39.22, 40.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:18:54'),
(23, 0, 2, 0, 1, 0, 'Fresho Carrot 1/2 Kg', 'Fresho-Carrot-1/2-Kg', '<ul><li>A popular sweet-tasting root vegetable, Carrots are narrow and cone shaped.</li><li>They have thick, fleshy, deeply colored root, which grows underground, and feathery green leaves that emerge above the ground.</li><li>While these greens are fresh tasting and slightly bitter, the carrot roots are crunchy textured with a sweet and minty aromatic taste.</li><li>Fresho brings you the flavour and richness of the finest crispy and juicy carrots that are locally grown and the best of the region.</li></ul><p><br></p>', '<ul><li>Refrigerate carrots in a mesh bag. Alternatively to retain freshness and for more longevity, trim off the greens and put whole carrots in a container of water and refrigerate.</li><li>With this method, they stay nice and crunchy. If the water starts to look cloudy, change it with fresh water.</li><li>Stored this way, carrots can last for even a month with no ill effects and do not wilt easily.</li><li>Carrots have a mild, pleasant flavour that is great by themselves or blended with other foods.</li><li>They are even good for stuffings and in making sauces.</li><li>Carrot juice is said to be one of the most healthiest drink.</li><li>Carrot halwa is the most popular Indian sweet made out of this vegetable.</li><li>Do look up carrot jam as well.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 20.00, 19.61, -2.00, -0.39, 0, 0, 0.00, 2, 0.39, 20.00, 19.61, 20.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:19:25'),
(24, 0, 2, 0, 1, 0, 'Fresho Capsicum 1/2 Kg', 'Fresho-Capsicum-1/2-Kg', '<ul><li>Leaving a moderately pungent taste on the tongue, Green capsicums, also known as green peppers are bell shaped, medium-sized fruit pods.</li><li>They have thick and shiny skin with a fleshy texture inside.</li></ul><p><br></p>', '<ul><li>Store them in a cool, dry place away from direct sunlight. Keep capsicums dry as moisture makes them rot faster. Refrigerate the peppers unwashed, in a plastic bag and consume within a week. Resort to refrigeration only when they cannot be consumed immediately.</li><li>Green bell peppers can be used for a wide variety of dishes due to its distinct flavour and scent. Can be grilled,roasted, baked and sauteed. Widely used in salads, pastas, pizzas, pepper sauce and even for flavouring curries.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 35.00, 34.31, -2.00, -0.69, 0, 0, 0.00, 2, 0.69, 35.00, 34.31, 35.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:23:46'),
(25, 0, 3, 0, 1, 0, 'Fresho Baby Corn - Peeled, 200 g', 'Fresho-Baby-Corn---Peeled,-200-g', '<ul><li>Baby corns are small in size and handpicked before they mature.</li><li>We deliver them to you fresh and peeled, so no more postponing that corn dish you wanted to make because you didn\'t get the time.</li></ul><p><br></p>', '<ul><li>Store baby corns in loose, plastic or paper bags in the refrigerator, but not for more than 2-3 days.</li><li>Baby corns have a wide variety of uses. Toss them on your pastas, vegetable soups, stir fries, manchurian and stews.</li><li>They can be eaten raw and the entire tiny ear of the corn is edible.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 49.00, 45.10, -8.60, -3.90, 0, 0, 0.00, 2, 0.90, 46.00, 45.10, 46.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:13', '2022-05-18 02:23:25'),
(26, 0, 2, 0, 1, 0, 'Fresho Bitter Gourd, 1/2 Kg', 'Fresho-Bitter-Gourd,-1/2-Kg', '<ul><li>The most bitter among all fruits, bitter gourds come with a rough, bumpy and green skin.</li><li>The off-white translucent flesh tastes crispy with the combination of the bitter seeds that are present inside.</li></ul><p><br></p>', '<ul><li>Bitter gourd helps to overcome Type-2 Diabetes and heals liver problems.</li><li>It clears acne, builds immunity, eases digestion, cures constipation and helps in weight loss.</li><li>It prevents cancer cells from multiplying, purifies blood and has healing qualities.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 25.00, 24.51, -2.00, -0.49, 0, 0, 0.00, 2, 0.49, 25.00, 24.51, 25.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:22:58'),
(27, 0, 2, 0, 1, 0, 'Fresho Cauliflower, 1/2 Kg', 'Fresho-Cauliflower,-1/2-Kg', '<ul><li>Cauliflower is made up of tightly bound clusters of soft, crumbly, sweet cauliflower florets that form a dense head.</li><li>Resembling a classic tree, the florets are attached to a central edible white trunk which is firm and tender.</li></ul><p><br></p>', '<ul><li>One serving of cauliflower contains 77 percent of daily recommended value of vitamin C.</li><li>Cauliflowers are rich in B complex vitamins, potassium and manganese.They protect from the risk of heart diseases and brain disorders.</li><li>It also contains cancer fighting nutrient called sulforaphane.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 27.00, 24.51, -10.20, -2.49, 0, 0, 0.00, 2, 0.49, 25.00, 24.51, 25.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:22:21'),
(28, 0, 2, 0, 1, 0, 'Fresho Cabbage, 1/2 Kg', 'Fresho-Cabbage,-1/2-Kg', '<ul><li>Cabbage improves brain health and vision. Best for people who want to lose weight in a healthy way.</li><li>It detoxifies the body and contains glutamine that reduces effects of inflammation, allergies, joint pain, irritation, fever.</li><li>Cabbages also help prevent cancer.</li></ul><p><br></p>', '<ul><li>Do not cut cabbages unless you are immediately consuming as it begins to lose vitamin C when cut.</li><li>If you absolutely cannot immediately finish the remaining cabbage, wrap it tightly in plastic wrap and store it in the refrigerator for up to two days.</li><li>Keeping them in the refrigerator retains the crispiness of the vegetable.</li><li>Shredded cabbage can be directly added to any salad and sandwiches as they are most nutritious when eaten raw. Also used in pickles and flat breads.</li><li>Stew fried cabbage, onion, garlic, bell pepper and green chilies mixed with steamed rice, and soya/chili/tomato sauce is a popular favorite (Chowmein) in China and other South East Asian regions.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 22.00, 21.57, -2.00, -0.43, 0, 0, 0.00, 2, 0.43, 22.00, 21.57, 22.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:22:03'),
(29, 0, 2, 0, 1, 0, 'Fresho Snake Gourd, 1/2 Kg', 'Fresho-Snake-Gourd,-1/2-Kg', '<ul><li>Snake gourds are true to their name as they have a long, curved shape with light green speckles and a waxy green skin.</li><li>Their firm flesh is embedded with seeds and they taste like cucumber and have a slightly bitter taste.</li><li>The fruits are orange in colour when ripe and pulpy red after complete ripening.</li></ul><p><br></p>', '<ul><li>Keep snake gourds in a plastic bag or in an air tight container and refrigerate.</li><li>Snake Gourds are added to various Indian dishes like curries, dal and sambar, avial.</li><li>They can be grilled and stuffed with other vegetables too.</li><li>Also made into pickles and chutneys</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 24.00, 23.53, -2.00, -0.47, 0, 0, 0.00, 2, 0.47, 24.00, 23.53, 24.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:29:14'),
(30, 0, 2, 0, 1, 0, 'Fresho Radish - White 1/2 Kg', 'Fresho-Radish---White-1/2-Kg', '<p>Radishes are a root crop with a crunchy texture and a sharp, spicy, hot or sweet taste. They are juicy and sometimes have a pungent smell.</p>', '<ul><li>Radishes are excellent source of vitamin C.</li><li>It contains folate, fiber, riboflavin, and potassium, as well as good amounts of copper, vitamin B6.</li><li>It is composed of high dietary fibre, which is very fine for digestive tract.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 32.00, 31.37, -2.00, -0.63, 0, 0, 0.00, 2, 0.63, 32.00, 31.37, 32.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 0, '2022-05-18 02:02:14', '2022-05-18 02:28:54'),
(31, 0, 2, 0, 1, 0, 'Fresho Ginger - Organically Grown, 150 G', 'Fresho-Ginger---Organically-Grown,-150-G', '<p>It Is Organically Grown And Handpicked From Farm </p><p> Product image shown is for representation purpose only, the actually product may vary based on season, produce &amp; availability.</p>', '<p> Firm and fibrous ginger roots are stretched with multiple fingers that have light to dark tan skin and rings on it and is aromatic, spicy and pungent. The flavour gets intensified when the ginger is dried and lessens when cooked.</p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 5.00, 5.88, 15.00, 0.88, 0, 0, 0.00, 2, 0.12, 6.00, 5.88, 6.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:28:37'),
(32, 0, 1, 0, 1, 0, 'Fresho Lemon, 200 g', 'Fresho-Lemon,-200-g', '<p>With a segmented flesh that has a unique pleasant aroma and a strong sour taste, lemons are round/oval and have a yellow, texturized external peel.</p>', '<p>Refrigerate them in a sealed plastic bag.</p><p>Fresh lemon juice is squeezed and added to many dishes like lemon rice, lemon tea and beverages like lemonades. The lemon peel is also edible and highly nutritious.</p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 10.00, 11.76, 15.00, 1.76, 0, 0, 0.00, 2, 0.24, 12.00, 11.76, 12.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:27:43'),
(33, 0, 1, 0, 1, 0, 'Fresho Amla, 200 g', 'Fresho-Amla,-200-g', '<p>Fresho Amla or Indian gooseberry is a popular seller at bigbasket because it is full of nutrition and is quite tasty too. Used for centuries for ayurvedic benefits, the Amla is also a staple in various kinds of dips and chutneys. Being a versatile ingredient, it is used in more than one ways.</p>', '<p>The nutritional benefits of Amla include being rich in vitamin C, A and other similar ingredients, which help boost eye sight. They also cleanse the stomach and provide you with antioxidant benefits that help to keep the skin younger for a longer time and fights illnesses like cancer.</p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 20.00, 19.61, -2.00, -0.39, 0, 0, 0.00, 2, 0.39, 20.00, 19.61, 20.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:27:19'),
(34, 0, 2, 0, 1, 0, 'Fresho Chilli - Green 200 g', 'Fresho-Chilli---Green-200-g', '<p>Green chillis are the best kitchen ingredient to bring a dash of spiciness to recipes. The fresh flavour and sharp bite make them a must in almost all Indian dishes. This particular green chilli variety is big.</p>', '<p>Wash and dry them. Gently pull out the top stem. Throw out the spoilt ones as the famous saying goes- \"one rotten spoils the whole pack\", in this context quite literally. Keep them in a container and refrigerate. </p><p> Chillies have a wide variety of uses since it is a popular spice and seasoning. Can even be powdered to flavour the food. Used to prepare chutneys and other snacks. </p><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 15.00, 11.76, -27.60, -3.24, 0, 0, 0.00, 2, 0.24, 12.00, 11.76, 12.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:26:44'),
(35, 0, 2, 0, 0, 0, 'Fresho Mint Leaves - Cleaned, without roots, 1 Bunch', 'Fresho-Mint-Leaves---Cleaned,-without-roots,-1-Bunch', '<ul><li>Mint leaves are tender herbs with gentle stems and have a distinct pleasant aroma, pleasing taste, cool after-sensation, and medicinal qualities.</li><li>They are best used raw or added at the end of cooking in order to maintain their delicate flavor and texture.</li></ul><p><br></p>', '<ul><li>Mint is a remedy to manage ailments related to the digestive tract, oral, respiratory and skin disorders such as acne, insect bites &amp; burns.</li><li>It is found to alleviate migraine pains, minor aches, muscle sprains and cramps.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 10.00, 9.80, -2.00, -0.20, 0, 0, 0.00, 2, 0.20, 10.00, 9.80, 10.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 0, '2022-05-18 02:02:14', '2022-05-18 02:26:17'),
(36, 0, 2, 0, 0, 0, 'Fresho Coriander Leaves, 1 Bunch', 'Fresho-Coriander-Leaves,-1-Bunch', '<ul><li>Coriander leaves are green, fragile with a decorative appearance. They contain minimal aroma and have a spicy sweet taste.</li><li>Now do not bother wasting time cutting off the roots as we value your money and time and provide you the freshest leafy edible parts .</li></ul><p><br></p>', '<ul><li>Coriander leaves fight food poisoning and lower blood sugar levels.</li><li>They relieve urinary tract infections and help in maintaining a healthy menstrual cycle while preventing neurological inflammations and diseases.</li><li>Tip - Add coriander leaves to boiling water. Let it cool down and then consume it. Drink this water every morning to cleanse the stomach.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 10.00, 9.80, -2.00, -0.20, 0, 0, 0.00, 2, 0.20, 10.00, 9.80, 10.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:25:58'),
(37, 0, 2, 0, 0, 0, 'Fresho Curry Leaves, 1 Bunch', 'Fresho-Curry-Leaves,-1-Bunch', '<ul><li>Curry leaves are an essential element of Indian cooking style where numerous of the traditional and modern recipes are imperfect without curry leaves.</li><li>These are used as tasting agent in food for its different taste.With dark green and glossy appearance, curry leaves have a strong flavour and release a tasty aroma when fried in hot oil.</li></ul><p><br></p>', '<ul><li>Curry leaves are anti-diabetic and anti-carcinogenic.</li><li>They help in the better functioning of the heart. they are a good remedy for diarrhea, nausea and indigestion.</li><li>Curry leaves help improve eyesight and prevents cataract.</li><li>Consume 4-5 raw curry leaves in the morning with an empty stomach to fight diabetes and grey hair.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 10.00, 9.80, -2.00, -0.20, 0, 0, 0.00, 2, 0.20, 10.00, 9.80, 10.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:25:31'),
(38, 0, 2, 0, 1, 0, 'Fresho Broccoli - Florets, 500 g', 'Fresho-Broccoli---Florets,-500-g', '<ul><li>Fresho brings to you trimmed crowns of Broccoli that are ready to be chopped for your favorite dish.</li><li>Just give them a quick rinse first and then they\'re ready to be steamed or boiled.</li></ul><p><br></p>', '<ul><li>Broccoli prevents cancer and reduces cholesteroll.</li><li>They maintain bone and heart health.</li><li>Broccolis are good for skin, eyes, and acts as an anti ageing factor.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 100.00, 105.88, 5.60, 5.88, 0, 0, 0.00, 2, 2.12, 108.00, 105.88, 108.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 0, '2022-05-18 02:02:14', '2022-05-18 02:25:06'),
(39, 0, 2, 0, 1, 0, 'Fresho Mushrooms - Button, 1 pack (Approx .180g - 200 g)', 'Fresho-Mushrooms---Button,-1-pack-(Approx-.180g---200-g)', '<p>Buttom mushrooms are very small sized mushrooms with smooth round caps and short stems. They have a mild flavour with a good texture that becomes more fragrant and meaty when cooked.</p>', '<ul><li>Button mushrooms boost our immune system.</li><li>They have anti-cancer benefits.</li><li>They contain good amounts of riboflavin which is necessary to maintain oral health.</li><li>They are very low in calories and rich in fiber.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 45.00, 47.06, 4.40, 2.06, 0, 0, 0.00, 2, 0.94, 48.00, 47.06, 48.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:24:43'),
(40, 0, 2, 0, 1, 0, 'Fresho Coccinia, 250 g', 'Fresho-Coccinia,-250-g', '<p>The flesh of Coccinia is crunchy with a mild bitter after taste but the matured ones taste even sweeter. The translucent white flesh with seeds embedded turns red on ripening. They are oval to elongated with thick and light green skin.</p>', '<ul><li>Coccinia protects the nervous system and prevents kidney stones.</li><li>They improve metabolism and reduce fat. It acts as an anti bacterial agent.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 5.00, 6.86, 27.10, 1.86, 0, 0, 0.00, 2, 0.14, 7.00, 6.86, 7.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:24:23'),
(41, 0, 2, 0, 1, 0, 'Fresho Spring Onion - With roots, 100 g', 'Fresho-Spring-Onion---With-roots,-100-g', '<ul><li>Spring onions come with a crisp texture and sweet flavor.</li><li>They are moist with thin, white flesh and a green stem.</li><li>The green stems are hollow, bitter, and pungent.</li></ul><p><br></p>', '<ul><li>Spring onions are an excellent source of sulfur that reduces the risk of cancer and lowers blood sugar levels.</li><li>They are rich in fiber and aid digestion.</li><li>Rich in vitamin A that is needed for eyesight.</li><li>They also help fight against cold and flu.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 15.00, 19.61, 23.50, 4.61, 0, 0, 0.00, 2, 0.39, 20.00, 19.61, 20.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:35:54'),
(42, 0, 2, 0, 1, 0, 'Fresho Sweet Potato, 500 g', 'Fresho-Sweet-Potato,-500-g', '<p>With flesh colours ranging from white, orange and yellow, sweet potatoes are ovate and cylindrical with golden brown or white-brown skin and a delicious sweet flavour. </p><p> While the white fleshed are firm, orange fleshed are softer.</p>', '<ul><li>Sweet potatoes prevent diabetes and reduce blood pressure. They influence fertility.</li><li>They are advised to consume regularly during pregnancy and breast feeding.</li><li>Good for healthy digestive system, healthy eyes, teeth and gums.</li><li>Effective in reducing addiction to narcotics like cigarettes and liquor.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 20.00, 21.57, 7.30, 1.57, 0, 0, 0.00, 2, 0.43, 22.00, 21.57, 22.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 0, '2022-05-18 02:02:14', '2022-05-18 02:35:27'),
(43, 0, 2, 0, 1, 0, 'Fresho Chow Chow, 500 g', 'Fresho-Chow-Chow,-500-g', '<p>Known wordlwide for its delicious seeds, roots, shoots, flowers, leaves and fruit, Chow chow also known as Chayote, is a roughly pear-shaped, mild flavoured and green vegetable</p>', '<ul><li>Chow chow can be stored in the refrigerator. Lightly wrap it in a paper towel before placing it in a bag.</li><li>Every part of this vegetable can be consumed.</li><li>Chow Chow can be eaten raw, steamed, baked, stuffed, fried, marinated or boiled.</li><li>Its soft flesh is often used for making baby food, juices, sauces as well as pasta dishes.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 20.00, 21.57, 7.30, 1.57, 0, 0, 0.00, 2, 0.43, 22.00, 21.57, 22.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:35:10'),
(44, 0, 2, 0, 1, 0, 'Fresho Pumpkin - Organically Grown, 1 pc', 'Fresho-Pumpkin---Organically-Grown,-1-pc', '<p>It is organically grown and handpicked from farm </p><p> Product image shown is for representation purpose only, the actually product may vary based on season, produce &amp; availability. </p>', NULL, '[]', '[\"\"]', '0', '0', 0, 0, 0, 55.00, 53.92, -2.00, -1.08, 0, 0, 0.00, 2, 1.08, 55.00, 53.92, 55.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:34:53'),
(45, 0, 2, 0, 1, 0, 'Fresho Lettuce - Iceberg, 1 pc (Approx. 250g-500g)', 'Fresho-Lettuce---Iceberg,-1-pc-(Approx.-250g-500g)', '<p>Iceberg lettuce is a variety of lettuce with crisp leaves which grows in a spherical head resembling a cabbage. The leaves on the outside tend to be green and the leaves in the center go from pale yellow to nearly whitish as you move closer and closer to the center of the head with the sweetest leaves in the center of the head.</p>', '<ul><li>Lettuce provides significant amounts of vitamins A and K.</li><li>They have a high water content, making it a refreshing choice during hot weather.</li><li>They also provide calcium, potassium, vitamin C, and folate.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 67.00, 56.86, -17.80, -10.14, 0, 0, 0.00, 2, 1.14, 58.00, 56.86, 58.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:34:26'),
(46, 0, 2, 0, 1, 0, 'Fresho Basale Leaf, 250 g', 'Fresho-Basale-Leaf,-250-g', '<ul><li>hick, semi-succulent, heart-shaped basal leaves are fresh green coloured spinach that grows fast with its soft-stemmed vine.</li><li>Comes with a mild flavor and mucilaginous texture.</li></ul><p><br></p>', '<ul><li>Basale leaf is rich in Vitamin A, C, Iron and Calcium.</li><li>Low in calories per volume and high in protein per calorie.</li><li>The succulent mucilage is a particularly rich source of soluble fiber.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 16.00, 15.69, -2.00, -0.31, 0, 0, 0.00, 2, 0.31, 16.00, 15.69, 16.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:34:07'),
(47, 0, 2, 0, 1, 0, 'Fresho Papaya - Raw, 1 kg', 'Fresho-Papaya---Raw,-1-kg', '<ul><li>Fresho is our brand of fresh fruits and vegetables which are individually handpicked every day by our experienced and technically competent buyers.</li><li>Our buying, storing, and packaging processes are tailored to ensure that only the fresh, nutrient-dense, healthy, and delicious produce reaches your doorstep.</li><li>We guarantee the quality of all Fresho products.</li><li>If you\'re not satisfied with the freshness of the items, you can hand them back to our Customer Experience Executive (CEE) for a full refund.</li></ul><p><br></p>', '<ul><li>Papayas reduce the risk of macular degeneration, a disease that affects the eyes as people age.</li><li>They prevent asthma and cancer.</li><li>Mashed papayas help in wound healing and preventing infections.</li><li>Papaya contain Folic acid, Vitamin C, Amino Acid, .Papaya helps in dig</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 30.00, 32.35, 7.30, 2.35, 0, 0, 0.00, 2, 0.65, 33.00, 32.35, 33.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:33:46'),
(48, 0, 2, 0, 1, 0, 'Fresho Knol Khol, 1 kg', 'Fresho-Knol-Khol,-1-kg', '<p>Knol Khols are big, greenish white colored vegetables with long, green extrusions.They have a crispy texture and taste mildly sweet</p>', '<p>Knol Khols have a long storage capacity. Avoid peeling them until consumption. They can be refrigerated for upto 5 days.</p><p>Knol Khols are peeled or grated and added to salads and also used to prepare curries.</p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 44.00, 44.12, 0.30, 0.12, 0, 0, 0.00, 2, 0.88, 45.00, 44.12, 45.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:33:18'),
(49, 0, 2, 0, 1, 0, 'Fresho Betel Leaf, 5 pcs', 'Fresho-Betel-Leaf,-5-pcs', '<ul><li>Fresho brings to you fresh Betel Leaf. This is also called paan ka Patta.</li><li>It has many curative and healing benefits.</li><li>They are rich in vitamins like vitamin C, thiamine, niacin, riboflavin, and carotene and are a great source of calcium.</li><li>These leaves used as a stimulant, an antiseptic, and a breath freshener.</li><li>It can be batter-coated and deep-fried till absolutely crisp.</li></ul><p><br></p>', '<ul><li>Betel leaf has vitamins such as vitamin C, riboflavin, niacin, thiamine and carotene.</li><li>It is also a greater supply of calcium.</li><li>The juice from the leaf is known to have diuretic properties and assists urination when taken with diluted milk.</li><li>Local application of betel leaves relieves sore throat.</li><li>Juice of betel leaves dropped in the ear relieves earaches.\"</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 20.00, 21.57, 7.30, 1.57, 0, 0, 0.00, 2, 0.43, 22.00, 21.57, 22.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:32:58'),
(50, 0, 2, 0, 1, 0, 'Fresho Garlic - Organically Grown, 100 g', 'Fresho-Garlic---Organically-Grown,-100-g', '<p>Fresho Organic products are organically grown and handpicked by expert. </p><p> Product image shown is for representation purpose only, the actually product may vary based on season, produce &amp; availability.</p>', NULL, '[]', '[\"\"]', '0', '0', 0, 0, 0, 12.00, 12.75, 5.90, 0.75, 0, 0, 0.00, 2, 0.26, 13.00, 12.75, 13.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:32:35'),
(51, 0, 2, 0, 1, 0, 'Fresho Arai Keerai, 250 g', 'Fresho-Arai-Keerai,-250-g', '<p>\"Arai Keerai\" describes the amaranth leaves in its middles stages of growth. Arai keerai can be used to made vadai which is also a delicious evening snack that helps to boost growth and immunity. Arai keerai helps in hair growth and keeps hair problems like dandruff at bay. </p>', NULL, '[]', '[\"\"]', '0', '0', 0, 0, 0, 14.00, 14.71, 4.80, 0.71, 0, 0, 0.00, 2, 0.29, 15.00, 14.71, 15.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:32:08'),
(52, 0, 2, 0, 1, 0, 'Fresho Banana Stem - Organically Grown, 1 pc', 'Fresho-Banana-Stem---Organically-Grown,-1-pc', '<p>Banana Stem is the fibrous stalk of the banana plant. It has high water content, fresh and crispy textured stalks with mild taste. Fresho stem grade bananas are offered in a pristine condition and are tasty and nutritious. We selectively pick stems of organically grown banana stem from the best farms.</p>', '<p>Banana stem should be used fresh in a day or two to prevent spoilage. Used to make juice and curries.</p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 23.00, 24.51, 6.20, 1.51, 0, 0, 0.00, 2, 0.49, 25.00, 24.51, 25.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:31:49'),
(53, 0, 2, 0, 1, 0, 'Fresho Banana Flower - Organically Grown, 1 pc', 'Fresho-Banana-Flower---Organically-Grown,-1-pc', '<p>Banana flower, also known as banana blossom, is a tear-shaped maroon or purplish flower hanging at the end of banana clusters grows on the end of the stem holding a cluster of bananas. The edible flower has a unique and excellent taste rich in nutrients. With every purple outer sheath removed it has anthers which are edible. We selectively pick organically grown banana flower from the best farms.</p>', '<p>Banana blossoms are best used fresh. You can also cover it in zip lock bags, wrap in transparent plastic or freeze bags and store under refrigerated conditions. </p><p> Banana blossoms can be eaten raw or cooked. Flowers are used to make delicious curries. They are also used to make vadas which makes them very crispy and tasty. Banana flowers added to fish curry is an excellent combination.</p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 26.00, 26.47, 1.80, 0.47, 0, 0, 0.00, 2, 0.53, 27.00, 26.47, 27.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:31:23'),
(54, 0, 2, 0, 1, 0, 'Fresho Leeks, 100 g', 'Fresho-Leeks,-100-g', '<p>Leek is a long bundle of leaf sheaths with a mild, onion-like taste. In its raw state, the vegetable is crunchy and firm. The edible portions of the leek are the white base of the leaves (above the roots and stem base) and the light green parts.</p>', '<ul><li>Leeks can help regulate intestinal function due to their high fiber content.</li><li>Due to its anti-inflammatory and antiseptic properties, leek juice is a valuable aid for treating arthritis, gout and inflammation of the urinary tract.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 20.00, 21.57, 7.30, 1.57, 0, 0, 0.00, 2, 0.43, 22.00, 21.57, 22.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:31:02'),
(55, 0, 2, 0, 1, 0, 'Fresho Turnip, 1 kg', 'Fresho-Turnip,-1-kg', '<ul><li>With a white, firm and crunchy flesh, Turnips are made of edible roots, stem and leaves.</li><li>They are starchy and succulent with a sweet and peppery flavour.</li></ul><p><br></p>', '<ul><li>Turnip are good for the healthy functioning of heart, bone and lungs.</li><li>They help in digestion and prevents body odour. Also helps cure asthma.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 100.00, 98.04, -2.00, -1.96, 0, 0, 0.00, 2, 1.96, 100.00, 98.04, 100.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:30:44'),
(56, 0, 2, 0, 1, 0, 'Fresho Thyme, 10 g', 'Fresho-Thyme,-10-g', '<p>With a savoury mint flavour, Thyme is a delicate herb with clusters of bright green, rounded leaves around woody stems.</p>', '<ul><li>Thyme helps in easy digestion of fatty foods and helps treat diarrhea, arthritis and stomach ache.</li><li>It gives relief from whooping cough and sore throat.</li><li>It is a diuretic.</li><li>It increases urination and reduces infections related to the urinary tract.</li></ul><p><br></p>', '[]', '[\"\"]', '0', '0', 0, 0, 0, 31.00, 31.37, 1.20, 0.37, 0, 0, 0.00, 2, 0.63, 32.00, 31.37, 32.00, 0.00, 0.00, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, 1, '2022-05-18 02:02:14', '2022-05-18 02:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `loc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `pid`, `loc`, `created_at`, `updated_at`) VALUES
(1, 1, 'storage/products/1/BiGNZlpO5zEedrAI.png', '2022-05-18 02:03:34', '2022-05-18 02:03:34'),
(2, 2, 'storage/products/2/0orqJUct3tqZdgyn.png', '2022-05-18 02:04:29', '2022-05-18 02:04:29'),
(3, 3, 'storage/products/3/4TnEwBiSbQ837S7f.png', '2022-05-18 02:05:22', '2022-05-18 02:05:22'),
(4, 4, 'storage/products/4/YGVM9xUFXnuPCOTk.png', '2022-05-18 02:05:44', '2022-05-18 02:05:44'),
(5, 5, 'storage/products/5/nKFLU8fdByI0kYGp.png', '2022-05-18 02:07:29', '2022-05-18 02:07:29'),
(6, 6, 'storage/products/6/XOx3vLYT7B2K3usx.png', '2022-05-18 02:08:09', '2022-05-18 02:08:09'),
(7, 7, 'storage/products/7/g6SyN1pdKFuBS6SY.png', '2022-05-18 02:08:35', '2022-05-18 02:08:35'),
(8, 8, 'storage/products/8/1qTKqXx88vjX7FjV.png', '2022-05-18 02:10:59', '2022-05-18 02:10:59'),
(9, 9, 'storage/products/9/1Mq2lHGBQPvqKfWt.png', '2022-05-18 02:11:23', '2022-05-18 02:11:23'),
(10, 10, 'storage/products/10/gxXA0VivCHk5q29Z.png', '2022-05-18 02:11:39', '2022-05-18 02:11:39'),
(11, 11, 'storage/products/11/GSCv5LGCqO9jaHhm.png', '2022-05-18 02:11:51', '2022-05-18 02:11:51'),
(12, 12, 'storage/products/12/E4O3oGQEgHus9yRQ.png', '2022-05-18 02:12:01', '2022-05-18 02:12:01'),
(13, 13, 'storage/products/13/Kmv9erXgkJLgzXZ6.png', '2022-05-18 02:12:11', '2022-05-18 02:12:11'),
(14, 14, 'storage/products/14/wE1Qaf7tWdKPGPAo.webp', '2022-05-18 02:13:41', '2022-05-18 02:13:41'),
(15, 16, 'storage/products/16/QAFdpadwBkNlg0td.webp', '2022-05-18 02:13:55', '2022-05-18 02:13:55'),
(18, 15, 'storage/products/15/R0KtZFoEnLX8ShFE.webp', '2022-05-18 02:15:05', '2022-05-18 02:15:05'),
(19, 17, 'storage/products/17/yh62V21Q9fOKuWsQ.webp', '2022-05-18 02:15:38', '2022-05-18 02:15:38'),
(20, 18, 'storage/products/18/Njd0G8p0Jv820FKh.webp', '2022-05-18 02:16:07', '2022-05-18 02:16:07'),
(21, 19, 'storage/products/19/OvWlttaAHqlX4kh6.webp', '2022-05-18 02:17:04', '2022-05-18 02:17:04'),
(22, 20, 'storage/products/20/tGk6bajxVQdYgtNz.webp', '2022-05-18 02:17:20', '2022-05-18 02:17:20'),
(23, 21, 'storage/products/21/w0iIXKtUBLcciga7.webp', '2022-05-18 02:18:29', '2022-05-18 02:18:29'),
(24, 22, 'storage/products/22/rsLrK3dy3MOBvXe6.webp', '2022-05-18 02:18:51', '2022-05-18 02:18:51'),
(25, 23, 'storage/products/23/33k1scJf4ILg8deK.jpg', '2022-05-18 02:19:19', '2022-05-18 02:19:19'),
(26, 28, 'storage/products/28/7JtMHyc9cFuPJdy8.webp', '2022-05-18 02:21:52', '2022-05-18 02:21:52'),
(27, 27, 'storage/products/27/euylwATCTHlBHYnr.webp', '2022-05-18 02:22:18', '2022-05-18 02:22:18'),
(28, 26, 'storage/products/26/W4EdTNte8sVFnn8q.webp', '2022-05-18 02:22:56', '2022-05-18 02:22:56'),
(29, 25, 'storage/products/25/ZMOqFEv4Ys9pcSHC.webp', '2022-05-18 02:23:16', '2022-05-18 02:23:16'),
(30, 24, 'storage/products/24/Sz8mIU9Wu45BlR8t.webp', '2022-05-18 02:23:42', '2022-05-18 02:23:42'),
(31, 40, 'storage/products/40/672ZRUlDfXPm9ghi.webp', '2022-05-18 02:24:20', '2022-05-18 02:24:20'),
(32, 39, 'storage/products/39/Qj76FHBjsv55PzbC.webp', '2022-05-18 02:24:40', '2022-05-18 02:24:40'),
(33, 38, 'storage/products/38/bQsFiYtiA4tj2ixQ.webp', '2022-05-18 02:25:05', '2022-05-18 02:25:05'),
(34, 37, 'storage/products/37/bQsdtHPjAaeC9RNd.webp', '2022-05-18 02:25:23', '2022-05-18 02:25:23'),
(35, 36, 'storage/products/36/2lbTsWmXvjzOiL0C.webp', '2022-05-18 02:25:54', '2022-05-18 02:25:54'),
(36, 35, 'storage/products/35/R58hLvwIvpzmC9TD.webp', '2022-05-18 02:26:16', '2022-05-18 02:26:16'),
(37, 34, 'storage/products/34/785Ghzx7JHAwC70j.webp', '2022-05-18 02:26:43', '2022-05-18 02:26:43'),
(39, 33, 'storage/products/33/mGg4WGyH6hCj6B5t.webp', '2022-05-18 02:26:59', '2022-05-18 02:26:59'),
(40, 32, 'storage/products/32/aBkgW5X1Mw8PpWpd.webp', '2022-05-18 02:27:41', '2022-05-18 02:27:41'),
(41, 31, 'storage/products/31/Qyv2ue9dgh9f4MIX.webp', '2022-05-18 02:28:34', '2022-05-18 02:28:34'),
(42, 30, 'storage/products/30/h63L8bj7aMC4cz3y.webp', '2022-05-18 02:28:52', '2022-05-18 02:28:52'),
(43, 29, 'storage/products/29/OJt36S27I8XBpbsP.webp', '2022-05-18 02:29:11', '2022-05-18 02:29:11'),
(44, 56, 'storage/products/56/qCaobDU1uDkfvhjO.webp', '2022-05-18 02:30:25', '2022-05-18 02:30:25'),
(45, 55, 'storage/products/55/bN7YF4JuuNTYPv0T.webp', '2022-05-18 02:30:43', '2022-05-18 02:30:43'),
(46, 54, 'storage/products/54/ei0HhkmH3hmHd82Z.webp', '2022-05-18 02:30:57', '2022-05-18 02:30:57'),
(47, 53, 'storage/products/53/KEog7A72zAltbULq.webp', '2022-05-18 02:31:20', '2022-05-18 02:31:20'),
(48, 52, 'storage/products/52/GkD5948vG0r8kAXY.webp', '2022-05-18 02:31:41', '2022-05-18 02:31:41'),
(49, 51, 'storage/products/51/lQpgmHkrEdDdjEsE.webp', '2022-05-18 02:32:02', '2022-05-18 02:32:02'),
(50, 50, 'storage/products/50/XxI5Vi4IjPfkclxh.webp', '2022-05-18 02:32:30', '2022-05-18 02:32:30'),
(51, 49, 'storage/products/49/LfMnGPFjDUDhD5uv.webp', '2022-05-18 02:32:56', '2022-05-18 02:32:56'),
(52, 48, 'storage/products/48/PY6Avk4WjEGtWUre.webp', '2022-05-18 02:33:15', '2022-05-18 02:33:15'),
(53, 47, 'storage/products/47/0GV8BsKWTiw9K3T9.webp', '2022-05-18 02:33:35', '2022-05-18 02:33:35'),
(54, 46, 'storage/products/46/PRinPulENy9dZN4C.webp', '2022-05-18 02:34:03', '2022-05-18 02:34:03'),
(55, 45, 'storage/products/45/YjY4OKxHZbwr0zdM.webp', '2022-05-18 02:34:24', '2022-05-18 02:34:24'),
(56, 44, 'storage/products/44/07ptHPkebCOk3snk.webp', '2022-05-18 02:34:50', '2022-05-18 02:34:50'),
(57, 43, 'storage/products/43/BvmkntJNaqM0jWec.webp', '2022-05-18 02:35:07', '2022-05-18 02:35:07'),
(58, 42, 'storage/products/42/6LF5esmFjBtQGs99.webp', '2022-05-18 02:35:23', '2022-05-18 02:35:23'),
(59, 41, 'storage/products/41/HvOD5fIbIBPZOkU3.webp', '2022-05-18 02:35:51', '2022-05-18 02:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` smallint(6) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtype` smallint(6) NOT NULL,
  `optid` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subdata` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minreq` smallint(6) NOT NULL DEFAULT 0,
  `minreqdet` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minreqdata` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enddate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oneuse` tinyint(1) NOT NULL DEFAULT 0,
  `noofuse` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ret_can_orders`
--

CREATE TABLE `ret_can_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oid` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `type` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `status` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `refundstatus` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `paytype` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `error` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderid` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payrazorpaymentid` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refundrazorpaymentid` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderAmount` double(15,2) NOT NULL DEFAULT 0.00,
  `amount_refunded` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `bid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `pid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `review` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Name', 'Name', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(2, 'AD1', 'AD1', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(3, 'AD2', 'AD2', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(4, 'AD3', 'AD3', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(5, 'City', 'City', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(6, 'State', 'State', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(7, 'Pincode', 'Pincode', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(8, 'Country', 'Country', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(9, 'PANNO', 'PANNO', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(10, 'GSTNO', 'GSTNO', '2022-05-18 01:50:37', '2022-05-18 01:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `general` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`general`)),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `general`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ABC', NULL, 0, '2022-05-18 02:38:12', '2022-05-18 02:38:12'),
(2, 'DEF', '{\"location\":\"DEfz\"}', 0, '2022-05-18 02:43:21', '2022-05-18 02:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s_e_o_s`
--

CREATE TABLE `s_e_o_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s_e_o_s`
--

INSERT INTO `s_e_o_s` (`id`, `page`, `title`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'Home', 'Home', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(2, 'NewProducts', 'NewProducts', 'NewProducts', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(3, 'HotDeals', 'HotDeals', 'HotDeals', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(4, 'TrendingProducts', 'TrendingProducts', 'TrendingProducts', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(5, 'AllProducts', 'AllProducts', 'AllProducts', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(6, 'TopSelling', 'TopSelling', 'TopSelling', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(7, 'Category', 'Category', 'Category', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(8, 'Brand', 'Brand', 'Brand', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(9, 'Contact Us', 'Contact Us', 'Contact Us', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(10, 'Terms&Cond', 'Terms&Cond', 'Terms&Cond', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(11, 'ShippingPolicy', 'ShippingPolicy', 'ShippingPolicy', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(12, 'PrivacyPolicy', 'PrivacyPolicy', 'PrivacyPolicy', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(13, 'RefundPolicy', 'RefundPolicy', 'RefundPolicy', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(14, 'ReturnPolicy', 'ReturnPolicy', 'ReturnPolicy', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(15, 'AboutUS', 'AboutUS', 'AboutUS', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(16, 'FAQ', 'FAQ', 'FAQ', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(17, 'Profile', 'Profile', 'Profile', '2022-05-18 01:50:37', '2022-05-18 01:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Fruit', '2022-05-18 01:53:05', '2022-05-18 01:53:05'),
(2, 'Vegetable', '2022-05-18 01:53:05', '2022-05-18 01:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `subscribe` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phno`, `email_verified_at`, `type`, `status`, `subscribe`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '8825867355', '2022-05-18 01:50:37', 2, 1, 1, '$2y$10$9O3urEsYSTFe0jJU8RpYE.2moV2SuNPy5cmeH29SLhKhoz8zoKXFG', 'dIwCkUaErf4TPXPWaJkqJQVVLGI0X2ryuNnpjQPSG8pwJ5U66KxOOJjewH0R', '2022-05-18 01:50:37', '2022-05-18 01:50:37'),
(2, 'Shop Owner', 'so@admin.com', '8825867351', '2022-05-18 01:50:37', 1, 1, 1, '$2y$10$GMbXIYUybDktzaTVoqSisO.ApHKTFFCQEx1B88Jjz.8Vy5v.X.BFa', NULL, '2022-05-18 01:50:37', '2022-05-18 01:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `u_o_m_s`
--

CREATE TABLE `u_o_m_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `u_o_m_s`
--

INSERT INTO `u_o_m_s` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kg', '2022-05-18 01:53:18', '2022-05-18 01:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `wish_lists`
--

CREATE TABLE `wish_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wish_lists`
--

INSERT INTO `wish_lists` (`id`, `uid`, `pid`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2022-05-18 02:47:48', '2022-05-18 02:47:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_interactions`
--
ALTER TABLE `customer_interactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_product_views`
--
ALTER TABLE `customer_product_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_m_s`
--
ALTER TABLE `c_m_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loggers`
--
ALTER TABLE `loggers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_subs`
--
ALTER TABLE `orders_subs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_manages`
--
ALTER TABLE `order_manages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `o_t_p_s`
--
ALTER TABLE `o_t_p_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packings`
--
ALTER TABLE `packings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_collections`
--
ALTER TABLE `pages_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin_codes`
--
ALTER TABLE `pin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ret_can_orders`
--
ALTER TABLE `ret_can_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_e_o_s`
--
ALTER TABLE `s_e_o_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phno_unique` (`phno`);

--
-- Indexes for table `u_o_m_s`
--
ALTER TABLE `u_o_m_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_interactions`
--
ALTER TABLE `customer_interactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customer_product_views`
--
ALTER TABLE `customer_product_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_m_s`
--
ALTER TABLE `c_m_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loggers`
--
ALTER TABLE `loggers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_subs`
--
ALTER TABLE `orders_subs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_manages`
--
ALTER TABLE `order_manages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_t_p_s`
--
ALTER TABLE `o_t_p_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packings`
--
ALTER TABLE `packings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages_collections`
--
ALTER TABLE `pages_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pin_codes`
--
ALTER TABLE `pin_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ret_can_orders`
--
ALTER TABLE `ret_can_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_e_o_s`
--
ALTER TABLE `s_e_o_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `u_o_m_s`
--
ALTER TABLE `u_o_m_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wish_lists`
--
ALTER TABLE `wish_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
