-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2020 at 04:38 AM
-- Server version: 10.4.10-MariaDB
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
-- Database: `incentive_db`
--
CREATE DATABASE IF NOT EXISTS `incentive_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `incentive_db`;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(6, '2016_06_01_000004_create_oauth_clients_table', 2),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auditrail`
--

DROP TABLE IF EXISTS `tbl_auditrail`;
CREATE TABLE IF NOT EXISTS `tbl_auditrail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

DROP TABLE IF EXISTS `tbl_bank`;
CREATE TABLE IF NOT EXISTS `tbl_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_kh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id`, `name`, `name_kh`, `code`, `address`, `remark`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 'ABA', NULL, '008', 'Address', 'ABA Bank', 1, '2020-05-21 04:45:52', '2020-05-21 04:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cabinet`
--

DROP TABLE IF EXISTS `tbl_cabinet`;
CREATE TABLE IF NOT EXISTS `tbl_cabinet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_cabinet`
--

INSERT INTO `tbl_cabinet` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ឯកឧត្តម្ភអគ្គមណ្ឌិតសភាចារ្យអូនព័ន្ធមន្នីរដ្ឋ', '2020-05-22 00:00:00', '2020-05-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_circular`
--

DROP TABLE IF EXISTS `tbl_circular`;
CREATE TABLE IF NOT EXISTS `tbl_circular` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `achivement` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `incentive` int(3) NOT NULL DEFAULT 0,
  `shape` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_by` int(4) NOT NULL,
  `order_level` int(4) NOT NULL DEFAULT 0,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_circular`
--

INSERT INTO `tbl_circular` (`id`, `achivement`, `incentive`, `shape`, `color`, `modified_by`, `order_level`, `remark`, `created_at`, `updated_at`) VALUES
(2, '៨៦%-១០០%', 100, 'square', 'green', 1, 1, NULL, '2020-05-21 05:46:03', '2020-05-21 05:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_configuration`
--

DROP TABLE IF EXISTS `tbl_configuration`;
CREATE TABLE IF NOT EXISTS `tbl_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword` (`keyword`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_configuration`
--

INSERT INTO `tbl_configuration` (`id`, `group`, `name`, `keyword`, `value`) VALUES
(1, 'General', 'Sort Order', 'SORT', 'desc'),
(2, 'General', 'Offset', 'OFFSET', '0'),
(3, 'General', 'Limit', 'LIMIT', '1'),
(4, 'General', 'Order', 'ORDER', 'desc'),
(5, 'General', 'Before Christ', 'BC', '២៥៦៣'),
(6, 'General', 'Year of Khmer', 'YEAR_KHMER', 'កុរ ឯកស័ក  ព.ស. ២៥៦៣'),
(7, 'General', 'Year', 'YEAR', '២០២០'),
(8, 'General', 'Company', 'COMPANY', 'PFMRP'),
(9, 'General', 'Address', 'ADDRESS', 'PFMRP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currency`
--

DROP TABLE IF EXISTS `tbl_currency`;
CREATE TABLE IF NOT EXISTS `tbl_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `abbreviation` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol_left` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol_right` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(4) NOT NULL,
  `modified_by` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_currency`
--

INSERT INTO `tbl_currency` (`id`, `name`, `code`, `rate`, `abbreviation`, `symbol_left`, `symbol_right`, `remark`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Reil', 'CD01', 4000, 'R', NULL, '៛', 'Remark', 1, 1, '2020-05-21 04:45:21', '2020-05-21 04:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE IF NOT EXISTS `tbl_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modified_by` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `modified_by`, `name`, `created_at`, `updated_at`) VALUES
(3, 1, 'Department', '2020-05-20 07:40:27', '2020-05-20 07:40:27'),
(4, 1, 'Department', '2020-05-20 08:13:20', '2020-05-20 08:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_document_bank`
--

DROP TABLE IF EXISTS `tbl_document_bank`;
CREATE TABLE IF NOT EXISTS `tbl_document_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_bank_id` int(11) NOT NULL,
  `incentive_id` int(11) DEFAULT NULL,
  `document_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `objective` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `send_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(4) NOT NULL,
  `updated_by` int(4) NOT NULL,
  `is_approve` tinyint(1) NOT NULL DEFAULT 0,
  `send_all_entity` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `incentive_id` (`incentive_id`),
  KEY `incentive_id_2` (`incentive_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_document_cabinet`
--

DROP TABLE IF EXISTS `tbl_document_cabinet`;
CREATE TABLE IF NOT EXISTS `tbl_document_cabinet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) DEFAULT NULL,
  `cabinet_id` int(11) NOT NULL,
  `document_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `objective` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `send_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(4) NOT NULL,
  `updated_by` int(4) NOT NULL,
  `is_approve` tinyint(1) NOT NULL DEFAULT 0,
  `send_all_entity` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `incentive_id` (`incentive_id`),
  KEY `incentive_id_2` (`incentive_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_document_template`
--

DROP TABLE IF EXISTS `tbl_document_template`;
CREATE TABLE IF NOT EXISTS `tbl_document_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type_id` int(11) NOT NULL,
  `document_name` int(11) NOT NULL,
  `description` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_document_type`
--

DROP TABLE IF EXISTS `tbl_document_type`;
CREATE TABLE IF NOT EXISTS `tbl_document_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `order_level` int(4) NOT NULL DEFAULT 0,
  `created_by` int(4) NOT NULL,
  `modified_by` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_document_type`
--

INSERT INTO `tbl_document_type` (`id`, `document_type`, `order_level`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Document Type', 0, 1, 1, '2020-05-22 02:58:56', '2020-05-22 02:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_duty`
--

DROP TABLE IF EXISTS `tbl_duty`;
CREATE TABLE IF NOT EXISTS `tbl_duty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modified_by` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_duty`
--

INSERT INTO `tbl_duty` (`id`, `modified_by`, `name`, `created_at`, `updated_at`) VALUES
(2, 1, 'Duty', '2020-05-21 03:30:42', '2020-05-21 03:30:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entity`
--

DROP TABLE IF EXISTS `tbl_entity`;
CREATE TABLE IF NOT EXISTS `tbl_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_id` int(4) DEFAULT NULL,
  `department_id` int(4) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abbreviation` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incentive`
--

DROP TABLE IF EXISTS `tbl_incentive`;
CREATE TABLE IF NOT EXISTS `tbl_incentive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attach_fille` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(4) NOT NULL,
  `updated_by` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incentive_bank`
--

DROP TABLE IF EXISTS `tbl_incentive_bank`;
CREATE TABLE IF NOT EXISTS `tbl_incentive_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incentive_data`
--

DROP TABLE IF EXISTS `tbl_incentive_data`;
CREATE TABLE IF NOT EXISTS `tbl_incentive_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_id` int(11) NOT NULL,
  `offier_id` int(11) DEFAULT NULL,
  `incentive_offier_id` int(11) NOT NULL,
  `bank` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identity_card` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `index` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `achievement` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `incentive_amount` float(10,4) NOT NULL,
  `tax` float(10,4) DEFAULT NULL,
  `return_amount` float(10,4) DEFAULT NULL,
  `incentive_after_tax` float(10,4) DEFAULT NULL,
  `reminder_amount` float(10,4) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `incentive_date` datetime DEFAULT NULL,
  `is_notify` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identity_card` (`identity_card`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incentive_officer`
--

DROP TABLE IF EXISTS `tbl_incentive_officer`;
CREATE TABLE IF NOT EXISTS `tbl_incentive_officer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `officer_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(4) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duty` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone_1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone_2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_bank_acc` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_by` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_by` int(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_incentive_officer`
--

INSERT INTO `tbl_incentive_officer` (`id`, `officer_id`, `user_id`, `title`, `first_name`, `last_name`, `duty`, `entity`, `gender`, `address`, `email`, `bank_account_no`, `bank_name`, `bank_code`, `telephone_1`, `telephone_2`, `updated_bank_acc`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'GF2343', 0, 'Mr', 'Lim', 'Macheng', 'ប្រធាន', '17-គណៈកម្មការមូលបត្រកម្ពុជា', 'Male', NULL, NULL, '456789', 'Acelida', '0987', '081397071', '012876723', '09865678', 1, NULL, 1, '2020-05-21 06:05:47', '2020-05-21 06:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incentive_request`
--

DROP TABLE IF EXISTS `tbl_incentive_request`;
CREATE TABLE IF NOT EXISTS `tbl_incentive_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_officer_id` int(11) NOT NULL,
  `request_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinytext COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `request_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_by` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

DROP TABLE IF EXISTS `tbl_notification`;
CREATE TABLE IF NOT EXISTS `tbl_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notification_title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification_type`
--

DROP TABLE IF EXISTS `tbl_notification_type`;
CREATE TABLE IF NOT EXISTS `tbl_notification_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_notification_type`
--

INSERT INTO `tbl_notification_type` (`id`, `notification_type`, `remark`) VALUES
(1, 'Notification Type', 'Notification Remark');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth_access_tokens`
--

DROP TABLE IF EXISTS `tbl_oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `tbl_oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_oauth_access_tokens`
--

INSERT INTO `tbl_oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('3e96708d4c33307b7edcadbadec7828b1456acf45de9f24d3cefb890c36ad800e9f104ef2df59319', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-17 21:28:48', '2020-05-17 21:28:48', '2020-05-25 04:28:48'),
('b3d11b71cfaee0683f275e317a7871b7d40cb6d7b0ec7edbc6d51ec9476773efd281906a9628f976', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-17 21:28:56', '2020-05-17 21:28:56', '2020-05-25 04:28:56'),
('4f0bb51d07934c65fe7fca6f4ae7392872932d41251877a902b4844db359621c9c2e401557179250', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-17 21:28:58', '2020-05-17 21:28:58', '2020-05-25 04:28:58'),
('a615d854d8fda993aed0053b67320d7a357557df34014c45781772db65d176c5561ed32b963cdc69', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-17 21:29:00', '2020-05-17 21:29:00', '2020-05-25 04:29:00'),
('6b229aee2738d73773b3596f18ed3415c79c7b533da838aa1ae501b3a6464f9e4ee67f9af0099359', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-17 21:29:02', '2020-05-17 21:29:02', '2020-05-25 04:29:02'),
('4bed28baa906b566701284c2fb478b001ef0866a93658d42089d007dcf8d558c38f35376f24b4aeb', 1, 1, 'Personal Access Token', '[]', 1, '2020-05-17 21:29:04', '2020-05-17 21:29:04', '2020-05-25 04:29:04'),
('82780ad92b615478a8a5db9d461fec8c16126cf354bdcb0ee1ea8a000a1b130fc1380477fb00e86f', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-17 22:00:42', '2020-05-17 22:00:42', '2020-05-25 05:00:42'),
('2ce1bbe04477d04e8211e9777723375021c06078a02c27cd2cd746aea690f195962e4130cebcfb73', 1, 1, 'Personal Access Token', '[]', 1, '2020-05-17 22:00:52', '2020-05-17 22:00:52', '2020-05-25 05:00:52'),
('5379a9a538801601a99c35dd837896167cde4d08609baeae034ccc210485303f7b7ef378ef256345', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-17 23:21:53', '2020-05-17 23:21:53', '2020-05-25 06:21:53'),
('1f3a6118f284306e42a9d356287af76b551b2911e2384a10c3c03c9ffa0ccd44af320c683250eb5f', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-17 23:22:45', '2020-05-17 23:22:45', '2020-05-25 06:22:45'),
('11919ec167ae2ff23c3803f8efdb3f2c7e344acc7b20975e2a1ac6d8bb2eae797a98ef2d438d878b', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-19 23:37:13', '2020-05-19 23:37:13', '2020-05-27 06:37:13'),
('f5f5dfc4e104651890c44d83b75beb8366aa86ede2f69cd56e0798ec677802e7292deae5337685c8', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-20 01:24:02', '2020-05-20 01:24:02', '2020-05-27 08:24:02'),
('80ca04e1d6b0bcb8ca474c8ce4362876da184526357c592f341c9bb25b9cc3334d607d1f22bec6b7', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-20 01:24:07', '2020-05-20 01:24:07', '2020-05-27 08:24:07'),
('96f7d82dd60e934c4996f00445af45b332890e958484b10c4bc588306d623b6987f842c4d93bc9c4', 1, 1, 'Personal Access Token', '[]', 1, '2020-05-20 01:24:09', '2020-05-20 01:24:09', '2020-05-27 08:24:09'),
('a6ed84a083d8baaf39f83c7c43f693cbc289e100f6e9545a22a7d9f6dfe9db0dd08c69784ae149ff', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-20 01:27:51', '2020-05-20 01:27:51', '2020-05-27 08:27:51'),
('53b0d1d080aa7d50f0c6233328fa2538a56a461a60434a0d8f039b589231e30758952c348ec64491', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-20 01:28:01', '2020-05-20 01:28:01', '2020-05-27 08:28:01'),
('742fa85dd2c008b4c6cdcd65e20668d65af89b72f7980a2ed4a4c4e6404654ffbc8240a75396045e', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-20 01:29:22', '2020-05-20 01:29:22', '2020-05-27 08:29:22'),
('fc9e804220f8ac78229ece554ce1eac29f58025813d14d51b8f8933bdeb7b00d241efcc839750fd8', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-20 01:29:25', '2020-05-20 01:29:25', '2020-05-27 08:29:25'),
('b07b705a7022ce6842f124cfd107ca6fbfb1dbfb151e47f23035d83a011ae844bf5ed978e6cea88e', 1, 1, 'Personal Access Token', '[]', 1, '2020-05-20 01:29:48', '2020-05-20 01:29:48', '2020-05-27 08:29:48'),
('9be8a45c7ea6899ee736864231e4fd7f4f4f0afc54e793c9ff5228e751de79d456ed7d534b4bcfaa', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-20 01:30:18', '2020-05-20 01:30:18', '2020-05-27 08:30:18'),
('721438a8ca4e9e473b2d58bd808d03dfd534ab5078415ccc79116a343401789b028e5af9ece9c112', 1, 1, 'Personal Access Token', '[]', 1, '2020-05-20 01:32:04', '2020-05-20 01:32:04', '2020-05-27 08:32:04'),
('20d58bb9a946710d43e6ae100b9839bc1ab8bbcbca7b848a3c25cfb0d9106ce80abd77512a836dfa', 1, 1, 'Personal Access Token', '[]', 0, '2020-05-20 01:32:52', '2020-05-20 01:32:52', '2020-05-27 08:32:52'),
('626f97d59f16fe458bf9edfc037c329b9c4ba4d4ff5e4c71e8679c88f171141ebf872ca7c6c43d17', 1, 1, 'Personal Access Token', '[]', 0, '2020-06-02 00:12:35', '2020-06-02 00:12:35', '2020-06-09 07:12:36'),
('6049c5ea3461f33083458497555588f16016aa5301809da8e68b0307f2dcd81346c556d5f0b09d7b', 1, 1, 'Personal Access Token', '[]', 0, '2020-06-02 00:22:27', '2020-06-02 00:22:27', '2020-06-09 07:22:28'),
('0f39b36963c281e727e30568a012b6b44c9682089226cf102427f58d3e6054ff1d8521255b117e35', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:45:10', '2020-06-02 18:45:10', '2020-06-10 01:45:10'),
('fde3425bc28c1fd5b383d85562c7e65367b571ef940402d79bcb84248f6350a14eacc8f419ae8e84', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:45:30', '2020-06-02 18:45:30', '2020-06-10 01:45:30'),
('c02ce9a0b7f5d6989741f6c59e02baecf0fea8c452fade523dbe71ff54e2e78151a416ff5e4e817e', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:54:29', '2020-06-02 18:54:29', '2020-06-10 01:54:29'),
('f3defd1baeaa19cac0ed3eec8bf773ba57607fba71965ff9516a7bcb2e1e5929a50a3ddfb536729e', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:54:53', '2020-06-02 18:54:53', '2021-06-03 01:54:53'),
('8c5c53f3b023bf65713a4ee54463676f4e07088651a416755368050bd23dc2e265503ee2eeb41ba9', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:55:03', '2020-06-02 18:55:03', '2021-06-03 01:55:03'),
('b96de246f968bea456a456d9fff3dbe79ee027f7fd7a74a851ddb756fd72f400d65a25c1839a95fb', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:55:58', '2020-06-02 18:55:58', '2021-06-03 01:55:58'),
('53174c39a526b98f2baa3a97c4a0fca5fe6ad3224d81abbd10078aa0cd967392795ce19cbe77c4eb', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:59:02', '2020-06-02 18:59:02', '2021-06-03 01:59:02'),
('688350278b84b23f125d228b9a4d4fee26376791ab6d9956945b4f79243ac3aac7a16010d3e97c15', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:59:37', '2020-06-02 18:59:37', '2021-06-03 01:59:37'),
('2990114271b69abf5b634c5254a4475e6dce0778fb6be38aeb3e1bfe4567f67264a488f58963cb8f', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:59:43', '2020-06-02 18:59:43', '2021-06-03 01:59:43'),
('8412dcbc238ae4721dbec56a1e9c3402ff6a2edf0288e995a42c5b88ad496f876500c5df940f23cd', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 18:59:58', '2020-06-02 18:59:58', '2021-06-03 01:59:58'),
('257ee04c075101f43c2feb7db7439f4d91fb9b95ef9bb7320b928bce90af4b33c593d01de135f82b', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:05:24', '2020-06-02 19:05:24', '2021-06-03 02:05:24'),
('e94e97fb214b01c58b225c8bcc2a10dad5ca8658396e68d5f5ed52d62c8e2a2492b1f5a1072eaba3', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:05:38', '2020-06-02 19:05:38', '2021-06-03 02:05:38'),
('af561e1538479b57126e8737486f138571003ddf56096bb27141bbf1eead2a21cda8568303c1c461', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:06:01', '2020-06-02 19:06:01', '2021-06-03 02:06:01'),
('7c8e761afd76f8afeb36357634abf8bb238f5670a23988a0e543a26ee14cf38f4d4803026e579e73', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:06:55', '2020-06-02 19:06:55', '2021-06-03 02:06:55'),
('26ced17ac62ffa94d78d593fe2b37c180d0d6d25b1c6040390a489e8dfd395564f888633646601cc', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:07:36', '2020-06-02 19:07:36', '2021-06-03 02:07:36'),
('e8fd2f21f3a46ba4aa771fb33ccac7f557ee3fd3054966af6ca27e28399570187b90d2fd5a623541', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:08:04', '2020-06-02 19:08:04', '2020-06-10 02:08:04'),
('f87bd8cfa297a161cf971549399c2e0a3fa3aa8a04aacbe5f38565f0cdefe4888c5448ec5bd1ab01', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:39:43', '2020-06-02 19:39:43', '2021-06-03 02:39:43'),
('a770435bb57148e3e9b91686f6f262c32992c0bf7a6738b4424e92579e30b5ff3599f458365be29b', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:41:13', '2020-06-02 19:41:13', '2021-06-03 02:41:13'),
('906f02702bdf5588edea94deff16e3e9901b81619c0b4cf05b79812bd8406dfd65acc02a80aed56c', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:41:25', '2020-06-02 19:41:25', '2021-06-03 02:41:25'),
('020afc7511abbd58aa9953f9bebce142705d48335742a736cb71a8c7d60b640dc3263107b3fa554e', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:42:12', '2020-06-02 19:42:12', '2021-06-03 02:42:12'),
('630a132935400f68ff5eedcfe947c6bc2bc422605427bca71320bd4b95af4329bfbff89df98c139b', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:42:27', '2020-06-02 19:42:27', '2021-06-03 02:42:27'),
('c485ad261a4a6cd3b34b78914faabc4475215353055c1f52f4647163aa11214eff39bec680c2d4a3', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:42:34', '2020-06-02 19:42:34', '2021-06-03 02:42:34'),
('0971c27a15957ba6bea59bed641d8db457875372855f3e78945029c6e47d9f5d19c1b151c3a55b3d', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:49:25', '2020-06-02 19:49:25', '2021-06-03 02:49:25'),
('4f20a54f9c5b6255a8393b2b9ac4f43e5aab4e17eacbdbe599ab48dcaf10be7aa34e67b397b9bf06', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:55:31', '2020-06-02 19:55:31', '2021-06-03 02:55:31'),
('dbecff0b7836b50bfe9a684d69b68f9bf46861d14421c3ecb38629ce0e7c5078707199421d36f6a1', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:55:37', '2020-06-02 19:55:37', '2021-06-03 02:55:37'),
('896de0da24cd4f38fe19c8405cb710a5ac45ea6a8ae5f3ad3f4ee176acdb9923ea513b032f43e290', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 19:56:28', '2020-06-02 19:56:28', '2021-06-03 02:56:28'),
('9d02baaf83967949167d3911d5ad050637c5224874b39c39f2aed4d1ac82782e24a9151af3b9a35b', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 20:02:26', '2020-06-02 20:02:26', '2021-06-03 03:02:26'),
('b7ea7681632824f19ada34b4429e1508a633b03f42d501be716c2309760d4fb0ddbd4dc824d1c653', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 20:04:12', '2020-06-02 20:04:12', '2021-06-03 03:04:12'),
('b8f5c698a5f2c5bd66232c2397c0e5556a66f25cb5bb8eb5c42e88364e0326f98418022b7fb992ac', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 20:07:12', '2020-06-02 20:07:12', '2021-06-03 03:07:12'),
('1ce32207da1daf168da163c5264b94d84965ccf2be882a98db70fee5a99b7c8b95b56c5cd362ae17', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 20:07:23', '2020-06-02 20:07:23', '2021-06-03 03:07:23'),
('92db0c231751c1db29d6ba859a5bd31e8202d5286bd807c5a86d420b72f57e5f6a82c6d6947f3d6a', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 20:11:08', '2020-06-02 20:11:08', '2021-06-03 03:11:08'),
('c027aa1774a9e3597c6cc0409026aa87ee4dd8b9df727b9ca1b0103c148c6fd9f25517bc0ef33060', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 20:58:52', '2020-06-02 20:58:52', '2020-06-10 03:58:53'),
('bb8a88aa790353e1f6cc8c10f34252b9bbbed0d3bdd51a8264853d38a0f2f064fd29c195fe67e416', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:00:42', '2020-06-02 21:00:42', '2020-06-10 04:00:42'),
('c4513441ee17fd1de6a526c8b8d7a90f979722cb926593c0332844335c35857729ba1d38098c36fc', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:01:27', '2020-06-02 21:01:27', '2020-06-10 04:01:27'),
('9fd5944702e369b31fbf54c9085ad252a1d550af888a2247e606b848f86bb41bedd81f4ba4ae1ea7', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:08:21', '2020-06-02 21:08:21', '2021-06-03 04:08:21'),
('6cc54288437df36ff19eabb12c8c6a9fdc358a0a532916631250dfb3e9dfd0690e0335866831f8b6', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:15:09', '2020-06-02 21:15:09', '2020-06-10 04:15:09'),
('1ae83212c9ba4dffdc8e427962fed0fdc826f9d743c2a12d45e32b9d99cb3f44a1efbbd6e609fd77', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:25:07', '2020-06-02 21:25:07', '2021-06-03 04:25:07'),
('967d558b8be696b7afd4e1ad9c2123537deedfb38b22a2410be3025694317a57797e2bcaec97813e', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:25:40', '2020-06-02 21:25:40', '2021-06-03 04:25:40'),
('5d19d310c25f45988186c3b662f91cd7ebc2f0581c270025028a7b8ca54ebdd48d65933f79834243', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:26:32', '2020-06-02 21:26:32', '2021-06-03 04:26:32'),
('4611c543641c20b8a89114fd48c3bbce706ad5f8abe6fd42b8de76a809041468d9a4040f49f9eae2', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:27:45', '2020-06-02 21:27:45', '2021-06-03 04:27:45'),
('58d2ce75578d74f355ce07bef237abd9dc7065ce275db13c2722390ccb3426022e3dc5aa462fba68', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:27:50', '2020-06-02 21:27:50', '2021-06-03 04:27:50'),
('9cfb9af0e5a7fc243384672145fc1e36c7cedd57ad35b9af0b3d903b8679c65a7d28deee9753f7b7', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:29:22', '2020-06-02 21:29:22', '2021-06-03 04:29:22'),
('59335bc38e9cb59307e64418e5a67a019f62fe1a6b64c74e996a4bae0b9051afa0d0a3f9e557f0a1', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 21:29:25', '2020-06-02 21:29:25', '2021-06-03 04:29:25'),
('71f66b3adc19abdd764ae05596f3bd86a68eb7cc6c7e751d3f87ba15f223ce11db040ec219402ca0', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:17:14', '2020-06-02 22:17:14', '2020-06-10 05:17:15'),
('53e346c04a35ab8a90f1d12ac589fa5cca482fb4b7a6316e8e456b3239bb294c13d93a6aa32611ce', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:50:58', '2020-06-02 22:50:58', '2021-06-03 05:50:58'),
('c243a5ed353f50de79ec4b5c4824d06a667921215a7d591333400fefab484e71123c709c3d669bc6', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:52:21', '2020-06-02 22:52:21', '2021-06-03 05:52:21'),
('71dfb816192d142c16056ed2544a4b69ce0d889268f72a63d1f3384a9eae750888b1d1d1fa92a244', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:52:30', '2020-06-02 22:52:30', '2021-06-03 05:52:30'),
('94256fe2386471bb3aa1fa9588642a8f3230d3a4c59fa0cb2d45b5a961756853eebc2d8029811178', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:52:53', '2020-06-02 22:52:53', '2021-06-03 05:52:53'),
('65e278728e743af2488571dc972045a0cd5ccda76d8bfca8c428921ccaf35f961f34a0506d25eb5a', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:53:17', '2020-06-02 22:53:17', '2021-06-03 05:53:17'),
('4566dbc0dc23e009bf3366a85d21bc8ca877040cd0d451e322c278516f120849a24485a2d2e01bc0', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:53:21', '2020-06-02 22:53:21', '2021-06-03 05:53:21'),
('a6e1ad72cc436e6bb429bb868e5a3399f918793bbdd8185eb9942469f3b126c4c2d9d38fde3c2fa8', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:53:27', '2020-06-02 22:53:27', '2021-06-03 05:53:27'),
('73149e6e6b1607277164c2ba71636620b0d466c171e99c0cc28a11f3fca943548d10b373ab8edfae', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:53:44', '2020-06-02 22:53:44', '2021-06-03 05:53:44'),
('006c96650e1583b12091c136bc921c2698d185a515dcb774a4c8b023a76a648506d90b5a0c827e10', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:55:14', '2020-06-02 22:55:14', '2021-06-03 05:55:14'),
('e97dc510ed21ffd68bac55bb06eb64f4fd54d6cec21e1a09a9bb0e6791dcc8c689bdf4f93ed19e4e', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:55:34', '2020-06-02 22:55:34', '2021-06-03 05:55:34'),
('1928bb7664d73099e4e91dc590dca9e7767370382ff611b618eb8be3f4403afb3940ab34e7f51f42', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:56:31', '2020-06-02 22:56:31', '2020-06-10 05:56:31'),
('2d9690346b90da7677a63d6182791445a6bfb2273d32a86323ab14ca55f8a56b58e0d9aec766d151', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:56:51', '2020-06-02 22:56:51', '2021-06-03 05:56:51'),
('bd1cf69c0bf27532c4b3c9608822baa193442a3c3d7062b9f2a4a02716f98b8bc8ef3b356f6bb498', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:57:15', '2020-06-02 22:57:15', '2021-06-03 05:57:15'),
('a54d2695e8859c57b1617d0e07660fbc636f317928640857bad16c690ec9ce6d2032d03cd557018c', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:58:14', '2020-06-02 22:58:14', '2021-06-03 05:58:14'),
('5ec903faa8a2f6e33a5f4b41d8cafd85f2ddd06767fb85b0e521df1d77fd825abedb91197a7d5105', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 22:59:34', '2020-06-02 22:59:34', '2021-06-03 05:59:34'),
('10ab30a8397332316f078f31c2a2ad6b670c39d8165f0a8c343ea2f32c86e4269a8d9ec57f9a6e73', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 23:00:57', '2020-06-02 23:00:57', '2021-06-03 06:00:57'),
('680b8ac8eedd3eb0bf14a01e09cbfc08605ad44b2987746cf86c4d9cc3085bc333abf71bdb6ef33c', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 23:06:41', '2020-06-02 23:06:41', '2021-06-03 06:06:41'),
('5bbf62ed32e9a6e2943175fbd646aa0c10d4557490d0ffb2aefb703837bb5eb73ec9fbd917ef683d', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 23:11:15', '2020-06-02 23:11:15', '2021-06-03 06:11:15'),
('7a8bbda970bc478a4dbbaff2cbf0c8361e1ebfc5c7847bb0b1e3ac134e8447e5229eb065fe2e72b6', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 23:17:36', '2020-06-02 23:17:36', '2021-06-03 06:17:36'),
('f61b6b5986ed494ac55012a3e098ef540fd57174934db973e7c5e79291c4903aed691cb3580dae7c', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-02 23:17:52', '2020-06-02 23:17:52', '2021-06-03 06:17:52'),
('a7d308ae23c62b7b76fc3b4ee1816c0e5c197921c1f49e35b4b508b4114ca8b71397b8c52b2930b4', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-03 01:42:33', '2020-06-03 01:42:33', '2021-06-03 08:42:33'),
('017d4a0fb043c4a3b4779c6959bea6e0b28ceeaef4941c35dd0e6de82abe4fd69f9f6d06e033dfde', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-03 01:44:40', '2020-06-03 01:44:40', '2021-06-03 08:44:40'),
('a9ccf1e25c5b50e8d6fd91f442e73c0763da6c889a2abbef0f4e5e0b4a476f2bad8bb4b5a33ff571', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-03 01:45:00', '2020-06-03 01:45:00', '2021-06-03 08:45:00'),
('d4a896400931bc1153dc1e5fbf0562ee7f6cc9859bc20040f81e652940d9469ecc7ffd0fd4620d0c', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-03 20:53:28', '2020-06-03 20:53:28', '2021-06-04 03:53:28'),
('71c339bb100f079fdace1e580a43acc00789b6daaac378950254a0a107a17217e832cbb50c816725', 1, 3, 'Personal Access Token', '[]', 0, '2020-06-07 20:28:54', '2020-06-07 20:28:54', '2020-06-15 03:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth_auth_codes`
--

DROP TABLE IF EXISTS `tbl_oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `tbl_oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth_clients`
--

DROP TABLE IF EXISTS `tbl_oauth_clients`;
CREATE TABLE IF NOT EXISTS `tbl_oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_oauth_clients`
--

INSERT INTO `tbl_oauth_clients` (`id`, `user_id`, `name`, `provider`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '', 'TgallaIZrEO1sXW8c3J4pMTs0mqntkvhN5FbVOWv', 'http://localhost', 1, 0, 0, '2020-05-17 19:44:45', '2020-05-17 19:44:45'),
(2, NULL, 'Laravel Password Grant Client', '', 'q0e0COrnwfJkUyotiyVdtCzD0wRPO7IXTe4zTBNC', 'http://localhost', 0, 1, 0, '2020-05-17 19:44:45', '2020-05-17 19:44:45'),
(3, NULL, 'Laravel Personal Access Client', NULL, '7VIW5QlD0tBTFhNecH1aaxlTgwtT7cOXp1BsHgo2', 'http://localhost', 1, 0, 0, '2020-06-02 18:39:06', '2020-06-02 18:39:06'),
(4, NULL, 'Laravel Password Grant Client', 'users', 'BXiJfn6dCZT6BhWMFqhEOlY6iKuxIzDRozFzZAQy', 'http://localhost', 0, 1, 0, '2020-06-02 18:39:06', '2020-06-02 18:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `tbl_oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `tbl_oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_oauth_personal_access_clients`
--

INSERT INTO `tbl_oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-05-17 19:44:45', '2020-05-17 19:44:45'),
(2, 3, '2020-06-02 18:39:06', '2020-06-02 18:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `tbl_oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `tbl_oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otp`
--

DROP TABLE IF EXISTS `tbl_otp`;
CREATE TABLE IF NOT EXISTS `tbl_otp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_device_id` int(11) NOT NULL,
  `otp_number` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `tbl_user_device_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

DROP TABLE IF EXISTS `tbl_page`;
CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_level` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page_feature`
--

DROP TABLE IF EXISTS `tbl_page_feature`;
CREATE TABLE IF NOT EXISTS `tbl_page_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `feature_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_level` int(3) DEFAULT NULL,
  `tbl_page_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page_permission`
--

DROP TABLE IF EXISTS `tbl_page_permission`;
CREATE TABLE IF NOT EXISTS `tbl_page_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `page_feature_id` int(11) DEFAULT NULL,
  `tbl_page_feature_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_resets`
--

DROP TABLE IF EXISTS `tbl_password_resets`;
CREATE TABLE IF NOT EXISTS `tbl_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

DROP TABLE IF EXISTS `tbl_position`;
CREATE TABLE IF NOT EXISTS `tbl_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modified_by` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`id`, `modified_by`, `name`, `created_at`, `updated_at`) VALUES
(2, 1, 'Position', '2020-05-21 03:45:24', '2020-05-21 03:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE IF NOT EXISTS `tbl_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modified_by` int(4) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `modified_by`, `name`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 'Supper Admin', NULL, '2020-05-21 03:58:58', '2020-05-21 03:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sector`
--

DROP TABLE IF EXISTS `tbl_sector`;
CREATE TABLE IF NOT EXISTS `tbl_sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modified_by` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_sector`
--

INSERT INTO `tbl_sector` (`id`, `modified_by`, `name`, `created_at`, `updated_at`) VALUES
(3, 1, 'Duty', '2020-05-20 08:48:24', '2020-05-20 08:48:24'),
(2, 1, 'Sector 2', '2020-05-20 08:37:19', '2020-05-20 08:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_signature`
--

DROP TABLE IF EXISTS `tbl_signature`;
CREATE TABLE IF NOT EXISTS `tbl_signature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `signature_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(3) NOT NULL,
  `modified_by` int(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taxable_salary`
--

DROP TABLE IF EXISTS `tbl_taxable_salary`;
CREATE TABLE IF NOT EXISTS `tbl_taxable_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxable_salary_monthly_from` float(20,4) NOT NULL,
  `taxable_salary_monthly_to` float(20,4) NOT NULL,
  `rate` int(3) NOT NULL,
  `currency_symbol` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `over_class_tax` float(20,4) NOT NULL,
  `created_by` int(3) NOT NULL,
  `modified_by` int(3) NOT NULL,
  `remark` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_level` int(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_taxable_salary`
--

INSERT INTO `tbl_taxable_salary` (`id`, `taxable_salary_monthly_from`, `taxable_salary_monthly_to`, `rate`, `currency_symbol`, `over_class_tax`, `created_by`, `modified_by`, `remark`, `order_level`, `created_at`, `updated_at`) VALUES
(1, 0.0000, 1000000.0000, 0, '៛', 0.0000, 1, 1, 'Mr', 1, '2020-05-21 05:54:11', '2020-05-21 05:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taxable_salary_history`
--

DROP TABLE IF EXISTS `tbl_taxable_salary_history`;
CREATE TABLE IF NOT EXISTS `tbl_taxable_salary_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxable_salary_monthly_from` float(20,4) NOT NULL,
  `taxable_salary_monthly_to` float(20,4) NOT NULL,
  `rate` int(3) NOT NULL,
  `currency_symbol` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `over_class_tax` float(20,4) NOT NULL,
  `created_by` int(3) NOT NULL,
  `modified_by` int(3) NOT NULL,
  `remark` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_level` int(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_title`
--

DROP TABLE IF EXISTS `tbl_title`;
CREATE TABLE IF NOT EXISTS `tbl_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_by` int(4) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_title`
--

INSERT INTO `tbl_title` (`id`, `name`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 1, '2020-05-21 03:57:03', '2020-05-22 03:00:22'),
(3, 'Mrs', 1, '2020-05-22 03:00:05', '2020-05-22 03:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', 'admin123@admin.com', '$2y$10$8KXjowOKpsVwgF9XiIfIWOMv5CtjVBAg2tw1SSy2JcAyzSkchVbO2', NULL, '2020-05-17 21:28:21', '2020-05-17 21:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_device`
--

DROP TABLE IF EXISTS `tbl_user_device`;
CREATE TABLE IF NOT EXISTS `tbl_user_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `device_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_token` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
